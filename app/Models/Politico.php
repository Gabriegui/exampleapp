<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Politico extends Model
{
    protected $table = 'public.politicos';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $fillable = ['Nome_guerra', 'user_id', 'numero_urna', 'partido'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'id');
    }
}
