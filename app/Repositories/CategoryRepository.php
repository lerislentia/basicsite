<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Categorie;
use DB;
use Exception;


class CategoryRepository extends BaseRepository{

    protected $category;

    public function __construct(Categorie $category){
        $this->category = $category;
    }

    public function index(){
        return $this->category->All();
    }

    public function findBy($params){
        $query = $this->category->select('*');
        foreach($params as $key => $value){
            $query->where($key, '=', $value);
        }
        return $query;
    }

    public function store($params){
        try{
            DB::beginTransaction();

            /**
             * name
             */
            $name       = $this->category->textName()->first();
            if(!$name){
                $name   = $this->category->textName()->create();
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
        

            /**
             * description
             */
            $description       = $this->category->textDescription()->first();
            if(!$description){
                $description   = $this->category->textDescription()->create();
            }
            $description->save();
            $dparams = [
                'text' 		        => $params['description'],
                'locale_id'	        => $params['locale'],
                'text_id'	=> $description->id
            ];

            $translation 						= $description->translations()->where('locale_id', '=', $dparams['locale_id'])->first();
            if(!$translation){
                $translation 					= $description->translations()->create($dparams);
            }else{
                $translation->fill($dparams);
            }
            $translation->save();


            $catparams = [
                'name'          => $name->id,
                'description'   => $description->id,
                'url'           => $params['url'],
                'tags'          => $params['tags'],
                'state_id'      => $params['state_id'],
                'parent_id'     => $params['parent_id'],

            ];
            $cat = $this->category->create($catparams);

            $cat->save();
            DB::commit();
            return $cat;
        }catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function update($id, $params){
        try{
            DB::beginTransaction();

            $cat =  $this->category->find($id);

            /**
             * name
             */
            $name       = $cat->textName()->first();
            if(!$name){
                $name   = $cat->textName()->create();
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
        

            /**
             * description
             */
            $description       = $cat->textDescription()->first();
            if(!$description){
                $description   = $cat->textDescription()->create();
            }
            $description->save();
            $dparams = [
                'text' 		        => $params['description'],
                'locale_id'	        => $params['locale'],
                'text_id'	        => $description->id
            ];

            $translation 						= $description->translations()->where('locale_id', '=', $dparams['locale_id'])->first();
            if(!$translation){
                $translation 					= $description->translations()->create($dparams);
            }else{
                $translation->fill($dparams);
            }
            $translation->save();


            $catparams = [
                'name'          => $name->id,
                'description'   => $description->id,
                'url'           => $params['url'],
                'tags'          => $params['tags'],
                'state_id'      => $params['state_id'],
                'parent_id'     => $params['parent_id'],

            ];

            $cat->fill($catparams);
            $cat->save();
            DB::commit();
            return $cat;
        }catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
    }
}