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
    const DESCRIPTION 	= 'description';
    const SITE 			= 'site_id';

    protected $table = 'product';

    protected $casts = [
        self::NAME 			=> 'int',
        self::DESCRIPTION 	=> 'int',
        self::SITE 	        => 'int',
    ];

    protected $fillable = [
        self::NAME,
        self::DESCRIPTION,
        self::SITE
    ];
    protected $appends = [
        'locale_value', 'name_value', 'description_value'
    ];

    public function site()
	{
		return $this->belongsTo(\App\Models\Site::class);
    }

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

    public function textDescription()
    {
        return $this->belongsTo(\App\Models\Text::class, 'description');
    }

    public function textName()
    {
        return $this->belongsTo(\App\Models\Text::class, 'name');
    }

    public function offers()
	{
		return $this->hasMany(\App\Models\Offer::class);
	}

	public function images()
	{
		return $this->belongsToMany(\App\Models\Image::class, 'product_image')
					->withPivot('product_id');
	}

	public function reviews()
	{
		return $this->hasMany(\App\Models\Review::class);
	}

    

    /**
     * ACCESSORS
     */

    public function getNameValueAttribute()
    {
        if (!isset($this->attributes['name'])) {
            return null;
        }
        $text 								= $this->textName()->first();

        $translations 						= $text->translations()->get();

        foreach ($translations as $translation) {
            $trans[$translation->locale_id] = $translation->toArray();
        }
        return ['lang' => $trans];
    }

    public function getDescriptionValueAttribute()
    {
        if (!isset($this->attributes['description'])) {
            return null;
        }
        $text 								= $this->textDescription()->first();

        $translations 						= $text->translations()->get();
        foreach ($translations as $translation) {
            $trans[$translation->locale_id] = $translation->toArray();
        }
        return ['lang' => $trans];
    }

    public function scopeShow(){
        return $this->with('images');
    }

    // public function getStateAttribute()
    // {
    //     if (!isset($this->attributes['state_id'])) {
    //         return null;
    //     }
    //     $text 								= $this->textState()->first();

    //     $translations 						= $text->translations()->get();
    //     foreach ($translations as $translation) {
    //         $trans[$translation->locale_id] = $translation->toArray();
    //     }
    //     return ['lang' => $trans];
    // }
}
