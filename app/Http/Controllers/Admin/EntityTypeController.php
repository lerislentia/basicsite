<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EntityTypeService;
use App\Services\EntityService;
use App\Services\TypeService;
use App\Services\LocaleService;
use Session;
use Redirect;

class EntityTypeController extends Controller
{
    protected $entitytypeservice;

    public function __construct(
            EntityTypeService $entitytypeservice,
            EntityService $entityservice,
            TypeService $typeservice,
            LocaleService $localeservice
            ) {
        $this->entitytypeservice    = $entitytypeservice;
        $this->localeservice        = $localeservice;
        $this->entityservice        = $entityservice;
        $this->typeservice          = $typeservice;
    }

    public function index()
    {
        $entitytypes   = $this->entitytypeservice->index();
        $locale         = Session::get('locale');
        $data = [
            'entitytypes'  => $entitytypes->toArray(),
            'locale'        => $locale,
            ];
        return view('admin.entitytypes.index', $data);
    }

    public function new(Request $request)
    {
        try {
            $locales    = $this->localeservice->index();
            $entities   = $this->entityservice->index();
            $types     = $this->typeservice->index();
            $locale     = Session::get('locale');

            if ($request->isMethod('post')) {
                $params     = $request->Only('entity_id', 'type_id');
                $newent    = $this->entitytypeservice->store($params);
                return Redirect::route('admin.entitytypes');
            }
            $data = [
                'entities'  => $entities->toArray(),
                'types'     => $types->toArray(),
                'locales'   => $locales->toArray(),
                'locale'    => $locale
                ];

            return view('admin.entitytypes.forms.new', $data);
        } catch (\Exception $e) {
            return view('admin.entitytypes.forms.new', $data);
        }
    }

    public function edit(Request $request, $code)
    {
        $dd = $code;
    }
}
