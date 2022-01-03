<?php

namespace Tests\Unit;
use App\Models\Ativo;
use Tests\TestCase;

class AtivoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testVerificarColunasAtivo()
    {
       $ativo = new Ativo;
       
       $esperado = [
        'ticker', 
        'quantidade', 
        'operacao', 
        'cotacao_atual', 
        'total_operacao', 
        'categoria_id',
        'user_id'
       ];
       
       $compare = array_diff($esperado, $ativo->getFillable());
      
       $this->assertEquals(0, count($compare));
    }

}
