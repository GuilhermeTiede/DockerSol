<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PainelControle extends Model
{
    use HasFactory;
    protected $table = 'painelcontrole';

    protected $fillable = [
        'contrato',
        'despesas',
        'recebimento',
        'a_receber_previsao',
        'valor_nf_emitida',
        'lucro',
        'imposto_previsto',
        'adm_fixo',
        'faturamento_total',
        'margem_lucro',
    ];
}
