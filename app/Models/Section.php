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
        'childrens', 'name_value', 'type', 'state','description_value', 'locale_value', 'array_data'
    ];


    public function state()
    {
        return $this->belongsTo(\App\Models\State::class);
    }

    public function textDescription()
    {
        return $this->belongsTo(\App\Models\Text::class, self::DESCRIPTION);
    }

    public function textName()
    {
        return $this->belongsTo(\App\Models\Text::class, self::NAME);
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
                    ->withPivot('id', 'sequence', self::TYPE)
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

    public function childrens()
    {
        return $this->hasMany(\App\Models\Section::class, self::FATHER, 'id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Section::class, self::FATHER);
    }

    /**
     * custom relations
     * 
     */

    /**
     * relacion temporal hasta renombrar la tabla sections a elements
     * luego en lugar de $this->section() se llamara $this->elements()
     *
     * @return void
     */


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
        if (!isset($this->attributes[self::DESCRIPTION])) {
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
        if (!isset($this->attributes[self::STATE])) {
            return null;
        }
        $state 								= $this->state()->first();
        $text 								= $state->textName()->first();
        $translations 						= $text->translations()->get();
        foreach ($translations as $translation) {
            $trans[$translation->locale_id] = $translation->toArray();
        }
        return ['lang' => $trans];
    }

    public function getParentAttribute()
    {
        return 	$this->parent()->with(['parent' => function ($query) {
            $query->select('id');
        }])->get();
    }

    public function getChildrensAttribute()
    {
        return 	$this->Childrens()->with(['childrens' => function ($query) {
            $query->select('id');
        }])->get();
    }

    public function getTypeAttribute()
    {
        if (!isset($this->attributes[self::TYPE])) {
            return null;
        }
        $type 								= $this->type()->first();
        $text 								= $type->textName()->first();
        $translations 						= $text->translations()->get();
        foreach ($translations as $translation) {
            $trans[$translation->locale_id] = $translation->toArray();
        }
        return ['lang' => $trans];
    }

    public function getArrayDataAttribute()
    {
        return json_decode($this->data, true);
    }
}
