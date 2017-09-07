<?php

namespace COEM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
  use SoftDeletes;
  /**
  * Tabla de la base de datos usada por el modelo
  *
  * @var string
  */
 protected $table = 'expenses';
 /**
  * Atributos que son asignados a cada instancia del modelo
  *
  * @var array
  */
 protected $fillable = ['concepto','tipo_gasto' ,'cantidad'];
 protected $dates = ['deleted_at'];

 public function scopeName($query,$name){
   if (trim($name) != "") {
     $query->where('concepto',"LIKE","%$name%");
   }
 }
}
