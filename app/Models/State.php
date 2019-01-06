<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

use Session;

/**
 * Class State
 * 
 * @property int $id
 * @property int $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Text $text
 * @property \Illuminate\Database\Eloquent\Collection $categories
 * @property \Illuminate\Database\Eloquent\Collection $entities
 * @property \Illuminate\Database\Eloquent\Collection $galleries
 * @property \Illuminate\Database\Eloquent\Collection $sections
 *
 * @package App\Models
 */
class State extends BaseModel
{
	const NAME = 'name';

	protected $table = 'state';

	protected $casts = [
		self::NAME => 'int'
	];

	protected $fillable = [
		self::NAME
	];

	protected $appends = [
		'name_value', 'locale_value'
	];

	public function textName()
	{
		return $this->belongsTo(\App\Models\Text::class, 'name');
	}

	public function categories()
	{
		return $this->hasMany(\App\Models\Categorie::class);
	}

	public function entities()
	{
		return $this->belongsToMany(\App\Models\Entity::class)
					->withTimestamps();
	}

	public function galleries()
	{
		return $this->hasMany(\App\Models\Gallery::class);
	}

	public function sections()
	{
		return $this->hasMany(\App\Models\Section::class);
	}


	/**
	 * ACCESSORS
	 */
	public function getNameValueAttribute()
    {
		if(!isset($this->attributes['name'])){
			return null;
		}
		$text 								= $this->textName()->first();

		$translations 						= $text->translations()->get();

		$trans = [];
		foreach($translations as $translation){
			$trans[$translation->locale_id] = $translation->toArray();
		}
		return ['lang' => $trans];
	}

}
