<?php

namespace Database\Seeders;

use App\Models\Professores;
use Illuminate\Database\Seeder;

class ProfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Se não encontrar o registro com o email, cadastra o registro no DB
        Professores::firstOrCreate(
            ['email' => 'mazera3@gmail.com'],
            ['name' => 'Édio Mazera', 'email' => 'mazera3@gmail.com', 'matricula' => '253855-5-02', 'password' => 'edmazera'],
        );

        Professores::firstOrCreate(
            ['email' => 'nadirtr7@gmail.com'],
            ['name' => 'Nadir Trainotti', 'email' => 'nadirtr7@gmail.com', 'matricula' => '339963-0-03', 'password' => 'edmazera'],
        );

        Professores::firstOrCreate(
            ['email' => 'prof01@gmail.com'],
            ['name' => 'Prof 01', 'email' => 'prof01@gmail.com', 'matricula' => '123456-7-89', 'password' => 'edmazera'],
        );

        Professores::firstOrCreate(
            ['email' => 'prof02@gmail.com'],
            ['name' => 'Prof 02', 'email' => 'prof02@gmail.com', 'matricula' => '123456-6-89', 'password' => 'edmazera'],
        );

        Professores::firstOrCreate(
            ['email' => 'prof03@gmail.com'],
            ['name' => 'Prof 03', 'email' => 'prof03@gmail.com', 'matricula' => '123456-5-89', 'password' => 'edmazera'],
        );
    }
}
// php artisan db:seed