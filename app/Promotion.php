<?php

namespace COEM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use SoftDeletes;
    /**
    * Tabla de la base de datos usada por el modelo
    *
    * @var string
    */
   protected $table = 'promotions';
   /**
    * Atributos que son asignados a cada instancia del modelo
    *
    * @var array
    */
   protected $fillable = ['nombre','descripcion','tipo'];
   protected $dates = ['deleted_at'];

   public function scopeName($query,$name){
     if (trim($name) != "") {
       $query->where('nombre',"LIKE","%$name%");
     }
   }
}
