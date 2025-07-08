<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model{
    protected $table = 'public.telefones';
    public $incrementing = false;
    protected $fillable = ['user_id', '_numero'];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class, 'id');
    }
}
