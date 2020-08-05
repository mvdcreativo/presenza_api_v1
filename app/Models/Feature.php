<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Feature",
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
 *          property="feature_id",
 *          description="feature_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="string"
 *      )
 * )
 */
class Feature extends Model
{
    use SoftDeletes;

    public $table = 'features';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'feature_id',
        'type',
        'slug',
        'icon'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'feature_id' => 'integer',
        'type' => 'string',
        'slug' => 'string',
        'icon' => 'string',

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
    public function feature()
    {
        return $this->belongsTo(\App\Models\Feature::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function features()
    {
        return $this->hasMany(\App\Models\Feature::class);
    }

    public function properties()
    {
        return $this->belongsToMany('App\Models\Property', 'features_properties')->withPivot('value');
    }
}
