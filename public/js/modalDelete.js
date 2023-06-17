/**
 * Funcion para el MODAL DELETE, tratamiento para asignar la acción
 */
(function () {
    let modalConfirm = document.getElementById("modalDelete");

    let formModal = document.getElementById('formDeleteModal');

    modalConfirm.addEventListener('hidden.bs.modal', event => {
        formModal.action = ".";
    });

    let myModalDeleteUser = new bootstrap.Modal('#modalDelete', {
        keyboard: false
    });

    let bottons = document.getElementsByClassName("btnDelete");

    for (let boton of bottons) {
        boton.addEventListener("click", function (event) {

            event.preventDefault();
            formModal.action = event.target.dataset.action;

            myModalDeleteUser.show();
        });
    }

})();
