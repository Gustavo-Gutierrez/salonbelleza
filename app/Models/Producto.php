<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'categoria',
        'stock_minimo',
        'stock_actual',
        'precio_compra',
        'precio_venta',
        'unidad_medida',
        'fecha_vencimiento',
        'ubicacion',
        'activo',
    ];

    protected $casts = [
        'stock_minimo' => 'integer',
        'stock_actual' => 'integer',
        'precio_compra' => 'decimal:2',
        'precio_venta' => 'decimal:2',
        'fecha_vencimiento' => 'date',
        'activo' => 'boolean',
    ];

    // Relaciones
    public function detalleCitas()
    {
        return $this->hasMany(DetalleCita::class);
    }

    public function movimientos()
    {
        return $this->hasMany(MovimientoInventario::class);
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    public function scopeBajoStock($query)
    {
        return $query->whereColumn('stock_actual', '<=', 'stock_minimo');
    }

    public function scopePorCategoria($query, $categoria)
    {
        return $query->where('categoria', $categoria);
    }

    // Métodos
    public function generarCodigo()
    {
        if (!$this->codigo) {
            $this->codigo = 'PROD-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
            $this->save();
        }
        return $this->codigo;
    }

    public function estaBajoStock()
    {
        return $this->stock_actual <= $this->stock_minimo;
    }

    public function agregarStock($cantidad, $motivo = 'Entrada manual', $userId = null)
    {
        $cantidadAnterior = $this->stock_actual;
        $this->stock_actual += $cantidad;
        $this->save();

        // Registrar movimiento
        if ($userId) {
            MovimientoInventario::create([
                'fecha' => now(),
                'tipo' => 'entrada',
                'motivo' => $motivo,
                'cantidad' => $cantidad,
                'cantidad_anterior' => $cantidadAnterior,
                'cantidad_nueva' => $this->stock_actual,
                'producto_id' => $this->id,
                'user_id' => $userId,
            ]);
        }

        return $this;
    }

    public function reducirStock($cantidad, $motivo = 'Salida manual', $userId = null, $citaId = null)
    {
        if ($cantidad > $this->stock_actual) {
            throw new \Exception('Stock insuficiente');
        }

        $cantidadAnterior = $this->stock_actual;
        $this->stock_actual -= $cantidad;
        $this->save();

        // Registrar movimiento
        if ($userId) {
            MovimientoInventario::create([
                'fecha' => now(),
                'tipo' => 'salida',
                'motivo' => $motivo,
                'cantidad' => $cantidad,
                'cantidad_anterior' => $cantidadAnterior,
                'cantidad_nueva' => $this->stock_actual,
                'producto_id' => $this->id,
                'user_id' => $userId,
                'cita_id' => $citaId,
            ]);
        }

        return $this;
    }

    // Atributos calculados
    public function getValorInventarioAttribute()
    {
        return $this->stock_actual * $this->precio_compra;
    }

    public function getEstadoStockAttribute()
    {
        if ($this->stock_actual == 0) {
            return 'agotado';
        } elseif ($this->stock_actual <= $this->stock_minimo) {
            return 'bajo';
        } else {
            return 'normal';
        }
    }

    // Eventos
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($producto) {
            $producto->codigo = 'PROD-' . str_pad(Producto::max('id') + 1, 6, '0', STR_PAD_LEFT);
        });
    }
}