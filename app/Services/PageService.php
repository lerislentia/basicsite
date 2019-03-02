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

    public function getByName($pagename, $locale){
        return $this->pagerepository->getByName($pagename, $locale);
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

    public function delete($id)
    {
        return $this->pagerepository->delete($id);
    }
}
