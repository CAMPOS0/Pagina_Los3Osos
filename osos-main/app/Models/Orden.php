<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $fillable = [
        'menu_id',
        'cantidad',
        'total',
        'estado'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
