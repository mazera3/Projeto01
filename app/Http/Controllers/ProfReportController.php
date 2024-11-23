<?php

namespace App\Http\Controllers;

use App\Models\Professores;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfReportController extends Controller
{

    // Gerar PDF de Professores
    public function gerarPdfProf(Request $request)
    {
        $professores = Professores::when($request->has('name') && $request->name !== "null", function ($whenQuery) use ($request) {
            $whenQuery->where('name', 'like', '%' . $request->name . '%');
        })
            ->when($request->has('matricula') && $request->matricula !== "null", function ($whenQuery) use ($request) {
                $whenQuery->where('matricula', 'like', '%' . $request->matricula . '%');
            })

            ->when($request->has('email') && $request->email !== "null", function ($whenQuery) use ($request) {
                $whenQuery->where('email', 'like', '%' . $request->email . '%');
            })
            ->orderByDesc('id')
            ->get();
        // Soma total de registros
        $totalRecords = $professores->count('id');

        // Quantidade de registros permitidos
        $numberRecordsAllowed = 10;

        // Verificar se a quantidade de registros ultrapassa o limite para gerar PDF.
        if ($totalRecords > $numberRecordsAllowed) {
            return back()->with('error', "Limite de registros ultrapassados para gerar PDF. O limite é de $numberRecordsAllowed registros!");
        }

        // Carregar a string com o HTML/conteúdo e determinar a orientação e o tamanho do arquivo
        $pdf = FacadePdf::loadView('professores.gerarPdf', ['professores' => $professores])->setPaper('a4', 'portrait');

        // Fazer o download do arquivo
        return $pdf->download('lista_professores.pdf');
    }


    public function gerarCsv(Request $request)
    {
        // dd($request);
        $professores = Professores::when($request->has('name') && $request->name !== "null", function ($whenQuery) use ($request) {
            $whenQuery->where('name', 'like', '%' . $request->name . '%');
        })
            ->when($request->has('matricula') && $request->matricula !== "null", function ($whenQuery) use ($request) {
                $whenQuery->where('matricula', 'like', '%' . $request->matricula . '%');
            })
            ->when($request->has('email') && $request->email !== "null", function ($whenQuery) use ($request) {
                $whenQuery->where('email', 'like', '%' . $request->email . '%');
            })
            ->when(!empty($request->filled('date_start')) && $request->date_start !== "null", function ($whenQuery) use ($request) {
                $whenQuery->where('created_at', '>=', \Carbon\Carbon::parse($request->date_start)->format('Y-m-d H:i:s'));
            })
            ->orderByDesc('id')
            ->get();

        // Soma total de registros
        $totalRecords = $professores->count('id');

        // Quantidade de registros permitidos
        $numberRecordsAllowed = 10;

        // Verificar se a quantidade de registros ultrapassa o limite para gerar CSV.
        if ($totalRecords > $numberRecordsAllowed) {
            return back()->with('error', "Limite de registros ultrapassados para gerar CSV. O limite é de $numberRecordsAllowed registros!");
        }
        // dd($users);
        // Criar o arquivo temporário
        $csvFileName = tempnam(sys_get_temp_dir(), 'csv_' . Str::ulid());

        // Abrir o arquivo na forma de scrita
        $openFile = fopen($csvFileName, 'w');

        $header = ['id', 'Nome', 'Matricula', 'E-mail', 'Data_de_Cadastro'];

        // Escrer o cabeçalho
        fputcsv($openFile, $header, ';');

        // Ler os registros recuperados do banco de dados
        foreach ($professores as $prof) {

            // Criar o array com os dados da linha do excel
            $profArray = [
                'id' => $prof->id,
                'name' => mb_convert_encoding($prof->name, 'ISO-8859-1', 'UTF-8'),
                'email' => $prof->email,
                'matricula' => $prof->matricula,
                'created_at' => \Carbon\Carbon::parse($prof->created_at)->format('d/m/Y H:i:s'),
            ];
            // Escrever o conteúdo no arqivo
            fputcsv($openFile, $profArray, ';');
        }
        // Fechar o arquivo apos a escrita
        fclose($openFile);

        // Realizar o download
        return response()->download($csvFileName, 'lista_professores_' . Str::ulid() . '.csv');
    }
}
