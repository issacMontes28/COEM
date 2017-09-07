<?php

namespace COEM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use DB;

class VeryfyMeasures extends Model
{
  use SoftDeletes;
  /**
  * Tabla de la base de datos usada por el modelo
  *
  * @var string
  */
  protected $table = 'verifymeasures';
  /**
  * Atributos que son asignados a cada instancia del modelo
  *
  * @var array
  */
  protected $fillable = [	'fecha','inicial','final'];
  protected $dates = ['deleted_at'];
}
