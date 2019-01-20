<?php

namespace App\Repositories;

use App\Models\Section;
use DB;

class SectionRepository
{
    protected $section;

    public function __construct(Section $section)
    {
        $this->section = $section;
    }

    public function index()
    {
        return $this->section->select('*')->orderBy(Section::ORDER);
    }


    public function show($id)
    {
        return $this->section->where('id', '=', $id)->with(['elements' => function ($query) {
            $query->select('id');
        }])
        ->orderBy('order')
        ->first();
    }

    public function store($params)
    {
        try {
            DB::beginTransaction();

            /**
             * name
             */
            $name       = $this->section->textName()->first();
            if (!$name) {
                $name   = $this->section->textName()->create();
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
            $description       = $this->section->textDescription()->first();
            if (!$description) {
                $description   = $this->section->textDescription()->create();
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


            $secparams = [
                'name'          => $name->id,
                'description'   => $description->id,
                'url'           => $params['url'],
                'tags'          => $params['tags'],
                'state_id'      => $params['state_id'],
                'type_id'       => $params['type_id'],

            ];
            $sect = $this->section->create($secparams);

            $sect->save();
            DB::commit();
            return $sect;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function update($id, $params)
    {
        try {
            DB::beginTransaction();

            $sec =  $this->section->find($id);

            /**
             * name
             */
            $name       = $sec->textName()->first();
            if (!$name) {
                $name   = $sec->textName()->create();
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
            $description       = $sec->textDescription()->first();
            if (!$description) {
                $description   = $sec->textDescription()->create();
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


            $secparams = [
                'name'          => $name->id,
                'description'   => $description->id,
                'url'           => $params['url'],
                'tags'          => $params['tags'],
                'state_id'      => $params['state_id'],
                'type_id'       => $params['type_id'],

            ];

            $sec->fill($secparams);
            $sec->save();
            DB::commit();
            return $sec;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $sec            =  $this->section->find($id);

            /**
             * name
             */
            $name           = $sec->textName()->first();

            $translations   = $name->translations()->get();
            foreach ($translations as $translation) {
                $translation->delete();
            }



            /**
             * description
             */
            $description    = $sec->textDescription()->first();

            $translations   = $description->translations()->get();
            foreach ($translations as $translation) {
                $translation->delete();
            }




            $sec->delete();
            $name->delete();
            $description->delete();

            DB::commit();
            return $sec;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
