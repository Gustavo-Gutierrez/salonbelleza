<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'ci',
        'birth_date',
        'role',
        'codigo_cliente',
        'codigo_empleado',
        'especialidad',
        'horario',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
    ];

    // Relaciones
    public function citasComoCliente()
    {
        return $this->hasMany(Cita::class, 'cliente_id');
    }

    public function citasComoEmpleado()
    {
        return $this->hasMany(Cita::class, 'empleado_id');
    }

    public function recibosEmitidos()
    {
        return $this->hasMany(Recibo::class, 'user_id');
    }

    public function recibosComoCliente()
    {
        return $this->hasMany(Recibo::class, 'cliente_id');
    }

    public function recibosComoEmpleado()
    {
        return $this->hasMany(Recibo::class, 'empleado_id');
    }

    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }

    public function movimientosInventario()
    {
        return $this->hasMany(MovimientoInventario::class);
    }

    // Scopes
    public function scopeClientes($query)
    {
        return $query->where('role', 'cliente');
    }

    public function scopeEmpleados($query)
    {
        return $query->where('role', 'empleado');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    // Métodos
    public function generarCodigoCliente()
    {
        if (!$this->codigo_cliente && $this->role == 'cliente') {
            $this->codigo_cliente = 'CLI-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
            $this->save();
        }
        return $this->codigo_cliente;
    }

    public function generarCodigoEmpleado()
    {
        if (!$this->codigo_empleado && $this->role == 'empleado') {
            $this->codigo_empleado = 'EMP-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
            $this->save();
        }
        return $this->codigo_empleado;
    }

    // Atributos calculados
    public function getTotalGastadoAttribute()
    {
        return $this->recibosComoCliente()->sum('total');
    }

    public function getCitasCompletadasAttribute()
    {
        return $this->citasComoCliente()->where('estado', 'completada')->count();
    }

    public function getTotalIngresosAttribute()
    {
        return $this->recibosComoEmpleado()->sum('total');
    }

    public function getCitasAtendidasAttribute()
    {
        return $this->citasComoEmpleado()->where('estado', 'completada')->count();
    }

    // Helpers
    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function isEmpleado()
    {
        return $this->role == 'empleado';
    }

    public function isCliente()
    {
        return $this->role == 'cliente';
    }

    // Eventos
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            if ($user->role == 'cliente') {
                $user->generarCodigoCliente();
            } elseif ($user->role == 'empleado') {
                $user->generarCodigoEmpleado();
            }
        });
    }
}