<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ativo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AtivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Ativo $ativo)
    {
        $this->ativo = $ativo;
    }
    
    public function index()
    {
        $ativos = Ativo::get();
        

        return response()->json([$ativos], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       Ativo::create([
        'ticker' => $request->ticker,
        'quantidade'=> $request->quantidade,
        'operacao' => $request->operacao,
        'cotacao_atual' => $request->cotacao_atual,
        'total_operacao' => $request->total_operacao,
        'categoria_id' => $request->categoria_id,
        'user_id' => $request->user_id = Auth::user()->id]);
        
        return response()->json(["message"=>"Movimentação de ativo criada!"],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Ativo  $ativo
     * @return \Illuminate\Http\Response
     */
    public function show(Ativo $ativo)
    {
        return response()->json([$ativo], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ativo $ativo)
    {
        $ativo->update($request->all());

        return response()->json([$ativo],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ativo $ativo)
    {
        $ativo->delete();

        return response()->json(["message", 'Movimentação excluída'], 200);
    }

    public function porHistorico()
    {    
        $ativoHistorico = Ativo::getHistorico();

        return response()->json([$ativoHistorico], 200);
    }     

    public function porCategoria($id)
    {
       $ativoCategoria = Ativo::getCategoria($id);

        return response()->json([$ativoCategoria], 200);
    }

    public function porTicker($ticker)
    {
       $ativoTicker = Ativo::getTicker($ticker);

        return response()->json([$ativoTicker], 200);

    }

    public function distribuicaoCarteira()
    {   
        
        $acaoTotal = Ativo::getTotalAcao();
        $fundoTotal = Ativo::getTotalFundo();    
        $rendaTotal = Ativo::getTotalRenda();  
             
        $totalCarteira = $rendaTotal+$fundoTotal+$acaoTotal;
        
        $acao = number_format(($acaoTotal*100)/$totalCarteira, 2, '.','.');
        $fundo = number_format(($fundoTotal*100)/$totalCarteira, 2, '.','.');
        $renda = number_format(($rendaTotal*100)/$totalCarteira, 2, '.','.');

        $porcentagemCarteira = ['Ações: '.$acao.'%', 'Fundo Imobiliário: '.$fundo.'%', 'Renda Fixa: '.$renda.'%'];
        $total = [ 'Total ação:R$ '.$acaoTotal,  'Total Fundo Imobiliário:R$ '.$fundoTotal ,  'Renda Fixa:R$ '.$rendaTotal];
        
        return response()->json([$porcentagemCarteira, $total], 200);

    }

    public function ditribuicaoDiaria($periodo){

        $rendaDiaria = Ativo::getDiaria($periodo);

        return response()->json(['Renda total no período:R$ '.$rendaDiaria,'Período: '. $periodo], 200);
    }

    
}
