<?php

namespace App\Services;

use App\Repositories\EntityTypeRepository;

class EntityTypeService
{
    protected $entitityperepository;

    public function __construct(EntityTypeRepository $entitityperepository)
    {
        $this->entitityperepository = $entitityperepository;
    }

    public function index($entity = null)
    {
        return $this->entitityperepository->index($entity)->get();
    }

    public function store($params)
    {
        return $this->entitityperepository->store($params);
    }
}
