import { Link } from "@inertiajs/react";

export default function Pagination({ links, currentPage }) {
    return (
        <div className="flex justify-center mt-4 mb-4 space-x-2">
            {links // Filtra os links para mostrar apenas as páginas atual, anterior, próxima, e os botões de navegação "Anterior" e "Próximo".
                .filter((link, index) => {
                    const isPrevious = link.label === "&laquo; Anterior"; // Verifica se o link é o botão "Anterior".
                    const isNext = link.label === "Próximo &raquo;"; // Verifica se o link é o botão "Próximo".
                    const isCurrent = link.active; // Verifica se o link é a página atual.

                    const isPageBeforeORAfter = index === currentPage || index === currentPage - 1 || index === currentPage + 1; //Verifica se o link corresponde à página atual, anterior ou próxima.

                    return isPrevious || isNext || isCurrent || isPageBeforeORAfter; // Retorna true para exibir o link se ele for "Anterior", "Próximo", a página atual ou uma das páginas antes/depois.
                })
                // Mapeia os links filtrados para gerar os botões de navegação.
                .map((link, index) => (
                    <Link
                        key={index} // Define uma chave única para cada link baseado no índice.
                        href={link.url ? link.url : '#'} // Define a URL do link ou "#" se não houver URL (link desabilitado).
                        as="button" // Configura o elemento como um botão para que o Inertia realize a requisição via AJAX.
                        className={`px-3 py-1 border rounded-md transition-colors duration-300 ${link.active
                            ? 'bg-blue-600 text-white border-blue-600 cursor-default' // Estilo para o link da página atual (ativo).
                            : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100 hover:text-blue-600' // Estilo para links normais (inativos).
                            } ${!link.url ? 'cursor-not-allowed opacity-50' : ''}`} // Aplica um estilo de desabilitado se o link não tiver URL.
                        onClick={e => !link.url && e.preventDefault()} // Previne o comportamento padrão se o link não tiver URL (desabilitado).
                    >{link.label === "&laquo; Anterior" ? (
                        "<" // Se o link for "Anterior", exibe o símbolo "<".
                    ) : link.label === "Próximo &raquo;" ? (
                        ">" // Se o link for "Próximo", exibe o símbolo ">".
                    ) : (
                        link.label // Caso contrário, exibe o número da página.
                    )}
                    </Link>
                ))
            }

        </div>
    );
};