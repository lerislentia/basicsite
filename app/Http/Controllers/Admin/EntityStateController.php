<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EntityStateService;
use App\Services\EntityService;
use App\Services\StateService;
use App\Services\LocaleService;
use Session;
use Redirect;

class EntityStateController extends Controller
{
    protected $entitystateservice;

    public function __construct(
            EntityStateService $entitystateservice,
            EntityService $entityservice,
            StateService $stateservice,
            LocaleService $localeservice
            ) {
        $this->entitystateservice   = $entitystateservice;
        $this->localeservice        = $localeservice;
        $this->entityservice        = $entityservice;
        $this->stateservice          = $stateservice;
    }

    public function index()
    {
        $entitystates   = $this->entitystateservice->index();
        $locale         = Session::get('locale');
        $data = [
            'entitystates'  => $entitystates->toArray(),
            'locale'        => $locale,
            ];
        return view('admin.entitystates.index', $data);
    }

    public function new(Request $request)
    {
        try {
            $locales    = $this->localeservice->index();
            $entities   = $this->entityservice->index();
            $states     = $this->stateservice->index();
            $locale     = Session::get('locale');

            if ($request->isMethod('post')) {
                $params     = $request->Only('entity_id', 'state_id');
                $newent    = $this->entitystateservice->store($params);
                return Redirect::route('admin.entitystates');
            }
            $data = [
                'entities'  => $entities->toArray(),
                'states'    => $states->toArray(),
                'locales'   => $locales->toArray(),
                'locale'    => $locale
                ];

            return view('admin.entitystates.forms.new', $data);
        } catch (\Exception $e) {
            return view('admin.entitystates.forms.new', $data);
        }
    }

    public function edit(Request $request, $code){
        $dd = $code;
    }
}
