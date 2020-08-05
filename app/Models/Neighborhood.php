<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Neighborhood",
 *      required={"name", "municipality_id"},
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
 *          property="code",
 *          description="code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="municipality_id",
 *          description="municipality_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Neighborhood extends Model
{
    use SoftDeletes;

    public $table = 'neighborhoods';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'code',
        'municipality_id',
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
        'municipality_id' => 'integer',
        'slug' => 'string',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'municipality_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function municipality()
    {
        return $this->belongsTo(\App\Models\Municipality::class)->with('city');
    }

}
