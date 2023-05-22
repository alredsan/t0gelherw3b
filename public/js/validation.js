"use strict";
// USO DE PATRON IIFE
(function(){

    const validatorsForms = {
        "/inicioSesion": () => validateLogin(),
        "/registro": () => validateRegister(),
        "/admin/ongs/edit": () => validateFormONG(),
    };

    /**
     * Una vez cargada la pagina por completo, invocar el metodo correspondiente para validar
     * en el lado del cliente
     */
    window.addEventListener('DOMContentLoaded', function () {
        let url = window.location.pathname.split(/\/\d/)[0];
        console.log(url);
        console.log(window);
        try {
            validatorsForms[url]();
        } catch (error){}
    });


    /**
     * Mostrar o ocultar la contraseña
     */
    function mostrarContrasena() {
        let botonMostrar = document.getElementById('showPasswd');
        botonMostrar.addEventListener('click',function(){
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

    function checkDNI(dni) {
        arrayLetters = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];

        numberDNI = dni.substr(0, dni.length - 1);

        if (isNaN(numberDNI[0])) {
            numberDNI = dni.substr(1, numberDNI.length - 1);
        }

        letterDNI = dni[dni.length - 1];

        result = numberDNI % 23;

        if (letterDNI == arrayLetters[result]) {
            return true;
        }

        return false;
    }

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


    function validateRegister() {
        let validateRegisterForm = document.forms.fRegister;

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


    function validateFormONG() {
        let validateONGForm = document.forms.formONG;

        $(validateONGForm).attr('novalidate', true);
        $(validateONGForm).submit(function (event) {
            let isValid = true;
            let firstInvalidElement = null;

            if (this.FotoLogo.checkValidity()) {
                showFeedBack($(this.FotoLogo), true);
            } else {
                isValid = false;
                firstInvalidElement = this.FotoLogo;
                showFeedBack($(this.FotoLogo), false);
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
        $(validateONGForm.IBANmetodoPago).change(defaultCheckElement);
        $(validateONGForm.eMail).change(defaultCheckElement);
        $(validateONGForm.Telefono).change(defaultCheckElement);
        $(validateONGForm.FotoLogo).change(defaultCheckElement);


        function formatCreditCard(card) {
            // card = card.replace(/\D/g, '');
            // card = card.replace(/^(\w{2}\d{2})?(\d{4})?(\d{4})?(\d{4})/,'$1 $2 $3 $4');
            // card = card.replace(/\s{2}/g,' ');
            console.log('C' + card);
            if (card.length > 0) {

                if (card.length % 5 == 0) {
                    card += " ";
                }
            }
            return (card.length < 19) ? card.trimStart() : card.trim();
        }

        $((validateONGForm.IBANmetodoPago)).on({
            beforeinput: function (event) {
                let isValid = true;
                let character = event.originalEvent.data;
                if (character) {
                    if (!/[\d\w]/.test(character)) isValid = false;
                    if (!isValid) {
                        event.preventDefault();
                    }
                    this.value = formatCreditCard(this.value);
                }
            }, paste: function (event) {
                this.value = formatCreditCard(this.value);
            }, change: function () {
                this.value = formatCreditCard(this.value);
            }
        });


    }

})();