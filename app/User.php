<?php namespace COEM;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, SoftDeletes;

	/**
	 * Tabla de la base de datos usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'users';
	/**
	 * Atributos que son asignados a cada instancia del modelo
	 *
	 * @var array
	 */
	protected $fillable = [	'nombre','apellidos','telefono','correo' ,'tipo_usuario','password'];
	protected $dates = ['deleted_at'];

	/**
	 * Atributos excluidos de la forma JSON del modelo.
	 *
	 * @var array
	 */
	//protected $hidden = ['password'];
	public function setPasswordAttribute($valor){
		if(!empty($valor)){
				$this->attributes['password'] = \Hash::make($valor);
		}
	}
	public function scopeName($query,$name){
		if (trim($name) != "") {
			$query->where(\DB::raw("CONCAT(nombre,' ',apellidos)"),"LIKE","%$name%");
		}
	}
}
