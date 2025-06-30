<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $table = 'public.telefones';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $fillable = ['id', 'user_id', '_numero'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'id');
    }
}
