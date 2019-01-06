<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class User
 * 
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $username
 * @property string $password
 * @property string $password_salt
 * @property string $email
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $roles
 *
 * @package App\Models
 */
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
	use Authenticatable, Authorizable, CanResetPassword;

	const FIRSTNAME 	= 'firstname';
	const LASTNAME 		= 'lastname';
	const PASS 			= 'password';
	const SALT 			= 'password_salt';
	const EMAIL 		= 'email';
	const RMTOKEN 		= 'remember_token';
	const CREATED_AT 	= 'created_at';
	const UPDATED_AT 	= 'updated_at';

	protected $table 	= 'user';

	protected $hidden = [
		self::PASS,
		self::RMTOKEN
	];

	protected $fillable = [
		self::FIRSTNAME,
		self::LASTNAME,
		self::PASS,
		self::SALT,
		self::EMAIL,
		self::RMTOKEN
	];
	protected $appends = [
		'locale_value'
	];
	public function roles()
	{
		return $this->belongsToMany(\App\Models\Role::class, 'user_role')
					->withTimestamps();
	}
}
