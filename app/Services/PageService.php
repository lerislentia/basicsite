<?php

namespace App\Services;

use App\Services\BaseService;

use App\Repositories\LocaleRepository;
use App\Repositories\PageRepository;

class PageService extends BaseService
{
    protected $pagerepository;

    public function __construct(PageRepository $pagerepository)
    {
        $this->pagerepository = $pagerepository;
    }

    public function index()
    {
        return $this->pagerepository->index();
    }

    public function create($params)
    {
        return $this->pagerepository->store($params);
    }

    public function show($id)
    {
        return $this->pagerepository->show($id);
    }

    public function update($id, $params)
    {
        return $this->pagerepository->update($id, $params);
    }
}
