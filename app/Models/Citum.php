<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Citum
 * 
 * @property int $id
 * @property Carbon|null $Fecha
 * @property Carbon|null $Hora
 * @property int $ClienteID
 * @property int $TrabajadoraID
 * @property int|null $Detalle_citaID
 * 
 * @property Cliente $cliente
 * @property DetalleCitum $detalle_citum
 * @property Trabajadora $trabajadora
 * @property Recibo $recibo
 *
 * @package App\Models
 */
class Citum extends Model
{
	protected $table = 'cita';
	public $timestamps = false;

	protected $casts = [
		'Fecha' => 'datetime',
		'Hora' => 'datetime',
		'ClienteID' => 'int',
		'TrabajadoraID' => 'int',
		'Detalle_citaID' => 'int'
	];

	protected $fillable = [
		'Fecha',
		'Hora',
		'ClienteID',
		'TrabajadoraID',
		'Detalle_citaID'
	];

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'id');
	}

	public function detalle_citum()
	{
		return $this->belongsTo(DetalleCitum::class, 'id');
	}

	public function trabajadora()
	{
		return $this->belongsTo(Trabajadora::class, 'id');
	}

	public function recibo()
	{
		return $this->hasOne(Recibo::class, 'id');
	}
}
