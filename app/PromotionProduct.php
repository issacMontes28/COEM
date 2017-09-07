<?php

namespace COEM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromotionProduct extends Model
{
    use SoftDeletes;
    /**
    * Tabla de la base de datos usada por el modelo
    *
    * @var string
    */
   protected $table = 'promotionproducts';
   /**
    * Atributos que son asignados a cada instancia del modelo
    *
    * @var array
    */
   protected $fillable = ['id_producto','id_promocion','cantidad_productos','precio'];
   protected $dates = ['deleted_at'];
}
