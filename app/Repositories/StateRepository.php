<?php

namespace App\Repositories;

use DB;
use App\Repositories\BaseRepository;

use App\Models\State;

class StateRepository extends BaseRepository{

    protected $state;

    public function __construct(State $state){
        $this->state = $state;
    }

    public function index(){
        return $this->state->All();
    }
    

    public function update($id, $params){
        try{
            DB::beginTransaction();

            $stat =  $this->state->find($id);

            /**
             * name
             */
            $name       = $stat->textName()->first();
            if(!$name){
                $name   = $stat->textName()->create();
            }
            $name->save();
            $nparams = [
                'text' 		=> $params['name'],
                'locale_id'	=> $params['locale'],
                'text_id'	=> $name->id
            ];

            $translation 						= $name->translations()->where('locale_id', '=', $nparams['locale_id'])->first();
            if(!$translation){
                $translation 					= $name->translations()->create($nparams);
            }else{
                $translation->fill($nparams);
            }
            $translation->save();

            $statparams = [
                'name'          => $name->id,
            ];

            $stat->fill($statparams);
            $stat->save();
            DB::commit();
            return $stat;
        }catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function show($id){
        return $this->state->find($id);
    }

    public function store($params){
        return $this->state->create($params);
    }
}