<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Translation
 * 
 * @property int $id
 * @property string $text
 * @property string $locale_id
 * @property int $text_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Locale $locale
 *
 */
class Translation extends BaseModel
{
    const TEXTID 	= 'text_id';
    const TEXT 		= 'text';
    const LOCALE 	= 'locale_id';

    protected $table = 'translation';

    protected $casts = [
        self::TEXTID => 'int'
    ];

    protected $fillable = [
        self::TEXT,
        self::LOCALE,
        self::TEXTID
    ];
    protected $appends = [
        'locale_value'
    ];
    public function locale()
    {
        return $this->belongsTo(\App\Models\Locale::class);
    }

    public function text()
    {
        return $this->belongsTo(\App\Models\Text::class);
    }
}
