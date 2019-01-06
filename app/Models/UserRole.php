<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class UserRole
 * 
 * @property int $user_id
 * @property int $role_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Role $role
 * @property \App\Models\User $user
 *
 */
class UserRole extends BaseModel
{
    const USER 	= 'user_id';
    const ROLE 	= 'role_id';

    protected $table = 'user_role';
    public $incrementing = false;

    protected $casts = [
        self::USER => 'int',
        self::ROLE => 'int'
    ];
    protected $appends = [
        'locale_value'
    ];
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
