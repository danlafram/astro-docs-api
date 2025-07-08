<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthTenantMiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if(isset($user)){
            $tenant = Tenant::find($user->currentTeam->tenant->id);
            tenancy()->initialize($tenant);
        } else {
            logger("Issue with AuthTenantMiddlware");
            return redirect('/');
        }
 
        return $next($request);
    }
}
