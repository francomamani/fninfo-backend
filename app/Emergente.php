<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emergente extends Model
{
    use SoftDeletes;
    protected $table = 'emergentes';
    protected $fillable = [
        'notificacion_id',
        'titulo',
        'descripcion',
        'imagen'
    ];
    protected $dates = ['deleted_at'];
}
