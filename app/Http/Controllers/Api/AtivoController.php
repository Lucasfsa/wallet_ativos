<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ativo;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;


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
        return $this->ativo->paginate(10);
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
        'user_id' => $request->user_id = Auth::user()->id
    ]);
        return with('Cadastro realizado');
    }

    /**
     * Display the specified resource.
     *
     * @param  Ativo  $ativo
     * @return \Illuminate\Http\Response
     */
    public function show(Ativo $ativo)
    {
        return $ativo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
