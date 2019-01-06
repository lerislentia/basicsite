<?php


namespace App\Services;

use App\Services\BaseService;

use App\Repositories\AdminRepository;

use App\Services\CategoryService;

class AdminService extends BaseService{

    protected $adminRepository;
    protected $categorie;

    public function __construct(AdminRepository $adminRepository, CategoryService $categorie){
        $this->adminRepository = $adminRepository;
        $this->categorie = $categorie;
    }

    public function index(){
        $categories =  $this->categorie->index();
        return $categories;
    }
}