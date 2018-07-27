<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tramite extends Model
{
    use SoftDeletes;
    protected $table = 'tramites';
    protected $fillable = [
        'titulo',
        'descripcion'
    ];
    protected $dates = ['deleted_at'];

    public function pasos() {
        return $this->hasMany('App\Paso');
    }
}