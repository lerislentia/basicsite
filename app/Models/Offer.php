<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 01 May 2019 13:05:11 +0000.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Offer
 * 
 * @property int $id
 * @property int $advanceBookingRequirement
 * @property int $aggregateRating
 * @property string $availability
 * @property \Carbon\Carbon $availabilityEnds
 * @property \Carbon\Carbon $availabilityStarts
 * @property string $availableDeliveryMethod
 * @property int $price
 * @property string $priceCurrency
 * @property int $product_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Currency $currency
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class Offer extends BaseModel
{

	protected $table = 'offer';

	protected $casts = [
		'advanceBookingRequirement' => 'int',
		'aggregateRating' => 'int',
		'price' => 'int',
		'product_id' => 'int'
	];

	protected $dates = [
		'availabilityEnds',
		'availabilityStarts'
	];

	protected $fillable = [
		'advanceBookingRequirement',
		'aggregateRating',
		'availability',
		'availabilityEnds',
		'availabilityStarts',
		'availableDeliveryMethod',
		'price',
		'priceCurrency',
		'product_id'
	];

	public function currency()
	{
		return $this->belongsTo(\App\Models\Currency::class, 'priceCurrency');
	}

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
