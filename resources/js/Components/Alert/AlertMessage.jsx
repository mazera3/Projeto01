import { useEffect } from "react";
import Swal from "sweetalert2";

function AlertMessage({message}){

    // Verifica se a mensagem contém tanto success quanto error
    const hasSuccess= message.success ? true : false;
    const hasError= message.error ? true : false;

    // Exibe o alerta com SweetAlert2 se houver mensagens
    useEffect(() => {
        if(hasSuccess){
            Swal.fire({
                title: "Sucesso!",
                text: message.success,
                icon: "success",
                confirmButtonColor: "#22c55e",
            });
        }

        if(hasError){
            Swal.fire({
                title: "Erro!",
                text: message.error,
                icon: "error",
                confirmButtonColor: "#ef4444",
            });
        }

    }, [message, hasSuccess, hasError]);

    return null; // Não é necessário renderizar nada no DOM
}

export default AlertMessage;