<?php

namespace App\Repositories;

use App\Models\EntityState;

class EntityStateRepository
{
    protected $entitystate;

    public function __construct(EntityState $entitystate)
    {
        $this->entitystate = $entitystate;
    }

    public function index($entity = null)
    {
        $query = $this->entitystate
            ->select([
                'entity_state.*',
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
        return $this->entitystate->create($params);
    }
}
