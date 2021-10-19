/**
 * Comprueba si los campos del login han sido rellenados.
 * 
 * @returns {Boolean}   true si los campos del login han sido rellenados.
 *                      false en caso contrario.
 */
function verificar_login()
{
    var user = $("#user_input").val();
    var password = $("#password_input").val();

    var campo_vacio = "";

    if(user === "")
        campo_vacio += "\tNombre de usuario\n";
    if(password === "")
        campo_vacio += "\tContraseña\n";

    if(campo_vacio !== "")
    {
        alert("Rellene los siguientes campos:\n" + campo_vacio);
        return false;
    }
    return true;
}