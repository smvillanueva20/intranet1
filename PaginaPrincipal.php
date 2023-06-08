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
   
    //Si el rol es alumno
    if ($usuario == "admin@tfg.com"){
    
        echo "Pagina de Admin";

    
    }
    //Si el rol es administrador
    elseif ($usuario == "pedro@tfg.com"){
       echo "Pagina de Pedro";
        
    }
   
}
//Si no existe la sesion
else{
    echo "<h1 style='color:red'> Acceso no autorizado </h1>";
}   
?>
   </body>
</html>
