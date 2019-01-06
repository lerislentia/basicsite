<?php

namespace App\Services;

use App\Repositories\EntityRepository;

class EntityService{

    protected $entityrepository;

    public function __construct(EntityRepository $entityrepository){
        $this->entityrepository = $entityrepository;
    }

    public function index(){
        return $this->entityrepository->index();
    }

    public function show($id){
        return $this->entityrepository->show($id);
    }
    public function store($params){
        return $this->entityrepository->store($params);
    }
    
}