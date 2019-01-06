<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Product
 * 
 * @property int $id
 * @property int $name
 * @property int $description
 * @property string $url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Text $text
 * @property \Illuminate\Database\Eloquent\Collection $categories
 * @property \Illuminate\Database\Eloquent\Collection $galleries
 * @property \Illuminate\Database\Eloquent\Collection $properties
 *
 */
class Product extends BaseModel
{
    const NAME 			= 'name';
    const DESCRIPTION 	= 'descipriton';
    const URL 			= 'url';

    protected $table = 'product';

    protected $casts = [
        self::NAME 			=> 'int',
        self::DESCRIPTION 	=> 'int'
    ];

    protected $fillable = [
        self::NAME,
        self::DESCRIPTION,
        self::URL
    ];
    protected $appends = [
        'locale_value'
    ];
    public function text()
    {
        return $this->belongsTo(\App\Models\Text::class, 'description');
    }

    public function categories()
    {
        return $this->belongsToMany(\App\Models\Categorie::class)
                    ->withPivot('id')
                    ->withTimestamps();
    }

    public function galleries()
    {
        return $this->belongsToMany(\App\Models\Gallery::class)
                    ->withPivot('id')
                    ->withTimestamps();
    }

    public function properties()
    {
        return $this->belongsToMany(\App\Models\Propertie::class, 'propertie_product')
                    ->withPivot('value')
                    ->withTimestamps();
    }
}
