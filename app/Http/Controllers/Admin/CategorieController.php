<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\CategoryService;
use App\Services\EntityStateService;
use App\Services\LocaleService;
use App\Services\SectionService;
use App;
use Redirect;
use Throwable;
use Session;

class CategorieController extends Controller
{
    const ENTITY = 'category';

    protected $categorie;
    protected $entitystate;
    protected $localeservice;
    protected $sectionservice;

    public function __construct(
        CategoryService $categorie,
        EntityStateService $entitystate,
        LocaleService $localeservice,
        SectionService $sectionservice
            ) {
        $this->categorie        = $categorie;
        $this->entitystate      = $entitystate;
        $this->localeservice    = $localeservice;
        $this->sectionservice   = $sectionservice;
    }

    public function index()
    {
        $categories = $this->categorie->index();

        $locales = $this->localeservice->index();
        // $locale             = Session::get('locale');
        $locale             = App::getLocale();

        $data = [
            'categories'    => $categories->toArray(),
            'locales'       => $locales->toArray(),
            'locale'        => $locale,
            ];

        return view('admin.categories.index', $data);
    }

    public function new(Request $request)
    {
        try {
            $categories         = $this->categorie->getParents();
            $states             = $this->entitystate->index(self::ENTITY);
            $locale             = Session::get('locale');

            $data = [
                'categorie'     => null,
                'categories'    => $categories->toArray(),
                'states'        => $states->toArray(),
                'locale'        => Session::get('locale')
            ];

            if ($request->isMethod('post')) {
                $params         = $request->All();
                $newcategorie   = $this->categorie->create($params);
                if ($newcategorie) {
                    return Redirect::route('admin.categories');
                }
            }

            // dd($data);
            return view('admin.categories.forms.new', $data);
        } catch (\Throwable $e) {
            return view('admin.categories.forms.new', $data);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $currentcategorie          = $this->categorie->findBy(['id' => $id]);

            $categories         = $this->categorie->getParents();
            $sections           = $this->sectionservice->index();
            $states             = $this->entitystate->index(self::ENTITY);
            // $locale             = Session::get('locale');
            $locale             = App::getLocale();

            if ($request->isMethod('post')) {
                $params                 = $request->All();
                $currentcategorie       = $this->categorie->update($id, $params);
                return Redirect::route('admin.categories');
            }
            // dd($sections->toArray());
            $data = [
            'currentcategorie'  => $currentcategorie->toArray(),
            'categories'        => $categories->toArray(),
            'sections'          => $sections->toArray(),
            'states'            => $states->toArray(),
            'locale'            => $locale
        ];

            return view('admin.categories.forms.edit', $data);
        } catch (\Throwable $e) {
            return view('admin.categories.forms.edit', $data);
        }
    }
}
