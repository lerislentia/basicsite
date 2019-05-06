<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\LocaleService;
use App\Services\StateService;
use App\Services\PageService;
use App\Services\SectionService;
use App\Services\PageSectionService;
use App\Services\SitesService;
use Session;
use Redirect;

class PageSectionController extends Controller
{
    const ENTITY = 'pagesection';

    protected $localeservice;
    protected $pageservice;
    protected $sectionservice;
    protected $pagesectionservice;
    protected $sitesservice;



    public function __construct(
        LocaleService $localeservice,
        PageService $pageservice,
        SectionService $sectionservice,
        PageSectionService $pagesectionservice,
        SitesService $sitesservice
        ) {
        $this->localeservice        = $localeservice;
        $this->pageservice          = $pageservice;
        $this->sectionservice       = $sectionservice;
        $this->pagesectionservice   = $pagesectionservice;
        $this->sitesservice         = $sitesservice;
    }

    public function index()
    {
        $siteactive         = $this->sitesservice->getActiveSite();
        $pages              = $siteactive->pages()->get();
        $sections           = collect();
        $pagesections       = collect();
        foreach($pages as $pagefor){
            $sectionsfor = $pagefor->sections()->get();
            foreach($sectionsfor as $sectionfor){
                if($sectionfor[$sectionfor::FATHER]  == null){
                    $sections->push($sectionfor);
                }
            }
        }

        foreach($sections as $section){
            $pagesectionsfor = $section->pagesections()->get();
            foreach($pagesectionsfor as $pagesectionfor){
                $pagesections->push($pagesectionfor);
            }
            
        }

        // $pages              = $this->pageservice->index();
        // $pagesections   = $this->pagesectionservice->index();
        $locales        = $this->localeservice->index();
        $locale     = Session::get('locale');

        $data = [
            'sections'      => $sections->toArray(),
            'pages'         => $pages->toArray(),
            'pagesections'  => $pagesections->toArray(),
            'locales'       => $locales->toArray(),
            'locale'        => $locale,
            ];
        return view('admin.pagesections.index', $data);
    }

    public function new(Request $request)
    {
        $sections           = $this->sectionservice->getParents();
        $pages              = $this->pageservice->index();
        $locales        = $this->localeservice->index();
        $locale     = Session::get('locale');

        if ($request->isMethod('post')) {
            $params     = $request->Only('section_id', 'page_id', 'order');
            $newent    = $this->pagesectionservice->store($params);
            return Redirect::route('admin.sectionpages');
        }

        $data = [
            'sections'      => $sections->toArray(),
            'pages'         => $pages->toArray(),
            'locales'       => $locales->toArray(),
            'locale'        => $locale,
            ];
        return view('admin.pagesections.forms.new', $data);
    }

    public function edit(Request $request, $id)
    {
        $currentpagesection     = $this->pagesectionservice->show($id);
        $sections           = $this->sectionservice->getParents();
        $pages              = $this->pageservice->index();
        $locales        = $this->localeservice->index();
        $locale     = Session::get('locale');

        if ($request->isMethod('post')) {
            $params     = $request->Only('section_id', 'page_id', 'order');
            $updated    = $this->pagesectionservice->update($id, $params);
            return Redirect::route('admin.sectionpages');
        }

        $data = [
            'currentpagesection'    => $currentpagesection->toArray(),
            'sections'          => $sections->toArray(),
            'pages'             => $pages->toArray(),
            'locales'           => $locales->toArray(),
            'locale'            => $locale,
            ];
        return view('admin.pagesections.forms.edit', $data);
    }

    public function delete(Request $request, $id)
    {
        $this->pagesectionservice->delete($id);
        return Redirect::route('admin.sectionpages');
    }

    public function order(Request $request)
    {
        $params     = $request->All();
        $this->pagesectionservice->order($params);
    }
}
