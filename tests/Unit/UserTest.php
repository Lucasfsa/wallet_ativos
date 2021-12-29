<?php

namespace Tests\Unit;
use App\Models\User;


use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

     public function test_verificar_colunas_user()
     {
        $user = new User;
        
        $esperado = [
            'name',
            'email',
            'password'
        ];
        
        $compare = array_diff($esperado, $user->getFillable());

        $this->assertEquals(0, count($compare));
     }
    
}
