<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;
use PHPageBuilder\Contracts\PageContract;
use PHPageBuilder\Contracts\PageTranslationContract;
use App\Services\PageRepository; // This is causing problems

class PageTranslation extends Model implements PageTranslationContract
{
    use HasFactory, BelongsToTenant;
    
    /**
     * Return the page this translation belongs to.
     *
     * @return PageContract
     */
    public function getPage()
    {
        $foreignKey = phpb_config('page.translation.foreign_key');
        return (new PageRepository)->findWithId($this->{$foreignKey});
    }
}
