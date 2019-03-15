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
        return $this->section
            ->select('*')
            ->with(['childrens' => function ($query) {
                $query->select('id', 'parent_id');
            }])
            ->orderBy(Section::ORDER);
    }

    public function findBy($params)
    {
        $query = $this->section->select('*');
        foreach ($params as $key => $value) {
            $query->where($key, '=', $value);
        }
        return $query;
    }

    public function show($id)
    {
        return $this->section->where('id', '=', $id)->with(['childrens' => function ($query) {
            $query->select('id', 'parent_id', 'name', 'description', 'state_id', 'type_id', 'url', 'tags', 'order', 'data');
        }])
        ->orderBy('order')
        ->first();
    }

    public function getParentsWithChildrensTree()
    {
        return $this->section
            ->whereNull('parent_id')
            ->with(['childrens' => function ($query) {
                $query->select('id', 'parent_id', 'name', 'description', 'state_id', 'type_id', 'url', 'tags', 'order', 'data');
            }])
        ->orderBy('order');
    }



    public function store($params)
    {
        try {
            DB::beginTransaction();

            $secparams = [
                'name'          => $params['name'],
                'description'   => $params['description'],
                'url'           => $params['url'],
                'tags'          => $params['tags'],
                'state_id'      => $params['state_id'],
                'type_id'       => $params['type_id'],
                'parent_id'     => isset($params['parent_id']) ? $params['parent_id'] : null,
                'order'       => $params['order'],

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

            $secparams = [
                'name'          => $params['name'],
                'description'   => $params['description'],
                'url'           => $params['url'],
                'tags'          => $params['tags'],
                'state_id'      => $params['state_id'],
                'type_id'       => $params['type_id'],
                'order'         => $params['order'],
                'parent_id'     => isset($params['parent_id']) ? $params['parent_id'] : null,

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

            $elements       = $sec->childrens()->get();
            foreach ($elements as $key => $element) {
                $this->delete($element);
                $element->delete();
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

    public function updateProperties($id, $params)
    {
        try {
            DB::beginTransaction();
            unset($params['entity_id']);
            $sec        =  $this->section->find($id);
            $sec->data  = json_encode($params);
            $sec->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
