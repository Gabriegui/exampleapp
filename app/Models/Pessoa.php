<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Politico;

class Pessoa extends Model{
    protected $table = 'public._pessoa';
    protected $fillable = ['Nome', 'Endereço', 'CPF', 'Gênero'];

    public function politico(){
        return $this->hasOne(Politico::class, 'user_id');
    }
}
