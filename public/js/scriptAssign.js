/**
 * ACCION: ASIGNAR/EDITAR ROLES DE UN USUARIO
 */

window.addEventListener('DOMContentLoaded', function () {

    let inputSearch = $('#email');
    let users = $('#listUsers');
    let btnEdit = $('.btnEdit');
    let formAssignUser = document.forms.fAssignUser;

    let myModalDOMAssign = document.getElementById('modalAddAssign');

    myModalDOMAssign.addEventListener('hidden.bs.modal', event => {
        formAssignUser.reset();
        $(formAssignUser.email).removeClass('is-valid is-invalid')
        $(formAssignUser.email).nextAll('div').removeClass('d-block');
        inputSearch.removeAttr('readonly');

        $(formAssignUser.chxRol).removeClass('is-valid is-invalid');
        $(formAssignUser.chxRol).nextAll('div').removeClass('d-block');
        users.empty();
    });
    /**
     * BUSCADOR DE USUARIOS
     */
    inputSearch.keyup(function () {
        let valueInputSearch = inputSearch.val();

        if (valueInputSearch.length > 2) {

            fetch('/api/user/search', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'url': '/api/user/search',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    email: inputSearch.val()
                })
            }).then(function (response) {
                return response.json();
            }).then(function (response) {
                let list = $('<div class="list-group"></div>');
                if (response.length > 0) {
                    response.forEach((user) => {
                        list.append(`<a href="#" data-email='${user.email}' class="list-group-item list-group-item-action">
                                            <span>${user.name} ${user.Apellidos}</span>
                                            <p class="fw-light text-end">${user.email}</p>
                                        </a>`);
                    });

                } else {
                    list.append(`<div class="list-group-item list-group-item-action">
                                            <strong>No ha sido encontrado, ya esta asignado un ONG o no existe</strong>
                                </div>`);
                }

                users.empty();
                users.append(list);
                list.find('a').click(function (event) {

                    inputSearch.val($(this).data().email.trim());
                    inputSearch.attr('readonly', 'true');
                    showFeedBack($(formAssignUser.email), true);
                    users.empty();

                });
            }).catch(function (response) {
                console.error("Error");
                users.empty();
                users.append(`<div class="text-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        Ha producido un error de conexion, intentalo mas tarde
                    </div>`);

            });

        }

    });

    let pName = document.getElementById('pName');
    let pIdUser = document.getElementById('idUser');


    let rolesChk = $('#modalEditAssign input.chkRoleEdit');
    let myModalDOM = document.getElementById('modalEditAssign');

    let myModalEdit = new bootstrap.Modal('#modalEditAssign', {
        keyboard: false
    });

    myModalDOM.addEventListener('hidden.bs.modal', event => {
        rolesChk.removeAttr('checked');
        pIdUser.value = "";
    });

    /**
     * EDITAR ROLES DE UN USUARIO, RECUPERAR EL ROL QUE TIENE ASIGNADO
     */
    btnEdit.click(function () {


        fetch($(this).data().src, {
            method: "GET",

        }).then(function (data) {
            return data.json();
        }).then(function (data) {
            if (data.result = "Valido") {
                pName.innerHTML = "<p><strong>Usuario:</strong> "+data.user.name+" "+data.user.Apellidos+"</p>";
                pIdUser.value = data.user.id;
                document.getElementById("role"+data.user.Role).checked = true;

                myModalEdit.show();
            }
        });
    });
});
