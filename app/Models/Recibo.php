<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Recibo
 * 
 * @property int $id
 * @property Carbon|null $Fecha
 * @property float|null $Total
 * @property int $CitaID
 * @property int $ClienteID
 * @property int|null $DetalleReciboID
 * @property int $TrabajadoraID
 * 
 * @property Citum $citum
 * @property Cliente $cliente
 * @property Detallerecibo $detallerecibo
 * @property Trabajadora $trabajadora
 *
 * @package App\Models
 */
class Recibo extends Model
{
	protected $table = 'recibo';
	public $timestamps = false;

	protected $casts = [
		'Fecha' => 'datetime',
		'Total' => 'float',
		'CitaID' => 'int',
		'ClienteID' => 'int',
		'DetalleReciboID' => 'int',
		'TrabajadoraID' => 'int'
	];

	protected $fillable = [
		'Fecha',
		'Total',
		'CitaID',
		'ClienteID',
		'DetalleReciboID',
		'TrabajadoraID'
	];

	public function citum()
	{
		return $this->belongsTo(Citum::class, 'id');
	}

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'id');
	}

	public function detallerecibo()
	{
		return $this->belongsTo(Detallerecibo::class, 'id');
	}

	public function trabajadora()
	{
		return $this->belongsTo(Trabajadora::class, 'id');
	}
}
