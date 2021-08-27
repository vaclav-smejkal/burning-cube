<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SeedController extends Controller
{
    public function index()
    {
        Artisan::call("migrate:fresh");
        Artisan::call("permission:create-role admin");
        Artisan::call("db:seed", ['--class' => 'DatabaseSeeder']);

        return "Generation was successful";
    }
}
