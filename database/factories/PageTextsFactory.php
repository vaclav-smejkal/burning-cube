<?php

namespace Database\Factories;

use App\Models\PageTexts;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageTextsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PageTexts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(4),
            'text' => $this->faker->paragraph(2),
            'uuid' => Str::uuid(),
        ];
    }
}
