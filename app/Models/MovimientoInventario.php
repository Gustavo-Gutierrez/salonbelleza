<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    use HasFactory;

    protected $table = 'movimientos_inventario';

    protected $fillable = [
        'fecha',
        'tipo',
        'motivo',
        'cantidad',
        'cantidad_anterior',
        'cantidad_nueva',
        'observaciones',
        'producto_id',
        'user_id',
        'cita_id',
    ];

    protected $casts = [
        'fecha' => 'date',
        'cantidad' => 'integer',
        'cantidad_anterior' => 'integer',
        'cantidad_nueva' => 'integer',
    ];

    // Relaciones
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    // Scopes
    public function scopeEntradas($query)
    {
        return $query->where('tipo', 'entrada');
    }

    public function scopeSalidas($query)
    {
        return $query->where('tipo', 'salida');
    }
}