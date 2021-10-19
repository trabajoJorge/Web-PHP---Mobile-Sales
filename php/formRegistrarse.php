<?php
    /**
     * Este PHP se encarga de verificar los datos del formulario de registrarse.php.
     * Una vez verificados los datos, guardamos los valores en usuarios.xml.
     */

    include_once '../php/utils.php';
    
    //Empezamos a verificar los datos.
    if (isset($_POST["submit_input"])) {
        //Miramos que no haya ningun campo vacío.
        if (isset($_POST["nombre_input"])) {
            $nombre = $_POST["nombre_input"];
        }
        if (isset($_POST["email_input"])) {
            $email = $_POST["email_input"];
        }
        if (isset($_POST["password_input"])) {
            $pass = $_POST["password_input"];
        }
        if (isset($_POST["repassword_input"])) {
            $repass = $_POST["repassword_input"];
        }
        /*
         * Comprobamos que la repetición del password sea correcta. Si no lo es,
         * destruye las variables guardadas.
         */
        if ($repass != $pass) {
            unset($_POST["nombre_input"]);
            unset($_POST["email_input"]);
            unset($_POST["password_input"]);
            unset($_POST["repassword_input"]);
            lanzarError("Alguna contraseña no es correcta", "../tienda/recomendaciones.php");
        } else if (empty($nombre) || empty($email)) {
            lanzarError("Hay algún dato vacío", "../tienda/recomendaciones.php");
        } else {
            //Empezamos a verificar si no existe un vendedor con el mismo nombre.
            $vendedores = simplexml_load_file("../xml/vendedor.xml");
            foreach($vendedores->vendedor as $vendedor){
                if($vendedor['user'] == $nombre){
                    lanzarError('Este nombre de usuario ya está en uso', "../tienda/registrarse.php");
                }
            }
            //Empezamos a verificar si no existe un usuario con el mismo nombre.
            $usuarios= simplexml_load_file("../xml/usuarios.xml");
            foreach($usuarios->usuario as $usuario){
                if($usuario->nombre == $nombre){
                    lanzarError('Este nombre de usuario ya está en uso', "../tienda/registrarse.php");
                }elseif ($usuario->email == $email) {
                    lanzarError('Este email ya está registrado', "../tienda/registrarse.php");
                }
            }
            
            //Si todo ha ido correctamente, guardamos los datos en usuarios.xml.
            $usuario= $usuarios->addChild("usuario");
            
            $usuario->addChild("nombre", $nombre);
            $usuario->addChild("email", $email);
            $usuario->addChild("password", $pass);
            
            $ult_id = $usuarios['ult_id'];
            $id_number = substr($ult_id, 2) + 1;
            $nuevo_id = 'u_'.$id_number;
            $usuario->addAttribute('id', $nuevo_id);
            $usuarios['ult_id'] = $nuevo_id;

            $usuarios-> asXML("../xml/usuarios.xml");
            
            lanzarAlerta("Registro realizado correctamente", "../tienda/login.php");
        }
    }
    lanzarError("Problemas a la hora de procesar el formulario", "../tienda/inicio.php");
?>
