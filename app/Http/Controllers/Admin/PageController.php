<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\LocaleService;
use App\Services\StateService;
use App\Services\PageService;
use Session;
use Redirect;

class PageController extends Controller
{
    const ENTITY = 'page';

    protected $localeservice;
    protected $pageservice;

    public function __construct(
        LocaleService $localeservice,
        StateService $stateservice,
        PageService $pageservice
            ) {
        $this->localeservice    = $localeservice;
        $this->stateservice      = $stateservice;
        $this->pageservice      = $pageservice;
    }

    public function index()
    {
        $pages      = $this->pageservice->index();

        $locales    = $this->localeservice->index();

        $locale     = Session::get('locale');

        $data = [
            'pages'     => $pages->toArray(),
            'locales'   => $locales->toArray(),
            'locale'    => $locale,
            ];
        return view('admin.pages.index', $data);
    }

    public function new(Request $request)
    {
        try {
            $states       = $this->stateservice->index(self::ENTITY);
            $locale             = Session::get('locale');

            if ($request->isMethod('post')) {
                $params         = $request->All();
                $newpage        = $this->pageservice->create($params);
                if ($newpage) {
                    return Redirect::route('admin.pages');
                }
            }

            $data = [
                'page'          => null,
                'states'        => $states->toArray(),
                'locale'        => Session::get('locale')
            ];

            return view('admin.pages.forms.new', $data);
        } catch (\Throwable $e) {
            return view('admin.pages.forms.new', $data);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            // $section           = $this->sectionsservice->getParents();
            $page            = $this->pageservice->show($id);

            $stateservices             = $this->stateservice->index(self::ENTITY);
            $locale             = Session::get('locale');

            if ($request->isMethod('post')) {
                $params         = $request->All();
                $page        = $this->pageservice->update($id, $params);
            }

            $data = [
            'currentpage'   => $page->toArray(),
            // 'sections'      => $sections->toArray(),
            'states'        => $stateservices->toArray(),
            'locale'        => Session::get('locale')
        ];

            return view('admin.pages.forms.edit', $data);
        } catch (\Throwable $e) {
            return view('admin.pages.forms.edit', $data);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $deleted            = $this->pageservice->delete($id);
            if ($deleted) {
                return Redirect::route('admin.pages');
            }
        } catch (\Throwable $e) {
            return Redirect::route('admin.pages.edit', ['id' => $id]);
        }
    }
}
