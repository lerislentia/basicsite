<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Entity
 * 
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $states
 *
 */
class Entity extends BaseModel
{
    const NAME = 'name';

    protected $table = 'entity';

    protected $fillable = [
        self::NAME
    ];
    protected $appends = [
        'locale_value'
    ];
    public function states()
    {
        return $this->belongsToMany(\App\Models\State::class)
                    ->withTimestamps();
    }
}
