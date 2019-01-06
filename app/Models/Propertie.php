<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Propertie
 * 
 * @property int $id
 * @property int $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Text $text
 * @property \Illuminate\Database\Eloquent\Collection $products
 *
 * @package App\Models
 */
class Propertie extends BaseModel
{
	const NAME = 'name';

	protected $table = 'propertie';

	protected $casts = [
		self::NAME => 'int'
	];

	protected $fillable = [
		self::NAME
	];
	protected $appends = [
		'locale_value'
	];
	public function text()
	{
		return $this->belongsTo(\App\Models\Text::class, 'name');
	}

	public function products()
	{
		return $this->belongsToMany(\App\Models\Product::class, 'propertie_product')
					->withPivot('value')
					->withTimestamps();
	}
}
