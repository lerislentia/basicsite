<?php

namespace App\Services;

use App\Repositories\EntityStateRepository;

class EntityStateService{

    protected $entitistaterepository;

    public function __construct(EntityStateRepository $entitistaterepository){
        $this->entitistaterepository = $entitistaterepository;
    }

    public function index($entity = null){
        return $this->entitistaterepository->index($entity)->get();
    }

    public function store($params){
        return $this->entitistaterepository->store($params);
    }
}