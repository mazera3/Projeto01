<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(Request $request): Response
    {
        // $users = User::get();
        // dd($users);

        // $users = User::OrderByDesc('id')->paginate(10);

        $users = User::when($request->has('name'), function($whenQuery) use ($request){
            $whenQuery->where('name', 'like', '%' . $request->name . '%');
        })
        -> when($request -> has('email'), function($whenQuery) use ($request){
            $whenQuery -> where('email', 'like', '%' . $request->email . '%');
        })

        ->when($request->filled('date_start'), function($whenQuery) use ($request){
            $whenQuery->where('created_at', '>=', \Carbon\Carbon::parse($request->date_start)->format('Y-m-d H:i:s'));
        })
        ->when($request->filled('date_end'), function($whenQuery) use ($request){
            $whenQuery->where('created_at', '<=', \Carbon\Carbon::parse($request->date_end)->format('Y-m-d H:i:s'));
        })
        ->orderByDesc('id')
        ->paginate(10)
        ->withQueryString();

        return Inertia::render('Users/UserIndex', [
            'users' => $users,
            'filters' => [
                'name' => $request->name,
                'email' => $request->email,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end
            ]
        ]);
    }


    public function show(User $user): Response
    {
        // dd($user);
        return Inertia::render('Users/UserShow', ['user' => $user]);
    }

    public function create(): Response
    {
        return Inertia::render('Users/UserCreate');
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ], [
            'name.required' => 'O campo nome é obrigatório!',
            'name.string' => 'O nome deve ser uma string válida.',
            'name.max' => 'O nome não pode ter mais que :max caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.string' => 'O e-mail deve ser uma string válida.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.max' => 'O e-mail não pode ter mais que :max caracteres.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.string' => 'A senha deve ser uma string válida.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return Redirect::route('users.show', ['user' => $user->id])->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function edit(User $user): Response
    {
        // dd($user);
        return Inertia::render('Users/UserEdit', ['user' => $user]);

    }

    public function update(Request $request, User $user)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$user->id}",
        ], [
            'name.required' => 'O campo nome é obrigatório!',
            'name.string' => 'O nome deve ser uma string válida.',
            'name.max' => 'O nome não pode ter mais que :max caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.string' => 'O e-mail deve ser uma string válida.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.max' => 'O e-mail não pode ter mais que :max caracteres.',
            'email.unique' => 'Este e-mail já está cadastrado.',
        ]);
        // dd($user);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return Redirect::route('users.show', ['user' => $user->id])->with('success', 'Usuário editado com sucesso!');
    }

    public function destroy(User $user)
    {
        // dd($user);
        // Excluir o registro do banco de dados
        $user->delete();

        return Redirect::route('users.index');
        // return Redirect::route('users.index')->with('success', 'Usuário apagado com sucesso!');
    }
}