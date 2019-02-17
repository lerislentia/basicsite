<?php

namespace App\Models;

use App\Models\BaseModel;

class Page extends BaseModel
{
    const NAME 			= 'name';
    const TAGS 			= 'tags';
    const STATE		    = 'state_id';

    protected $table    = 'page';

    protected $casts = [
        self::NAME 			=> 'int'
    ];

    protected $fillable = [
        self::NAME,
        self::TAGS,
        self::STATE
    ];

    protected $appends = [
        'locale_value', 'name_value'
    ];

    public function sections()
    {
        return $this->belongsToMany(\App\Models\Section::class)
                    ->withPivot('id')
                    ->withTimestamps();
    }

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
}
