<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class LtmTranslation
 * 
 * @property int $id
 * @property int $status
 * @property string $locale
 * @property string $group
 * @property string $key
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 */
class LtmTranslation extends BaseModel
{
    const STATUS 	= 'status';
    const LOCALE 	= 'locale';
    const GROUP 	= 'group';
    const KEY 		= 'key';
    const VALUE 	= 'value';

    protected $casts = [
        self::STATUS => 'int'
    ];

    protected $fillable = [
        self::STATUS,
        self::LOCALE,
        self::GROUP,
        self::KEY,
        self::VALUE
    ];
    protected $appends = [
        'locale_value'
    ];
}
