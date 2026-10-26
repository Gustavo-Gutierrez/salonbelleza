<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCita extends Model
{
    use HasFactory;

    protected $table = 'detalle_citas';

    protected $fillable = [
        'cita_id',
        'servicio_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relaciones
    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    // Eventos
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($detalle) {
            // Calcular subtotal automáticamente
            $detalle->subtotal = $detalle->cantidad * $detalle->precio_unitario;
        });

        static::saved(function ($detalle) {
            // Recalcular total de la cita
            if ($detalle->cita) {
                $detalle->cita->calcularTotal();
            }
        });

        static::deleted(function ($detalle) {
            // Recalcular total de la cita
            if ($detalle->cita) {
                $detalle->cita->calcularTotal();
            }
        });
    }
}