<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;

use App\Models\Locale;
use App\Models\Page;
use DB;

class PageRepository extends BaseRepository
{
    protected $pagemodel;

    public function __construct(Page $pagemodel)
    {
        $this->pagemodel = $pagemodel;
    }

    public function index()
    {
        return $this->pagemodel->with('site');
    }

    public function show($id)
    {
        return $this->pagemodel->where('id', '=', $id)->with(['sections' => function ($query) {
            $query->select('section.id');
        }])
        ->first();
    }

    public function getByName($pagename, $locale)
    {
        return $this->pagemodel
            ->select('page.*')
            ->where('page.name', '=', $pagename)
            ->first();
    }

    public function store($params)
    {
        try {
            DB::beginTransaction();

            $newparams = [
                'name'          => $params['name'],
                'tags'          => $params['tags'],
                'state_id'      => $params['state_id'],
            ];

            $new = $this->pagemodel->create($newparams);

            $new->save();
            DB::commit();
            return $new;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function update($id, $params)
    {
        try {
            DB::beginTransaction();

            $pag =  $this->pagemodel->find($id);

            /**
             * name
             */
            $name       = $pag->textName()->first();
            if (!$name) {
                $name   = $pag->textName()->create();
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


            $pagparams = [
                'name'          => $name->id,
                'tags'          => $params['tags'],
                'state_id'      => $params['state_id']
            ];

            $pag->fill($pagparams);
            $pag->save();
            DB::commit();
            return $pag;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
