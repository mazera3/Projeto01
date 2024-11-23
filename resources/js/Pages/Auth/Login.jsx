// Importa componentes reutilizáveis para o formulário
import Checkbox from '@/Components/Checkbox'; // Componente para a checkbox "Lembre de mim"
import InputError from '@/Components/InputError'; // Componente que exibe mensagens de erro
import InputLabel from '@/Components/InputLabel'; // Componente para labels de campos de input
import PrimaryButton from '@/Components/Button/PrimaryButton'; // Botão principal estilizado
import TextInput from '@/Components/TextInput'; // Componente de campo de texto para entrada de dados
import GuestLayout from '@/Layouts/GuestLayout'; // Layout padrão para páginas de visitantes
import { Head, Link, useForm } from '@inertiajs/react'; // Importa o Head para manipular o título da página, Link para navegação e useForm para gerenciamento de formulários

// Define o componente Login que será exportado
export default function Login({ status, canResetPassword }) {

    // Usa o hook useForm para gerenciar o estado do formulário
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',         // Armazena o valor do campo "email"
        password: '',      // Armazena o valor do campo "password"
        remember: false,   // Estado do checkbox "Lembre de mim"
    });

    // Função para submissão do formulário
    const submit = (e) => {
        e.preventDefault(); // Previne o comportamento padrão do formulário (recarregar a página)

        post(route('login'), { // Realiza o envio dos dados para a rota de login
            onFinish: () => reset('password'), // Reseta o campo de senha após o envio do formulário
        });
    };

    return (
        // Define o layout da página usando GuestLayout
        <GuestLayout>

            {/* Define o título da página como "Login" */}
            <Head title="Login" />

            {/* Exibe uma mensagem de status, se existir */}
            {status && (
                <div className="mb-4 text-sm font-medium text-green-600">
                    {status}
                </div>
            )}

            {/* Início do formulário */}
            <form onSubmit={submit}>

                {/* Campo de entrada para o e-mail */}
                <div>
                    {/* Label para o campo de e-mail */}
                    <InputLabel htmlFor="email" value="E-mail" />

                    <TextInput
                        id="email" // Define o ID do campo
                        type="email" // Define o tipo como e-mail
                        name="email" // Nome do campo
                        placeholder="Digite o e-mail de usuário" // Placeholder do campo
                        value={data.email} // Valor do campo, controlado pelo useForm
                        className="mt-1 block w-full" // Classe de estilização do input
                        autoComplete="username" // Autocompletar baseado no nome de usuário
                        isFocused={true} // Foca o campo automaticamente
                        onChange={(e) => setData('email', e.target.value)} // Atualiza o estado ao mudar o valor
                    />

                    {/* Exibe erro de e-mail, se existir */}
                    <InputError message={errors.email} className="mt-2" />
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="password" value="Senha" />

                    <TextInput
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Digite a senha"
                        value={data.password}
                        className="mt-1 block w-full"
                        autoComplete="current-password"
                        onChange={(e) => setData('password', e.target.value)}
                    />

                    <InputError message={errors.password} className="mt-2" />
                </div>

                {/* Checkbox "Lembre de mim" */}
                <div className="mt-4 block">
                    <label className="flex items-center">
                        <Checkbox
                            name="remember" // Nome do checkbox
                            checked={data.remember} // Valor booleano do estado
                            onChange={(e) => setData('remember', e.target.checked)} // Atualiza o estado ao alterar o valor
                        />
                        <span className="ms-2 text-sm text-gray-600 dark:text-gray-400">
                            Lembre de mim
                        </span> {/* Texto ao lado da checkbox */}
                    </label>
                </div>

                {/* Link para redefinir senha e botão de submit */}
                <div className="mt-4 flex items-center justify-end">
                    {canResetPassword && ( // Exibe o link se puder redefinir senha
                        <Link
                            href={route('password.request')} // Link para a rota de redefinição de senha
                            className="no-underline rounded-md text-sm text-gray-600  hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                        >
                            Esqueceu sua senha?
                        </Link>
                    )}

                    {/* Botão "Acessar" */}
                    <PrimaryButton className="ms-4" disabled={processing}>
                        Acessar
                    </PrimaryButton>
                </div>

                {/* Informações para teste de login */}
                <div className="mt-4">
                    <span className="ms-2 text-sm text-red-600 dark:text-gray-400">
                        Usuário: cesar@celke.com.br
                    </span>
                    <br/>
                    <span className="ms-2 text-sm text-red-600 dark:text-gray-400">
                        Senha: 123456A#
                    </span>
                </div>

            </form>


        </GuestLayout>
    )
}