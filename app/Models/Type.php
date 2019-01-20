<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Type
 * 
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $galleries
 * @property \Illuminate\Database\Eloquent\Collection $section_texts
 *
 */
class Type extends BaseModel
{
    const NAME       = 'name';
    const DEFINITION = 'definition';

    protected $table = 'type';

    protected $fillable = [
        self::NAME,
        self::DEFINITION
    ];

    protected $casts = [
        self::NAME 			=> 'int',
    ];

    protected $appends = [
        'locale_value', 'name_value'
    ];


    public function textName()
    {
        return $this->belongsTo(\App\Models\Text::class, 'name');
    }

    public function galleries()
    {
        return $this->hasMany(\App\Models\Gallery::class);
    }

    public function section_texts()
    {
        return $this->hasMany(\App\Models\SectionText::class);
    }

    public function elements()
    {
        return $this->hasMany(\App\Models\Element::class);
    }

    public function entities()
    {
        return $this->belongsToMany(\App\Models\Entity::class)
                    ->withPivot('id')
                    ->withTimestamps();
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
        if (!isset($this->attributes['name'])) {
            return null;
        }
        $name 								= $this->textName()->first();

        $translations 						= $name->translations()->get();

        foreach ($translations as $translation) {
            $trans[$translation->locale_id] = $translation->toArray();
        }
        return ['lang' => $trans];
    }
}
