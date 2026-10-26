<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cita extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'codigo',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado',
        'notas',
        'total',
        'descuento',
        'total_final',
        'cliente_id',
        'empleado_id',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora_inicio' => 'datetime',
        'hora_fin' => 'datetime',
        'total' => 'decimal:2',
        'descuento' => 'decimal:2',
        'total_final' => 'decimal:2',
    ];

    // Relaciones
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function empleado()
    {
        return $this->belongsTo(User::class, 'empleado_id');
    }

    public function detalleCitas()
    {
        return $this->hasMany(DetalleCita::class);
    }

    public function recibo()
    {
        return $this->hasOne(Recibo::class);
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'detalle_citas')
                    ->withPivot(['cantidad', 'precio_unitario', 'subtotal'])
                    ->withTimestamps();
    }

    // Scopes
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeConfirmadas($query)
    {
        return $query->where('estado', 'confirmada');
    }

    public function scopeCompletadas($query)
    {
        return $query->where('estado', 'completada');
    }

    public function scopeCanceladas($query)
    {
        return $query->where('estado', 'cancelada');
    }

    public function scopeParaHoy($query)
    {
        return $query->whereDate('fecha', today());
    }

    public function scopeEntreFechas($query, $inicio, $fin)
    {
        return $query->whereBetween('fecha', [$inicio, $fin]);
    }

    public function scopePorEmpleado($query, $empleadoId)
    {
        return $query->where('empleado_id', $empleadoId);
    }

    public function scopePorCliente($query, $clienteId)
    {
        return $query->where('cliente_id', $clienteId);
    }

    // Métodos
    public function calcularDuracion()
    {
        if ($this->hora_inicio && $this->hora_fin) {
            $inicio = \Carbon\Carbon::parse($this->hora_inicio);
            $fin = \Carbon\Carbon::parse($this->hora_fin);
            return $inicio->diffInMinutes($fin);
        }
        
        // Calcular duración basada en servicios
        $duracion = $this->detalleCitas->sum(function($detalle) {
            return optional($detalle->servicio)->duracion_minutos * $detalle->cantidad;
        });
        
        return $duracion ?: 60;
    }

    public function calcularTotal()
    {
        $total = $this->detalleCitas->sum('subtotal');
        $this->total = $total;
        $this->total_final = $total - $this->descuento;
        $this->save();
    }

    public function estaDisponible()
    {
        $existeConflicto = self::where('empleado_id', $this->empleado_id)
            ->where('fecha', $this->fecha)
            ->where('id', '!=', $this->id)
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('hora_inicio', '<', $this->hora_fin)
                      ->where('hora_fin', '>', $this->hora_inicio);
                });
            })
            ->whereIn('estado', ['pendiente', 'confirmada', 'en_proceso'])
            ->exists();

        return !$existeConflicto;
    }

    // Eventos
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cita) {
            $cita->codigo = 'CITA-' . date('Ymd') . '-' . str_pad(Cita::max('id') + 1, 4, '0', STR_PAD_LEFT);
            
            // Calcular hora_fin basado en servicios
            if ($cita->hora_inicio && !$cita->hora_fin) {
                $cita->hora_fin = \Carbon\Carbon::parse($cita->hora_inicio)->addMinutes(60);
            }
        });

        static::created(function ($cita) {
            $cita->calcularTotal();
        });
    }
}