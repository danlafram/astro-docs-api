<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = Tenant::take(1)->first();
        
        Theme::create([
            'name' => 'default',
            'is_active' => true,
            'tenant_id' => $tenant->id
        ]);

        Theme::create([
            'name' => 'discovery',
            'is_active' => false,
            'tenant_id' => $tenant->id
        ]);
    }
}
