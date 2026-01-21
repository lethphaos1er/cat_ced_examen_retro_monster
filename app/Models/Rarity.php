<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rarity extends Model
{
    use HasFactory;

    protected $table = 'rarities';

    protected $fillable = [
        'name',
    ];

    public function monsters()
    {
        return $this->hasMany(Monster::class, 'rarity_id');
    }
}
