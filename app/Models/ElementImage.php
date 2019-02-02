<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 24 Jan 2019 07:48:38 +0000.
 */

namespace App\Models;

use \App\Models\BaseModel;

/**
 * Class ElementImage
 * 
 * @property int $id
 * @property int $element_id
 * @property int $image_id
 * 
 * @property \App\Models\Element $element
 * @property \App\Models\Image $image
 *
 */
class ElementImage extends BaseModel
{
    protected $table = 'element_image';
    public $timestamps = false;

    protected $casts = [
        'element_id' => 'int',
        'image_id' => 'int'
    ];

    protected $fillable = [
        'element_id',
        'image_id'
    ];

    public function element()
    {
        return $this->belongsTo(\App\Models\Element::class);
    }

    public function image()
    {
        return $this->belongsTo(\App\Models\Image::class);
    }
}
