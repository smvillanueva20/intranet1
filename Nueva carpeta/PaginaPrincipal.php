<html>
   <head>
      <meta charset="UTF-8"/>
      <title>Página principal</title>
   </head>
   <body>

<?php
//Incluimos la biblioteca de funciones
include_once('Biblioteca_funciones.php');

//Indicamos que trabajamos con sesiones
session_start();

//Si existe la sesion
if (isset($_SESSION["sesion"])){

    //Convertimos los datos de la sesion de string a array
    $datos=unserialize($_SESSION["sesion"]);

    //Recogemos los datos del array
    $usuario=$datos["usuario"];
    $passwd=$datos["passwd"];

    //Recogemos el rol del usuario
    $rol=ObtenerRol($usuario,$passwd);

    //Si el rol es alumno
    if ($rol == "USUARIO"){

        //Llamar a la función rolAlumno
        $array=rolusuario($usuario,$passwd);

        //Ponemos en variables los datos del array
        $nombre=$array["nombre"];
        $apellido1=$array["apellido1"];
        $apellido2=$array["apellido2"];


        //Si el nombre esta vacío
        if (empty($nombre)) {
            echo "<h3> Bienvenido ".$usuario.".</h3>";
            echo "</br> </br>";
        }
        //Si el nombre no esta vacío
        else{

            echo "<h3> Bienvenido ".$nombre." ".$apellido1." ".$apellido2;
            echo "</br> </br>";
        }

        //Enlace para ir al email
        echo "¿Quieres acceder al correo? <a href='https://10.3.0.4/squirrelmail'> Pincha aqui </a>";
        echo "</br> </br>";
        //Enlace para cerrar sesión
        echo "<a href='CerrarSesion.php'> Cerrar Sesión </a>";

    }
    //Si el rol es administrador
    elseif ($rol == "ADMINISTRADOR"){
        //Llamar a la función rolAdministrador
        rolAdministrador();
        echo "</br> </br>";
        //Enlace para borrar la base de datos
        echo "<a href='ScriptBD.php'> Borrar la base de datos</a>";
        echo "</br> </br>";
        //Enlace para ir a phpmyadmin
        echo "<a href='https://10.3.0.4/phpmyadmin'> Ir a phpmyadmin </a>";
        echo "</br> </br>";
        //Enlace al correo
        echo "¿Quieres acceder al correo? <a href='https://10.3.0.4/squirrelmail'> Pincha aqui </a>";
        echo "</br> </br>";
        //Enlace para cerrar sesión
        echo "<a href='CerrarSesion.php'> Cerrar Sesión </a>";


    }

}
//Si no existe la sesion
else{
    echo "<h1 style='color:red'> Acceso no autorizado </h1>";
}
?>
   </body>
</html>
