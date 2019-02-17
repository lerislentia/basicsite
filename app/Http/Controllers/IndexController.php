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

use App\Models\Section;
use App\Models\Categorie;
use Illuminate\Support\Facades\Cache;
use Session;
use Config;


class IndexController extends Controller
{
    protected $sectionservice;
    protected $pageservice;
    protected $stateservice;
    protected $localeservice;
    protected $categoryservice;
    protected $structureservice;
    protected $layoutsservice;

    public function __construct(
        StateService $stateservice,
        SectionService $sectionservice,
        PageService $pageservice,
        CategoryService $categoryservice,
        StructureService $structureservice,
        LayoutService $layoutsservice
        ) {
        $this->stateservice     = $stateservice;
        $this->sectionservice   = $sectionservice;
        $this->pageservice      = $pageservice;
        $this->categoryservice  = $categoryservice;
        $this->structureservice = $structureservice;
        $this->layoutsservice   = $layoutsservice;
    }
    public function index(Request $request, $pagename = null)
    {
        $cacheon = Config::get('app.default.CONTENT_CACHE');

        if($cacheon){
            $content = Cache::get($pagename);
            if ($content) {
                return $content;
            }
        }
        if(!$pagename){
            $pagename = 'inicio';
        }
        
        $locale     = Session::get('locale');
        $page       = $this->pageservice->getByName($pagename, $locale);

        if(!$page){
            return abort(404);
        }
        $sections       = $page->sections()->get();

        $htmlsections   = $this->structureservice->parse($sections);

        $categories     = $this->categoryservice->getParents();

        $data = [
            'categories'    => $categories->toArray(),
            'sections'      => $htmlsections,
        ];
        $view =  view('home', $data);
        $content = $view->render();

        if($cacheon){
            Cache::put($pagename, $content, 1);
        }
        return $content;
    }
}
