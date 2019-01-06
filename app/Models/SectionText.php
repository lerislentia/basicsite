<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class SectionText
 * 
 * @property int $id
 * @property int $section_id
 * @property int $text_id
 * @property int $sequence
 * @property int $type_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Section $section
 * @property \App\Models\Text $text
 * @property \App\Models\Type $type
 *
 * @package App\Models
 */
class SectionText extends BaseModel
{
	const SECTION 	= 'section_id';
	const TEXT  	= 'text_id';
	const SEQUENCE  = 'sequence';
	const TYPE 		= 'type_id';

	protected $table = 'section_text';

	protected $casts = [
		self::SECTION 	=> 'int',
		self::TEXT 		=> 'int',
		self::SEQUENCE 	=> 'int',
		self::TYPE 		=> 'int'
	];

	protected $fillable = [
		self::SECTION,
		self::TEXT,
		self::SEQUENCE,
		self::TYPE
	];
	protected $appends = [
		'locale_value'
	];
	public function section()
	{
		return $this->belongsTo(\App\Models\Section::class);
	}

	public function text()
	{
		return $this->belongsTo(\App\Models\Text::class);
	}

	public function type()
	{
		return $this->belongsTo(\App\Models\Type::class);
	}
}
