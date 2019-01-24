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
        return $this->sectionrepository->index()->get();
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

    public function delete($id)
    {
        return $this->sectionrepository->delete($id);
    }

    public function getParents()
    {
        return $this->sectionrepository->findBy(['parent_id' => null])->get();
    }
}
