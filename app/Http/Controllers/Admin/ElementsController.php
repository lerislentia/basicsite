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

    protected $elementsservice;
    protected $sectionsservice;
    protected $entitystate;
    protected $entitytype;
    protected $typeservice;
    protected $localeservice;

    public function __construct(
        ElementsService $elementsservice,
        SectionService $sectionsservice,
        EntityStateService $entitystate,
        EntityTypeService $entitytype,
        TypeService $typeservice,
        LocaleService $localeservice
        ) {
        $this->elementsservice  = $elementsservice;
        $this->sectionsservice  = $sectionsservice;
        $this->entitystate      = $entitystate;
        $this->entitytype       = $entitytype;
        $this->typeservice       = $typeservice;
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
            $types        = $this->typeservice->index(self::ENTITY);
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
                'types'         => $types->toArray(),
                'entitystates'  => $entitystates->toArray(),
                'locale'        => Session::get('locale')
            ];

            return view('admin.elements.forms.new', $data);
        } catch (\Throwable $e) {
            return view('admin.elements.forms.new', $data);
        }
    }

    public function edit(){

    }

    public function editProperties(Request $request, int $id){
        try{

        $locale             = Session::get('locale');
        
        $element    = $this->elementsservice->show($id);

        if(!$element){
            throw new \Exception("no se encontro el elemento en la base de datos");
        }

        if ($request->isMethod('post')) {
            try{
                DB::beginTransaction();
                $params = $request->all();
                unset($params['_token']);
                $obj    = json_encode($params);
                $element->data = json_encode($params);
                $element->save();
                DB::commit();
                return Redirect::route('admin.elements');
            }catch(\Exception $e){
                DB::rollback();               
                throw new Exception($e->getMessage());
            }
            
        }

        $type = $element->type()->first();

        $definition = isset($type->definition) ? $type->definition : null;

        if(!$definition){
            throw new \Exception("error en type : {$id}, el campo 'definition' no esta informado");
        }

        $view = "definitions.{$definition}.forms.edit";

        $data = [
            'element'       => $element->toArray(),
            'locale'        => Session::get('locale')
        ];

        return view($view, $data);

        }catch(\Exception $e){
            $request->session()->flash('message', $e->getMessage());
            return Redirect::route('admin.elements');
        }

    }
}
