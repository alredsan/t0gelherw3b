"use strict";

function checkFileExtension(file, allowedExtensions) {
    let fileExtension = file.name.split('.').pop().toLowerCase();

    return allowedExtensions.some((extension) => {
        return extension === fileExtension
    });
}



/**
     * Mostrar o ocultar la contraseña
     */
function mostrarContrasena() {
    let botonMostrar = document.getElementById('showPasswd');
    botonMostrar.addEventListener('click', function () {
        let campo = document.getElementById("passwd");
        if (campo.type == "password") {
            campo.type = "text";
        } else {
            campo.type = "password";
        }
    });
}

function showFeedBack(input, valid, message) {
    let validClass = (valid) ? 'is-valid' : 'is-invalid';
    let div = (valid) ? input.nextAll("div.valid-feedback") : input.nextAll("div.invalid-feedback");
    input.nextAll('div').removeClass('d-block');
    div.removeClass('d-none').addClass('d-block');
    input.removeClass('is-valid is-invalid').addClass(validClass);
    if (message) {
        div.empty();
        div.append(message);
    }
}

function defaultCheckElement(event) {
    this.value = this.value.trim();
    if (!this.checkValidity()) {
        showFeedBack($(this), false);
    } else {
        showFeedBack($(this), true);
    }
}

// USO DE PATRON IIFE
(function () {

    const validatorsForms = {
        "/inicioSesion": () => validateLogin(),
        "/registro": () => validateRegister(),
        "/cuenta/perfil/editar": () => validateFormUser(),
        "/cuenta/perfil/cambiopassword": () => validateFormChangePassword(),
        "/admin/ongs/edit": () => validateFormONG(),
        "/admin/ongs/new": () => validateFormONG(),
        "/admin/ong/event/new": () => validateEvent(),
        "/admin/ong/event/edit": () => validateEvent(),
        "/admin/users/editar": () => validateFormUser(),
        "/admin/types/add": () => validateFormTypes(),
        "/admin/types/edit": () => validateFormTypes(),
        "/app/event": () => validateFormDonative(),
        "/admin/ong/usersAssign": () => validateFormAssign()
    };

    /**
     * Una vez cargada la pagina por completo, invocar el metodo correspondiente para validar
     * en el lado del cliente
     */
    window.addEventListener('DOMContentLoaded', function () {
        let url = window.location.pathname.split(/\/\d/)[0];

        try {
            validatorsForms[url]();
        } catch (error) { }
    });

    let inputFile = document.getElementById('FotoLogoSelec');
    let photoPreview = document.getElementById('FotoPreview');

    if (photoPreview) {
        inputFile.addEventListener('change', function (event) {
            let fileImagen = event.target.files[0];
            if (fileImagen && checkFileExtension(fileImagen, ['jpg', 'png', 'gif'])) photoPreview.src = URL.createObjectURL(fileImagen);
        });
    }





    /**
     * Metodo donde se calcula la letra si es correcta
     * @param {*} dni
     * @returns
     */
    function checkDNI(dni) {
        let arrayLetters = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];

        let numberDNI = dni.substr(0, dni.length - 1);

        if (isNaN(numberDNI[0])) {
            numberDNI = dni.substr(1, numberDNI.length - 1);
        }

        let letterDNI = dni[dni.length - 1];

        let result = numberDNI % 23;

        if (letterDNI == arrayLetters[result]) {
            return true;
        }

        return false;
    }

    /**
     * Metodo donde se valida los datos del Usuario
     */
    function validateLogin() {
        let validateLoginForm = document.forms.fLogin;
        mostrarContrasena();

        $(validateLoginForm).attr('novalidate', true);
        $(validateLoginForm).submit(function (event) {
            let isValid = true;
            let firstInvalidElement = null;

            if (this.passwd.checkValidity()) {
                showFeedBack($(this.passwd), true);
            } else {
                isValid = false;
                firstInvalidElement = this.passwd;
                showFeedBack($(this.passwd), false);
            }

            if (this.email.checkValidity()) {
                showFeedBack($(this.email), true);
            } else {
                isValid = false;
                firstInvalidElement = this.email;
                showFeedBack($(this.email), false);
            }

            if (!isValid) {
                firstInvalidElement.focus();
                event.preventDefault();
                event.stopPropagation();
            }

        });

        $(validateLoginForm.email).change(defaultCheckElement);
        $(validateLoginForm.passwd).change(defaultCheckElement);
    }

    /**
     * Metodo donde se valida el registro
     */
    function validateRegister() {
        let validateRegisterForm = document.forms.fRegister;
        mostrarContrasena();
        $(validateRegisterForm).attr('novalidate', true);

        $(validateRegisterForm).submit(function (event) {
            let isValid = true;
            let firstInvalidElement = null;

            if (this.passwd.value != this.passwdConfirm.value) {
                isValid = false;
                firstInvalidElement = this.passwdConfirm;
                showFeedBack($(this.passwdConfirm), false);
            }

            if (this.passwd.checkValidity()) {
                showFeedBack($(this.passwd), true);
            } else {
                isValid = false;
                firstInvalidElement = this.passwd;
                showFeedBack($(this.passwd), false);
            }

            if (this.Telefono.checkValidity()) {
                showFeedBack($(this.Telefono), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Telefono;
                showFeedBack($(this.Telefono), false);
            }

            if (this.Provincia.checkValidity()) {
                showFeedBack($(this.Provincia), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Provincia;
                showFeedBack($(this.Provincia), false);
            }

            if (this.Direccion.checkValidity()) {
                showFeedBack($(this.Apellidos), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Direccion;
                showFeedBack($(this.Direccion), false);
            }

            if (this.DNI.checkValidity()) {
                showFeedBack($(this.DNI), true);

                if (!checkDNI(this.DNI.value)) {
                    showFeedBack($(this.DNI), false);
                }
            } else {
                isValid = false;
                firstInvalidElement = this.DNI;
                showFeedBack($(this.DNI), false);
            }

            if (this.email.checkValidity()) {
                showFeedBack($(this.email), true);
            } else {
                isValid = false;
                firstInvalidElement = this.email;
                showFeedBack($(this.email), false);
            }

            if (this.Apellidos.checkValidity()) {
                showFeedBack($(this.Apellidos), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Apellidos;
                showFeedBack($(this.Apellidos), false);
            }

            if (this.Nombre.checkValidity()) {
                showFeedBack($(this.Nombre), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Nombre;
                showFeedBack($(this.Nombre), false);
            }

            if (!isValid) {
                firstInvalidElement.focus();
                event.preventDefault();
                event.stopPropagation();
            }

        });

        $(validateRegisterForm.Nombre).change(defaultCheckElement);
        $(validateRegisterForm.Apellidos).change(defaultCheckElement);
        $(validateRegisterForm.email).change(defaultCheckElement);

        $(validateRegisterForm.Direccion).change(defaultCheckElement);
        $(validateRegisterForm.Provincia).change(defaultCheckElement);
        $(validateRegisterForm.Telefono).change(defaultCheckElement);

        $(validateRegisterForm.DNI).change(function () {
            if (this.checkValidity()) {
                showFeedBack($(this), true);
                if (!checkDNI(this.value)) {
                    showFeedBack($(this), false);
                }
            } else {
                showFeedBack($(this), false);
            }
        });

        $(validateRegisterForm.passwd).change(function () {
            if (!this.checkValidity()) {
                showFeedBack($(this), false);
            } else {
                showFeedBack($(this), true);
                validateRegisterForm.passwdConfirm.value = "";
            }
        });

        $(validateRegisterForm.passwdConfirm).change(function () {

            if (validateRegisterForm.passwd.value != validateRegisterForm.passwdConfirm.value) {
                showFeedBack($(validateRegisterForm.passwdConfirm), false);
            } else {
                showFeedBack($(validateRegisterForm.passwdConfirm), true);
            }
        });

    }

    /**
     * Metodo donde se valida el formulario de ONG
     */
    function validateFormONG() {
        let validateONGForm = document.forms.formONG;

        $(validateONGForm).attr('novalidate', true);
        $(validateONGForm).submit(function (event) {
            let isValid = true;
            let firstInvalidElement = null;

            if (this.FotoLogo.value) {
                if (!checkFileExtension(this.FotoLogo.files[0], ['jpg', 'png', 'gif'])) {
                    isValid = false;
                    firstInvalidElement = this.FotoLogo;
                    showFeedBack($(this.FotoLogo), false);
                } else {

                    showFeedBack($(this.FotoLogo), true);
                }
            }

            if (this.Telefono.checkValidity()) {
                showFeedBack($(this.Telefono), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Telefono;
                showFeedBack($(this.Telefono), false);
            }

            if (this.eMail.checkValidity()) {
                showFeedBack($(this.eMail), true);
            } else {
                isValid = false;
                firstInvalidElement = this.eMail;
                showFeedBack($(this.eMail), false);
            }

            if (this.IBANmetodoPago.checkValidity()) {
                showFeedBack($(this.IBANmetodoPago), true);
            } else {
                isValid = false;
                firstInvalidElement = this.IBANmetodoPago;
                showFeedBack($(this.IBANmetodoPago), false);
            }

            if (this.FechaCreacion.checkValidity()) {
                showFeedBack($(this.FechaCreacion), true);
            } else {
                isValid = false;
                firstInvalidElement = this.FechaCreacion;
                showFeedBack($(this.FechaCreacion), false);
            }

            if (this.Descripcion.checkValidity()) {
                showFeedBack($(this.Telefono), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Descripcion;
                showFeedBack($(this.Descripcion), false);
            }

            if (this.DireccionSede.checkValidity()) {
                showFeedBack($(this.DireccionSede), true);
            } else {
                isValid = false;
                firstInvalidElement = this.DireccionSede;
                showFeedBack($(this.DireccionSede), false);
            }

            if (this.Name.checkValidity()) {
                showFeedBack($(this.Name), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Name;
                showFeedBack($(this.Name), false);
            }



            if (!isValid) {
                firstInvalidElement.focus();
                event.preventDefault();
                event.stopPropagation();
            }

        });

        $(validateONGForm.Name).change(defaultCheckElement);
        $(validateONGForm.DireccionSede).change(defaultCheckElement);
        $(validateONGForm.Descripcion).change(defaultCheckElement);
        $(validateONGForm.FechaCreacion).change(defaultCheckElement);
        $(validateONGForm.eMail).change(defaultCheckElement);
        $(validateONGForm.Telefono).change(defaultCheckElement);
        $(validateONGForm.FotoLogo).change(function () {
            if (this.value) {
                if (!checkFileExtension(this.files[0], ['jpg', 'png', 'gif'])) {
                    showFeedBack($(this), false);
                } else {
                    showFeedBack($(this), true);
                }
            }
        });

        $((validateONGForm.IBANmetodoPago)).change(defaultCheckElement);
    }

    /**
     * Metodo donde se valida el formulario de cambio contraseña
     */
    function validateFormChangePassword() {
        let validateFormChangePassword = document.forms.formChangePasswd;

        $(validateFormChangePassword).attr('novalidate', true);
        $(validateFormChangePassword).submit(function (event) {
            let isValid = true;
            let firstInvalidElement = null;

            if (this.confirmarpassword.checkValidity()) {
                showFeedBack($(this.confirmarpassword), true);
            } else {
                isValid = false;
                firstInvalidElement = this.confirmarpassword;
                showFeedBack($(this.confirmarpassword), false);
            }

            if (this.newpassword.checkValidity()) {
                showFeedBack($(this.newpassword), true);
            } else {
                isValid = false;
                firstInvalidElement = this.newpassword;
                showFeedBack($(this.newpassword), false);
            }


            if (this.oldpassword.checkValidity()) {
                showFeedBack($(this.oldpassword), true);
            } else {
                isValid = false;
                firstInvalidElement = this.oldpassword;
                showFeedBack($(this.oldpassword), false);
            }

            if (this.newpassword.value != this.confirmarpassword.value) {
                isValid = false;
                firstInvalidElement = this.confirmarpassword;
                showFeedBack($(this.confirmarpassword), false);
            }

            if (!isValid) {
                firstInvalidElement.focus();
                event.preventDefault();
                event.stopPropagation();
            }

        });
        $(validateFormChangePassword.oldpassword).change(defaultCheckElement);
        $(validateFormChangePassword.newpassword).change(function () {
            if (!this.checkValidity()) {
                showFeedBack($(this), false);
            } else {
                showFeedBack($(this), true);
                validateFormChangePassword.confirmarpassword.value = "";
            }
        });
        $(validateFormChangePassword.confirmarpassword).change(function () {

            if (validateFormChangePassword.newpassword.value != validateFormChangePassword.confirmarpassword.value) {
                showFeedBack($(validateFormChangePassword.confirmarpassword), false);
            } else {
                showFeedBack($(validateFormChangePassword.confirmarpassword), true);
            }
        });
    }

    /**
     * metodo donde se valida el usuario
     */
    function validateFormUser() {
        let validateUpdateUserForm = document.forms.formUserUpdate;
        $(validateUpdateUserForm).attr('novalidate', true);

        $(validateUpdateUserForm).submit(function (event) {
            let isValid = true;
            let firstInvalidElement = null;

            if (this.Foto.value) {
                if (!checkFileExtension(this.Foto.files[0], ['jpg', 'png', 'gif'])) {
                    isValid = false;
                    firstInvalidElement = this.Foto;
                    showFeedBack($(this.Foto), false);
                } else {
                    showFeedBack($(this.Foto), true);
                }
            }

            if (this.passwd) {
                if (this.passwd.value != this.passwdConfirm.value) {
                    isValid = false;
                    firstInvalidElement = this.passwdConfirm;
                    showFeedBack($(this.passwdConfirm), false);
                }

                if (this.passwd.checkValidity()) {
                    showFeedBack($(this.passwd), true);
                } else {
                    isValid = false;
                    firstInvalidElement = this.passwd;
                    showFeedBack($(this.passwd), false);
                }
            }


            if (this.Telefono.checkValidity()) {
                showFeedBack($(this.Telefono), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Telefono;
                showFeedBack($(this.Telefono), false);
            }

            if (this.Provincia.checkValidity()) {
                showFeedBack($(this.Provincia), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Provincia;
                showFeedBack($(this.Provincia), false);
            }

            if (this.Direccion.checkValidity()) {
                showFeedBack($(this.Apellidos), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Direccion;
                showFeedBack($(this.Direccion), false);
            }

            if (this.DNI) {
                if (this.DNI.checkValidity()) {
                    showFeedBack($(this.DNI), true);

                    if (!checkDNI(this.DNI.value)) {
                        isValid = false;
                        firstInvalidElement = this.DNI;
                        showFeedBack($(this.DNI), false);
                    }
                } else {
                    isValid = false;
                    firstInvalidElement = this.DNI;
                    showFeedBack($(this.DNI), false);
                }
            }


            if (this.email.checkValidity()) {
                showFeedBack($(this.email), true);
            } else {
                isValid = false;
                firstInvalidElement = this.email;
                showFeedBack($(this.email), false);
            }

            if (this.Apellidos.checkValidity()) {
                showFeedBack($(this.Apellidos), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Apellidos;
                showFeedBack($(this.Apellidos), false);
            }

            if (this.Nombre.checkValidity()) {
                showFeedBack($(this.Nombre), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Nombre;
                showFeedBack($(this.Nombre), false);
            }

            if (!isValid) {
                firstInvalidElement.focus();
                event.preventDefault();
                event.stopPropagation();
            }

        });

        $(validateUpdateUserForm.Nombre).change(defaultCheckElement);
        $(validateUpdateUserForm.Apellidos).change(defaultCheckElement);
        $(validateUpdateUserForm.email).change(defaultCheckElement);

        $(validateUpdateUserForm.Direccion).change(defaultCheckElement);
        $(validateUpdateUserForm.Provincia).change(defaultCheckElement);
        $(validateUpdateUserForm.Telefono).change(defaultCheckElement);

        $(validateUpdateUserForm.Foto).change(function () {
            if (this.value) {
                if (!checkFileExtension(this.files[0], ['jpg', 'png', 'gif'])) {
                    showFeedBack($(this), false);
                } else {
                    showFeedBack($(this), true);
                }
            }
        });

        $(validateUpdateUserForm.DNI).change(function () {
            if (this.checkValidity()) {
                showFeedBack($(this), true);
                if (!checkDNI(this.value)) {
                    showFeedBack($(this), false);
                }
            } else {
                showFeedBack($(this), false);
            }
        });

        if (validateUpdateUserForm.passwd) {

            $(validateUpdateUserForm.passwd).change(function () {
                if (!this.checkValidity()) {
                    showFeedBack($(this), false);
                } else {
                    showFeedBack($(this), true);
                    validateUpdateUserForm.passwdConfirm.value = "";
                }
            });

            $(validateUpdateUserForm.passwdConfirm).change(function () {

                if (validateUpdateUserForm.passwd.value != validateUpdateUserForm.passwdConfirm.value) {
                    showFeedBack($(validateUpdateUserForm.passwdConfirm), false);
                } else {
                    showFeedBack($(validateUpdateUserForm.passwdConfirm), true);
                }
            });

        }

    }

    /**
     * Metodo donde se valida el formulario de Evento
     */
    function validateEvent() {
        let validateEventNewForm = document.forms.formEvent;

        $(validateEventNewForm).attr('novalidate', true);
        $(validateEventNewForm).submit(function (event) {
            let isValid = true;
            let firstInvalidElement = null;

            if (this.Foto.value) {
                if (!checkFileExtension(this.Foto.files[0], ['jpg', 'png', 'gif'])) {
                    isValid = false;
                    firstInvalidElement = this.Foto;
                    showFeedBack($(this.Foto), false);
                } else {
                    showFeedBack($(this.Foto), true);
                }
            }


            if (this.Latitud.value != "") {
                showFeedBack($(this.Latitud), true);
            } else {
                isValid = false;
                firstInvalidElement = this.searchDire;
                showFeedBack($(this.Latitud), false);
            }

            if (this.Direccion.checkValidity()) {
                showFeedBack($(this.Direccion), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Direccion;
                showFeedBack($(this.Direccion), false);
            }

            if (this.numMaxVoluntarios.checkValidity()) {
                showFeedBack($(this.numMaxVoluntarios), true);
            } else {
                isValid = false;
                firstInvalidElement = this.numMaxVoluntarios;
                showFeedBack($(this.numMaxVoluntarios), false);
            }

            if (this.FechaEvento.checkValidity()) {
                showFeedBack($(this.FechaEvento), true);
            } else {
                isValid = false;
                firstInvalidElement = this.FechaEvento;
                showFeedBack($(this.FechaEvento), false);
            }

            if (this.Nombre.checkValidity()) {
                showFeedBack($(this.Nombre), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Nombre;
                showFeedBack($(this.Nombre), false);
            }

            if (!isValid) {
                firstInvalidElement.focus();
                event.preventDefault();
                event.stopPropagation();
            }

        });

        $(validateEventNewForm.Latitud).change(function () {
            if (this.value != "") {
                showFeedBack($(this), true);
            } else {
                isValid = false;
                firstInvalidElement = validateEventNewForm.searchDire;
                showFeedBack($(this), false);
            }
        });
        $(validateEventNewForm.Direccion).change(defaultCheckElement);
        $(validateEventNewForm.numMaxVoluntarios).change(defaultCheckElement);
        $(validateEventNewForm.FechaEvento).change(defaultCheckElement);
        $(validateEventNewForm.Nombre).change(defaultCheckElement);

        $(validateEventNewForm.Foto).change(function () {
            if (this.value) {
                if (!checkFileExtension(this.files[0], ['jpg', 'png', 'gif'])) {
                    showFeedBack($(this), false);
                } else {
                    showFeedBack($(this), true);
                }
            }
        });

    }

    /**
     * Metodo donde se valida el formuario de Types
     */
    function validateFormTypes() {

        let validateONGForm = document.forms.formType;

        $(validateONGForm).attr('novalidate', true);
        $(validateONGForm).submit(function (event) {
            let isValid = true;
            let firstInvalidElement = null;

            if (this.Nombre.checkValidity()) {
                showFeedBack($(this.Nombre), true);
            } else {
                isValid = false;
                firstInvalidElement = this.Nombre;
                showFeedBack($(this.Nombre), false);
            }
            if (!isValid) {
                firstInvalidElement.focus();
                event.preventDefault();
                event.stopPropagation();
            }

        });
        $(validateONGForm.Nombre).change(defaultCheckElement);

    }

    /**
     * Metodo donde se valida el numero introducido en la form de donación
     */
    function validateFormDonative() {
        let validateFormDonative = document.forms.donativeform;


        $(validateFormDonative).attr('novalidate', true);
        $(validateFormDonative).submit(function (event) {
            let isValid = true;
            let firstInvalidElement = null;

            if (this.donative.checkValidity()) {
                showFeedBack($(this.donative), true);
            } else {
                isValid = false;
                firstInvalidElement = this.donative;
                showFeedBack($(this.donative), false);
            }
            if (!isValid) {
                firstInvalidElement.focus();
                event.preventDefault();
                event.stopPropagation();
            }

        });
        $(validateFormDonative.donative).change(defaultCheckElement);
    }

    /**
     * Metodo donde se valida el asignacion del permiso
     */
    function validateFormAssign() {
        let formAssignUser = document.forms.fAssignUser;

        $(formAssignUser).attr('novalidate', true);
        $(formAssignUser).submit(function (event) {
            let isValid = true;
            let firstInvalidElement = null;

            if (this.email.readOnly) {
                showFeedBack($(this.email), true);
            } else {
                isValid = false;
                firstInvalidElement = this.email;
                showFeedBack($(this.email), false);
            }

            if (this.chxRol.value != "") {
                showFeedBack($(this.chxRol), true);
            } else {
                isValid = false;
                // firstInvalidElement = this.chxRol;
                showFeedBack($(this.chxRol), false);
            }

            if (!isValid) {
                if (firstInvalidElement) {
                    firstInvalidElement.focus();
                }
                event.preventDefault();
                event.stopPropagation();
            }

        });

        $(formAssignUser.chxRol).change(function (event) {
            if (this.checked) {
                showFeedBack($(this), true);
                $("#msgRadio").addClass('d-none');
            } else {
                showFeedBack($(this), false);
            }

        });
    }

})();
