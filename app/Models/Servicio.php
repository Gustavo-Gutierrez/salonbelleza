<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Servicio
 * 
 * @property int $id
 * @property string|null $Nombre
 * @property float|null $Precio
 * @property int|null $Detalle_servicioID
 * 
 * @property DetalleServicio $detalle_servicio
 * @property DetalleCitum $detalle_citum
 *
 * @package App\Models
 */
class Servicio extends Model
{
	protected $table = 'servicio';
	public $timestamps = false;

	protected $casts = [
		'Precio' => 'float',
		'Detalle_servicioID' => 'int'
	];

	protected $fillable = [
		'Nombre',
		'Precio',
		'Detalle_servicioID'
	];

	public function detalle_servicio()
	{
		return $this->belongsTo(DetalleServicio::class, 'id');
	}

	public function detalle_citum()
	{
		return $this->hasOne(DetalleCitum::class, 'id');
	}
}
