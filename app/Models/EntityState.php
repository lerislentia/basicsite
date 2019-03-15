<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 02 Dec 2018 14:30:09 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class EntityState
 * 
 * @property int $entity_id
 * @property int $state_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Entity $entity
 * @property \App\Models\State $state
 *
 */
class EntityState extends BaseModel
{
    const ENTITY 	= 'entity_id';
    const STATE 	= 'state_id';

    protected $table = 'entity_state';

    protected $casts = [
        self::ENTITY => 'int',
        self::STATE => 'int'
    ];
    protected $fillable = [
        self::ENTITY,
        self::STATE
    ];

    protected $appends = [
        'locale_value', 'state', 'entity'
    ];
    public function entity()
    {
        return $this->belongsTo(\App\Models\Entity::class);
    }

    public function state()
    {
        return $this->belongsTo(\App\Models\State::class);
    }


    /**
     * ACCESSORS
     */
    public function getStateAttribute()
    {
        if (!isset($this->attributes['state_id'])) {
            return null;
        }
        return  $this->state()->first();
        // $text 								= $state->textName()->first();

        // $translations 						= $text->translations()->get();
        // foreach ($translations as $translation) {
        //     $trans[$translation->locale_id] = $translation->toArray();
        // }
        // return ['lang' => $trans];
    }

    public function getEntityAttribute()
    {
        if (!isset($this->attributes['entity_id'])) {
            return null;
        }
        return $this->entity()->first();
    }
}
