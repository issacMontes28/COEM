<?php

namespace COEM;

use COEM\Pacient;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Date extends Model
{
  use SoftDeletes;
  /**
   * Tabla de la base de datos usada por el modelo Cita
   *
   * @var string
   */
  protected $table = 'dates';
  protected $dates = ['deleted_at'];
  /**
   * Atributos que son llenados cuando se crea un nuevo registro de Cita
   *
   * @var array
   */
  protected $fillable = ['id_paciente','fecha','hora','division','tipo_cita','id_doctor'];

  public function pacient(){
   		return $this->belongsTo('COEM\Pacient','id_paciente');
  }
  public function date_actions(){
      return $this->hasMany('COEM\Date_action');
  }
  public function scopeFecha($query,$fecha1){
    if ($fecha1 != null) {
      $query->where('fecha',"=","$fecha1");
    }
  }
  public function scopeName($query,$id_paciente){
      if ($id_paciente != null) {
        /*$cita = Date::findOrFail(1);
        echo $cita->pacient->nombre;*/
  			$query->where('id_paciente',"=","$id_paciente");
  		}
    }

}
