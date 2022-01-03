<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class Ativo extends Model
{
    use HasFactory;
    
    protected $fillable = ['ticker', 'quantidade', 'operacao', 'cotacao_atual', 'total_operacao', 'categoria_id','user_id'];   

    public static function getHistorico()
    {
        $historico = DB::table('ativos')
            ->where('user_id', Auth::user()->id)
                ->get();
        return $historico;
    }

    public static function getCategoria($id)
    {
        $categoria = DB::table('ativos')
            ->where('categoria_id', $id)
                ->where('user_id', Auth::user()->id)
                    ->get();

        return $categoria;
    }

    public static function getTicker($ticker)
    {
        $ticker = DB::table('ativos')
            ->where('ticker', "like", "%".$ticker."%")
                ->where('user_id', Auth::user()->id)
                    ->get();

        return $ticker;
    }

    public static function getDiaria($periodo)
    {
        $rendaDiaria = DB::table('ativos')
            ->whereDate('created_at', $periodo)
                ->where('user_id', Auth::user()->id)
                    ->get()
                        ->sum('total_operacao');

        return $rendaDiaria;
    }
    
    public static function getTotalAcao()
    {
        $acaoCompra = DB::table('ativos')
            ->where('categoria_id', '1')
                ->where('operacao','compra')
                    ->where('user_id', Auth::user()->id)
                        ->get()
                            ->sum('total_operacao');

        $acaoTotal = $acaoCompra - DB::table('ativos')
            ->where('categoria_id', '1')
                ->where('operacao','venda')
                    ->where('user_id', Auth::user()->id)
                        ->get()
                            ->sum('total_operacao');

        return $acaoTotal;
    }

    public static function getTotalFundo()
    {
        $fundoCompra = DB::table('ativos')
            ->where('categoria_id', '2')
                ->where('operacao','compra')
                    ->where('user_id', Auth::user()->id)
                        ->get()->
                            sum('total_operacao');

        $fundoTotal = $fundoCompra - DB::table('ativos')
            ->where('categoria_id', '1')
                ->where('operacao','venda')
                    ->where('user_id', Auth::user()->id)
                        ->get()
                            ->sum('total_operacao');  

        return $fundoTotal;
    }

    public static function getTotalRenda()
    {
         $rendaCompra = DB::table('ativos')
            ->where('categoria_id', '3')
                ->where('operacao','compra')
                    ->where('user_id', Auth::user()->id)
                        ->get()
                            ->sum('total_operacao');

        $rendaTotal = $rendaCompra - DB::table('ativos')
            ->where('categoria_id', '3')
                ->where('operacao','venda')
                    ->where('user_id', Auth::user()->id)
                        ->get()
                            ->sum('total_operacao');

        return $rendaTotal;
    }
   
}
