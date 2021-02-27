<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\CharacteristicValue
 *
 * @property int $id
 * @property int $product_id
 * @property int $characteristic_id
 * @property string $value
 * @property-read \App\Entity\Characteristic $characteristic
 * @property-read \App\Entity\Product $product
 * @mixin \Eloquent
 */
class CharacteristicValue extends Model
{
    protected $table = 'product_characteristic_values';

    protected $fillable = [
        'product_id',
        'characteristic_id',
        'value',
    ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class, 'characteristic_id', 'id');
    }
}
