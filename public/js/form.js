
/**
 * Mostrar o ocultar la contraseña
 */
function mostrarContrasena() {
    var campo = document.getElementById("passwd");
    if (campo.type == "password") {
        campo.type = "text";
    } else {
        campo.type = "password";
    }
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


function validateLogin() {
    let validateLoginForm = document.forms.fLogin;

    $(validateLoginForm).attr('novalidate', true);
    $(validateLoginForm).submit(function (event) {
        isValid = true;
        firstInvalidElement = null;

        if (this.email.checkValidity()) {
            showFeedBack($(this.email), true);
        } else {
            isValid = false;
            firstInvalidElement = this.email;
            showFeedBack($(this.email), false);
        }

        if (this.passwd.checkValidity()) {
            showFeedBack($(this.passwd), true);
        } else {
            isValid = false;
            firstInvalidElement = this.passwd;
            showFeedBack($(this.passwd), false);
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
        isValid = true;
        firstInvalidElement = null;

        if (this.Nombre.checkValidity()) {
            showFeedBack($(this.Nombre), true);
        } else {
            isValid = false;
            firstInvalidElement = this.Nombre;
            showFeedBack($(this.Nombre), false);
        }

        if (this.Apellidos.checkValidity()) {
            showFeedBack($(this.Apellidos), true);
        } else {
            isValid = false;
            firstInvalidElement = this.Apellidos;
            showFeedBack($(this.Apellidos), false);
        }

        if (this.email.checkValidity()) {
            showFeedBack($(this.email), true);
        } else {
            isValid = false;
            firstInvalidElement = this.email;
            showFeedBack($(this.email), false);
        }

        if (this.DNI.checkValidity()) {
            showFeedBack($(this.DNI), true);
        } else {
            isValid = false;
            firstInvalidElement = this.DNI;
            showFeedBack($(this.DNI), false);
        }

        if (this.Direccion.checkValidity()) {
            showFeedBack($(this.Apellidos), true);
        } else {
            isValid = false;
            firstInvalidElement = this.Direccion;
            showFeedBack($(this.Direccion), false);
        }

        if (this.Provincia.checkValidity()) {
            showFeedBack($(this.Provincia), true);
        } else {
            isValid = false;
            firstInvalidElement = this.Provincia;
            showFeedBack($(this.Provincia), false);
        }


        if (this.Telefono.checkValidity()) {
            showFeedBack($(this.Telefono), true);
        } else {
            isValid = false;
            firstInvalidElement = this.Telefono;
            showFeedBack($(this.Telefono), false);
        }

        if (this.passwd.checkValidity()) {
            showFeedBack($(this.passwd), true);
        } else {
            isValid = false;
            firstInvalidElement = this.passwd;
            showFeedBack($(this.passwd), false);
        }

        if (this.passwd.value != this.passwdConfirm.value) {
            isValid = false;
            firstInvalidElement = this.passwdConfirm;
            showFeedBack($(this.passwdConfirm), false);
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
    $(validateRegisterForm.DNI).change(defaultCheckElement);
    $(validateRegisterForm.Direccion).change(defaultCheckElement);
    $(validateRegisterForm.Provincia).change(defaultCheckElement);
    $(validateRegisterForm.Telefono).change(defaultCheckElement);
    $(validateRegisterForm.passwd).change(function(){
        if (!this.checkValidity()) {
            showFeedBack($(this), false);
        } else {
            showFeedBack($(this), true);
            validateRegisterForm.passwdConfirm.value = "";
        }
    });

    $(validateRegisterForm.passwdConfirm).change(function(){

        if (validateRegisterForm.passwd.value != validateRegisterForm.passwdConfirm.value) {
            showFeedBack($(validateRegisterForm.passwdConfirm), false);
        }else{
            showFeedBack($(validateRegisterForm.passwdConfirm), true);
        }
    });

}

