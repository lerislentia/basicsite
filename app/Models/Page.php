<?php

namespace App\Models;

use App\Models\BaseModel;

class Page extends BaseModel
{
    const NAME 			= 'name';
    const TAGS 			= 'tags';
    const STATE		    = 'state_id';

    protected $table    = 'page';

    protected $fillable = [
        self::NAME,
        self::TAGS,
        self::STATE
    ];

    protected $appends = [
        'locale_value'
    ];

    public function sections()
    {
        return $this->belongsToMany(\App\Models\Section::class)
                    ->withPivot('id')
                    ->withTimestamps();
    }

    public function pagesections()
    {
        return $this->hasMAny(\App\Models\PageSection::class)
        ->orderBy(\App\Models\PageSection::ORDER);
    }
}
