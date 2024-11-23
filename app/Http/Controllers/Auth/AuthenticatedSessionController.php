<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    
    /**
     * Exibe a página de login.
     *
     * Este método é responsável por renderizar a página de login usando o Inertia. Ele também passa dados 
     * adicionais como a possibilidade de redefinir a senha, com base na existência da rota 'password.request', 
     * e o status da sessão, que pode conter mensagens como sucesso ou erro.
     *
     * @return \Inertia\Response Página de login renderizada.
     */
    public function create(): Response
    {

        // Renderiza a view 'Auth/Login' e passa as variáveis 'canResetPassword' e 'status' para a view.
        return Inertia::render('Auth/Login', [

            'canResetPassword' => Route::has('password.request'), // Verifica se a rota para redefinição de senha existe.

            'status' => session('status'), // Obtém o status da sessão (como mensagens de sucesso ou erro).
        ]);
    }

    /**
     * Processa uma solicitação de autenticação.
     *
     * Este método lida com a requisição de login de um usuário. Ele autentica o usuário
     * utilizando as credenciais fornecidas na requisição, regenera a sessão para evitar 
     * ataques de fixação de sessão e, por fim, redireciona o usuário autenticado para 
     * a página pretendida ou para o dashboard.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request  A requisição de login contendo as credenciais do usuário.
     * @return \Illuminate\Http\RedirectResponse  Redireciona o usuário para o dashboard ou para a página original que ele pretendia acessar.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentica o usuário com as credenciais fornecidas no request.
        $request->authenticate();

        // Regenera a sessão para evitar ataques de fixação de sessão.
        $request->session()->regenerate();

        // Redireciona o usuário autenticado para a página pretendida ou o dashboard.
        // intended busca a URL que o usuário estava tentando acessar antes de ser redirecionado para o login.
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}