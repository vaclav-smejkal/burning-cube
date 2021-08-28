<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Package::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'comment' => $this->faker->paragraph(2),
            'price' => $this->faker->randomFloat(2, 1, 20000),
            'is_one_time' => rand(0, 1),
        ];
    }
}
