<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagenNotificacion extends Model
{
    protected $table = 'imagen_notificaciones';
    protected $fillable = [
        'notificacion_id',
        'imagen',
        'descripcion'
    ];
    protected $dates = ['deleted_at'];

    public function notificacion() {
        return $this->belongsTo('App\Notificacion');
    }
}
