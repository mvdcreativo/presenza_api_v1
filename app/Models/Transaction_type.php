<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaction_type extends Model
{
    use SoftDeletes;

    public $table = 'transaction_types';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
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
        return $this->belongsToMany(\App\Models\Publication::class,'publications_transaction_types' )
        ->using(\App\Models\PublicationsTransactionTypes::class)
        ->withPivot('price','currency_id');
    }


    /////////////////////////////
    ///SCOPES
    /////////////////////////////

    public function scopeFilter($query, $filter)
    {
        if ($filter)
            return $query
                ->orWhere('name', "LIKE", '%' . $filter . '%');
    }

}
