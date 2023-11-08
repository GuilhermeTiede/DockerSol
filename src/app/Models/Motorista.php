<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorista extends Model
{
    use HasFactory;

    protected $table = 'motoristas';

    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'cnh',
        'categoriaCnh',
        'endereco',
        'telefone'
    ];


    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }
}
