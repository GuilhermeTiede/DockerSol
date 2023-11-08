<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $table = 'veiculos';
    protected $fillable = [
        'id_motorista',
        'placa',
        'renavam',
        'chassi',
        'modelo',
        'marca',
        'ano',
        'cor',
        'tipoCombustivel',
        'tipoVeiculo',
        'categoriaVeiculo',
    ];

    public function motorista()
    {
        return $this->belongsTo(Motorista::class, 'id_motorista');
    }

}
