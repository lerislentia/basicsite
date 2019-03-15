<?php

namespace App\Models;

use App\Models\BaseModel;

class PageSection extends BaseModel
{
    const PAGE 	    = 'page_id';
    const SECTION   = 'section_id';
    const ORDER     = 'order';

    protected $table = 'page_section';

    protected $casts = [
        self::ORDER 	=> 'int',
    ];

    protected $fillable = [
        self::PAGE,
        self::SECTION,
        self::ORDER,
    ];

    protected $appends = [
        'locale_value', 'page', 'section'
    ];

    public function page()
    {
        return $this->belongsTo(\App\Models\Page::class);
    }

    public function section()
    {
        return $this->belongsTo(\App\Models\Section::class);
    }

    /**
     * ACCESSORS
     */
    public function getPageAttribute()
    {
        if (!isset($this->attributes[self::PAGE])) {
            return null;
        }
        return $this->Page()->first();
    }

    public function getSectionAttribute()
    {
        if (!isset($this->attributes[self::SECTION])) {
            return null;
        }
        return $this->Section()->first();
    }
}
