<?php

namespace App\Models;

use DateTime;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpensesPropertiesUsers extends Model
{
    public $table = 'expenses_properties_users';

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'user_id',
        'property_id',
        'currency_id',
        'expense_id',
        'value'
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'property_id'=> 'integer',
        'currency_id' => 'integer',
        'expense_id' => 'integer',
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
    public function currency()
    {
        return $this->belongsTo(\App\Models\Currency::class);
    }

    public function property()
    {
        return $this->belongsTo(\App\Models\Property::class);
    }


    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function expense()
    {
        return $this->belongsTo(\App\Models\Expense::class);
    }




    //////SCOPES

    public function scopeBy_user($query, $user_id)
    {

        if($user_id){
            $result = $query->whereHas('users', function($q) use($user_id) {
                $q
                ->where('user_id', $user_id);
            });

            return $result;

        }
        return $query;

    }


    public function scopeFilter($query, $filter)
    {
        if($filter){
            
            $query->whereHas('user', function($q) use($filter) {
                $q
                ->where('name', "LIKE", '%' . $filter . '%');
            });
    
            $query->orWhereHas('property', function($q) use($filter) {
                $q
                ->where('title', "LIKE", '%' . $filter . '%')
                ->orWhere('address', "LIKE", '%' . $filter . '%');
            });
            $query->orWhereHas('expense', function($q) use($filter) {
                $q
                ->where('name', "LIKE", '%' . $filter . '%');
            });

            if(DateTime::createFromFormat('d/m/Y', $filter)){
                $dateLocale = DateTime::createFromFormat('d/m/Y', $filter);

                $query->orWhereDate('created_at', $dateLocale->format('Y-m-d'));
            }

            $query->orWhereMonth('created_at', $filter );
            $query->orWhereDay('created_at',  $filter );
            $query->orWhereYear('created_at',  $filter );

            return $query;

        }
        return $query;

                

    }
}
