<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // verificar se o usuario está cadastrado
        if (!User::where('email', 'mazera3@gmail.com')->first()) {
            // cadastrar o usuario
            User::create([
                'name' => 'Édio Mazera',
                'email' => 'mazera3@gmail.com',
                'password' => 'edmazera',
            ]);
            // ->givePermissionTo('admin')
        }
        // Se não encontrar o registro com o email, cadastra o registro no DB
        // User::firstOrCreate(
        //     ['email' => 'kelly@celke.com.br'],
        //     ['name' => 'Kelly', 'email' => 'kelly@celke.com.br', 'password' => '123456A#'],
        // )->givePermissionTo('user');

    }
}
// php artisan db:seed