<?php
//Incluimos la biblioteca de funciones
include_once('Biblioteca_funciones.php');

//Si le han dado a Registrar
if (isset($_POST["Registrar"])){

    //Si han rellenado los datos principales
    if (isset($_POST["usuario"]) && !empty($_POST["usuario"]) &&
    isset($_POST["passwd"]) && !empty($_POST["passwd"])){

        //Todos los datos introducidos a variables
        $nombre=strtoupper($_POST["nombre"]);
        $apellido1=strtoupper($_POST["apellido1"]);
        $apellido2=strtoupper($_POST["apellido2"]);
        $usuario=strtoupper($_POST["usuario"]);
        $passwd=$_POST["passwd"];
        $rol="ALUMNO";

        //Hashear passwd
        $passwd_hash=hash("sha512",$passwd);

        //Si el usuario ya esta registrado
        $result=ComprobarUsuario($usuario,$passwd_hash);

            //Si no esta en la base de datos
            if (empty($result)){

                //Insertamos los datos
                insertarDatosUsuarios($nombre,$apellido1,$apellido2,$usuario,$passwd_hash,$rol);
            }
            //Si esta en la base de datos
            else{
                echo "<h3> Ya estas registrado.</h3>";
            }
    }

    //Si no han rellenado los requisitos mínimos
    else {
        echo "<h3> Rellene al menos usuario y contraseña.</h3>";
    }
}

//Si se ha dado a iniciar sesión
elseif (isset($_POST["Iniciar_sesion"])){
    //Redirigimos a la página Login.php
    header('Location: index.php');

}
?>
<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8">
      <title>Registro</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
      <link rel="stylesheet" href="styles.css">
   </head>
   <body>
      <form action="Registrar.php" method="post">
         <fieldset>
            <legend>Registro</legend>
            <label for="usuario">Nombre: </label>
            <input type="text" name="nombre" id="nombre">
            <br><br>
            <label for="usuario">Apellido1: </label>
            <input type="text" name="apellido1" id="apellido1">
            <br><br>
            <label for="usuario">Apellido2: </label>
            <input type="text" name="apellido2" id="apellido2">
            <br><br>
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario">
            <br><br>
            <label for="passwd">Contraseña: </label>
            <input type="password" name="passwd" id="passwd">
            <br><br>
            <input type="submit" name ="Registrar" id="registrar" value="Registrarse">
            <input type="submit" name ="Iniciar_sesion" id="Iniciar_sesion" value="Iniciar sesión">
         </fieldset>
      </form>
   </body>
</html>
