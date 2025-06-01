<?php

namespace App\Actions\Fortify;

use App\Models\Site;
use App\Models\Team;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // TODO: Validate the site name input
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) use ($input) {
                $this->createTeam($user, $input);
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user, array $input): void
    {
        // Tenant will likely already exist here, but there is a chance it doesn't.
        // Check to see if a tenant exists.
        // If a site exists, a tenant then has to exist. Both get created during initial indexing process.
        // We set the cloud ID so if its set there should be a site.
        if(isset($input['cloud_id'])) {
            $site = Site::where('cloud_id', '=', $input['cloud_id'])->first();

            $createdTeam = $user->ownedTeams()->save(Team::forceCreate([
                'user_id' => $user->id,
                'name' => $input['site'], // TODO: validate site input
                'personal_team' => true,
            ]));
    
            // Tenant will already be created here... so find it using cloud_id?
            $cloud_id = $input['cloud_id'];
    
            $site = Site::where('cloud_id', '=', $cloud_id)->first();
    
            $site->tenant->team_id = $user->currentTeam->id;
            $site->tenant->save();
        } else {
            // Don't create  site or tenant. Let the indexing flow handle it.
            // TODO: Maybe prompt the UI to index or show documenation to do the indexing.
            // TODO: How are we going to associate the tenant with the team if someone starts here?
            $createdTeam = $user->ownedTeams()->save(Team::forceCreate([
                'user_id' => $user->id,
                'name' => $input['site'], // TODO: validate site input
                'personal_team' => true,
            ]));
        }
        // TODO:
        // After this, kickoff the job to add the default theme to this account.
        // Add default theme and then add default pages for that theme. Ideally figure out theme config here too and use that.
    }
}
