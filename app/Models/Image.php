<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Image extends Model
{
    use SoftDeletes;

    public $table = 'images';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'url',
        'title',
        'subtitle',
        'description',
        'url_small',
        'url_medium',
        'position'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'url' => 'string',
        'url_small' => 'string',
        'url_medium' => 'string',
        'title' => 'string',
        'subtitle' => 'string',
        'description' => 'string',
        'position' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'url' => 'required',
        'url_small' => 'required',
        'url_medium' => 'required'
    ];

    public function properties()
    {
        return $this->belongsToMany('App\Models\Property', 'images_properties');
    }
}
