<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detallerecibo
 * 
 * @property int $id
 * @property int|null $Cantidad
 * @property int|null $Descuento
 * @property float|null $Precio_unitario
 * @property int|null $ProductoID
 * 
 * @property Producto $producto
 * @property Recibo $recibo
 *
 * @package App\Models
 */
class Detallerecibo extends Model
{
	protected $table = 'detallerecibo';
	public $timestamps = false;

	protected $casts = [
		'Cantidad' => 'int',
		'Descuento' => 'int',
		'Precio_unitario' => 'float',
		'ProductoID' => 'int'
	];

	protected $fillable = [
		'Cantidad',
		'Descuento',
		'Precio_unitario',
		'ProductoID'
	];

	public function producto()
	{
		return $this->belongsTo(Producto::class, 'id');
	}

	public function recibo()
	{
		return $this->hasOne(Recibo::class, 'id');
	}
}
