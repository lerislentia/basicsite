<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class PropertieProduct
 * 
 * @property int $propertie_id
 * @property int $product_id
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Product $product
 * @property \App\Models\Propertie $propertie
 *
 */
class PropertieProduct extends BaseModel
{
    const PROPERTIE = 'propertie_id';
    const PRODUCT 	= 'product_id';
    const VALUE 	= 'value';

    protected $table = 'propertie_product';
    public $incrementing = false;

    protected $casts = [
        self::PROPERTIE => 'int',
        self::PRODUCT 	=> 'int'
    ];

    protected $fillable = [
        self::VALUE
    ];
    protected $appends = [
        'locale_value'
    ];
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function propertie()
    {
        return $this->belongsTo(\App\Models\Propertie::class);
    }
}
