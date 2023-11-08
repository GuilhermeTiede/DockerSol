<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FluxoCaixa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ordemServico',
        'id_fontePagadora',
        'tipo',
        'valor',
        'observacao',
        'data'
    ];

    protected $table = 'fluxocaixas';

    public function ordemServico()
    {
        return $this->belongsTo(OrdemServico::class, 'id_ordemServico');
    }

    public function fontePagadora()
    {
        return $this->belongsTo(FontePagadora::class, 'id_fontePagadora');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }
}
