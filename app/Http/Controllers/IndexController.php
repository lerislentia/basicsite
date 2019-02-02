<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\SectionService;
use App\Services\StateService;
use App\Services\LocaleService;
use App\Services\CategoryService;
use App\Services\StructureService;
use App\Services\LayoutService;

use App\Models\Section;
use App\Models\Categorie;
use Illuminate\Support\Facades\Cache;
use Config;

class IndexController extends Controller
{
    protected $sectionservice;
    protected $stateservice;
    protected $localeservice;
    protected $categoryservice;
    protected $structureservice;
    protected $layoutsservice;

    public function __construct(
        StateService $stateservice,
        SectionService $sectionservice,
        CategoryService $categoryservice,
        StructureService $structureservice,
        LayoutService $layoutsservice
        ) {
        $this->stateservice     = $stateservice;
        $this->sectionservice   = $sectionservice;
        $this->categoryservice  = $categoryservice;
        $this->structureservice = $structureservice;
        $this->layoutsservice   = $layoutsservice;
    }
    public function index()
    {
        $content = Cache::get('home');
        if ($content) {
            return $content;
        }

        $sections = $this->sectionservice->getParents();

        // $htmlsections = $this->structureservice->parseSections($sections);

        $htmlsections = $this->structureservice->parse($sections);

        $categories = $this->categoryservice->getParents();

        $data = [
            'categories'    => $categories->toArray(),
            'sections'      => $htmlsections,
        ];
        $view =  view('home', $data);
        $content = $view->render();
        Cache::put('home', $content, 1);
        return $content;
    }
}
