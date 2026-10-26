<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recibo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'codigo',
        'fecha',
        'subtotal',
        'descuento',
        'iva',
        'total',
        'metodo_pago',
        'observaciones',
        'qr_code',
        'cita_id',
        'cliente_id',
        'empleado_id',
        'user_id',
    ];

    protected $casts = [
        'fecha' => 'date',
        'subtotal' => 'decimal:2',
        'descuento' => 'decimal:2',
        'iva' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // Relaciones
    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function empleado()
    {
        return $this->belongsTo(User::class, 'empleado_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scopes
    public function scopeEntreFechas($query, $inicio, $fin)
    {
        return $query->whereBetween('fecha', [$inicio, $fin]);
    }

    public function scopePorMetodoPago($query, $metodo)
    {
        return $query->where('metodo_pago', $metodo);
    }

    public function scopePorEmpleado($query, $empleadoId)
    {
        return $query->where('empleado_id', $empleadoId);
    }

    // Métodos
    public function calcularTotales()
    {
        if ($this->cita) {
            $this->subtotal = $this->cita->total;
            $this->descuento = $this->cita->descuento;
            $this->iva = $this->subtotal * 0.16; // 16% IVA (ajustar según país)
            $this->total = ($this->subtotal - $this->descuento) + $this->iva;
        }
    }

    // Eventos
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($recibo) {
            $recibo->codigo = 'REC-' . date('Ymd') . '-' . str_pad(Recibo::max('id') + 1, 6, '0', STR_PAD_LEFT);
            $recibo->calcularTotales();
        });
    }
}