<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Publication extends Model
{
    use SoftDeletes;

    public $table = 'publications';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'property_id',
        'status_id',
        'currency_id',
        'price',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'property_id' => 'integer',
        'status_id' => 'integer',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'property_id' => 'required',
        'status_id' => 'required',

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function property()
    {
        return $this->belongsTo(\App\Models\Property::class)->with('images', 'neighborhood', 'features', 'propertyType', 'videos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function transaction_types()
    {
        return $this->belongsToMany(\App\Models\Transaction_type::class, 'publications_transaction_types')
            ->using(\App\Models\PublicationsTransactionTypes::class)
            ->withPivot('price', 'currency_id');
    }



    /////////////////////////////
    ///SCOPES
    /////////////////////////////

    public function scopeFilter($query, $filter)
    {
        if ($filter)
            $query
            ->whereHas('property', function ($q) use ($filter) {
                $q
                    ->where('id', "LIKE", '%' . $filter . '%')
                    ->orWhere('code', "LIKE", '%' . $filter . '%')
                    ->orWhere('title', "LIKE", '%' . $filter . '%')
                    ->orWhere('address', "LIKE", '%' . $filter . '%');
            });


        return $query;
    }

    public function scopeFilter_status_id($query, $filter)
    {
        if ($filter){
            return $query->where('status_id', $filter);

        }


        return $query;
    }

    public function scopeActive($query, $filter)
    {
        if ($filter){

            return $query->where('status_id', 8)
            ->whereHas('property', function ($q) {
                $q->where('status_id', 1);

            });

        }


        return $query;
    }



    public function scopeFilter_params($query, $filter)
    {

        if ($filter) {
            $parametersDecode = json_decode($filter);
            ////////////////////////////////////////////////////////////////////////////////////
            /////////  compruebo los parametros que llegan a que tipo de busqueda corresponden;
            /////////   los que no corresponden a FEATURES los separo y los elimino del arreglo que llega "$parametersDecode"
            /////////   ejecuta filtro correspondiente
            ////////////////////////////////////////////////////////////////////////////////////
            //por precio
            if($parametersDecode){
                if ($parametersDecode->price) {
                    $price = $parametersDecode->price;
                    unset($parametersDecode->price);
                    $query->whereHas('transaction_types', function ($q) use ($price) {
                        if(!$price->from) $price->from = 0;
                        if(!$price->to ) $price->to = 10000000000;
                        $q->where('price', '>=' ,$price->from)
                        ->where('price', '<=', $price->to);
                    });
                }
                //por tipo de propiedad
                if (isset($parametersDecode->propertyType)) {
                    $propertyType = $parametersDecode->propertyType;
                    unset($parametersDecode->propertyType);
                    $query->whereHas('property', function ($q) use ($propertyType) {
                        $q->filterPropertyType($propertyType);

                    });
                }
                //por tipo de transacción
                if (isset($parametersDecode->propertyStatus)) {
                    $propertyStatuses = $parametersDecode->propertyStatus;
                    unset($parametersDecode->propertyStatus);
                    foreach ($propertyStatuses as $key => $propertyStatus) {
                        if($key === 0){
                            $query->whereHas('transaction_types', function ($q) use ($propertyStatus) {
                                $q->where('transaction_type_id', $propertyStatus->id);

                            });
                        }else{
                            $query->whereHas('transaction_types', function ($q) use ($propertyStatus) {
                                $q->orWhere('transaction_type_id', $propertyStatus->id);

                            });
                        }
                    }
                    return $query;

                }

                //por ubicación
                if (isset($parametersDecode->state)
                    || isset($parametersDecode->city)
                    || isset($parametersDecode->municipality)
                    || isset($parametersDecode->neighborhood))
                {
                    if(isset($parametersDecode->state)){
                        $state = $parametersDecode->state;
                        unset($parametersDecode->state);
                        $query->whereHas('property', function ($q) use ($state) {
                            $q->filterState($state);

                        });
                    }
                    if(isset($parametersDecode->city)){
                        $city = $parametersDecode->city;
                        unset($parametersDecode->city);
                        $query->whereHas('property', function ($q) use ($city) {
                            $q->filterCity($city);

                        });
                    }
                    if(isset($parametersDecode->municipality)){
                        $municipality = $parametersDecode->municipality;
                        unset($parametersDecode->municipality);
                        $query->whereHas('property', function ($q) use ($municipality) {
                            $q->filterMunicipality($municipality);

                        });
                    }

                    if(isset($parametersDecode->neighborhood)) {
                        $neighborhood = $parametersDecode->neighborhood;
                        unset($parametersDecode->neighborhood);
                        $query->whereHas('property', function ($q) use ($neighborhood) {
                            $q->filterNeighborhood($neighborhood);

                        });
                    }
                }
                ///////////////////////////////////////////////////////////////////////////

                ///////////////////////////////////////////////////////////////////////////
                ///////ejecuto los filtros de Features
                //////////////////////////////////////////////////////////////////////////
                //filtra por caracteristicas ( features )
                foreach ($parametersDecode as $key => $value) {
                       $query->whereHas('property', function ($q) use ($key,$value) {
                           $q->filterFeatures($key,$value);
                       });
                }






            }

            return $query;
        }
        return $query;

        // return $query;
    }
}
