<?php

namespace App\Services;

use App\Repositories\TypeRepository;

class TypeService
{
    protected $typerepository;

    public function __construct(TypeRepository $typerepository)
    {
        $this->typerepository = $typerepository;
    }

    public function index($entity = null)
    {
        return $this->typerepository->index($entity)->get();
    }

    public function update($id, $params)
    {
        return $this->typerepository->update($id, $params);
    }

    public function show($id)
    {
        return $this->typerepository->show($id);
    }
    public function store($params)
    {
        return $this->typerepository->store($params);
    }
}
