<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\LocaleService;
use App\Services\TypeService;
use Session;
use Redirect;
use DB;

class TypeController extends Controller
{
    protected $typeservice;
    protected $localeservice;

    public function __construct(TypeService $typeservice, LocaleService $localeservice)
    {
        $this->localeservice    = $localeservice;
        $this->typeservice      = $typeservice;
    }

    public function index()
    {
        $types      = $this->typeservice->index();
        $locales    = $this->localeservice->index();
        $locale     = Session::get('locale');

        $data = [
            'types'     => $types->toArray(),
            'locales'   => $locales->toArray(),
            'locale'    => $locale
            ];
        return view('admin.types.index', $data);
    }

    public function new(Request $request)
    {
        try {
            $locales    = $this->localeservice->index();
            $locale     = Session::get('locale');

            if ($request->isMethod('post')) {
                $params     = $request->All();
                $newtype    = $this->typeservice->store($params);
                return Redirect::route('admin.types');
            }
            $data = [
                'locales'   => $locales->toArray(),
                'locale'    => $locale
                ];

            return view('admin.types.forms.new', $data);
        } catch (\Exception $e) {
            return view('admin.types.forms.new', $data);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $type           = $this->typeservice->show($id);
            $types          = $this->typeservice->index();
            $locales        = $this->localeservice->index();
            $locale         = Session::get('locale');

            if ($request->isMethod('post')) {
                $params     = $request->All();
                $type       = $this->typeservice->update($id, $params);
            }
            $data = [
                'type'     => $type->toArray(),
                'types'    => $types->toArray(),
                'locales'   => $locales->toArray(),
                'locale'    => $locale
                ];
            DB::commit();
            return view('admin.types.forms.edit', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return view('admin.types.forms.edit', $data);
        }
    }
}
