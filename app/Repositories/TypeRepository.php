<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;

use App\Models\Type;
use DB;

class TypeRepository extends BaseRepository
{
    protected $type;

    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    public function index($entity = null)
    {
        $query = $this->type->select('type.*');
        if ($entity) {
            $query->join('entity_type as et', 'et.type_id', '=', 'type.id');
            $query->join('entity as en', 'entity_id', '=', 'en.id');
            $query->where('en.name', '=', $entity);
        }
        return $query;
    }

    public function show($id)
    {
        return $this->type->find($id);
    }

    public function store($params)
    {
        try {
            DB::beginTransaction();

            $typparams = [
                'name'          => $params['name'],
                'definition'    => $params['definition'],
            ];

            $typ = $this->type->create($typparams);

            $typ->save();
            DB::commit();
            return $typ;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function update($id, $params)
    {
        try {
            DB::beginTransaction();

            $typ =  $this->type->find($id);

            $typparams = [
                'name'          => $params['name'],
                'definition'    => isset($params['definition']) ? $params['definition'] : null
            ];

            $typ->fill($typparams);
            $typ->save();
            DB::commit();
            return $typ;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
