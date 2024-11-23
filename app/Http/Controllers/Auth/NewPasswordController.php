<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class NewPasswordController extends Controller
{
    /**
     * Exibe a visualização de redefinição de senha.
     *
     * Este método é responsável por renderizar a página onde o usuário pode
     * inserir uma nova senha. Ele recebe um token de redefinição e o e-mail
     * do usuário para garantir a segurança da operação.
     *
     * @param Request $request A solicitação que contém o e-mail do usuário e o token.
     * @return Response A resposta com a visualização da página de redefinição de senha.
     */
    public function create(Request $request): Response
    {
        // Renderiza a visualização de redefinição de senha usando Inertia,
        // passando o e-mail do usuário e o token de redefinição como dados.
        return Inertia::render('Auth/ResetPassword', [
            // O e-mail do usuário é recuperado da solicitação.
            'email' => $request->email,

            // O token de redefinição é recuperado da rota.
            'token' => $request->route('token'),
        ]);
    }

    /**
     * Manipula uma solicitação de nova senha.
     *
     * Este método valida a solicitação do usuário para redefinir a senha,
     * tenta redefinir a senha e, em seguida, redireciona o usuário
     * com base no resultado da operação. Se a redefinição for bem-sucedida,
     * o usuário será redirecionado para a página de login. Caso contrário,
     * uma exceção de validação será lançada.
     *
     * @param Request $request A solicitação que contém os dados necessários para redefinir a senha.
     * @return RedirectResponse A resposta de redirecionamento após o processamento da solicitação.
     * @throws \Illuminate\Validation\ValidationException Se a validação falhar.
     */
    public function store(Request $request): RedirectResponse
    {
        // Valida os dados da solicitação, garantindo que o token, e-mail e senha sejam fornecidos e estejam no formato correto.
        $request->validate([
            'token' => 'required', // O token de redefinição de senha deve ser fornecido.
            'email' => 'required|email', // O e-mail deve ser fornecido e deve ser um endereço de e-mail válido.
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // A senha deve ser fornecida, confirmada e seguir as regras padrão.
        ]);

        // Aqui tentaremos redefinir a senha do usuário. Se for bem-sucedido, atualizaremos a senha no modelo de usuário
        // real e a persistiremos no banco de dados. Caso contrário, analisaremos o erro e retornaremos a resposta.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                // Atualiza a senha do usuário e gera um novo token de lembrete.
                $user->forceFill([
                    'password' => Hash::make($request->password), // A nova senha é criptografada antes de ser salva.
                    'remember_token' => Str::random(60), // Um novo token de lembrete é gerado.
                ])->save(); // Salva as alterações no modelo de usuário.

                // Dispara o evento de redefinição de senha.
                event(new PasswordReset($user));
            }
        );

        // Se a senha foi redefinida com sucesso, redirecionamos o usuário de volta para a página de login.
        // Caso contrário, redirecionamos de volta para onde o usuário veio, incluindo a mensagem de erro.
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status)); // Redireciona para a rota de login com a mensagem de status.
        }

        // Se a redefinição da senha falhar, lança uma exceção de validação com uma mensagem de erro apropriada.
        throw ValidationException::withMessages([
            'email' => [trans($status)], // A mensagem de erro é traduzida e associada ao e-mail.
        ]);
    }
}