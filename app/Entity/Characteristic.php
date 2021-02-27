<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Characteristic
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property array $options
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @mixin \Eloquent
 */
class Characteristic extends Model
{
    const TYPE_STRING = 'string';
    const TYPE_SELECT = 'select';

    protected $table = 'product_characteristics';

    protected $fillable = [
        'name',
        'type',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function isString(): bool
    {
        return $this->type === self::TYPE_STRING;
    }

    public function isSelect(): bool
    {
        return $this->type === self::TYPE_SELECT;
    }

    public function getOptions(): array
    {
        if ($this->isString()) {
            return [];
        }
        return $this->options;
    }

    public static function getTypesList(): array
    {
        return [
            self::TYPE_STRING => 'String',
            self::TYPE_SELECT => 'Select',
        ];
    }
}
