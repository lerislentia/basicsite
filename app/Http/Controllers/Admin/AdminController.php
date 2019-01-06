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

class AdminController extends Controller
{
    protected $adminservice;

    public function __construct(AdminService $adminservice)
    {
        $this->adminservice = $adminservice;
    }

    public function index()
    {
        $categories = $this->adminservice->index();
        // dd($categories->toArray());
        $data = [
            'categories' => $categories->toArray()
        ];
        return view('admin.main', $data);
    }
}
