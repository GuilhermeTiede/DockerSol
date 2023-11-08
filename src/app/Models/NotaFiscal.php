<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaFiscal extends Model
{
    use HasFactory;
    protected $fillable = [
        'numeroNf',
        'dataEmissao',
        'dataPrevisaoPagamento',
        'mes',
        'exercicio',
        'valorTotal',
        'valorISS',
        'valorPis',
        'valorCofins',
        'valorInss',
        'valorIr',
        'valorCsll',
        'descricao',
        'cnpj_prestador',
        'nome_prestador',
        'cnpj_tomador',
        'nome_tomador',
    ];
    protected $table = 'notasfiscais';
}
