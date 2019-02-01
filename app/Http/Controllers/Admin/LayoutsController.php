<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\LayoutService;
use App\Services\LocaleService;
use App\Services\StateService;
use Session;
use Redirect;

class LayoutsController extends Controller
{
    const ENTITY = 'layout';

    protected $layoutservice;
    protected $localeservice;
    protected $state;

    public function __construct(LayoutService $layoutservice, LocaleService $localeservice, StateService $state)
    {
        $this->layoutservice = $layoutservice;
        $this->localeservice = $localeservice;
        $this->state = $state;
    }

    public function index()
    {
        $layouts =  $this->layoutservice->index();

        $locales    = $this->localeservice->index();
        $locale     = Session::get('locale');

        $data = [
            'layouts'   => $layouts->toArray(),
            'locales'   => $locales->toArray(),
            'locale'    => $locale,
            ];
        return view('admin.layouts.index', $data);
    }

    public function new(Request $request)
    {
        try {
            $locales    = $this->localeservice->index();
            $states     = $this->state->index(self::ENTITY);
            $locale     = Session::get('locale');

            if ($request->isMethod('post')) {
                $params     = $request->All();
                $newent    = $this->layoutservice->store($params);
                return Redirect::route('admin.layouts');
            }
            $data = [
                'locales'   => $locales->toArray(),
                'locale'    => $locale,
                'states'    => $states->toArray()
                ];

            return view('admin.layouts', $data);
        } catch (\Exception $e) {
            return view('admin.layouts.forms.new', $data);
        }
    }

    public function edit(Request $request, $id)
    {
        $entity    = $this->layoutservice->show($id);

        $locale     = Session::get('locale');
        $states     = $this->state->index(self::ENTITY);

        if ($request->isMethod('post')) {
            $params     = $request->All();
            unset($params['_token']);
            $newent    = $this->layoutservice->update($id, $params);
            return Redirect::route('admin.layouts');
        }

        $data = [
            'layout'   => $entity->toArray(),
            'locale'   => $locale,
            'states'   => $states->toArray()
            ];
        return view('admin.layouts.forms.edit', $data);
    }
}
