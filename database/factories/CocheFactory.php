<?php

namespace Database\Factories;

use App\Models\Coche;
use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;

class CocheFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coche::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            $marcaIds=Marca::pluck('id')->toArray();
        return [
                'modelo'=>$this->faker->sentence($nbWords = 2, $variableNbWords = true),
                'color'=>$this->faker->safeColorName,
                'kilometros'=>$this->faker->numberBetween($min = 1000, $max = 100000),
                'marca_id'=>$this->faker->optional()->randomElement($marcaIds)
        ];
    }
}
