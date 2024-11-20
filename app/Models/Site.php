<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    protected $guarded = [];

    /**
     * Get the pages for the site.
     */
    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }
}
