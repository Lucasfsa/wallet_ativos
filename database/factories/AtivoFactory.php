<?php

namespace Database\Factories;

use App\Models\Ativo;
use Illuminate\Database\Eloquent\Factories\Factory;

class AtivoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Ativo::class;

    public function definition()
    {
        return [
            'ticker' =>$this->faker->words(3, true),
            'quantidade' => $this->faker->randomFloat(2,10,300),
            'operacao' => $this->faker->word(3, true),
            'cotacao_atual'=>$this->faker->randomFloat(2,10,300),
            'total_operacao'=>$this->faker->randomFloat(2,10,300)  
        ];
    }
}
