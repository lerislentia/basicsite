<?php

namespace App\Services;

use App\Repositories\LayoutRepository;

class LayoutService
{
    protected $layoutrepository;

    public function __construct(LayoutRepository $layoutrepository)
    {
        $this->layoutrepository = $layoutrepository;
    }

    public function index()
    {
        return $this->layoutrepository->index();
    }

    public function show($id)
    {
        return $this->layoutrepository->show($id);
    }

    public function store($params)
    {
        return $this->layoutrepository->store($params);
    }

    public function update($id, $params)
    {
        return $this->layoutrepository->update($id, $params);
    }
}
