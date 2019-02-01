<?php

namespace App\Services;

use App\Repositories\StateRepository;

class StateService
{
    protected $staterepository;

    public function __construct(StateRepository $staterepository)
    {
        $this->staterepository = $staterepository;
    }

    public function index($entity = null)
    {
        return $this->staterepository->index($entity);
    }

    public function show($id)
    {
        return $this->staterepository->show($id);
    }

    public function update($id, $params)
    {
        return $this->staterepository->update($id, $params);
    }

    public function store($params)
    {
        return $this->staterepository->store($params);
    }
}
