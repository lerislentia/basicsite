<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class GalleryProduct
 * 
 * @property int $id
 * @property int $gallery_id
 * @property int $product_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Gallery $gallery
 * @property \App\Models\Product $product
 *
 */
class GalleryProduct extends BaseModel
{
    const GALLERY = 'gallery_id';
    const PRODUCT = 'product_id';

    protected $table = 'gallery_product';

    protected $casts = [
        self::GALLERY => 'int',
        self::PRODUCT => 'int'
    ];

    protected $fillable = [
        self::GALLERY,
        self::PRODUCT
    ];
    protected $appends = [
        'locale_value'
    ];
    public function gallery()
    {
        return $this->belongsTo(\App\Models\Gallery::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
}
