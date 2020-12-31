<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{   
    protected $table = 'tblproductos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nombre', 'Precio', 'Descripcion', 'Imagen'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
