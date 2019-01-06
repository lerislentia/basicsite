<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class GallerySection
 * 
 * @property int $id
 * @property int $gallery_id
 * @property int $section_id
 * @property int $secuence
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Gallery $gallery
 * @property \App\Models\Section $section
 *
 * @package App\Models
 */
class GallerySection extends BaseModel
{
	const GALLERY 	= 'gallery_id';
	const SECTION 	= 'section_id';
	const SEQUENCE 	= 'sequence';

	protected $table = 'gallery_section';

	protected $casts = [
		self::GALLERY 	=> 'int',
		self::SECTION 	=> 'int',
		self::SEQUENCE 	=> 'int'
	];

	protected $fillable = [
		self::GALLERY,
		self::SECTION,
		self::SEQUENCE
	];
	protected $appends = [
		'locale_value'
	];
	public function gallery()
	{
		return $this->belongsTo(\App\Models\Gallery::class);
	}

	public function section()
	{
		return $this->belongsTo(\App\Models\Section::class);
	}
}
