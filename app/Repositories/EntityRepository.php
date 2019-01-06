<?php

namespace App\Repositories;

use App\Models\Entity;
use DB;

class EntityRepository{


    protected $entity;

    public function __construct(Entity $entity){
        $this->entity = $entity;
    }

    public function index(){
        return $this->entity->All();
    }
    
    public function show($id){
        return $this->entity->find($id);
    }

    public function store($params){
        return $this->entity->create($params);
    }

    public function update($id, $params){
        try{
            DB::beginTransaction();
            $ent =  $this->entity->find($id);
            $ent->fill($params);
            $ent->save();
            DB::commit();
            return $ent;
        }catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
    }

}