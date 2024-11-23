<?php

namespace App\Http\Controllers;

use App\Models\Professores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfessoresController extends Controller
{
    //
    public function listar(Request $request): Response
    {
        
        $prof = Professores::when($request->has('name'), function($whenQuery) use ($request){$whenQuery->where('name', 'like', '%' . $request->name . '%');
        })
        -> when($request -> has('email'), function($whenQuery) use ($request){
            $whenQuery -> where('email', 'like', '%' . $request->email . '%');
        })
        -> when($request -> has('matricula'), function($whenQuery) use ($request){
            $whenQuery -> where('matricula', 'like', '%' . $request->matricula . '%');
        })
        ->orderByDesc('id')
        ->paginate(10)
        ->withQueryString();
        return Inertia::render('Professores/ProfessoresListar',[
            'professores' => $prof,
            'filters' => [
                'name' => $request->name,
                'email' => $request->email,
                'matricula' => $request->matricula,
            ]
        ]);
    }

    public function ver(Professores $prof): Response
    {
        // dd($prof);
        return Inertia::render('Professores/ProfessorVer', ['prof' => $prof]);
    }

    public function criar(): Response
    {
        return Inertia::render('Professores/ProfessorCriar');
    }

    public function salvar(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:professores',
            'matricula' => 'required|string|max:255|unique:professores',
            'password' => 'required|string|min:8|confirmed'
        ], [
            'name.required' => 'O campo nome é obrigatório!',
            'name.string' => 'O nome deve ser uma string válida.',
            'name.max' => 'O nome não pode ter mais que :max caracteres.',

            'matricula.required' => 'O campo matricula é obrigatório.',
            'matricula.string' => 'A matricula deve ser uma string válida.',
            'matricula.matricula' => 'A matricula deve ser um número válido.',
            'matricula.max' => 'A matricula não pode ter mais que :max caracteres.',
            'matricula.unique' => 'Esta matricula já está cadastrada.',

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

        $prof = Professores::create([
            'name' => $request->name,
            'email' => $request->email,
            'matricula' => $request->matricula,
            'password' => $request->password,
        ]);

        return Redirect::route('professores.ver', ['prof' => $prof->id])->with('success', 'Professor cadastrado com sucesso!');
    }

    public function editar(Professores $prof): Response
    {
        // dd($prof);
        return Inertia::render('Professores/ProfessorEditar', ['prof' => $prof]);

    }

    public function atualizar(Request $request, Professores $prof)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:professores,email,{$prof->id}",
            'matricula' => "required|string|max:255|unique:professores,matricula,{$prof->id}",
        ], [
            'name.required' => 'O campo nome é obrigatório!',
            'name.string' => 'O nome deve ser uma string válida.',
            'name.max' => 'O nome não pode ter mais que :max caracteres.',

            'matricula.required' => 'O campo matricula é obrigatório.',
            'matricula.string' => 'A matricula deve ser uma string válida.',
            'matricula.matricula' => 'A matricula deve ser um número válido.',
            'matricula.max' => 'A matricula não pode ter mais que :max caracteres.',
            'matricula.unique' => 'Esta matricula já está cadastrada.',

            'email.required' => 'O campo e-mail é obrigatório.',
            'email.string' => 'O e-mail deve ser uma string válida.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.max' => 'O e-mail não pode ter mais que :max caracteres.',
            'email.unique' => 'Este e-mail já está cadastrado.',
        ]);
        // dd($prof);
        $prof->update([
            'name' => $request->name,
            'matricula' => $request->matricula,
            'email' => $request->email,
        ]);

        return Redirect::route('professores.ver', ['prof' => $prof->id])->with('success', 'Professor editado com sucesso!');
    }

    public function destroy(Professores $prof)
    {
        // dd($prof);
        // Excluir o registro do banco de dados
        $prof->delete();

        return Redirect::route('professores.listar');
    }

}
