<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageTexts;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Question::factory(8)->create();
        \App\Models\Server::factory(8)->create();
        \App\Models\Package::factory(6)->create();

        $this->faker = Faker::create();
        PageTexts::create([
            'name' => 'HomePage',
            'text' => $this->faker->paragraph(2),
            'uuid' => Str::uuid(),
        ]);
        PageTexts::create([
            'name' => 'VOP',
            'text' => $this->faker->paragraph(2),
            'uuid' => Str::uuid(),
        ]);
        PageTexts::create([
            'name' => 'Kontakty',
            'text' => $this->faker->paragraph(2),
            'uuid' => Str::uuid(),
        ]);
        PageTexts::create([
            'name' => 'JakNaTo?',
            'text' => $this->faker->paragraph(2),
            'uuid' => Str::uuid(),
        ]);
        PageTexts::create([
            'name' => 'ONas',
            'text' => $this->faker->paragraph(2),
            'uuid' => Str::uuid(),
        ]);

        // Only for testing
        $admin = User::create([
            'uuid' => Str::uuid(),
            'email' => 'admin@gmail.com',
            'verify_token' => substr(Str::uuid(), 0, 8),
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'uuid' => Str::uuid(),
        ]);
        $admin->assignRole("admin");
    }
}
