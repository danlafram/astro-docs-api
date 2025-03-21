<?php

namespace App\Http\Controllers;

use App\Models\Page;
use DirectoryIterator;
use Illuminate\Http\Request;

use \App\Services\PageRepository;

// TODO - Extract the page repository to be initiated on the controller
// TODO - Validate all of the request inputs
class PageController extends Controller
{
    public function index()
    {
        $pages = Page::where('tenant_id', '=', tenant()->id)->get();

        // Currently, just display the themes that are in the folder. Eventually, this will have to be database driven.
        $themes = $this->getThemes();

        return view('admin.themes')->with('pages', $pages)->with('themes', $themes);
    }

    /**
     * This function handles the ability to publish to different themes that are uploaded to a tenant's account.
     * TODO: Maybe have a "Confirm" screen just to make sure what they are doing is intentional.
     */
    public function publish(string $theme)
    {
        $domain = tenant()->domain()->first();
        $domain->active_theme = $theme;
        $domain->save();
        return redirect()->route('theme')->with('success', 'Theme published successfully');
    }

    public function create()
    {
        // At some point, we'll likely need to move these to S3 under an account prefix
        $layouts = $this->getLayouts();

        return view('admin.pages.new')->with('layouts', $layouts);
    }

    public function store(Request $request)
    {
        // TODO - Validation for the request
        $pageRepository = new PageRepository;
        
        $success = $pageRepository->create([
            'name' => $request->input('name'),
            'layout' => $request->input('layout'),
            'title' => $request->input('title'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'route' => $request->input('route'),
            'tenant_id' => tenant()->getTenantKey(),
        ]);

        if($success) {
            return redirect()->route('theme')->with('success', '');
        } else {
            return redirect()->route('theme')->with('error', '');
        }
        
    }

    public function edit(string $id)
    {
        $page = Page::find($id);

        $layouts = $this->getLayouts();

        return view('admin.pages.edit')->with('page', $page)->with('layouts', $layouts);
    }

    public function update(Request $request, string $id)
    {
        $pageRepository = new PageRepository;
        $page = $pageRepository->findWithId($id);

        $success = $pageRepository->update($page, [
            'name' => $request->input('name'),
            'layout' => $request->input('layout'),
            'title' => $request->input('title'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'route' => $request->input('route'),
            'tenant_id' => tenant()->getTenantKey(),
        ]);

        if($success) {
            return redirect()->route('theme')->with('success', 'Page updated successfully');
        } else {
            return redirect()->route('theme')->with('fail', 'Unable to update page');
        } 
    }

    public function duplicate(string $id)
    {
        $pageRepository = new PageRepository;

        $page = $pageRepository->findWithId($id);

        return view('admin.pages.duplicate')->with('page', $page);
    }

    public function clone(Request $request, string $id)
    {
        $pageRepository = new PageRepository;

        $page = Page::find($id);

        if(!is_null($page)){
            $success = $pageRepository->createWithData([
                'name' => $request->input('name'),
                'layout' => $page['layout'],
                'title' => array('en' => $page->getTranslation('title')),
                'meta_title' => array('en' => $page->getTranslation('meta_title')),
                'meta_description' => array('en' => $page->getTranslation('meta_description')),
                'route' => array('en' => $page->getRoute()),
                'configuration_id' => $page->configuation_id,
                'tenant_id' => tenant()->getTenantKey(),
                'data' => $page->get('data'),
            ]);
    
            if($success) {
                return redirect()->route('theme')->with('success', '');
            } else {
                return redirect()->route('theme')->with('error', '');
            }
        }
        

        
    }

    public function delete(string $id)
    {
        $pageRepository = new PageRepository;
        $page = $pageRepository->findWithId($id);
        return view('admin.pages.delete')->with('page', $page);
    }

    public function destroy(string $id)
    {
        $pageRepository = new PageRepository;
        $success = $pageRepository->destroy($id);

        if($success) {
            return redirect()->route('theme')->with('success', 'Page deleted successfully');
        } else {
            return redirect()->route('theme')->with('fail', 'Unable to delete page');
        }
    }

    private function getLayouts()
    {
        $layouts = [];
        $theme = tenant()->domain()->first()->active_theme;
        if (file_exists(base_path() . '/themes/' . $theme . '/layouts')) {
            $layoutsDirectory = new DirectoryIterator(base_path() . '/themes/' . $theme . '/layouts');
            foreach ($layoutsDirectory as $entry) {
                if ($entry->isDir() && ! $entry->isDot()) {
                    array_push($layouts, $entry->getFilename());
                }
            }
        }

        return $layouts;
    }

    private function getThemes()
    {
        $themes = [];
        if (file_exists(base_path() . '/themes')) {
            $layoutsDirectory = new DirectoryIterator(base_path() . '/themes');
            foreach ($layoutsDirectory as $entry) {
                if ($entry->isDir() && ! $entry->isDot()) {
                    array_push($themes, $entry->getFilename());
                }
            }
        }

        return $themes;
    }

    /**
     * This function serves to give dynamic data to the 'listing' page based on the current URL/route
     * Called from the blocks/listing-details/views.php
     * TODO: Test this with Tenancy. Likely some changes needed to query on 'tenant_id'
     */
    // public static function getListingData(string $url)
    // {
    //     if(str_contains($url, '/listing/')){
    //         $configuration_id = last(explode('-', $url));

    //         if(!is_null($configuration_id)){
    //             $configuration = Configuration::where([
    //                 ['id', '=', $configuration_id],
    //                 ['tenant_id', '=', tenant()->id]
    //                 ])->first();
    //             return $configuration;
    //         }
    //     } else if(str_contains($url, '/build')){
    //         $configuration = Configuration::select()->first();
    //         return $configuration;
    //     }
    // }

    // // Implement pagination as well using url/query params
    // public static function getListings()
    // {
    //     // Paginate value could be configurable at some point
    //      $configurations = Configuration::where('tenant_id', '=', tenant()->id)->get();

    //      return $configurations;
    // }
}


