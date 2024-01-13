<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nome',
        'cnpj',
        'estado',
        'municipio',
        'logradouro',
        'numero',
        'cep',
        'empresa_id',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'cliente_id');
    }

}
