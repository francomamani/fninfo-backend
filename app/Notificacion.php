<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notificacion extends Model
{
    use SoftDeletes;
    protected $table = 'notificaciones';
    protected $fillable = [ 'user_id',
                            'categoria_id',
                            'ubicacion_id',
                            'titulo',
                            'contenido',
                            'imagen',
                            'fecha_inicio',
                            'fecha_fin',
                            'web',
                            'prioridad'
                            ];
    protected $dates = ['deleted_at'];

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function ubicacion(){
        return $this->belongsTo('App\Ubicacion');
    }
    public function imagenNotificaciones() {
        return $this->hasMany('App\ImagenNotificacion');
    }
}
