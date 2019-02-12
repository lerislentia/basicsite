<?php

namespace App\Models;

use App\Models\BaseModel;

class PageSection extends BaseModel
{
    const PAGE 	    = 'page_id';
    const SECTION   = 'section_id';

    protected $table = 'page_section';

    protected $casts = [
        self::PAGE 	    => 'int',
        self::SECTION 	=> 'int',
    ];

    protected $fillable = [
        self::PAGE,
        self::SECTION,
    ];

    protected $appends = [
        'locale_value'
    ];

    public function page()
    {
        return $this->belongsTo(\App\Models\Page::class);
    }

    public function section()
    {
        return $this->belongsTo(\App\Models\Section::class);
    }
}
