<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Expense extends Model
{
    use SoftDeletes;

    public $table = 'expenses';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];



    public function expenses_properties_user()
    {
        return $this->hasMany(\App\Models\ExpensesPropertiesUsers::class);
        
    }


/////////////////////////////
    ///SCOPES
/////////////////////////////

    public function scopeFilter($query, $filter)
    {
        if($filter)
            return $query
                ->where('name', "LIKE", '%'.$filter.'%');

    }




}
