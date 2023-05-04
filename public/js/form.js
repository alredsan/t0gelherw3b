
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
