<?php

namespace App\Services;

use App\Repositories\SiteRepository;

class SitesService
{
    protected $siterepository;

    public function __construct(SiteRepository $siterepository)
    {
        $this->siterepository = $siterepository;
    }

    public function index($entity = null)
    {
        return $this->siterepository->index($entity)->get();
    }

    public function update($id, $params)
    {
        return $this->siterepository->update($id, $params);
    }

    public function show($id)
    {
        return $this->siterepository->show($id);
    }
    public function store($params)
    {
        return $this->siterepository->store($params);
    }

    public function getActiveSite()
    {
        return $this->siterepository->getActiveSite()->first();
    }
}
