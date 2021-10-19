/**
 * Verifica que haya sido algo escrito en el buscador y en caso de que se busque una id que sea un número positivo.
 * 
 * @returns {Boolean}   true en caso de que haya sido algo escrito en el buscador y en caso de que se busque una id que sea un número positivo.
 *                      false en caso contrario.
 */
function verificar_buscador()
{
    var busqueda = $("#buscar_input").val();
    var buscar_por = $("#buscador_select").children("option:selected").val();

    if(busqueda === "")
    {
        alert("Escriba que desea buscar");
        return false;
    }else if(buscar_por === "Id" && (!isNaN(busqueda) || busqueda < 0))
    {
        alert("La id debe ser un número positivo");
        return false;
    }
    return true;

}