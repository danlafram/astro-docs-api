<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function show($cloud_id)
    {
        // Check if there is a user/team associated with this account first, and maybe display login page.
        // If no associated account (first time joining) then display register
        $site = Site::where('cloud_id', '=', $cloud_id)->first();

        if(isset($site)){
            // Check if the site has a user associated with it already
            // Do this by checking for a team
            if($site->tenant->team){
                return redirect('/login');
            }
            return view('auth.register')->with('site_name', $site->site_name)->with('cloud_id', $cloud_id);
        } else {
            return view('auth.register');
        }
    }
}
