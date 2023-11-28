<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalleCitum
 * 
 * @property int $id
 * @property Carbon|null $Hora
 * @property int|null $ServicioID
 * 
 * @property Servicio $servicio
 * @property Citum $citum
 *
 * @package App\Models
 */
class DetalleCitum extends Model
{
	protected $table = 'detalle_cita';
	public $timestamps = false;

	protected $casts = [
		'Hora' => 'datetime',
		'ServicioID' => 'int'
	];

	protected $fillable = [
		'Hora',
		'ServicioID'
	];

	public function servicio()
	{
		return $this->belongsTo(Servicio::class, 'id');
	}

	public function citum()
	{
		return $this->hasOne(Citum::class, 'id');
	}
}
