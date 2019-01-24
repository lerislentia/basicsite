<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 13 Jan 2019 18:38:13 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Element
 * 
 * @property int $id
 * @property int $name
 * @property int $type_id
 * @property int $section_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Section $section
 * @property \App\Models\Text $text
 * @property \App\Models\Type $type
 *
 */
class Element extends BaseModel
{
    protected $table = 'element';

    protected $casts = [
        'name' => 'int',
        'type_id' => 'int',
        'section_id' => 'int',
        'state_id' => 'int',
        'order' => 'int'
    ];

    protected $fillable = [
        'name',
        'type_id',
        'section_id',
        'state_id',
        'order',
        'data',
    ];

    protected $appends = [
        'name_value', 'state', 'section', 'type','locale_value', 'array_data'
    ];

    public function section()
    {
        return $this->belongsTo(\App\Models\Section::class);
    }

    public function text()
    {
        return $this->belongsTo(\App\Models\Text::class, 'name');
    }

    public function type()
    {
        return $this->belongsTo(\App\Models\Type::class);
    }

    public function state()
    {
        return $this->belongsTo(\App\Models\State::class);
    }

    public function images()
	{
		return $this->belongsToMany(\App\Models\Image::class)
					->withPivot('id');
	}

	public function texts()
	{
		return $this->belongsToMany(\App\Models\Text::class)
					->withPivot('id');
	}

    /**
     * custom relations
     */


    public function textName()
    {
        return $this->belongsTo(\App\Models\Text::class, 'name');
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

    public function getStateAttribute()
    {
        if (!isset($this->attributes['state_id'])) {
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

    public function getSectionAttribute()
    {
        if (!isset($this->attributes['section_id'])) {
            return null;
        }
        $section 							= $this->section()->first();
        $text 								= $section->textName()->first();
        $translations 						= $text->translations()->get();
        foreach ($translations as $translation) {
            $trans[$translation->locale_id] = $translation->toArray();
        }
        return ['lang' => $trans];
    }

    public function getTypeAttribute()
    {
        if (!isset($this->attributes['type_id'])) {
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
