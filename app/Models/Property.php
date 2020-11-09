<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    public $table = 'properties';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'code',
        'address',
        'description',
        'status_id',
        'property_type_id',
        'neighborhood_id',
        'latitude',
        'longitude',
        'user_owner_id',
        'slug',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'address',
        'code' => 'string',
        'status_id' => 'integer',
        'property_type_id' => 'integer',
        'neighborhood_id' => 'integer',
        'latitude' => 'string',
        'longitude' => 'string',
        'user_owner_id' => 'integer',
        'slug' => 'string',
        'expenses_aprox' => 'float'

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'title' => 'required',
        // 'status_id' => 'required',
        // 'property_type_id' => 'required',
        // 'neighborhood_id' => 'required'
    ];

    /////////////////////////
    ///RELACIONES
    /////////////////////////
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function propertyType()
    {
        return $this->belongsTo(\App\Models\Property_type::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function neighborhood()
    {
        return $this->belongsTo(\App\Models\Neighborhood::class)->with('municipality');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userOwner()
    {
        return $this->belongsTo(\App\User::class);
    }


    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'images_properties')->orderBy('position', 'ASC');
    }

    public function publication()
    {
        return $this->hasOne('App\Models\Publication');
    }

    public function features()
    {
        return $this->belongsToMany('App\Models\Feature', 'features_properties')->with('feature')->withPivot('value');
    }

    public function expenses_properties_user()
    {
        return $this->hasMany(\App\Models\ExpensesPropertiesUsers::class);
    }
    /////////////////////////////
    ///SCOPES
    /////////////////////////////

    public function scopeFilter($query, $filter)
    {
        if ($filter)
            return $query
                ->orWhere('title', "LIKE", '%' . $filter . '%')
                ->orWhere('address', "LIKE", '%' . $filter . '%')
                ->orWhere('code', "LIKE", '%' . $filter . '%');
    }

    public function scopeFilterFeatures($query, $filterKey, $filterValue)
    {
        if ($filterKey)
            return $query->whereHas('features', function (Builder $q) use ($filterKey, $filterValue) {
                if (!$filterValue || $filterValue === true) {
                    $q->where('slug', $filterKey);
                } else {
                    $q->where('slug', $filterKey)
                        ->where('value', $filterValue);
                }
            });
    }

    public function scopeFilterState($query, $filter)
    {
        if ($filter)
            return $query->whereHas('neighborhood', function (Builder $q) use ($filter) {
                $q->whereHas('municipality', function (Builder $qcity) use ($filter) {
                    $qcity->whereHas('city', function (Builder $qstate) use ($filter) {
                        $qstate->where('province_id', $filter);
                    });
                });
            });
    }

    public function scopeFilterCity($query, $filter)
    {
        if ($filter)
            return $query->whereHas('neighborhood', function (Builder $q) use ($filter) {
                $q->whereHas('municipality', function (Builder $qcity) use ($filter) {
                    $qcity->where('city_id', $filter);
                });
            });
    }
    public function scopeFilterMunicipality($query, $filter)
    {
        if ($filter)
            return $query->whereHas('neighborhood', function (Builder $q) use ($filter) {
                    $q->where('municipality_id', $filter);
            });
    }

    public function scopeFilterNeighborhood($query, $filter)
    {
        // print_r($filter);
        if ($filter)
            foreach ($filter as $key => $value) {
                if ($key === 0) {
                    $query->where('neighborhood_id', $value);
                }else{
                    $query->orWhere('neighborhood_id', $value);
                }
            }
        return $query;
    }

    public function scopeFilterPropertyType($query, $filter)
    {
        // print_r($filter);
        if ($filter)

            return $query->where('property_type_id', $filter->id);

    }
}
