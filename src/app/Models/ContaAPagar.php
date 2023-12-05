<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaAPagar extends Model
{
    use HasFactory;
    protected $table = 'contasapagar';

    protected $fillable = [
        'tipo',
        'descricao',
        'valor',
        'dataVencimento',
        'dataPagamento',
        'status',
        'id_ordemServico',
        'id_fontePagadora'
    ];


    public function fontePagadora()
    {
        return $this->belongsTo(FontePagadora::class, 'id_fontePagadora');
    }

    public function ordemServico()
    {
        return $this->belongsTo(OrdemServico::class, 'id_ordemServico');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function documentoscontrato()
    {
        return $this->hasMany(DocumentosContrato::class, 'contrato_id');
    }



}
