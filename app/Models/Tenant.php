<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Stancl\Tenancy\Database\Models\Domain;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tenant extends BaseTenant
{
    use HasDomains;

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'team_id',
        ];
    }

    public function domain(): HasOne
    {
        return $this->hasOne(Domain::class, 'tenant_id');
    }

    /**
     * Get the pages for the site.
     */
    public function site(): HasOne
    {
        return $this->hasOne(Site::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}