<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Property",
 *      required={"title", "status_id", "property_type_id", "neighborhood_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status_id",
 *          description="status_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="property_type_id",
 *          description="property_type_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="neighborhood_id",
 *          description="neighborhood_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="latitude",
 *          description="latitude",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="longitude",
 *          description="longitude",
 *          type="string"
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
        'user_customer_id',
        'slug'
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
        'user_customer_id' => 'integer',
        'slug' => 'string',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'status_id' => 'required',
        'property_type_id' => 'required',
        'neighborhood_id' => 'required'
    ];

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
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userCustomer()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'images_properties');
    }

    public function publications()
    {
        return $this->hasMany('App\Models\Publication');
    }

    public function features()
    {
        return $this->belongsToMany('App\Models\Feature', 'features_properties')->with('feature')->withPivot('value');
    }
}
