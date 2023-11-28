<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalleServicio
 * 
 * @property int $id
 * @property int|null $Cantidad
 * @property int|null $ProductoID
 * 
 * @property Producto $producto
 * @property Servicio $servicio
 *
 * @package App\Models
 */
class DetalleServicio extends Model
{
	protected $table = 'detalle_servicio';
	public $timestamps = false;

	protected $casts = [
		'Cantidad' => 'int',
		'ProductoID' => 'int'
	];

	protected $fillable = [
		'Cantidad',
		'ProductoID'
	];

	public function producto()
	{
		return $this->belongsTo(Producto::class, 'id');
	}

	public function servicio()
	{
		return $this->hasOne(Servicio::class, 'id');
	}
}
