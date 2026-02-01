<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'type_id',

        // ✅ string obligatoire en DB
        'rarity',

        // ✅ typo DB
        'rarety_id',

        'pv',
        'attack',
        'defense',
        'image_url',
        'description',
    ];

    public function type()
    {
        return $this->belongsTo(MonsterType::class, 'type_id');
    }
    public function rarety()
    {
        return $this->belongsTo(Rarity::class, 'rarety_id');
    }

}
