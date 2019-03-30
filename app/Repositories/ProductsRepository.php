<?php

namespace App\Repositories;

use App\Models\Product;

class ProductsRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}
