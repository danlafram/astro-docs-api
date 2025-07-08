<?php

namespace Database\Seeders;

use App\Models\Site;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;

class DomainTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);
        
        // Create the tenant
        $tenant = Tenant::create();

        // Store the site with any additional details provided
        $site = Site::create([
            'site_name' => 'testing-site',
            'cloud_id' => $faker->uuid(),
            'site_url' => $faker->url(),
            'installer_account_id' => $faker->uuid(),
            'owner_account_id' => $faker->uuid(),
            'index' => 'test_index',
            'tenant_id' => $tenant->id,
            'space_id' => 'test_space_id',
        ]);

        $tenant->domains()->create(['domain' => 'testing-site' . '.' . config('app.suffix_domain')]);

        // Associate with a Team/User
        $user = User::take(1)->first(); // Just assume its the first for these test scripts. Make this better later.

        $tenant->team_id = $user->currentTeam->id;
        
        $tenant->save();
    }
}
