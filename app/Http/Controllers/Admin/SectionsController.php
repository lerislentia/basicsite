<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\SectionService;
use App\Services\TypeService;
use App\Services\LocaleService;
use App\Services\EntityStateService;
use App\Models\Section;
use Session;
use Redirect;

class SectionsController extends Controller
{

    const ENTITY = 'section';

    protected $sectionservice;
    protected $localeservice;
    protected $typeservice;
    protected $entitystate;

    public function __construct(
            SectionService $sectionservice, 
            EntityStateService $entitystate, 
            TypeService $typeservice, 
            LocaleService $localeservice
            ){
        $this->sectionservice   = $sectionservice;
        $this->entitystate      = $entitystate;
        $this->typeservice      = $typeservice;
        $this->localeservice    = $localeservice;        
    }

    public function index(){
        $sections   = $this->sectionservice->index();

        $locales    = $this->localeservice->index();
        $locale     = Session::get('locale');

        $data = [
            'sections'   => $sections->toArray(),
            'locales'   => $locales->toArray(),
            'locale'    => $locale,
            ];
        return view('admin.sections.index', $data);
    }

    public function new(Request $request){
        try{
            
            $sections   = $this->sectionservice->index();
            $types          = $this->typeservice->index();
            $states             = $this->entitystate->index(self::ENTITY);
            $locale             = Session::get('locale');

            if ($request->isMethod('post')) {
                $params         = $request->All();
                $newsection   = $this->sectionservice->create($params);
                if($newsection){
                    return Redirect::route('admin.sections');
                }
            }

            $data = [
                'secti'         => null,
                'sections'      => $sections->toArray(),
                'types'         => $types->toArray(),
                'states'        => $states->toArray(),
                'locale'        => Session::get('locale')
            ];

            return view('admin.sections.forms.new', $data);
        }catch(\Throwable $e){
            return view('admin.sections.forms.new', $data);
        }
    }

    public function edit(Request $request, $id){

        try{
        $section            = $this->sectionservice->show($id);
        $types          = $this->typeservice->index();
        $states             = $this->entitystate->index(self::ENTITY);
        $locale             = Session::get('locale');

        if ($request->isMethod('post')) {
            $params         = $request->All();
            $section      = $this->sectionservice->update($id, $params);
        }

        $data = [
            'section'       => $section->toArray(),
            'types'         => $types->toArray(),
            'states'        => $states->toArray(),
            'locale'        => Session::get('locale')
        ];

        return view('admin.sections.forms.edit', $data);
        }catch(\Throwable $e){
            return view('admin.sections.forms.edit', $data);
        }
    }
}
