<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paso extends Model
{
    use SoftDeletes;
    protected $table = 'pasos';
    protected $fillable = [
        'tramite_id',
        'titulo',
        'descripcion',
        'url',
        'ubicacion_id',
        'documento',
        'imagen',
        'posicion'
    ];
    protected $dates = ['deleted_at'];

    public function tramite() {
        return $this->belongsTo('App\Tramite');
    }
}
