<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
    use HasFactory;

    protected $fillable = ['nome_access_level'];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_access_levels');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_access');
    }
}
