<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    protected $guarded = [];

    /**
     * Get the site that owns the page.
     */
    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
