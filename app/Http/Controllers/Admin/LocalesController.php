<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\LocaleService;
use Session;

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

    public function edit($id)
    {
        $locale    = $this->localeservice->show($id);
        $data = [
            'locale'   => $locale->toArray(),
            ];
        return view('admin.locales.forms.edit', $data);
    }
}
