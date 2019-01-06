<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Locale
 * 
 * @property string $id
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $translations
 *
 * @package App\Models
 */
class Locale extends BaseModel
{
	const DESCRIPTION = 'description';

	protected $table = 'locale';
	public $incrementing = false;

	protected $fillable = [
		parent::ID,
		self::DESCRIPTION
	];

	public function translations()
	{
		return $this->hasMany(\App\Models\Translation::class);
	}
}
