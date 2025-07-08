<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function index()
    {
        $domain = tenant()->domains()->first();

        // TODO: Check if the domain is custom, and maybe display the status of it.
        return view('admin.domain.domain')->with('domain', $domain);
    }

    public function confirm(Request $request)
    {
        // We will probably need some rules here on subdomains
        $subdomain = $request->input('subdomain');

        // If we pass verification, show the confirmation screen
        return view('admin.domain.confirm')->with('subdomain', $subdomain);

    }

    public function update(Request $request)
    {
        // Make the API call to cloudflare here https://developers.cloudflare.com/api/resources/custom_hostnames/

        // If failed, display a message.
        $subdomain = $request->input('subdomain');
        $domain = tenant()->domains()->first();
        $domain->domain = $subdomain;
        $domain->save();

        return redirect()->route('domain'); // view('admin.domain.domain')->with('domain', $domain);
    }
}
