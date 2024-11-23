<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    // Rota GET que exibe o formulário de registro de novos usuários.
    // Quando a URL '/register' é acessada, o método 'create' do 'RegisteredUserController' é chamado.
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    // Define uma rota POST para o endpoint 'register', que aciona o método 'store' do RegisteredUserController para lidar com o envio de dados de registro de novos usuários.
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Define uma rota GET para a URL 'login', que chama o método 'create' do controlador 'AuthenticatedSessionController' para exibir a página de login. 
    // A rota recebe o nome 'login', que pode ser usada para referenciar essa rota em links e redirecionamentos.
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // Rota que processa o envio do formulário de login, chamando o método 'store' do AuthenticatedSessionController.
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Define uma rota GET para a página de solicitação de redefinição de senha,
    // associando-a ao método 'create' do PasswordResetLinkController.
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    // Define uma rota GET para a página de solicitação de redefinição de senha,
    // associando-a ao método 'create' do PasswordResetLinkController.
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});