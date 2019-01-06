<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Text;

use Session;

/**
 * Class Categorie
 * 
 * @property int $id
 * @property int $name
 * @property int $description
 * @property string $url
 * @property string $tags
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $parent_id
 * @property int $state_id
 * 
 * @property \App\Models\Categorie $categorie
 * @property \App\Models\State $state
 * @property \App\Models\Text $text
 * @property \Illuminate\Database\Eloquent\Collection $categories
 * @property \Illuminate\Database\Eloquent\Collection $products
 *
 */
class Categorie extends BaseModel
{
    const NAME 			= 'name';
    const DESCRIPTION 	= 'description';
    const URL 			= 'url';
    const TAGS 			= 'tags';
    const FATHER 		= 'parent_id';
    const STATE 		= 'state_id';

    protected $table = 'categorie';

    protected $casts = [
        self::NAME 			=> 'int',
        self::DESCRIPTION 	=> 'int',
        self::FATHER 		=> 'int',
        self::STATE 		=> 'int'
    ];

    protected $fillable = [
        self::NAME,
        self::DESCRIPTION,
        self::URL,
        self::TAGS,
        self::FATHER,
        self::STATE
    ];

    protected $appends = [
        'childs', 'name_value', 'description_value', 'locale_value', 'state', 'sections'
    ];

    public function categorie()
    {
        return $this->belongsTo(\App\Models\Categorie::class, 'parent_id');
    }

    public function state()
    {
        return $this->belongsTo(\App\Models\State::class);
    }

    public function textDescription()
    {
        return $this->belongsTo(\App\Models\Text::class, 'description');
    }

    public function textName()
    {
        return $this->belongsTo(\App\Models\Text::class, 'name');
    }

    public function textState()
    {
        return $this->belongsTo(\App\Models\Text::class, 'state_id');
    }

    public function categories()
    {
        return $this->hasMany(\App\Models\Categorie::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(\App\Models\Product::class)
                    ->withPivot('id')
                    ->withTimestamps();
    }

    public function sections()
    {
        return $this->belongsToMany(\App\Models\Section::class, 'categorie_section')
                    ->withPivot('categorie_id')
                    ->withTimestamps();
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

    public function getStateAttribute()
    {
        if (!isset($this->attributes['state_id'])) {
            return null;
        }
        $text 								= $this->textState()->first();

        $translations 						= $text->translations()->get();
        foreach ($translations as $translation) {
            $trans[$translation->locale_id] = $translation->toArray();
        }
        return ['lang' => $trans];
    }

    public function getSectionsAttribute()
    {
        return $this->sections()->get();
    }


    public function getChildsAttribute()
    {
        return 	$this->categories()->with(['categories' => function ($query) {
            $query->select('id');
        }])->get();
    }
}
