<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 13 Jan 2019 18:38:13 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class CategorieSection
 * 
 * @property int $categorie_id
 * @property int $section_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Categorie $categorie
 * @property \App\Models\Section $section
 *
 */
class CategorieSection extends BaseModel
{
    protected $table = 'categorie_section';
    public $incrementing = false;

    protected $casts = [
        'categorie_id' => 'int',
        'section_id' => 'int'
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
