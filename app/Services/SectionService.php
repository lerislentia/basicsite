<?php

namespace App\Services;

use App\Repositories\SectionRepository;

class SectionService
{
    protected $sectionrepository;

    public function __construct(SectionRepository $sectionrepository)
    {
        $this->sectionrepository = $sectionrepository;
    }

    public function index()
    {
        return $this->sectionrepository->index();
    }

    public function show($id)
    {
        return $this->sectionrepository->show($id);
    }

    public function store($params)
    {
        return $this->sectionrepository->store($params);
    }

    public function update($id, $params)
    {
        return $this->sectionrepository->update($id, $params);
    }

    public function create($params)
    {
        return $this->sectionrepository->store($params);
    }
}
