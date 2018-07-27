<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ubicacion extends Model
{
    use SoftDeletes;
    protected $table = 'ubicaciones';
    protected $fillable = ['categoria_ubicacion_id', 'nombre', 'descripcion', 'lat', 'lng', 'planta', 'imagen'];
    protected $dates = ['deleted_at'];

    public function categoriaUbicacion(){
        return $this->belongsTo('App\CategoriaUbicacion');
    }
    public function notificaciones(){
        return $this->hasMany('App\Notificacion');
    }
    public function imagenes() {
        return $this->hasMany('App\Imagen');
    }
}
