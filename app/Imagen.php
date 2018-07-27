<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';
    protected $fillable = [
        'ubicacion_id',
        'imagen',
        'descripcion'
    ];
    protected $dates = ['deleted_at'];

    public function ubicacion() {
        return $this->belongsTo('App\Ubicacion');
    }
}
