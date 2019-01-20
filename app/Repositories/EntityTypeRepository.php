<?php

namespace App\Repositories;

use App\Models\EntityType;

class EntityTypeRepository
{
    protected $entitytype;

    public function __construct(EntityType $entitytype)
    {
        $this->entitytype = $entitytype;
    }

    public function index($entity = null)
    {
        $query = $this->entitytype
            ->select([
                'entity_type.*',
                'en.name'
            ])
            ->join('entity as en', 'entity_id', '=', 'en.id');
        if ($entity) {
            $query->where('en.name', '=', $entity);
        }
        return $query;
    }

    public function store($params)
    {
        return $this->entitytype->create($params);
    }
}
