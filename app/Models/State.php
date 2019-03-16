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
 */
class State extends BaseModel
{
    const NAME  = 'name';
    const VALUE = 'value';

    protected $table = 'state';

    protected $fillable = [
        self::NAME,
        self::VALUE
    ];

    protected $appends = [
        'locale_value'
    ];

    public function categories()
    {
        return $this->hasMany(\App\Models\Categorie::class);
    }

    public function entities()
    {
        return $this->belongsToMany(\App\Models\Entity::class)
                    ->withPivot('id')
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
}
