<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
    use HasFactory;

    protected $table = 'monsters';

    protected $fillable = [
        'name',
        'user_id',
        'rarity',
        'pv',
        'attack',
        'defense',
        'image_url',
        'description',
        'rarity_id',
        'type_id',
    ];

    protected $casts = [
        'pv' => 'integer',
        'attack' => 'integer',
        'defense' => 'integer',
        'user_id' => 'integer',
        'rarity_id' => 'integer',
        'type_id' => 'integer',
    ];

    public function type()
    {
        return $this->belongsTo(MonsterType::class, 'type_id');
    }

    public function rarity()
    {
        return $this->belongsTo(Rarity::class, 'rarity_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
