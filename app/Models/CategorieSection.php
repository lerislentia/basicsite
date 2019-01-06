<?php

namespace App\Models;

use App\Models\BaseModel;

class CategorieSection extends BaseModel{

    const CATEGORIE = 'categorie_id';
    const SECTION 	= 'product_id';

    protected $table = 'categorie_section';

    protected $casts = [
		self::CATEGORIE => 'int',
		self::SECTION 	=> 'int'
	];

	protected $fillable = [
		self::CATEGORIE,
		self::SECTION
	];

    public function categorie()
	{
		return $this->belongsTo(\App\Models\Categorie::class);
	}

	public function section()
	{
		return $this->belongsTo(\App\Models\Section::class);
	}
    
}