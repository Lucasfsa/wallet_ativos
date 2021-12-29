<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ativo extends Model
{
    use HasFactory;
    
    protected $fillable = ['ticker', 'quantidade', 'operacao', 'cotacao_atual', 'total_operacao','categoria_id'];
    
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
