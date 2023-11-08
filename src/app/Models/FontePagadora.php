<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FontePagadora extends Model
{
    use HasFactory;
    protected $table = 'fontepagadoras';

    protected $fillable = [
        'agencia',
        'conta',
        'banco',
        'tipoConta',
        'nomeTitular',
    ];
}
