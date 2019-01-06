<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\CategoryRepository;

class CategoryService extends BaseService
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return $this->category->index();
    }

    public function store($params)
    {
        return $this->category->store($params);
    }

    public function update($id, $params)
    {
        return $this->category->update($id, $params);
    }

    public function findBy($params)
    {
        return $this->category->findBy($params)->first();
    }

    public function getParents()
    {
        return $this->category->findBy(['parent_id' => null])->get();
    }

    public function create($params)
    {
        return $this->category->store($params);
    }
}
