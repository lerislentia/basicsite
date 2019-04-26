<?php

namespace App\Services;

use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Repositories\ProductsRepository;

class ProductsService extends BaseService{

    protected $productsrepository;
    public function __construct(ProductsRepository $productsrepository){
        $this->productsrepository = $productsrepository;
    }

    public function index(){
        return $this->productsrepository->index();
    }

    public function show($id){
        return $this->productsrepository->show($id);
    }

    public function create($params)
    {
        return $this->productsrepository->store($params);
    }

    public function update($id, $params)
    {
        return $this->productsrepository->update($id, $params);
    }

    public function findBy($params)
    {
        return $this->productsrepository->findBy($params)->first();
    }
}