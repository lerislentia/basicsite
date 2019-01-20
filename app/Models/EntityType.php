<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 13 Jan 2019 18:38:13 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class EntityType
 * 
 * @property int $id
 * @property int $entity_id
 * @property int $type_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Entity $entity
 * @property \App\Models\Type $type
 *
 */
class EntityType extends BaseModel
{
    protected $table = 'entity_type';

    protected $casts = [
        'entity_id' => 'int',
        'type_id' => 'int'
    ];

    protected $appends = [
        'locale_value', 'type', 'entity'
    ];

    protected $fillable = [
        'entity_id',
        'type_id'
    ];

    public function entity()
    {
        return $this->belongsTo(\App\Models\Entity::class);
    }

    public function type()
    {
        return $this->belongsTo(\App\Models\Type::class);
    }


    /**
     * ACCESSORS
     */
    public function getTypeAttribute()
    {
        if (!isset($this->attributes['type_id'])) {
            return null;
        }
        $type 								= $this->Type()->first();
        $text 								= $type->textName()->first();

        $translations 						= $text->translations()->get();
        foreach ($translations as $translation) {
            $trans[$translation->locale_id] = $translation->toArray();
        }
        return ['lang' => $trans];
    }

    public function getEntityAttribute()
    {
        if (!isset($this->attributes['entity_id'])) {
            return null;
        }
        return $this->Entity()->first()->name;
    }
}
