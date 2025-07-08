<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Politico extends Model{
    protected $table = 'public.politicos';
    public $incrementing = false;
    protected $fillable = ['Nome_guerra', 'user_id', 'numero_urna', 'partido', 'ano_eleicao'];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class, 'id');
    }
}
