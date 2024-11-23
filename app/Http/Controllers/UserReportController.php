<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserReportController extends Controller
{
    public function generatePdf(Request $request)
    {
        // dd($request);
        // Recuperar os registros do banco de dados
        // $users = User::orderByDesc('id')->get();
        // $users = User::where('id', 100)->orderByDesc('id')->get();
        $users = User::when($request->has('name') && $request->name !== "null", function ($whenQuery) use ($request) {
            $whenQuery->where('name', 'like', '%' . $request->name . '%');
        })
            ->when($request->has('email') && $request->email !== "null", function ($whenQuery) use ($request) {
                $whenQuery->where('email', 'like', '%' . $request->email . '%');
            })

            ->when(!empty($request->filled('date_start')) && $request->date_start !== "null", function ($whenQuery) use ($request) {
                $whenQuery->where('created_at', '>=', \Carbon\Carbon::parse($request->date_start)->format('Y-m-d H:i:s'));
            })
            ->when(!empty($request->filled('date_end')) && $request->date_end !== "null", function ($whenQuery) use ($request) {
                $whenQuery->where('created_at', '<=', \Carbon\Carbon::parse($request->date_end)->format('Y-m-d H:i:s'));
            })
            ->orderByDesc('id')
            ->get();
        // Soma total de registros
        $totalRecords = $users->count('id');

        // Quantidade de registros permitidos
        $numberRecordsAllowed = 2;

        // Verificar se a quantidade de registros ultrapassa o limite para gerar PDF.
        if ($totalRecords > $numberRecordsAllowed) {
            return back()->with('error', "Limite de registros ultrapassados para gerar PDF. O limite é de $numberRecordsAllowed registros!");
        }

        // Carregar a string com o HTML/conteúdo e determinar a orientação e o tamanho do arquivo
        $pdf = FacadePdf::loadView('users.generatePdf', ['users' => $users])->setPaper('a4', 'portrait');

        // Fazer o download do arquivo
        return $pdf->download('list_users.pdf');
    }

    public function generateCsv(Request $request)
    {
        // dd($request);
        $users = User::when($request->has('name') && $request->name !== "null", function ($whenQuery) use ($request) {
            $whenQuery->where('name', 'like', '%' . $request->name . '%');
        })
            ->when($request->has('email') && $request->email !== "null", function ($whenQuery) use ($request) {
                $whenQuery->where('email', 'like', '%' . $request->email . '%');
            })

            ->when(!empty($request->filled('date_start')) && $request->date_start !== "null", function ($whenQuery) use ($request) {
                $whenQuery->where('created_at', '>=', \Carbon\Carbon::parse($request->date_start)->format('Y-m-d H:i:s'));
            })
            ->when(!empty($request->filled('date_end')) && $request->date_end !== "null", function ($whenQuery) use ($request) {
                $whenQuery->where('created_at', '<=', \Carbon\Carbon::parse($request->date_end)->format('Y-m-d H:i:s'));
            })
            ->orderByDesc('id')
            ->get();

        // Soma total de registros
        $totalRecords = $users->count('id');

        // Quantidade de registros permitidos
        $numberRecordsAllowed = 2;

        // Verificar se a quantidade de registros ultrapassa o limite para gerar CSV.
        if ($totalRecords > $numberRecordsAllowed) {
            return back()->with('error', "Limite de registros ultrapassados para gerar CSV. O limite é de $numberRecordsAllowed registros!");
        }
        // dd($users);
        // Criar o arquivo temporário
        $csvFileName = tempnam(sys_get_temp_dir(), 'csv_' . Str::ulid());

        // Abrir o arquivo na forma de scrita
        $openFile = fopen($csvFileName, 'w');

        $header = ['id', 'Nome', 'E-mail', 'Data_de_Cadastro'];

        // Escrer o cabeçalho
        fputcsv($openFile, $header, ';');

        // Ler os registros recuperados do banco de dados
        foreach ($users as $user) {

            // Criar o array com os dados da linha do excel
            $userArray = [
                'id' => $user->id,
                'name' => mb_convert_encoding($user->name, 'ISO-8859-1', 'UTF-8'),
                'email' => $user->email,
                'created_at' => \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s'),
            ];
            // Escrever o conteúdo no arqivo
            fputcsv($openFile, $userArray, ';');
        }
        // Fechar o arquivo apos a escrita
        fclose($openFile);

        // Realizar o download
        return response()->download($csvFileName, 'list_users_' . Str::ulid() . '.csv');
    }
}
