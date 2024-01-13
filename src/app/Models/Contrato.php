<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
    protected $table = 'contratos';
    protected $fillable = [

        'nomeContrato',
        'numeroContrato',
        'dataInicio',
        'dataFim',
        'valorContrato',
        'seguroGarantia',
        'responsabilidadeTecnica',
        'observacao',
        'renovado',
        'dataRenovacao',
        'cliente_id',
    ];
    protected $casts = [
        'dataInicio' => 'date:Y-m-d',
        'dataFim' => 'date:Y-m-d',
        'dataRenovacao' => 'date:Y-m-d',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function documentoscontrato()
    {
        return $this->hasMany(DocumentosContrato::class);
    }

    public function ordemservico()
    {
        return $this->hasMany(OrdemServico::class, 'contrato_id');
    }
}
