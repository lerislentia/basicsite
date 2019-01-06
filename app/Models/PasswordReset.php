<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class PasswordReset
 * 
 * @property string $email
 * @property string $token
 * @property \Carbon\Carbon $created_at
 *
 */
class PasswordReset extends BaseModel
{
    const TOKEN = 'token';
    const EMAIL = 'email';

    public $incrementing = false;
    public $timestamps = false;

    protected $hidden = [
        self::TOKEN
    ];

    protected $fillable = [
        self::EMAIL,
        self::TOKEN
    ];
    protected $appends = [
        'locale_value'
    ];
}
