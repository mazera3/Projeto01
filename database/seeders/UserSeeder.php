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
            ])->givePermissionTo('admin');
        }
        // Se não encontrar o registro com o email, cadastra o registro no DB
        User::firstOrCreate(
            ['email' => 'kelly@celke.com.br'],
            ['name' => 'Kelly', 'email' => 'kelly@celke.com.br', 'password' => '123456A#'],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'jessica@celke.com.br'],
            ['name' => 'Jessica', 'email' => 'jessica@celke.com.br', 'password' => '123456A#'],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'gabrielly@celke.com.br'],
            ['name' => 'Gabrielly', 'email' => 'gabrielly@celke.com.br', 'password' => '123456A#'],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'marcos@celke.com.br'],
            ['name' => 'Marcos', 'email' => 'marcos@celke.com.br', 'password' => '123456A#'],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'ana@celke.com.br'],
            ['name' => 'Ana', 'email' => 'ana@celke.com.br', 'password' => '123456A#'],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'joao@celke.com.br'],
            ['name' => 'Joao', 'email' => 'joao@celke.com.br', 'password' => '123456A#'],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'Maria@celke.com.br'],
            ['name' => 'Maria', 'email' => 'Maria@celke.com.br', 'password' => '123456A#'],
        )->givePermissionTo('user');
        
        User::firstOrCreate(
            ['email' => 'jose@celke.com.br'],
            ['name' => 'Jose', 'email' => 'jose@celke.com.br', 'password' => '123456A#'],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'pedro@celke.com.br'],
            ['name' => 'Pedro', 'email' => 'pedro@celke.com.br', 'password' => '123456A#'],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'mateus@celke.com.br'],
            ['name' => 'Mateus', 'email' => 'mateus@celke.com.br', 'password' => '123456A#'],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'cesar1@celke.com.br'],
            [
                'name' => 'Cesar1', 
                'email' => 'cesar1@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(1)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'kelly1@celke.com.br'],
            [
                'name' => 'Kelly1', 
                'email' => 'kelly1@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(1)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'cesar2@celke.com.br'],
            [
                'name' => 'Cesar2', 
                'email' => 'cesar2@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(2)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'pedro2@celke.com.br'],
            [
                'name' => 'Pedro2', 
                'email' => 'pedro2@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(2)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'cesar3@celke.com.br'],
            [
                'name' => 'Cesar3', 
                'email' => 'cesar3@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(3)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'jessica3@celke.com.br'],
            [
                'name' => 'Jessica3', 
                'email' => 'jessica3@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(3)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'cesar4@celke.com.br'],
            [
                'name' => 'Cesar4', 
                'email' => 'cesar4@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(4)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'cesar5@celke.com.br'],
            [
                'name' => 'Cesar5', 
                'email' => 'cesar5@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(5)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'marcio5@celke.com.br'],
            [
                'name' => 'Marcio5', 
                'email' => 'marcio5@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(5)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'mateus5@celke.com.br'],
            [
                'name' => 'Mateus5', 
                'email' => 'mateus5@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(5)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'cesar6@celke.com.br'],
            [
                'name' => 'Cesar6', 
                'email' => 'cesar6@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(6)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'cesar7@celke.com.br'],
            [
                'name' => 'Cesar7', 
                'email' => 'cesar7@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(7)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');
        User::firstOrCreate(
            ['email' => 'cesar8@celke.com.br'],
            [
                'name' => 'Cesar8', 
                'email' => 'cesar8@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(8)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'cesar9@celke.com.br'],
            [
                'name' => 'Cesar9', 
                'email' => 'cesar9@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(9)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'cesar10@celke.com.br'],
            [
                'name' => 'Cesar1', 
                'email' => 'cesar10@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(10)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'cesar11@celke.com.br'],
            [
                'name' => 'Cesar11', 
                'email' => 'cesar11@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(11)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');

        User::firstOrCreate(
            ['email' => 'cesar12@celke.com.br'],
            [
                'name' => 'Cesar12', 
                'email' => 'cesar12@celke.com.br', 
                'password' => '123456A#', 
                'created_at' => Carbon::now()->subMonth(12)->format('Y-m-d H:i:s')],
        )->givePermissionTo('user');
    }
}
// php artisan db:seed