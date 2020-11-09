<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Image",
 *      required={"url"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="url",
 *          description="url",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="subtitle",
 *          description="subtitle",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
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
