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
        // After this, kickoff the job to add the default theme to this account.
        // Add default theme and then add default pages for that theme. Ideally figure out theme config here too and use that.
    }
}
