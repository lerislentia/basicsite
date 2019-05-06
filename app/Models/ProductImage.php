<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 01 May 2019 13:18:32 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class ProductImage
 * 
 * @property int $product_id
 * @property int $image_id
 * 
 * @property \App\Models\Image $image
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class ProductImage extends BaseModel
{

	protected $table = 'product_image';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'image_id' => 'int'
	];

	public function image()
	{
		return $this->belongsTo(\App\Models\Image::class);
	}

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
