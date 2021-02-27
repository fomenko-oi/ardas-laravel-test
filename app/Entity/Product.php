<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Product
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\CharacteristicValue[] $characteristicValues
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
    ];

    public function characteristicValues()
    {
        return $this->hasMany(CharacteristicValue::class, 'product_id', 'id');
    }

    public function addCharacteristic(int $characteristicId, string $value): CharacteristicValue
    {
        return $this->characteristicValues()->create([
            'characteristic_id' => $characteristicId,
            'value' => $value,
        ]);
    }
}
