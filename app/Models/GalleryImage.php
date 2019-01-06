<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class GalleryImage
 * 
 * @property int $id
 * @property int $gallery_id
 * @property int $image_id
 * @property int $sequence
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Gallery $gallery
 * @property \App\Models\Image $image
 *
 * @package App\Models
 */
class GalleryImage extends BaseModel
{

	const GALLERY 	= 'gallery_id';
	const IMAGE		= 'image_id';
	const SEQUENCE 	= 'sequence';

	protected $table = 'gallery_image';

	protected $casts = [
		self::GALLERY 	=> 'int',
		self::IMAGE 	=> 'int',
		self::SEQUENCE 	=> 'int'
	];

	protected $fillable = [
		self::GALLERY,
		self::IMAGE,
		self::SEQUENCE
	];
	protected $appends = [
		'locale_value'
	];
	public function gallery()
	{
		return $this->belongsTo(\App\Models\Gallery::class);
	}

	public function image()
	{
		return $this->belongsTo(\App\Models\Image::class);
	}
}
