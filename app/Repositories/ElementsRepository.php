<?php

namespace App\Repositories;

use App\Models\Element;
use DB;

class ElementsRepository
{
    public function __construct(Element $element)
    {
        $this->element = $element;
    }

    public function index($type = null)
    {
        $query = $this->element
            ->select([
                'element.*',
            ]);
        if ($type) {
            $query->where('type_id', '=', $type);
        }
        return $query;
    }

    public function show(int $id)
    {
        return $this->element->where('id', '=', $id)->with(['type' => function ($query) {
            $query->select('id', 'definition', 'name');
        }])
        ->first();
    }

    public function store($params)
    {
        try {
            DB::beginTransaction();

            /**
             * name
             */
            $name       = $this->element->textName()->first();
            if (!$name) {
                $name   = $this->element->textName()->create();
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



            $secparams = [
                'name'          => $name->id,
                'section_id'      => isset($params['section_id']) ? $params['section_id'] : null,
                'state_id'      => $params['state_id'],
                'type_id'       => $params['type_id'],
                'order'       => $params['order'],

            ];
            $elem = $this->element->create($secparams);

            $elem->save();
            DB::commit();
            return $elem;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
