<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SeedController extends Controller
{
    public function index()
    {
        Artisan::call("migrate:fresh");
        Artisan::call("permission:create-role admin");
        Artisan::call("db:seed", ['--class' => 'DatabaseSeeder']);
        $files = Storage::allFiles('public/img/package-images');
        Storage::delete($files);

        return "Generation was successful";
    }
}
