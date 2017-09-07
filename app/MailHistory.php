<?php

namespace COEM;

use Illuminate\Database\Eloquent\Model;

class MailHistory extends Model
{
  /**
  * Tabla de la base de datos usada por el modelo
  *
  * @var string
  */
 protected $table = 'mails_history';
 /**
  * Atributos que son asignados a cada instancia del modelo
  *
  * @var array
  */
 protected $fillable = ['id_paciente','fecha_envio'];
}
