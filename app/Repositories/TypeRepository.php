<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;

use App\Models\Type;
use DB;

class TypeRepository extends BaseRepository{

    protected $type;

    public function __construct(Type $type){
        $this->type = $type;
    }

    public function index(){
        return $this->type->All();
    }

    public function show($id){
        return $this->type->find($id);
    }

    public function store($params){
        try{
            DB::beginTransaction();

            /**
             * name
             */
            $name       = $this->type->textName()->first();
            if(!$name){
                $name   = $this->type->textName()->create();
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

            $typparams = [
                'name'          => $name->id,
            ];

            $typ = $this->type->create($typparams);
        
            $typ->save();
            DB::commit();
            return $typ;
        }catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function update($id, $params){
        try{
            DB::beginTransaction();

            $typ =  $this->type->find($id);

            /**
             * name
             */
            $name       = $typ->textName()->first();
            if(!$name){
                $name   = $typ->textName()->create();
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
        

            $typparams = [
                'name'          => $name->id
            ];

            $typ->fill($typparams);
            $typ->save();
            DB::commit();
            return $typ;
        }catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
    }
}