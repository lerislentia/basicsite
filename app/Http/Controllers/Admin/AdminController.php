<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\SectionService;
use App\Services\StateService;
use App\Services\LocaleService;
use App\Services\CategoryService;
use App\Services\AdminService;

use App\Models\Section;
use App\Models\Categorie;
use Session;

class AdminController extends Controller
{
    protected $adminservice;
    protected $localeservice;

    public function __construct(
        AdminService $adminservice,
        LocaleService $localeservice
        ) {
        $this->adminservice     = $adminservice;
        $this->localeservice    = $localeservice;
    }

    public function index()
    {
        $categories = $this->adminservice->index();

        $locales    = $this->localeservice->index();

        $locale     = Session::get('locale');

        $data = [
            'categories'    => $categories->toArray(),
            'locales'       => $locales->toArray(),
            'locale'        => $locale
        ];
        return view('admin.main', $data);
    }
}
