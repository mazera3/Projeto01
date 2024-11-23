// Importa a biblioteca React para construir componentes
import React from "react";

// Importa componentes do Inertia.js para manipular o cabeçalho do documento e criar links
import { Head, Link } from "@inertiajs/react";

// Define o componente Welcome e recebe a propriedade auth
export default function Welcome({ auth }) {

    // Obtém o ano atual para exibição no rodapé
    const currentYear = new Date().getFullYear();

    // Obtém o nome do aplicativo do ambiente ou define um padrão
    const appName = import.meta.env.VITE_APP_NAME || "Seu Gerenciador Financeiro";

    return (
        <>
            {/* Define o título da página como "Home" */}
            <Head title="Home" />

            {/* Container principal com um fundo gradiente e configurações de flexbox para centralização */}
            <div className="bg-gradient-to-r from-blue-400 to-indigo-600 min-h-screen flex flex-col justify-center items-center text-white">

                {/* Seção de cabeçalho centralizada */}
                <header className="text-center">

                    {/* Título principal do aplicação */}
                    <h1 className="text-3xl font-bold mb-6">Gerencie Suas Finanças Pessoais com Facilidade!</h1>

                    {/* Descrição do aplicação */}
                    <p className="text-lg mb-10">
                        Controle seus gastos, organize seu orçamento e alcance seus objetivos financeiros.
                    </p>

                    {/* Container para os links de ação com espaçamento */}
                    <div className="flex justify-center space-x-4">

                        {/* Verifica se o usuário está autenticado */}
                        {auth.user ? (
                            <Link href={route('dashboard')} className="bg-blue-900 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-300">
                                Dashboard
                            </Link>
                        ) : ( // Se o usuário não estiver autenticado
                            <>
                                <Link href={route('login')} className="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded transition duration-300">
                                    Acessar
                                </Link>

                                <Link href={route('register')} className="bg-blue-900 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-300">
                                    Cadastrar
                                </Link>
                            </>
                        )}
                    </div>

                </header>

                {/* Seção com informações adicionais sobre o aplicativo */}
                <section className="mt-12 flex flex-col md:flex-row justify-center items-center space-y-6 md:space-y-0 md:space-x-6">

                    {/* Descrição do primeiro recurso */}
                    <div className="bg-white text-black p-6 rounded-lg shadow-lg w-72 text-center">
                        <h3 className="font-bold text-xl mb-4">Controle Simples</h3>
                        <p>
                            Monitore todas as suas despesas e receitas com facilidade, garantindo total controle.
                        </p>
                    </div>

                    {/* Descrição do primeiro recurso */}
                    <div className="bg-white text-black p-6 rounded-lg shadow-lg w-72 text-center">
                        <h3 className="font-bold text-xl mb-4">Relatórios Detalhados</h3>
                        <p>
                            Visualize gráficos e relatórios que ajudam a entender melhor seus hábitos financeiros.
                        </p>
                    </div>

                    {/* Descrição do primeiro recurso */}
                    <div className="bg-white text-black p-6 rounded-lg shadow-lg w-72 text-center">
                        <h3 className="font-bold text-xl mb-4">Planejamento de Metas</h3>
                        <p>
                            Defina metas de economia e veja como seu progresso avança no dia a dia.
                        </p>
                    </div>

                </section>

                {/* Seção do rodapé */}
                <footer className="mt-16 text-center">
                    {/* Exibe o ano atual e o nome do aplicativo */}
                    <p>@ {currentYear} {appName}. Todos os direitos reservados.</p>
                </footer>

            </div>
        </>
    )
}