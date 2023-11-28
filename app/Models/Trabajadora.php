<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Trabajadora
 * 
 * @property int $id
 * @property int|null $Ci
 * @property string|null $Especialidad
 * @property string|null $Horario
 * @property string|null $Nombre
 * 
 * @property Citum $citum
 * @property Recibo $recibo
 *
 * @package App\Models
 */
class Trabajadora extends Model
{
	protected $table = 'trabajadora';
	public $timestamps = false;

	protected $casts = [
		'Ci' => 'int'
	];

	protected $fillable = [
		'Ci',
		'Especialidad',
		'Horario',
		'Nombre'
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
