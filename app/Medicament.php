<?php

namespace COEM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use DB;

class Medicament extends Model
{
    use SoftDeletes;
    /**
    * Tabla de la base de datos usada por el modelo
    *
    * @var string
    */
    protected $table = 'medicaments';
    /**
    * Atributos que son asignados a cada instancia del modelo
    *
    * @var array
    */
    protected $fillable = [	'nombre','descripcion','tipo','existencias','precio_compra','precio_venta',
    'precio_venta_tarjeta','id_proveedor','area','imagen'];
    protected $dates = ['deleted_at'];

    //Método para guardar la imagen con segundos adjuntados en el nombre del archivo subido
    //para evitar sobreescritura debido a archivos con nombres iguales
    public function setImagenAttribute($imagen){
      //Si la imagen existe
      if(! empty($imagen)){
            //Se concatenan los segundos actuales al nombre de la imagen
            $name = Carbon::now()->second.$imagen->getClientOriginalName();
            //Se la asigna al nombre de la imagen
            $this->attributes['imagen'] = $name;
            //Se almacena la imagen
            \Storage::disk('local')->put($name, \File::get($imagen));
        }
      if (empty($imagen)) {
        $name = "pastilla.png";
        $this->attributes['imagen'] = $name;
      }
    }
    public function scopeName($query,$name){
      if (trim($name) != "") {
        $query->where('nombre',"LIKE","%$name%");
      }
    }
}
