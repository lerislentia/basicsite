<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Event
 * 
 * @property int $id
 * @property int $name
 * @property int $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Text $text
 *
 * @package App\Models
 */
class Event extends BaseModel
{
	const NAME 			= 'name';
	const DESCRIPTION 	= 'description';

	protected $table = 'event';

	protected $casts = [
		self::NAME 			=> 'int',
		self::DESCRIPTION 	=> 'int'
	];

	protected $fillable = [
		self::NAME,
		self::DESCRIPTION
	];
	protected $appends = [
		'locale_value'
	];
	public function text()
	{
		return $this->belongsTo(\App\Models\Text::class, 'description');
	}
}
