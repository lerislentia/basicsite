<?php

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Site
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $pages
 *
 */
class Site extends BaseModel
{
    const NAME 		= 'name';
    const URL 		= 'url';
    const STATE 	= 'state';

    const STATE_ACTIVE = 1;

    protected $table = 'site';
    public $timestamps = false;

    protected $casts = [
        self::STATE => 'int'
    ];

    protected $fillable = [
        self::NAME,
        self::URL,
        self::STATE,
    ];

    public function pages()
    {
        return $this->hasMany(\App\Models\Page::class);
    }

    public function products()
	{
		return $this->hasMany(\App\Models\Product::class);
	}
}
