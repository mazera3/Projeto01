<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Exibe a página de registro de novos usuários.
     * 
     * Este método é responsável por retornar a visualização de registro 
     * para que o usuário possa se cadastrar no sistema. Ele utiliza o 
     * Inertia.js para renderizar a página de registro dentro do fluxo 
     * de uma aplicação SPA (Single Page Application).
     *
     * @return \Inertia\Response Retorna uma resposta com a página de registro renderizada.
     */
    public function create(): Response
    {
        // Renderiza a visualização 'Auth/Register' utilizando o Inertia.js.
        // O método 'Inertia::render' exibe a página 'Register' localizada em 'Auth',
        // que é a página de cadastro de usuários.
        return Inertia::render('Auth/Register');
    }
    
    /**
     * Handle an incoming registration request.
     *
     * Este método processa uma solicitação de registro de um novo usuário.
     * Ele valida os dados da solicitação, cria um novo registro de usuário,
     * dispara um evento de registro e faz login automaticamente no usuário.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Valida os dados da solicitação de registro, garantindo que todos os campos obrigatórios sejam preenchidos e que o e-mail seja único.
        $request->validate([
            'name' => 'required|string|max:255', // O nome é obrigatório, deve ser uma string e ter no máximo 255 caracteres.
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class, // O e-mail é obrigatório, deve ser em minúsculas, ser um e-mail válido, ter no máximo 255 caracteres e ser único na tabela de usuários.
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // A senha é obrigatória, deve ser confirmada e seguir as regras padrão de senha.
        ]);

        // Cria um novo usuário com os dados fornecidos na solicitação.
        $user = User::create([
            'name' => $request->name, // Define o nome do usuário.
            'email' => $request->email, // Define o e-mail do usuário.
            'password' => Hash::make($request->password), // Cria um hash da senha antes de armazená-la.
        ]);

        // Dispara um evento de registro para ações relacionadas ao registro do usuário.
        event(new Registered($user));

        // Faz login no usuário recém-registrado.
        Auth::login($user);

        // Redireciona o usuário para o dashboard após o registro.
        return redirect(route('dashboard', absolute: false));
    }
}