<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 */
class Role extends BaseModel
{
    const NAME 			= 'name';
    protected $table 	= 'role';

    protected $fillable = [
        self::NAME
    ];
    protected $appends = [
        'locale_value'
    ];
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'user_role')
                    ->withTimestamps();
    }
}
