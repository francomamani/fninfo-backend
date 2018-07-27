<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaUbicacion extends Model
{
    use SoftDeletes;
    protected $table = 'categoria_ubicaciones';
    protected $fillable = ['nombre', 'descripcion', 'icono', 'color'];
    protected $dates = ['deleted_at'];

    public function ubicaciones(){
        return $this->hasMany('App\Ubicacion');
    }

    public static function boot ()
    {
        parent::boot();
        static::deleting(function ($parent) {
            $parent->ubicaciones()->delete();
        });
    }
}
