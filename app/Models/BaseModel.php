<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BaseModel extends Model{

    const ID = 'id';

    protected $locale;

    /**
	 * ACCESSORS
	 */

    public function getLocaleValueAttribute()
    {
        return isset($this->locale) ? $this->locale : Session('locale');
    }
    
    public function setLocaleAttribute($locale){
        $this->locale = $locale;
    }
}