<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Politico extends Model
{
    protected $table = 'public.politicos';
    protected $primaryKey = 'id';
    protected $fillable = ['Nome', 'Apelido', 'Partido', 'Urna'];
}
