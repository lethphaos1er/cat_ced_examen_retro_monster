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

    // Si tu n'as PAS de table liée, garde pas de relation ici.
    // Si tu en as une plus tard, tu la remettras.
}
