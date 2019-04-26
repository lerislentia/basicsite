<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class ProductsRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index(){
        return $this->product->All();
    }

    public function show($id){
        return $this->product->find($id)->first();
    }

    public function findBy($params)
    {
        $query = $this->product->select('*');
        foreach ($params as $key => $value) {
            $query->where($key, '=', $value);
        }
        return $query;
    }

    public function store($params)
    {
        try {
            DB::beginTransaction();

            /**
             * name
             */
            $name       = $this->product->textName()->first();
            if (!$name) {
                $name   = $this->product->textName()->create();
            }
            $name->save();
            $nparams = [
                'text' 		=> $params['name'],
                'locale_id'	=> $params['locale'],
                'text_id'	=> $name->id
            ];

            $translation 						= $name->translations()->where('locale_id', '=', $nparams['locale_id'])->first();
            if (!$translation) {
                $translation 					= $name->translations()->create($nparams);
            } else {
                $translation->fill($nparams);
            }
            $translation->save();


            /**
             * description
             */
            $description       = $this->product->textDescription()->first();
            if (!$description) {
                $description   = $this->product->textDescription()->create();
            }
            $description->save();
            $dparams = [
                'text' 		        => $params['description'],
                'locale_id'	        => $params['locale'],
                'text_id'	=> $description->id
            ];

            $translation 						= $description->translations()->where('locale_id', '=', $dparams['locale_id'])->first();
            if (!$translation) {
                $translation 					= $description->translations()->create($dparams);
            } else {
                $translation->fill($dparams);
            }
            $translation->save();


            $prodparams = [
                'name'          => $name->id,
                'description'   => $description->id,
                'url'           => $params['url'],
            ];
            $prod = $this->product->create($prodparams);

            $prod->save();
            DB::commit();
            return $prod;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function update($id, $params)
    {
        try {
            DB::beginTransaction();

            $prod =  $this->product->find($id);

            /**
             * name
             */
            $name       = $prod->textName()->first();
            if (!$name) {
                $name   = $prod->textName()->create();
            }
            $name->save();
            $nparams = [
                'text' 		=> $params['name'],
                'locale_id'	=> $params['locale'],
                'text_id'	=> $name->id
            ];

            $translation 						= $name->translations()->where('locale_id', '=', $nparams['locale_id'])->first();
            if (!$translation) {
                $translation 					= $name->translations()->create($nparams);
            } else {
                $translation->fill($nparams);
            }
            $translation->save();


            /**
             * description
             */
            $description       = $prod->textDescription()->first();
            if (!$description) {
                $description   = $prod->textDescription()->create();
            }
            $description->save();
            $dparams = [
                'text' 		        => $params['description'],
                'locale_id'	        => $params['locale'],
                'text_id'	        => $description->id
            ];

            $translation 						= $description->translations()->where('locale_id', '=', $dparams['locale_id'])->first();
            if (!$translation) {
                $translation 					= $description->translations()->create($dparams);
            } else {
                $translation->fill($dparams);
            }
            $translation->save();


            $prodparams = [
                'name'          => $name->id,
                'description'   => $description->id,
                'url'           => $params['url'],
            ];

            $prod->fill($prodparams);
            $prod->save();
            DB::commit();
            return $prod;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
