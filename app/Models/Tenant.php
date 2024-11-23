<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Stancl\Tenancy\Database\Models\Domain;

class Tenant extends BaseTenant
{
    use HasDomains;

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
}