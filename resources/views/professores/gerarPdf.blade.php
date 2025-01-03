<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Professores</title>
</head>

<body>

    <h2 style="text-align: center;">Professores</h2>

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #adb5bd;">
                <th style="border: 1px solid #ccc;">ID</th>
                <th style="border: 1px solid #ccc;">Nome</th>
                <th style="border: 1px solid #ccc;">Matrícula</th>
                <th style="border: 1px solid #ccc;">E-mail</th>
                <th style="border: 1px solid #ccc;">Data de Cadastrado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($professores as $prof)
                <tr>
                    <td style="border: 1px solid #ccc;">{{ $prof->id }}</td>
                    <td style="border: 1px solid #ccc;">{{ $prof->name }}</td>
                    <td style="border: 1px solid #ccc;">{{ $prof->matricula }}</td>
                    <td style="border: 1px solid #ccc;">{{ $prof->email }}</td>
                    <td style="border: 1px solid #ccc;">{{ \Carbon\Carbon::parse($prof->created_at)->format('d/m/Y H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="border: 1px solid #ccc; text-align: center; color: #f00;">Nenhum professor encontrado!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
