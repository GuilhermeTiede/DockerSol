<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosContrato extends Model
{
    use HasFactory;


    protected $table = 'documentoscontratos';

    protected $fillable = [
        'contrato_id',
        'nomeDocumento',
        'dataDocumento',
        'tipoDocumento',
    ];

     public function contrato()
     {
         return $this->belongsTo(Contrato::class, 'contrato_id');
     }
}
