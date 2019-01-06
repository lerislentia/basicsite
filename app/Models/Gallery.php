<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Gallery
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $width
 * @property float $height
 * @property int $type_id
 * @property int $state_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\State $state
 * @property \App\Models\Type $type
 * @property \Illuminate\Database\Eloquent\Collection $images
 * @property \Illuminate\Database\Eloquent\Collection $products
 * @property \Illuminate\Database\Eloquent\Collection $sections
 *
 * @package App\Models
 */
class Gallery extends BaseModel
{
	const NAME 			= 'name';
	const DESCRIPTION 	= 'descirption';
	const WIDTH 		= 'width';
	const HEIGHT 		= 'height';
	const TYPE 			= 'type_id';
	const STATE 		= 'state_id';


	protected $table = 'gallery';

	protected $casts = [
		self::WIDTH 	=> 'float',
		self::HEIGHT 	=> 'float',
		self::TYPE 		=> 'int',
		self::STATE 	=> 'int'
	];

	protected $fillable = [
		self::NAME,
		self::DESCRIPTION,
		self::WIDTH,
		self::HEIGHT,
		self::TYPE,
		self::STATE
	];
	protected $appends = [
		'locale_value'
	];
	public function state()
	{
		return $this->belongsTo(\App\Models\State::class);
	}

	public function type()
	{
		return $this->belongsTo(\App\Models\Type::class);
	}

	public function images()
	{
		return $this->belongsToMany(\App\Models\Image::class)
					->withPivot('id', 'sequence')
					->withTimestamps();
	}

	public function products()
	{
		return $this->belongsToMany(\App\Models\Product::class)
					->withPivot('id')
					->withTimestamps();
	}

	public function sections()
	{
		return $this->belongsToMany(\App\Models\Section::class)
					->withPivot('id', 'secuence')
					->withTimestamps();
	}
}
