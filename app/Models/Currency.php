<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Currency",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="symbol",
 *          description="symbol",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          description="value",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="string"
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
class Currency extends Model
{
    use SoftDeletes;

    
    public $table = 'currencies';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'symbol',
        'value',
        'status',
        'slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'symbol' => 'string',
        'value' => 'float',
        'status' => 'string',
        'slug' => 'string',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function transactions()
    {
        return $this->hasMany(\App\Models\Transaction::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function publications()
    {
        return $this->hasMany(\App\Models\Publication::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function expenses_properties_user()
    {
        return $this->hasMany(\App\Models\ExpensesPropertiesUsers::class);
        
    }

        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function publications_transaction_types()
    {
        return $this->hasMany(\App\Models\PublicationsTransactionTypes::class);
    }
}
