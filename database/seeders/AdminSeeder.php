<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'nombre' => 'Admin One',
            'email' => 'luis@gmail.com',
            'password' => Hash::make('Luis12345'),
        ]);

        Admin::create([
            'nombre' => 'Admin Two',
            'email' => 'sofi@gmail.com',
            'password' => Hash::make('Sofi12345'),
        ]);

        Admin::create([
            'nombre' => 'Admin Two',
            'email' => 'monse@gmail.com',
            'password' => Hash::make('Monse12345'),
        ]);
    }
}
