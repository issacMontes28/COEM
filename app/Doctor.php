<?php

namespace COEM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
  use SoftDeletes;
     /**
     * Tabla de la base de datos usada por el modelo
     *
     * @var string
     */
    protected $table = 'doctors';
    /**
     * Atributos que son asignados a cada instancia del modelo
     *
     * @var array
     */
    protected $fillable = [	'nombre','apaterno' ,'amaterno','direccion_fiscal','telefono_casa',
    'telefono_celular','telefono_oficina','correo','cedula_prof'];
    protected $dates = ['deleted_at'];

    public function scopeName($query,$name){
      if (trim($name) != "") {
        $query->where(\DB::raw("CONCAT(nombre,' ',apaterno,' ',amaterno)"),"LIKE","%$name%");
      }
    }
}
