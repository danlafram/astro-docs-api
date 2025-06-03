<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    public function index()
    {
        $tenant = tenant();

        $themes = Theme::where('tenant_id', '=', $tenant->id)->get();

        $pages = Page::where('tenant_id', '=', $tenant->id)
            ->where('theme_id', '=', $tenant->domain()->first()->theme_id)
            ->get();

        return view('admin.themes')->with('pages', $pages)->with('themes', $themes);
    }

    // Not ready for this yet
    // public function new()
    // {
    //     // dd(storage_path());
    //     // Get a path for a directory
    //     // Copy a basic theme folder into that directory
    //     // Publish the theme
    //     // dd(storage_path());
        
    //     $createDirectory = Storage::makeDirectory('/themes/test-s3-tenant'); // returns true/false not the actual directory...
    //     if($createDirectory){
    //         $directory = Storage::disk('s3')->url('/tenant-' . tenant()->id . '/themes/'. 'test-s3-tenant');
    //         logger($directory);
    //         logger(__DIR__.'/../../../themes/discovery');
    //         $res = File::copyDirectory(__DIR__.'/../../../themes/discovery', $directory); // TOOD: Find destination directory somehow...
    //         dd($res);
    //     }
    //     // $themePath = base_path(config('pagebuilder.theme.folder_url') .'/'. 'test-theme');
    //     // File::copyDirectory(__DIR__.'/../../../themes/discovery', 'test-s3-tenant'); // TOOD: Find destination directory somehow...

    //     // $themeName = $this->argument('name');
    //     // $themePath = base_path(config('pagebuilder.theme.folder_url').'/'.$themeName);
    //     // File::copyDirectory(__DIR__.'/../../themes/stub', $themePath);
    //     // Artisan::call('pagebuilder:publish-theme', ['theme' => $themeName]);
    // }

    /**
     * This function handles the ability to publish to different themes that are uploaded to a tenant's account.
     * TODO: Maybe have a "Confirm" screen just to make sure what they are doing is intentional.
     */
    public function publish($theme_id)
    {
        // Set active false on active theme
        $current_active_theme = Theme::find(tenant()->domain()->first()->theme_id);
        $current_active_theme->is_active = false;
        $current_active_theme->save();

        // Set it on the domain
        $domain = tenant()->domain()->first();
        $domain->theme_id = $theme_id;
        $domain->save();

        // Then set active true new theme
        $new_active_theme = Theme::find($theme_id);
        $new_active_theme->is_active = true;
        $new_active_theme->save();

        return redirect()->route('theme')->with('success', 'Theme published successfully');
    }
}
