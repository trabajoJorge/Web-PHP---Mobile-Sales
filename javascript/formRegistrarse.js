/**
 * Verifica que los datos del registro hayan sido rellenados de manera correcta.
 * 
 * @returns {Boolean}   true en caso de que los datos del registro hayan sido correctamente rellenados.
 *                      false en caso contrario.
 */
function verificar_registro()
{
    var nombre = $("#nombre_input").val();
    var email = $("#email_input").val();
    var password = $("#password_input").val();
    var repassword = $("#repassword_input").val();

    var campo_vacio = "";
    var formato_incorrecto = "";
    var alerta = "";

    if(nombre === "") campo_vacio += "\tNombre de usuario\n";
    if(email === "") campo_vacio += "\tDirección de correo\n";
    else if(!validarEmail(email)) formato_incorrecto += "\tDirección de correo\n";
    if(password === "") campo_vacio += "\tContraseña\n";
    if(repassword === "") campo_vacio += "\tRepetir contraseña\n";
    if(password !== repassword) formato_incorrecto += "\tLas contraseñas no coinciden\n";

    if(campo_vacio !== "")
    {
        campo_vacio = "Por favor rellene los siguientes campos:\n" + campo_vacio;
        alerta += campo_vacio;
    }
    if(formato_incorrecto !== "")
    {
        formato_incorrecto = "El formato de los siguientes campos no es correcto:\n" + formato_incorrecto;
        alerta += formato_incorrecto;
    }

    if(alerta !== "")
    {
        alert(alerta);
        return false;
    }
    return true;
}

/**
 * Dado un email comprueba si el formato de este es correcto.
 * @param {String} email
 * @returns {Boolean}   true si el formato del email es correcto.
 *                      false caso contrario.
 */
function validarEmail(email) {
    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email)){
        return true;
    } else {
        return false;
    }
}