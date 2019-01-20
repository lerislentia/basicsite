<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ElementsService;
use App\Services\SectionService;
use App\Services\EntityStateService;
use App\Services\EntityTypeService;
use App\Services\TypeService;
use App\Services\LocaleService;
use Session;
use Redirect;
use DB;

class ElementsController extends Controller
{
    const ENTITY = 'element';

    public function __construct(
        ElementsService $elementsservice,
        SectionService $sectionsservice,
        EntityStateService $entitystate,
        EntityTypeService $entitytype,
        LocaleService $localeservice
        ) {
        $this->elementsservice  = $elementsservice;
        $this->sectionsservice  = $sectionsservice;
        $this->entitystate      = $entitystate;
        $this->entitytype       = $entitytype;
        $this->localeservice    = $localeservice;
    }

    public function index()
    {
        $elements   =  $this->elementsservice->index();


        $locales    = $this->localeservice->index();
        $locale     = Session::get('locale');

        $data = [
            'elements'   => $elements->toArray(),
            'locales'   => $locales->toArray(),
            'locale'    => $locale,
            ];
        return view('admin.elements.index', $data);
    }

    public function new(Request $request)
    {
        try {
            $sections           = $this->sectionsservice->index();
            $entitystates       = $this->entitystate->index(self::ENTITY);
            $entitytypes        = $this->entitytype->index(self::ENTITY);
            $locale             = Session::get('locale');



            if ($request->isMethod('post')) {
                $params         = $request->All();
                $newelement     = $this->elementsservice->create($params);
                if ($newelement) {
                    return Redirect::route('admin.elements');
                }
            }

            $data = [
                'secti'         => null,
                'sections'      => $sections->toArray(),
                'entitytypes'   => $entitytypes->toArray(),
                'entitystates'  => $entitystates->toArray(),
                'locale'        => Session::get('locale')
            ];

            return view('admin.elements.forms.new', $data);
        } catch (\Throwable $e) {
            return view('admin.elements.forms.new', $data);
        }
    }
}
