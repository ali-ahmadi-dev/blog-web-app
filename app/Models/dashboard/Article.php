<?php

namespace App\Models\dashboard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    //

    public function category(): BelongsTo
    {

        return $this->belongsTo(Category::class);
    }
}
