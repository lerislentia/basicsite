<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\LocaleService;
use App\Services\SitesService;
use Session;
use Redirect;
use DB;

class SitesController extends Controller
{
    protected $sitesservice;
    protected $localeservice;

    public function __construct(SitesService $sitesservice, LocaleService $localeservice)
    {
        $this->localeservice    = $localeservice;
        $this->sitesservice      = $sitesservice;
    }

    public function index()
    {
        $sites      = $this->sitesservice->index();
        $locales    = $this->localeservice->index();
        $locale     = Session::get('locale');

        $data = [
            'sites'     => $sites->toArray(),
            'locales'   => $locales->toArray(),
            'locale'    => $locale
            ];
        return view('admin.sites.index', $data);
    }

    public function new(Request $request)
    {
        try {
            $locales    = $this->localeservice->index();
            $locale     = Session::get('locale');

            if ($request->isMethod('post')) {
                $params     = $request->All();
                $newtype    = $this->sitesservice->store($params);
                return Redirect::route('admin.sites');
            }
            $data = [
                'locales'   => $locales->toArray(),
                'locale'    => $locale
                ];

            return view('admin.sites.forms.new', $data);
        } catch (\Exception $e) {
            return view('admin.sites.forms.new', $data);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $site           = $this->sitesservice->show($id);
            $sites          = $this->sitesservice->index();
            $locales        = $this->localeservice->index();
            $locale         = Session::get('locale');

            if ($request->isMethod('post')) {
                $params     = $request->All();
                $type       = $this->sitesservice->update($id, $params);
            }
            $data = [
                'site'     => $site->toArray(),
                'sites'    => $sites->toArray(),
                'locales'   => $locales->toArray(),
                'locale'    => $locale
                ];
            DB::commit();
            return view('admin.sites.forms.edit', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return view('admin.sites.forms.edit', $data);
        }
    }
}
