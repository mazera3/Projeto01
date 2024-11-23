// Importa componentes reutilizáveis
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/Button/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';

// Função que representa o componente para recuperar a senha
export default function ForgotPassword({ status }) {

    // Utiliza o hook useForm para gerenciar o estado do formulário de redefinição de senha.
    const { data, setData, post, processing, errors } = useForm({
        email: '', // Inicializa o campo de e-mail como uma string vazia.
    });

    // Função para submissão do formulário
    const submit = (e) => {
        e.preventDefault(); // Impede o comportamento padrão de recarregar a página ao enviar o formulário

        post(route('password.email')); // Envia uma solicitação POST para a rota de e-mail de redefinição de senha.
    };

    return (
        <GuestLayout>
            <Head title="Esqueceu a Senha" />

            <div className="mb-4 text-sm text-gray-600 dark:text-gray-400">
                Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um e-mail com
                link de redefinição que permitirá que você escolha uma nova senha.
            </div>

            {status && (
                <div className="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                    {status}
                </div>
            )}

            <form onSubmit={submit}>

                <div>
                    <InputLabel htmlFor="email" value="E-mail" />

                    <TextInput
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Digite o e-mail de usuário"
                        value={data.email}
                        className="mt-1 block w-full"
                        isFocused={true}
                        onChange={(e) => setData('email', e.target.value)}
                    />

                    <InputError message={errors.email} className="mt-2" />
                </div>

                <div className="mt-4 flex items-center justify-end">
                    <Link
                        href={route('login')}
                        className="no-underline rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                    >
                        Clique aqui para acessar
                    </Link>

                    <PrimaryButton className="ms-4" disabled={processing}>
                        Solicitar
                    </PrimaryButton>
                </div>
            </form>
        </GuestLayout>
    );
}