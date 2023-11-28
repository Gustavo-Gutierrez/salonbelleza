<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 * 
 * @property int $id
 * @property int|null $Cantidad
 * @property string|null $Nombre
 * @property float|null $Precio
 * 
 * @property DetalleServicio $detalle_servicio
 * @property Detallerecibo $detallerecibo
 *
 * @package App\Models
 */
class Producto extends Model
{
	protected $table = 'producto';
	public $timestamps = false;

	protected $casts = [
		'Cantidad' => 'int',
		'Precio' => 'float'
	];

	protected $fillable = [
		'Cantidad',
		'Nombre',
		'Precio'
	];

	public function detalle_servicio()
	{
		return $this->hasOne(DetalleServicio::class, 'id');
	}

	public function detallerecibo()
	{
		return $this->hasOne(Detallerecibo::class, 'id');
	}
}
