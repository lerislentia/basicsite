<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Image
 * 
 * @property int $id
 * @property string $name
 * @property string $path
 * @property string $caption
 * @property string $description
 * @property float $width
 * @property float $height
 * @property string $href
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $galleries
 *
 */
class Image extends BaseModel
{
    const ID 			    = 'id';
    const FILENAME 			= 'filename';
    const THUMB 			= 'thumb';

    protected $table = 'image';

    protected $fillable = [
        self::FILENAME,
        self::THUMB
    ];
    protected $appends = [
        'locale_value'
    ];

    public function products()
	{
		return $this->belongsToMany(\App\Models\Product::class, 'product_image');
	}
}
