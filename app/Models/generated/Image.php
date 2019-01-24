<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 24 Jan 2019 07:49:47 +0000.
 */

namespace App\Models;

use App\Models\BaseModel as Eloquent;

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
 * @property \Illuminate\Database\Eloquent\Collection $elements
 *
 * @package App\Models
 */
class Image extends BaseModel
{
	use \App\Models\BaseModel;
	protected $table = 'image';

	protected $casts = [
		'width' => 'float',
		'height' => 'float'
	];

	protected $fillable = [
		'name',
		'path',
		'caption',
		'description',
		'width',
		'height',
		'href'
	];

	public function elements()
	{
		return $this->belongsToMany(\App\Models\Element::class)
					->withPivot('id');
	}
}
