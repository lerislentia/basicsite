<?php

namespace App\Services;

use App\Services\BaseService;

use App\Repositories\LocaleRepository;
use App\Repositories\ProductsRepository;

class ProductsService extends BaseService
{
    protected $productsrepository;

    public function __construct(ProductsRepository $productsrepository)
    {
        $this->productsrepository = $productsrepository;
    }
}
