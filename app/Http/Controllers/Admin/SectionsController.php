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
use DB;

class SectionsController extends Controller
{
    const ENTITY = 'element';

    protected $sectionservice;
    protected $localeservice;
    protected $typeservice;
    protected $entitystate;

    public function __construct(
            SectionService $sectionservice,
            EntityStateService $entitystate,
            TypeService $typeservice,
            LocaleService $localeservice
            ) {
        $this->sectionservice   = $sectionservice;
        $this->entitystate      = $entitystate;
        $this->typeservice      = $typeservice;
        $this->localeservice    = $localeservice;
    }

    public function index()
    {
        $sections   = $this->sectionservice->getParentsWithChildrensTree();

        $locales    = $this->localeservice->index();
        $locale     = Session::get('locale');

        $data = [
            'sections'   => $sections->toArray(),
            'locales'   => $locales->toArray(),
            'locale'    => $locale,
            ];
        return view('admin.sections.index', $data);
    }

    public function new(Request $request)
    {
        try {
            $sections           = $this->sectionservice->getParents();
            $types              = $this->typeservice->index(self::ENTITY);
            $entitystates       = $this->entitystate->index(self::ENTITY);
            $locale             = Session::get('locale');

            if ($request->isMethod('post')) {
                $params         = $request->All();
                $newsection   = $this->sectionservice->create($params);
                if ($newsection) {
                    return Redirect::route('admin.sections');
                }
            }

            $data = [
                'secti'         => null,
                'sections'      => $sections->toArray(),
                'types'         => $types->toArray(),
                'entitystates'  => $entitystates->toArray(),
                'locale'        => Session::get('locale')
            ];

            return view('admin.sections.forms.new', $data);
        } catch (\Throwable $e) {
            return view('admin.sections.forms.new', $data);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $sections           = $this->sectionservice->getParents();
            $section            = $this->sectionservice->show($id);
            // $elements           = $this->elementservice->index();
            $types              = $this->typeservice->index(self::ENTITY);
            // $entitytypes        = $this->entitytype->index(self::ENTITY);
            $entitystates             = $this->entitystate->index(self::ENTITY);
            $locale             = Session::get('locale');

            if ($request->isMethod('post')) {
                $params         = $request->All();
                $section        = $this->sectionservice->update($id, $params);
            }

            $data = [
            'currentsection'       => $section->toArray(),
            'sections'      => $sections->toArray(),
            'types'         => $types->toArray(),
            'states'        => $entitystates->toArray(),
            'locale'        => Session::get('locale')
        ];

            return view('admin.sections.forms.edit', $data);
        } catch (\Throwable $e) {
            return view('admin.sections.forms.edit', $data);
        }
    }

    public function delete(Request $request, $id)
    {
        $this->sectionservice->delete($id);
        return Redirect::route('admin.sections');
    }


    public function editProperties(Request $request, int $id)
    {
        try {
            $locale             = Session::get('locale');

            $section    = $this->sectionservice->show($id);

            if (!$section) {
                throw new \Exception("no se encontro el sectiono en la base de datos");
            }

            if ($request->isMethod('post')) {
                try {
                    DB::beginTransaction();
                    $params = $request->all();
                    unset($params['_token']);
                    $obj    = json_encode($params);
                    $section->data = json_encode($params);
                    $section->save();
                    DB::commit();
                    return Redirect::route('admin.sections');
                } catch (\Exception $e) {
                    DB::rollback();
                    throw new Exception($e->getMessage());
                }
            }

            $type = $section->type()->first();

            $definition = isset($type->definition) ? $type->definition : null;

            if (!$definition) {
                throw new \Exception("error en type : {$id}, el campo 'definition' no esta informado");
            }

            $view = "properties.{$definition}.forms.edit";

            $data = [
            'section'       => $section->toArray(),
            'locale'        => Session::get('locale')
        ];

            return view($view, $data);
        } catch (\Exception $e) {
            $request->session()->flash('message', $e->getMessage());
            return Redirect::route('admin.sections');
        }
    }
}
