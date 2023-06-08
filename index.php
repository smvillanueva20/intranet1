<?php
//Incluimos la biblioteca de funciones 
include_once('Biblioteca_funciones.php');

//Indicamos que trabajamos con sesiones
session_start();

//Si existe una sesión
if (isset($_SESSION["sesion"])){
    //Redirigimos a la página
    header("Location: PaginaPrincipal.php");
}

//Si no existe una sesión
else{
    //Si le han dado a enviar
    if (isset($_POST["Enviar"])){
        //Si han rellenado todos los datos del formulario
        if (isset($_POST["usuario"]) && !empty($_POST["usuario"]) 
      && isset($_POST["passwd"]) && !empty($_POST["passwd"])){
            
            //Recogemos los datos del formulario
            $usuario=$_POST["usuario"];
            $passwd=$_POST["passwd"];   
            
            //Pasarlo a mayusculas
            $usuario=strtoupper($usuario);
            
            //Hasheamos la contraseña
            $passwd_hash=hash("sha512",$passwd);
            
            //Llamamos a la función para ver si existe el usuario
            $result=ComprobarUsuario($usuario,$passwd_hash);
            
            //Si el resultado es igual que el nombre de usuario
            if ($result == $usuario){
            
                //Creamos array con los datos del usuario
                $array=array("usuario"=>$usuario,"passwd"=>$passwd_hash);
                
                //Convertimos de array a string
                $datos=serialize($array);
                
                //Creamos sesión
                $_SESSION["sesion"] = $datos;
          
                //Redirigimos 
                header("Location: PaginaPrincipal.php");
            }
            //Si no lo es
            else{
                echo "<h3> Usuario y/o contraseña incorrectos.</h3>";
            }
            
         }
         //Si no han rellenado todos los datos del formulario
         else{
            echo "<h3> Rellene todos los datos del formulario. <h3>";
         }      
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Página de inicio de sesión</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6 col-md-4">
        <h1 class="text-center intranet-title">Intranet</h1>
        <form>
          <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo electrónico">
          </div>
          <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
