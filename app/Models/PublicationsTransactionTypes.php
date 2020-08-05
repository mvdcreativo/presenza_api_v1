<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PublicationsTransactionTypes extends Pivot
{

    public $incrementing = true;
    protected $with=['currency'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function currency()
    {
        return $this->belongsTo(\App\Models\Currency::class);
    }
}
