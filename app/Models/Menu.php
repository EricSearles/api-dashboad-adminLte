<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'rota'];

    public function accessLevels()
    {
        return $this->belongsToMany(AccessLevel::class, 'menu_access_levels');
    }
}
