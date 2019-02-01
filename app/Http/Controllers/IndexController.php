<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\SectionService;
use App\Services\StateService;
use App\Services\LocaleService;
use App\Services\CategoryService;
use App\Services\StructureService;

use App\Models\Section;
use App\Models\Categorie;

class IndexController extends Controller
{
    protected $sectionservice;
    protected $stateservice;
    protected $localeservice;
    protected $categoryservice;
    protected $structureservice;

    public function __construct(
        StateService $stateservice, 
        SectionService $sectionservice, 
        CategoryService $categoryservice,
        StructureService $structureservice
        )
    {
        $this->stateservice     = $stateservice;
        $this->sectionservice   = $sectionservice;
        $this->categoryservice  = $categoryservice;
        $this->structureservice    = $structureservice;
    }
    public function index()
    {
        // $sections = $this->sectionservice->index();

        $state = $this->stateservice->show(2);

        $sections = $this->sectionservice->getParents();

        // $htmlsections = $this->structureservice->parseSections($sections);

        $htmlsections = $this->structureservice->parse($sections);

        $categories = $this->categoryservice->getParents();

        $data = [
            'categories'    => $categories->toArray(),
            'sections'      => $htmlsections,
        ];
        return view('home', $data);
    }
}
