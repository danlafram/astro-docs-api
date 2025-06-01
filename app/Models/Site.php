<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Site extends Model
{
    use BelongsToTenant;

    protected $guarded = [];

    /**
     * Get the pages for the site.
     */
    public function pages(): HasMany
    {
        return $this->hasMany(ContentPage::class);
    }

    /**
     * Get the site that owns the page.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
