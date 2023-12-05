<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;
    protected $table = 'ordemservicos';

    protected $fillable = [
        'id',
        'contrato_id',
        'valorOrdemServico',
        'dataOrdemServico',
        'numeroOrdemServico',
    ];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class,'contrato_id');
    }

    public function fluxoCaixas()
    {
        return $this->hasMany(FluxoCaixa::class, 'id_ordemServico');
    }

    public function documentoscontrato()
    {
        return $this->hasMany(DocumentosContrato::class, 'contrato_id');
    }

}
