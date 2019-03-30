<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\LocaleService;
use Session;
use Redirect;

class LocalesController extends Controller
{
    protected $localeservice;

    public function __construct(LocaleService $localeservice)
    {
        $this->localeservice = $localeservice;
    }

    public function index()
    {
        $locales    = $this->localeservice->index();
        $locale     = Session::get('locale');
        $data = [
            'locales'   => $locales->toArray(),
            'locale'    => $locale,
            ];
        return view('admin.locales.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $locale    = $this->localeservice->show($id);
        $locales    = $this->localeservice->index();

        if ($request->isMethod('post')) {
            $params     = $request->All();
            $newloc     = $this->localeservice->update($id, $params);
            return Redirect::route('admin.locales');
        }

        $data = [
            'locale'   => $locale->toArray(),
            'locales'   => $locales->toArray()
            ];
        return view('admin.locales.forms.edit', $data);
    }

    public function new(Request $request)
    {
        $locales    = $this->localeservice->index();
        if ($request->isMethod('post')) {
            $params     = $request->All();
            $newloc     = $this->localeservice->store($params);
            return Redirect::route('admin.locales');
        }
        $data = [
            'locales'   => $locales->toArray(),
            ];
        return view('admin.locales.forms.new', $data);
    }
}
