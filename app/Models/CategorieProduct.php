<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class CategorieProduct
 * 
 * @property int $id
 * @property int $categorie_id
 * @property int $product_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Categorie $categorie
 * @property \App\Models\Product $product
 *
 */
class CategorieProduct extends BaseModel
{
    const CATEGORIE = 'categorie_id';
    const PRODUCT 	= 'product_id';

    protected $table = 'categorie_product';

    protected $casts = [
        self::CATEGORIE => 'int',
        self::PRODUCT 	=> 'int'
    ];

    protected $fillable = [
        self::CATEGORIE,
        self::PRODUCT
    ];

    public function categorie()
    {
        return $this->belongsTo(\App\Models\Categorie::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
}
