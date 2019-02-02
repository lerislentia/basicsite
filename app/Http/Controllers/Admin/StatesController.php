<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\LocaleService;
use App\Services\StateService;
use Session;

class StatesController extends Controller
{
    protected $stateservice;
    protected $localeservice;

    public function __construct(StateService $stateservice, LocaleService $localeservice)
    {
        $this->localeservice = $localeservice;
        $this->stateservice = $stateservice;
    }

    public function index()
    {
        $states = $this->stateservice->index();
        $locales = $this->localeservice->index();
        $locale             = Session::get('locale');
        // dd($categories->toArray());
        $data = [
            'states'    => $states->toArray(),
            'locales'   => $locales->toArray(),
            'locale'    => $locale
            ];
        return view('admin.states.index', $data);
    }

    public function new()
    {
    }

    public function edit(Request $request, $id)
    {
        try {
            $state          = $this->stateservice->show($id);
            $states         = $this->stateservice->index();
            $locales        = $this->localeservice->index();
            $locale         = Session::get('locale');

            if ($request->isMethod('post')) {
                $params     = $request->All();
                $state      = $this->stateservice->update($id, $params);
            }
            $data = [
                'state'     => $state->toArray(),
                'states'    => $states->toArray(),
                'locales'   => $locales->toArray(),
                'locale'    => $locale
                ];

            return view('admin.states.forms.edit', $data);
        } catch (\Exception $e) {
            return view('admin.states.forms.edit', $data);
        }
    }
}
