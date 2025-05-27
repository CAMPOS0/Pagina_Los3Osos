<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicio_id',
        'user_id', // si quieres registrar quién creó el evento (opcional)
        'precio_final',
        'ubicacion',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    // Relación con Servicio
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
