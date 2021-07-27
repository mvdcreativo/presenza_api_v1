<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Transaction",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_owner_id",
 *          description="user_owner_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_customer_id",
 *          description="user_customer_id",
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
 *          property="transaction_type_id",
 *          description="transaction_type_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          description="value",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="currency_id",
 *          description="currency_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Transaction extends Model
{
    use SoftDeletes;

    public $table = 'transactions';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_owner_id',
        'user_customer_id',
        'property_id',
        'transaction_type_id',
        'value',
        'currency_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_owner_id' => 'integer',
        'user_customer_id' => 'integer',
        'property_id' => 'integer',
        'transaction_type_id' => 'integer',
        'value' => 'float',
        'currency_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userOwner()
    {
        return $this->belongsTo(\App\User::class, 'user_owner_id', 'user_owner');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userCustomer()
    {
        return $this->belongsTo(\App\User::class, 'user_customer_id', 'user_customer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function property()
    {
        return $this->belongsTo(\App\Models\Property::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function transactionType()
    {
        return $this->belongsTo(\App\Models\Transaction_type::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function currency()
    {
        return $this->belongsTo(\App\Models\Currency::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function taxes()
    {
        return $this->belongsToMany(\App\Models\Tax::class);
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
                    ->where('id', "LIKE", '%' . $filter . '%');
                    // ->orWhere('code', "LIKE", '%' . $filter . '%')
                    // ->orWhere('title', "LIKE", '%' . $filter . '%')
                    // ->orWhere('address', "LIKE", '%' . $filter . '%');
            });


        return $query;
    }
}
