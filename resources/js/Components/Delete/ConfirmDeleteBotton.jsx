import React from "react";
import DangerButton from "../Button/DangerButton";
import Swal from 'sweetalert2'
import { useForm } from "@inertiajs/react";

function ConfirmDeleteBotton({ id, routaName }) {

    const {delete: destroy} = useForm();

    const handleDelete = () => {

        Swal.fire({
            title: "Tem certeza?",
            text: "Você não poderá reverter esta ação",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ef4444",
            cancelButtonColor: "#3b82f6",
            confirmButtonText: "Sim, excluir!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                destroy(route(routaName, id), {
                    onSuccess: () => {
                        Swal.fire(
                            "Excluído!",
                            "O registro foi excluído com sucesso!",
                            "success"
                        );
                    },
                    onError: () => {
                        Swal.fire(
                            "Erro!",
                            "Ocorreu um erro ao tentar excluir o Registro !",
                            "error"
                        );
                    }
                });
            }
        });
    };
    return (
        <DangerButton className="ms-1 text-sm" onClick={handleDelete}>
            Apagar
        </DangerButton>
    )
}

export default ConfirmDeleteBotton;