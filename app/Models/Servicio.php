<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'precio',
        'duracion_minutos',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'duracion_minutos' => 'integer',
        'activo' => 'boolean',
    ];

    // Relaciones
    public function detalleCitas()
    {
        return $this->hasMany(DetalleCita::class);
    }

    public function citas()
    {
        return $this->belongsToMany(Cita::class, 'detalle_citas')
                    ->withPivot(['cantidad', 'precio_unitario', 'subtotal'])
                    ->withTimestamps();
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    // Métodos
    public function generarCodigo()
    {
        if (!$this->codigo) {
            $this->codigo = 'SERV-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
            $this->save();
        }
        return $this->codigo;
    }

    // Atributos calculados
    public function getVecesUtilizadoAttribute()
    {
        return $this->detalleCitas()->count();
    }

    public function getTotalVendidoAttribute()
    {
        return $this->detalleCitas()->sum('subtotal');
    }

    // Eventos
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($servicio) {
            $servicio->codigo = 'SERV-' . str_pad(Servicio::max('id') + 1, 6, '0', STR_PAD_LEFT);
        });
    }
}