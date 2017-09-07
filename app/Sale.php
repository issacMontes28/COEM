<?php

namespace COEM;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
  /**
   * Tabla de la base de datos usada por el modelo
   *
   * @var string
   */
  protected $table = 'ventas';
  /**
   * Atributos que son asignados a cada instancia del modelo
   *
   * @var array
   */
  protected $fillable = [	'id_cliente','id_producto','cantidad','fecha','nfactura','forma_pago','id_promocion'];

    public function pacient(){
        return $this->belongsTo('COEM\Pacient','id_cliente');
    }
    public function medicament(){
        return $this->belongsTo('COEM\Medicament','id_producto');
    }
    public function scopeFecha($query,$fecha1){
      if ($fecha1 != null) {
        $query->where('fecha',"=","$fecha1");
      }
    }
    public function scopeName($query,$id_paciente){
      if ($id_paciente != null) {
        $query->where('id_cliente',"=","$id_paciente");
      }
    }

}
