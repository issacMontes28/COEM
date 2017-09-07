<?php

namespace COEM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes;
    /**
    * Tabla de la base de datos usada por el modelo
    *
    * @var string
    */
   protected $table = 'providers';
   /**
    * Atributos que son asignados a cada instancia del modelo
    *
    * @var array
    */
   protected $fillable = ['nombre','nombre_encargado' ,'apellidos',
   'telefono_celular','telefono_oficina','correo'];
   protected $dates = ['deleted_at'];

   public function scopeName($query,$name){
     if (trim($name) != "") {
       $query->where(\DB::raw("CONCAT(nombre,' ',apellidos)"),"LIKE","%$name%");
     }
   }
}
