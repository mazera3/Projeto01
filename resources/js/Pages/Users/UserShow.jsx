import AlertMessage from "@/Components/Alert/AlertMessage";
import InfoButton from "@/Components/Button/InfoButton";
import WarningButton from "@/Components/Button/WarningButton";
import ConfirmDeleteBotton from "@/Components/Delete/ConfirmDeleteBotton";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, usePage } from "@inertiajs/react";

export default function UserShow({ user }) {
    const { flash } = usePage().props;
    return (
        <AuthenticatedLayout>
            <Head title="Visualizar Usuário" />

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
                        <Link href={route('users.index')} className="hover:text-gray-700 dark:hover:text-gray-300">
                            Usuários
                        </Link>
                        <span className="mx-1">/</span>
                        <span>Visualizar</span>
                    </nav>
                </div>
            </div>

            <div className="py-4 mx-auto max-w-8xl px-1 sm:px-0 lg:px-0">
                <div className="overflow-hidden bg-white shadow-lg sm:rounded-lg dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                    <div className="flex justify-between items-center p-3">
                        <h3 className="text-lg">Visualizar</h3>
                        <div className="flex space-x-1">
                            <Link href={route('users.index')}>
                                <InfoButton className="text-sm">
                                    Listar
                                </InfoButton>
                            </Link>
                            <Link href={route('users.edit', { id: user.id })}>
                                <WarningButton className="text-sm">
                                    Editar
                                </WarningButton>
                            </Link>
                            <ConfirmDeleteBotton
                                id={user.id}
                                routaName="users.destroy"
                            />
                        </div>
                    </div>
                    {/* Apresentar a mensagem de sucesso */}
                    <AlertMessage message={flash} />

                    {/* Imprimir os dados do usuário */}
                    <div className="bg-gray-50 text-sm dark:bg-gray-700 p-4">
                        <div className="mb-2">
                            <span className="text-md font-semibold text-gray-700 dark:text-gray-200">ID: </span>
                            <span className="text-md text-gray-600 dark:text-gray-400">{user.id}</span>
                        </div>

                        <div className="mb-2">
                            <span className="text-md font-semibold text-gray-700 dark:text-gray-200">Nome: </span>
                            <span className="text-md text-gray-600 dark:text-gray-400">{user.name}</span>
                        </div>

                        <div className="mb-2">
                            <span className="text-md font-semibold text-gray-700 dark:text-gray-200">E-mail: </span>
                            <span className="text-md text-gray-600 dark:text-gray-400">{user.email}</span>
                        </div>

                    </div>

                </div>
            </div>
        </AuthenticatedLayout>
    )
}