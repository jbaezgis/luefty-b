<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	//En caso de que la tabla sea otra
    //protected $table = 'nombre_de_mi_tabla';
    protected $fillable = ['name', 'email', 'message'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
