<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Contact
 * 
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $phone
 * @property string $email
 * @property string $message
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Contact extends BaseModel
{
	const FIRSTNAME = 'firstname';
	const LASTNAME 	= 'lastname';
	const PHONE 	= 'phone';
	const EMAIL 	= 'email';
	const MESSAGE 	= 'message';


	protected $table = 'contact';

	protected $fillable = [
		self::FIRSTNAME,
		self::LASTNAME,
		self::PHONE,
		self::EMAIL,
		self::MESSAGE
	];
	protected $appends = [
		'locale_value'
	];
	
}
