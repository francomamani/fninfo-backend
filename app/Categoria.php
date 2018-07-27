<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    protected $table = 'categorias';
    protected $fillable = ['nombre', 'descripcion', 'icono', 'color'];
    protected $dates = ['deleted_at'];

    public function notificaciones(){
        return $this->hasMany('App\Notificacion');
    }
}
