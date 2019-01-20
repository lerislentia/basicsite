<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 13 Jan 2019 18:38:15 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Text
 * 
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $categories
 * @property \Illuminate\Database\Eloquent\Collection $elements
 * @property \Illuminate\Database\Eloquent\Collection $events
 * @property \Illuminate\Database\Eloquent\Collection $products
 * @property \Illuminate\Database\Eloquent\Collection $properties
 * @property \Illuminate\Database\Eloquent\Collection $sections
 * @property \Illuminate\Database\Eloquent\Collection $states
 * @property \Illuminate\Database\Eloquent\Collection $testimonials
 * @property \Illuminate\Database\Eloquent\Collection $translations
 * @property \Illuminate\Database\Eloquent\Collection $types
 *
 */
class Text extends BaseModel
{
    protected $table = 'text';

    public function categories()
    {
        return $this->hasMany(\App\Models\Categorie::class, 'description');
    }

    public function elements()
    {
        return $this->hasMany(\App\Models\Element::class, 'name');
    }

    public function events()
    {
        return $this->hasMany(\App\Models\Event::class, 'description');
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'description');
    }

    public function properties()
    {
        return $this->hasMany(\App\Models\Propertie::class, 'name');
    }

    public function sections()
    {
        return $this->belongsToMany(\App\Models\Section::class)
                    ->withPivot('id', 'sequence', 'type_id')
                    ->withTimestamps();
    }

    public function states()
    {
        return $this->hasMany(\App\Models\State::class, 'name');
    }

    public function testimonials()
    {
        return $this->hasMany(\App\Models\Testimonial::class, 'comment');
    }

    public function translations()
    {
        return $this->hasMany(\App\Models\Translation::class);
    }

    public function types()
    {
        return $this->hasMany(\App\Models\Type::class, 'name');
    }
}
