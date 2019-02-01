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
class Layout extends BaseModel
{
    const NAME = 'name';
    const STATE     = 'state_id';

    protected $table = 'layout';

    protected $casts = [
        'state_id' => 'int',
    ];

    protected $fillable = [
        self::NAME,
        self::STATE
    ];

    protected $appends = [
        'locale_value'
    ];

    public function state()
    {
        return $this->belongsTo(\App\Models\State::class);
    }

    
}
