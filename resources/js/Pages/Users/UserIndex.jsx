import AlertMessage from "@/Components/Alert/AlertMessage";
import PrimaryButton from "@/Components/Button/PrimaryButton";
import SuccessButton from "@/Components/Button/SuccessButton";
import WarningButton from "@/Components/Button/WarningButton";
import ConfirmDeleteBotton from "@/Components/Delete/ConfirmDeleteBotton";
import Pagination from "@/Components/Pagination";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm, usePage } from "@inertiajs/react";



export default function UserIndex({ users, filters }) {

    const { flash } = usePage().props;

    const { data, setData, get } = useForm({
        name: filters.name || '',
        email: filters.email || '',
        date_start: filters.date_start || '',
        date_end: filters.date_end || '',
    })

    // Pesquisar
    const handleSearch = (e) => {
        // Não recarregar a página
        e.preventDefault();
        // Rota para pesquisar os usuários no bd
        get(route('users.index'));
    }
    // Gerar PDF
    function handleGeneratePdf(){

        // Constrói a query string a partir dos filtros recebidos
        const queryString = new URLSearchParams(filters).toString();

        // Constrói a URL completa para o PDF com a query string dos filtros
        const pdfUrl = `${route('users.generate-pdf')}?${queryString}`;

        // Redireciona para a URL para gerar o PDF
        window.location.href = pdfUrl;
    }
    // Geras CSV
    function handleGenerateCsv(){

        // Constrói a query string a partir dos filtros recebidos
        const queryString = new URLSearchParams(filters).toString();

        // Constrói a URL completa para o CSV com a query string dos filtros
        const csvUrl = `${route('users.generate-csv')}?${queryString}`;

        // Redireciona para a URL para gerar o CSV
        window.location.href = csvUrl;
    }

    return (
        <AuthenticatedLayout>
            <Head title="Listar Usuários" />

            <div className="max-w-8xl mx-auto px-1 sm:px-0 lg:px-0">
                <div className="flex justify-between items-center">
                    <h2 className="text-xl font-semibold leading-tight text-gray-600 dark:text-gray-200">
                        Usuário
                    </h2>
                    <nav className="text-sm text-gray-500 dark:text-gray-400">
                        <Link href={route('dashboard')} className="hover:text-gray-700 dark:hover:text-gray-300">
                            Dashboard
                        </Link>
                        <span className="mx-1">/</span>
                        <span>Usuários</span>
                    </nav>
                </div>
            </div>

            <div className="py-4 mx-auto max-w-8xl px-1 sm:px-0 lg:px-0">
                <div className="overflow-hidden bg-white shadow-lg sm:rounded-lg dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                    <div className="flex justify-between items-center p-3">
                        <h3 className="text-lg">Listar</h3>
                        <div className="flex space-x-1">
                            <Link href={route('users.create')}>
                                <SuccessButton className="ms-4 text-sm">
                                    Cadastrar
                                </SuccessButton>
                            </Link>
                            <WarningButton
                                className="ms-1 text-sm"
                                onClick={handleGeneratePdf}
                            >
                                PDF
                            </WarningButton>
                            <SuccessButton
                            className="ms-1 text-sm"
                            onClick={handleGenerateCsv}
                            >
                                CSV
                            </SuccessButton>
                        </div>
                    </div>

                    {/* Apresentar a mensagem de sucesso */}
                    <AlertMessage message={flash} />
                    {/* Formulário de Pesquisa */}
                    <form onSubmit={handleSearch} className="p-3 bg-gray-100 dark:bg-gray-900 flex flex-col md:flex-row md:flex-wrap gap-2">
                        <div className="flex flex-col md:flex-row md:flex-wrap gap-2">
                            <input
                                type="text"
                                value={data.name}
                                onChange={(e) => setData('name', e.target.value)}
                                placeholder="Nome"
                                className="w-full md:w-1/5 px-3 py-1.5 text-sm rounded-md border border-gray-300 dark:border-gray-700 focus:outline-none"
                            />

                            <input
                                type="text"
                                value={data.email}
                                onChange={(e) => setData('email', e.target.value)}
                                placeholder="E-mail"
                                className="w-full md:w-1/5 px-3 py-1.5 text-sm rounded-md border border-gray-300 dark:border-gray-700 focus:outline-none"
                            />

                            <input
                                type="datetime-local"
                                value={data.date_start}
                                onChange={(e) => setData('date_start', e.target.value)}
                                placeholder="Data Início"
                                className="w-full md:w-1/5 px-3 py-1.5 text-sm rounded-md border border-gray-300 dark:border-gray-700 focus:outline-none"
                            />

                            <input
                                type="datetime-local"
                                value={data.date_end}
                                onChange={(e) => setData('date_end', e.target.value)}
                                placeholder="data Final"
                                className="w-full md:w-1/5 px-3 py-1.5 text-sm rounded-md border border-gray-300 dark:border-gray-700 focus:outline-none"
                            />
                        </div>
                        <div className="flex flex-col sm:flex-row gap-2 mt-1">
                            <PrimaryButton type="submit" className="w-full sm:w-auto px-3 py-1 text-sm">
                                Pesquisar
                            </PrimaryButton>
                            <Link href={route('users.index')} className="w-full sm:w-auto">
                                <WarningButton className="w-full sm:w-auto text-sm px-3 py-1">
                                    Limpar
                                </WarningButton>
                            </Link>
                        </div>
                    </form>
                    {/* Tabela de Registros */}
                    <div className="overflow-hidden bg-white shadow-sm dark:bg-gray-800">
                        <table className="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead className="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th className="px-6 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">ID</th>
                                    <th className="px-6 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">Nome</th>
                                    <th className="hidden sm:table-cell px-6 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">E-mail</th>
                                    <th className="px-6 py-3 text-center text-sm font-medium text-gray-500 tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody className="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                {users.data.map((user) => (
                                    <tr key={user.id}>
                                        <td className="px-6 py-2 text-sm text-gray-900 dark:text-gray-100">
                                            {user.id}
                                        </td>
                                        <td className="px-6 py-2 text-sm text-gray-900 dark:text-gray-100">
                                            {user.name}
                                        </td>
                                        <td className="hidden sm:table-cell px-6 py-2 text-sm text-gray-900 dark:text-gray-100">
                                            {user.email}
                                        </td>
                                        <td className="px-6 py-2 text-sm text-center text-gray-900 dark:text-gray-100">
                                            <Link href={route('users.show', { id: user.id })}>
                                                <PrimaryButton className="ms-1">
                                                    Visualizar
                                                </PrimaryButton>
                                            </Link>
                                            <Link href={route('users.edit', { id: user.id })}>
                                                <WarningButton className="ms-1">
                                                    Editar
                                                </WarningButton>
                                            </Link>
                                            <ConfirmDeleteBotton
                                                id={user.id}
                                                routaName="users.destroy"
                                            />

                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                    {/* Paginação */}
                    <Pagination links={users.links} currentPage={users.current_page} />
                </div>
            </div>
        </AuthenticatedLayout>
    )
}