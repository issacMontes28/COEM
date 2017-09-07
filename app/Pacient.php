<?php namespace COEM;

use COEM\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pacient extends Model {

	use SoftDeletes;
	/**
	 * Tabla de la base de datos usada por el modelo
	 *
	 * @var string
	 */

	protected $table = "pacients";
	protected $dates = ['deleted_at'];

	/**
	 * Atributos que son asignados a cada instancia del modelo
	 *
	 * @var array
	 */
	protected $fillable = ['apaterno','amaterno','nombre','fecha_nac','calle',
  'num_ext','num_int','colonia','cp','localidad','municipio','estado','telefono_casa','telefono_celular',
  'telefono_oficina','correo','fecha_inicio','kilos','cintura','cadera','fecha_fin','referido_por'];

	public function dates(){
		return $this->hasMany('COEM\Date');
	}
	public function scopeName($query,$name){
		if (trim($name) != "") {
			$query->where(\DB::raw("CONCAT(nombre,' ',apaterno,' ',amaterno)"),"LIKE","%$name%");
		}
	}
}
