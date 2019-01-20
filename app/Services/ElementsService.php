<?php

namespace App\Services;

use App\Repositories\ElementsRepository;

class ElementsService
{
    protected $elementrepository;

    public function __construct(ElementsRepository $elementrepository)
    {
        $this->elementrepository = $elementrepository;
    }

    public function index($type = null)
    {
        return $this->elementrepository->index($type)->get();
    }

    public function create($params)
    {
        return $this->elementrepository->store($params);
    }
}
