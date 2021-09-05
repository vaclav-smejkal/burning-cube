<?php

namespace Database\Factories;

use App\Models\Server;
use App\Helper\Helper;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Server::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(2);
        $randIP = mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255);
        return [
            'name' => $this->faker->userName(),
            'sanitized_name' => Helper::instance()->friendly_url($name),
            'ip_address' => $randIP,
            'port' => $this->faker->numerify('#####'),
        ];
    }
}
