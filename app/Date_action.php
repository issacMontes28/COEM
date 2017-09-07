<?php

namespace COEM;

use COEM\Date;
use COEM\Date_action;
use DB;
use Illuminate\Database\Eloquent\Model;

class Date_action extends Model
{
  /**
   * Tabla de la base de datos usada por el modelo
   *
   * @var string
   */
  protected $table = 'date_actions';
  /**
   * Atributos que son asignados a cada instancia del modelo
   *
   * @var array
   */
  protected $fillable = [	'id_cita','fecha','modificaciones','asistencia','nota',
  'peso_actual','peso_dif','cintura_actual','cintura_dif','cadera_actual','cadera_dif'];

  public function date(){
      return $this->belongsTo('COEM\Date','id_cita');
  }
  public function scopeFecha($query,$fecha1){
    if ($fecha1 != null) {
      $query->where('fecha',"=","$fecha1");
    }
  }
  public function scopeName($query,$id_paciente){
    if ($id_paciente != null) {
      $fila_citas = DB::select("select * from dates where id_paciente='$id_paciente'");
      $array = array();
      foreach ($fila_citas as $cita) {
        $array[] = array('valor'=> $cita->id);
      }
      $query->whereIn('id_cita',$array);
    }
  }
}
