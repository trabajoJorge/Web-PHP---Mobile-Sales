/**
 * Verifica que todos los datos de la pagina verSolicitudes.php estan correctamente rellenados.
 * 
 * @return {Boolean}    true en caso de que los datos esten correctamente rellenados.
 *                      false en caso contrario.
 */
function verificar_movil_agregado()
{
    var nombre = $("#nombre_input").val();
    var marca = $("#marca_input").val();
    var precio = $("#precio_input").val();
    var fecha_salida = $("#fecha_input").val();
    var ram = $("#ram_input").val();
    var memoria = $("#memoria_input").val();
    var camara_delantera = $("#camara_delantera_input").val();
    var camara_trasera = $("#camara_trasera_input").val();
    var dimension_pantalla = $("#dimension_input").val();
    var resolucion_pantalla = $("#resolucion_input").val();
    
    var campo_vacio = "";
    var formato_incorrecto = "";
    var error_adicional = "";
    var alerta = "";
    
    //Validación de el nombre, la marca y el precio
    if(nombre === "") campo_vacio += "\tNombre del teléfono\n";
    if(marca === "") campo_vacio += "\tMarca del teléfono\n";
    if(precio === "") campo_vacio += "\tPrecio del teléfono\n";
    else
        if(isNaN(precio) && ((precio*100) % 1 !== 0)) formato_incorrecto += "\tPrecio del teléfono\n";
        else
            if(precio <= 0) error_adicional += "El precio no puede ser menor o igual a cero\n";
    
    //Validación de la fecha de salida
    if(fecha_salida === "") campo_vacio += "\tFecha de salida del teléfono\n";
    else 
        if(!validar_fecha(fecha_salida)) formato_incorrecto += "\tFecha de salida del teléfono\n";
        else
            if(!existe_fecha(fecha_salida)) error_adicional += "La fecha ingresada no exisite\n";
    
    //Validación de las memorias
    if(ram === "") campo_vacio += "\tMemoria RAM del teléfono\n";
    else
        if(!validar_memoria(ram)) formato_incorrecto += "\tMemoria RAM del teléfono\n";
    if(memoria === "") campo_vacio += "\tMemoria del teléfono\n";
    else
        if(!validar_memoria(memoria)) formato_incorrecto += "\tMemoria del teléfono\n";
    
    //Validación de las camaras
    if(isNaN(camara_delantera) && (camara_delantera % 1 !== 0)) formato_incorrecto += "\tCámara delantera del teléfono\n";
    if(camara_trasera === "") campo_vacio += "\tCámara trasera del teléfono\n";
    else
        if(isNaN(camara_trasera) && (camara_trasera % 1 !== 0)) formato_incorrecto += "\tCámara trasera del teléfono\n";
    
    //Validación de la pantalla
    if(dimension_pantalla === "") campo_vacio += "\tDimensión de la pantalla del teléfono\n";
    else
        if(isNaN(dimension_pantalla) && ((dimension_pantalla * 1000) % 1 !== 0)) formato_incorrecto += "\tDimensión de la pantalla del teléfono\n";
    if(resolucion_pantalla === "") campo_vacio += "\tResolución de la pantalla del teléfono\n";
    else
        if(!validar_resolucion(resolucion_pantalla)) formato_incorrecto += "\tResolución de la pantalla del teléfono\n";
    
    //Gestión de errores
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
    alerta += error_adicional;
    if(alerta !== "")
    {
        alert(alerta);
        return false;
    }
    return true;
}


/**
 * Dado un string comprueba si es una fecha en el formato correcto.
 * @param {String} fecha
 * @returns {Boolean}   true si fecha es un String con el formato correcto.
 *                      false en el caso contrario.
 */
function validar_fecha(fecha)
{
    var RegExPattern = /^\d{2,4}\-\d{1,2}\-\d{1,2}$/;
      if ((fecha.match(RegExPattern)) && (fecha!=='')) {
            return true;
      } else {
            return false;
      }
}

/**
 * Dado un String con el formato correcto de una fecha devuelve si esa fecha existe.
 * @param {String} fecha
 * @returns {Boolean}   true si fecha es una fecha que existe.
 *                      false caso contrario.
 */
function existe_fecha(fecha) {
      var fechaf = fecha.split("-");
      var year = fechaf[0];
      var month = fechaf[1];
      var day = fechaf[2];
      var date = new Date(year,month,'0');
      if((day-0)>(date.getDate()-0)){
            return false;
      }
      return true;
}

/**
 * Dado un string devuelve si tiene el formato adecuado para una memoria.
 * @param {String} memoria 
 * @returns {Boolean}   true si la memoria está en un formato correcto.
 *                      false caso contrario.
 */
function validar_memoria(memoria) {
    if (isNaN(memoria)) return false;
    if (memoria % 1 !== 0) return false;
    return true;
}

/**
 * Dado un String comprueba si este tiene el formato de la resolución de la pantalla.
 * @param {String} resolucion
 * @returns {Boolean}   true si resolucion tiene el formato de la resolución de la pantalla.
 *                      false caso contrario.
 */
function validar_resolucion(resolucion) {
  var RegExPattern = /^\d{2,4}\x\d{2,4}$/;
  if (resolucion.match(RegExPattern)) {
            return true;
      } else {
            return false;
      }
}