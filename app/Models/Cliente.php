<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 * 
 * @property int $id
 * @property int|null $Ci
 * @property string|null $Direccion
 * @property string|null $Email
 * @property string|null $Nombre
 * @property string|null $Telefono
 * 
 * @property Citum $citum
 * @property Recibo $recibo
 *
 * @package App\Models
 */
class Cliente extends Model
{
	protected $table = 'cliente';
	public $timestamps = false;

	protected $casts = [
		'Ci' => 'int'
	];

	protected $fillable = [
		'Ci',
		'Direccion',
		'Email',
		'Nombre',
		'Telefono'
	];

	public function citum()
	{
		return $this->hasOne(Citum::class, 'id');
	}

	public function recibo()
	{
		return $this->hasOne(Recibo::class, 'id');
	}
}
