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
        return $this->pagemodel->All();
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
        // SELECT * FROM basicsite.page
        // inner join text as t on page.name = t.id
        // inner join translation as tr on tr.text_id = t.id;
        return $this->pagemodel
            ->select('page.*')
            ->join('text as t', 'page.name', '=', 't.id')
            ->join('translation as tr', 'tr.text_id', '=', 't.id')
            ->where('tr.text', '=', $pagename)
            ->where('tr.locale_id', '=', $locale)
            ->first();

    }

    public function store($params)
    {
        try {
            DB::beginTransaction();

            /**
             * name
             */
            $name       = $this->pagemodel->textName()->first();
            if (!$name) {
                $name   = $this->pagemodel->textName()->create();
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


            $newparams = [
                'name'          => $name->id,
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
