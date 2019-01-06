<?php

namespace App\Services;

use App\Services\BaseService;

use App\Repositories\LocaleRepository;

class LocaleService extends BaseService
{
    protected $localerepository;

    public function __construct(LocaleRepository $localerepository)
    {
        $this->localerepository = $localerepository;
    }

    public function index()
    {
        return $this->localerepository->index();
    }

    public function show($id)
    {
        return $this->localerepository->show($id);
    }

    public function store($params)
    {
        return $this->localerepository->store($params);
    }
}
