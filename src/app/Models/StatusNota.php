<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusNota extends Model
{
    use HasFactory;

    protected $table = 'status_notas';

    protected $fillable = [
        'nota_id',
        'status'
    ];

    public function notaFiscal()
    {
        return $this->belongsTo(NotaFiscal::class, 'nota_id');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id');
    }

    public function ordemservico()
    {
        return $this->belongsTo(OrdemServico::class, 'ordemservico_id');
    }

    public function fontepagadora()
    {
        return $this->belongsTo(FontePagadora::class, 'fontepagadora_id');
    }
}
