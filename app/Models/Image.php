<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Image
 * 
 * @property int $id
 * @property string $name
 * @property string $path
 * @property string $caption
 * @property string $description
 * @property float $width
 * @property float $height
 * @property string $href
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $galleries
 *
 */
class Image extends BaseModel
{
    const NAME 			= 'name';
    const PATH 			= 'path';
    const CAPTION 		= 'caption';
    const DESCRIPTION 	= 'desciprtion';
    const HREF 			= 'href';
    const WIDTH 		= 'width';
    const HEIGHT 		= 'height';

    protected $table = 'image';

    protected $casts = [
        self::WIDTH 	=> 'float',
        self::WIDTH 	=> 'float'
    ];

    protected $fillable = [
        self::NAME,
        self::PATH,
        self::CAPTION,
        self::DESCRIPTION,
        self::WIDTH,
        self::WIDTH,
        self::HREF
    ];
    protected $appends = [
        'locale_value'
    ];

    public function elements()
    {
        return $this->belongsToMany(\App\Models\Element::class)
                    ->withPivot('id');
    }
}
