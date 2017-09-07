<?php

namespace COEM;

use Illuminate\Database\Eloquent\Model;

class MonthlyExpense extends Model
{
    /**
    * Tabla de la base de datos usada por el modelo
    *
    * @var string
    */
   protected $table = 'monthlyexpenses';
   /**
    * Atributos que son asignados a cada instancia del modelo
    *
    * @var array
    */
   protected $fillable = ['id_gasto','gasto_mensual' ,'fecha_pago'];

   public static function monthlyExpenses($fecha_inicio,$fecha_fin){
    	return MonthlyExpense::whereBetween('votes', [$fecha_inicio, $fecha_fin])->get();
    }
    public function scopeName($query,$fecha1){
      if ($fecha1 != null) {
        $query->where('fecha_pago',"=","$fecha1");
      }
    }
    public function scopeNombre($query,$id_gasto){
      if ($id_gasto != null) {
        $query->where('id_gasto',"=","$id_gasto");
      }
    }
}
