<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Testimonial
 * 
 * @property int $id
 * @property int $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Text $text
 *
 * @package App\Models
 */
class Testimonial extends BaseModel
{
	const COMMENT = 'comment';

	protected $table = 'testimonial';

	protected $casts = [
		self::COMMENT => 'int'
	];

	protected $fillable = [
		self::COMMENT
	];
	protected $appends = [
		'locale_value'
	];
	public function text()
	{
		return $this->belongsTo(\App\Models\Text::class, 'comment');
	}
}
