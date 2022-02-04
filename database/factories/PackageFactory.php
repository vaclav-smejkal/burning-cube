<?php

namespace Database\Factories;

use App\Models\Package;
use App\Helper\Helper;
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
        $name = $this->faker->sentence(2);

        return [
            'name' => $name,
            'sanitized_name' => Helper::instance()->friendly_url($name),
            'comment' => $this->faker->paragraph(2),
            'price' => $this->faker->randomFloat(2, 1, 75),
            'sms_price' => $this->faker->randomFloat(2, 1, 75),
            'is_one_time' => rand(0, 1),
        ];
    }
}
