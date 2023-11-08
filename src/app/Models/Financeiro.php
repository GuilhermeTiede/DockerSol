<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financeiro extends Model
{
    use HasFactory;

    protected $table = 'financeiros';

    protected $fillable = [
        'mes',
        'ano',
        'faturamento',
        'recibemento',
        'despesas',
        'adm',
        'percentual_adm',
        'retirada',
        'percentual_retirada',
        'investimento',
        'percentual_investimento',
        'impostos_pagos',
        'percentual_impostos_pagos',
        'impostos_retidos',
        'percentual_impostos_retidos',
        'percentual_impostos_retidos_sobre_faturamento',
        'soma_percentual_impostos',
        'lucro',
    ];

}
