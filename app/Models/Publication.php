<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @SWG\Definition(
 *      definition="Publication",
 *      required={"property_id", "status_id", "transaction_type_id", "currency_id", "price"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="property_id",
 *          description="property_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="status_id",
 *          description="status_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="transaction_type_id",
 *          description="transaction_type_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="currency_id",
 *          description="currency_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="price",
 *          description="price",
 *          type="number",
 *          format="number"
 *      )
 * )
 */
class Publication extends Model
{
    use SoftDeletes;

    public $table = 'publications';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'property_id',
        'status_id',
        'currency_id',
        'price'
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
        return $this->belongsTo(\App\Models\Property::class)->with('images','neighborhood','features','propertyType');
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
            ->withPivot('price','currency_id');
    }


}