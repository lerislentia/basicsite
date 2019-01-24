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
 * Class Section
 * 
 * @property int $id
 * @property int $name
 * @property int $description
 * @property string $url
 * @property string $tags
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $state_id
 * 
 * @property \App\Models\State $state
 * @property \App\Models\Text $text
 * @property \Illuminate\Database\Eloquent\Collection $galleries
 * @property \Illuminate\Database\Eloquent\Collection $texts
 *
 */
class Section extends BaseModel
{
    const NAME 			= 'name';
    const DESCRIPTION 	= 'description';
    const STATE			= 'state_id';
    const TYPE			= 'type_id';
    const URL			= 'url';
    const TAGS 			= 'tags';
    const ORDER 		= 'order';
    const FATHER 		= 'parent_id';
    const DATA 		    = 'data';


    protected $table = 'section';

    protected $casts = [
        self::NAME 			=> 'int',
        self::DESCRIPTION 	=> 'int',
        self::TYPE 			=> 'int',
        self::STATE 		=> 'int',
        self::ORDER 		=> 'int',
        self::FATHER 		=> 'int',
    ];

    protected $fillable = [
        self::NAME,
        self::DESCRIPTION,
        self::URL,
        self::TAGS,
        self::STATE,
        self::TYPE,
        self::ORDER,
        self::FATHER,
        self::DATA

    ];

    protected $appends = [
        'childs', 'name_value', 'description_value', 'locale_value'
    ];


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

    public function galleries()
    {
        return $this->belongsToMany(\App\Models\Gallery::class)
                    ->withPivot('id', 'secuence')
                    ->withTimestamps();
    }

    public function texts()
    {
        return $this->belongsToMany(\App\Models\Text::class)
                    ->withPivot('id', 'sequence', 'type_id')
                    ->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(\App\Models\Categorie::class, 'categorie_section')
                    ->withPivot('value')
                    ->withTimestamps();
    }

    public function type()
    {
        return $this->belongsTo(\App\Models\Type::class);
    }

    public function elements()
    {
        return $this->hasMany(\App\Models\Element::class);
    }

    public function sections()
    {
        return $this->hasMany(\App\Models\Section::class, 'parent_id');
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

    public function getChildsAttribute()
    {
        return 	$this->sections()->with(['sections' => function ($query) {
            $query->select('id');
        }])->get();
    }
}
