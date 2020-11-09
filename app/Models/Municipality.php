<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Municipality extends Model
{
    use SoftDeletes;

    public $table = 'municipalities';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'code',
        'city_id',
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
        'code' => 'string',
        'city_id' => 'integer',
        'slug' => 'string',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'city_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function city()
    {
        return $this->belongsTo(\App\Models\City::class)->with('province');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function neighborhoods()
    {
        return $this->hasMany(\App\Models\Neighborhood::class);
    }


    /////////////////////////////
        ///SCOPES
    /////////////////////////////

    public function scopeFilter($query, $filter)
    {
        if($filter)
            return $query
                ->orWhere('name', "LIKE", '%'.$filter.'%')
                ->orWhere('code', "LIKE", '%'.$filter.'%')
                ->orWhere('id', "LIKE", '%'.$filter.'%');
    }
}
