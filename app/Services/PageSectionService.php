<?php

namespace App\Services;

use App\Services\BaseService;

use App\Repositories\PageSectionRepository;
use App\Repositories\LocaleRepository;

class PageSectionService extends BaseService
{
    public function __construct(PageSectionRepository $pagesectionrepository)
    {
        $this->pagesectionrepository =$pagesectionrepository;
    }

    public function index()
    {
        return $this->pagesectionrepository->index()->get();
    }

    public function show($id)
    {
        return $this->pagesectionrepository->show($id);
    }

    public function store($params)
    {
        return $this->pagesectionrepository->store($params);
    }

    public function update($id, $params)
    {
        return $this->pagesectionrepository->update($id, $params);
    }

    public function delete($id)
    {
        return $this->pagesectionrepository->delete($id);
    }
}
