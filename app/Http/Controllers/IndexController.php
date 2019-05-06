<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\SectionService;
use App\Services\PageService;
use App\Services\StateService;
use App\Services\LocaleService;
use App\Services\CategoryService;
use App\Services\StructureService;
use App\Services\LayoutService;
use App\Services\SitesService;

use App\Models\Section;
use App\Models\Categorie;
use Illuminate\Support\Facades\Cache;
use Session;
use Config;
use Storage;
use App;
use Redirect;

class IndexController extends Controller
{
    protected $sectionservice;
    protected $pageservice;
    protected $stateservice;
    protected $localeservice;
    protected $categoryservice;
    protected $structureservice;
    protected $layoutsservice;
    protected $sitesservice;

    public function __construct(
        StateService $stateservice,
        SectionService $sectionservice,
        PageService $pageservice,
        LocaleService $localeservice,
        CategoryService $categoryservice,
        StructureService $structureservice,
        LayoutService $layoutsservice,
        SitesService $sitesservice
        ) {
        $this->stateservice     = $stateservice;
        $this->sectionservice   = $sectionservice;
        $this->pageservice      = $pageservice;
        $this->localeservice    = $localeservice;
        $this->categoryservice  = $categoryservice;
        $this->structureservice = $structureservice;
        $this->layoutsservice   = $layoutsservice;
        $this->sitesservice     = $sitesservice;
    }
    public function index(Request $request, $locale = null, $pagename = null)
    {
        try {
            if (!$pagename) {
                $pagename = 'index';
            }

            $cacheon = Config::get('app.default.CONTENT_CACHE');

            if ($cacheon) {
                $content = Cache::get($pagename);
                if ($content) {
                    return $content;
                }
            }

            $locales    = $this->localeservice->index();
            if ($locale) {
                // $locale     = Session::get('locale');
                \App::setlocale($locale);
                Session(['locale' => $locale]);
            } else {
                $locale = \App::getlocale();
                return Redirect()->route('home', ['locale' => $locale, 'pagename' => $pagename]);
            }

            $site       = $this->sitesservice->getActiveSite();

            if (!$site) {
                throw new \Exception('no sites active available');
            }

            $pages      = $site->pages()->get();

            foreach ($pages as $pagefor) {
                if ($pagefor[$pagefor::NAME] == $pagename) {
                    $page = $pagefor;
                }
            }

            // $page       = $this->pageservice->getByName($pagename, $locale);

            if (!$page) {
                return abort(404);
            }
            $pagesections       = $page->pagesections()->get();
            $sections           = [];
            foreach ($pagesections as $pagesection) {
                $sections[$pagesection[$pagesection::ORDER]] =  $pagesection->section()->first();
            }


            // dd($sections->toArray());
            $htmlelements   = $this->structureservice->parse($sections, [], $locale);

            $categories     = $this->categoryservice->getParents();

            $activelayout   = $this->structureservice->getLayout();

            $data = [
            'categories'        => $categories->toArray(),
            'elements'          => $htmlelements,
            'locales'           => $locales->toArray(),
            'locale'            => $locale
        ];

            $view =  view("layouts/{$activelayout->name}/home", $data);

            $content = $view->render();

            $generateon = Config::get('app.default.GENERATE_HTML');
            // $replaceurl = Config::get('app.default.GENERATE_BASEURL');
            // $replaceurl = Config::get('app.default.GENERATE_BASEURL');
            $baseurl = Config::get('app.url');
            if ($generateon) {
                $savecontent = str_replace($baseurl, $site[$site::URL], $content);
                if ($locale == App::getlocale()) {
                    Storage::put($pagename.".html", $savecontent);
                }
                Storage::put("{$locale}/".$pagename.".html", $savecontent);
            }

            if ($cacheon) {
                Cache::put($pagename, $content, 1);
            }
            return $content;
        } catch (\Exception $e) {
            $ddd = $e->getMessage();
        }
    }
}
