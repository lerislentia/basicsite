<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EntityService;
use App\Services\LocaleService;
use Session;
use Redirect;

class EntityController extends Controller
{
    protected $entityservice;
    protected $localeservice;

    public function __construct(EntityService $entityservice, LocaleService $localeservice)
    {
        $this->entityservice = $entityservice;
        $this->localeservice = $localeservice;
    }

    public function index()
    {
        $entities =  $this->entityservice->index();

        $locales    = $this->localeservice->index();
        $locale     = Session::get('locale');

        $data = [
            'entities'   => $entities->toArray(),
            'locales'   => $locales->toArray(),
            'locale'    => $locale,
            ];
        return view('admin.entities.index', $data);
    }

    public function new(Request $request)
    {
        try {
            $locales    = $this->localeservice->index();
            $locale     = Session::get('locale');

            if ($request->isMethod('post')) {
                $params     = $request->All();
                $newent    = $this->entityservice->store($params);
                return Redirect::route('admin.entities');
            }
            $data = [
                'locales'   => $locales->toArray(),
                'locale'    => $locale
                ];

            return view('admin.entities.forms.new', $data);
        } catch (\Exception $e) {
            return view('admin.entities.forms.new', $data);
        }
    }

    public function edit($id)
    {
        $entity    = $this->entityservice->show($id);

        $locale     = Session::get('locale');

        $data = [
            'entity'   => $entity->toArray(),
            'locale'   => $locale,
            ];
        return view('admin.entities.forms.edit', $data);
    }
}
