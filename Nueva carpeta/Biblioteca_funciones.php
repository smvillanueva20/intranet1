<?php

/* Biblioteca de funciones de BBDD
---------------------------------- */

//Creamos las constantes para la conexión a base de datos
const host="10.3.0.5";
const userBD="root";
const passBD="Cmadrid21";
const nameBD="tfg";

//Creamos una función para abrir conexion
function getConnection($p_host,$p_userBD,$p_passwdBD,$p_BD){
    //Creamos una variable que recoge la conexión de la BBDD
    $enlace = mysqli_connect($p_host,$p_userBD,$p_passwdBD,$p_BD);

    //Comprobamos si la conexión se ha establecido
    if($enlace) return $enlace;//Si hay conexion, la devuelvo
}

//Creamos una función para cerrar conexión
function closeConnection($p_conn){
    //Se cierra la conexión
    mysqli_close($p_conn);
}

//Creamos una función para insertar cualquier sentencia SQL
function OperacionesSQL($conn,$p_sql){
    if (mysqli_query($conn,$p_sql) === TRUE){
        echo $p_sql." Exito"."</br>";
    }
}

//Creamos una función para insertar datos en la tabla usuarios
function insertarDatosUsuarios($nombre,$apellido1,$apellido2,$usuario,$passwd,$rol){
    //Llamamos a la función para abrir una conexión
    $conn=getConnection(host,userBD,passBD,nameBD);

    //Si se ha conectado insertamos datos
    if (mysqli_query($conn,"INSERT INTO usuarios VALUES ('".$nombre."','".$apellido1."','".$apellido2."','".$usuario."','".$passwd."','".$rol."';)") === TRUE){
        echo "<h3> Exito al registrarse. </h3>";
    }

    //Cerramos conexión
    closeConnection($conn);
}

//Creamos una función para ver si existe el usuario en la BBDD
function ComprobarUsuario($p_usu,$p_passwd){
    //Llamamos a la función para abrir una conexión
    $conn=getConnection(host,userBD,passBD,nameBD);
    //Creamos una variable con la sentencia sql
    $query = "SELECT * FROM usuarios where usuario='".$p_usu."' and passwd='".$p_passwd."';";
   //Creamos una variable con el resultado de la sentencia
    $result = mysqli_query($conn,$query);

    //Recorremos las tuplas del select
    while ($row = mysqli_fetch_assoc($result)){
        //Devolvemos el nombre de dicho usuario
        return $row["usuario"];
    }

    //Cerramos conexión
    closeConnection($conn);

}

//Creamos una función para obtener el rol del usuario
function ObtenerRol($p_usu,$p_passwd){
    //Llamamos a la función para abrir una conexión
    $conn=getConnection(host,userBD,passBD,nameBD);
    //Creamos una variable con la sentencia sql
    $query = "SELECT rol FROM usuarios where usuario='".$p_usu."'and passwd='".$p_passwd."';";
    //Creamos una variable con el resultado de la sentencia
    $result = mysqli_query($conn,$query);

    //Recorremos las tuplas del select
    while ($row = mysqli_fetch_assoc($result)){
        //Devolvemos el rol asociado a dicho usuario y contraseña
        return $row["rol"];
    }

    //Cerramos conexión
    closeConnection($conn);
}


//Creamos una función para cuando el rol del usuario sea alumno
function rolusuario($p_usu,$p_passwd){
    //Llamamos a la función para abrir una conexión
    $conn=getConnection(host,userBD,passBD,nameBD);
    //Creamos una variable con la sentencia sql
    $query = "SELECT nombre,apellido1,apellido2 FROM usuarios where usuario='".$p_usu."' and passwd='".$p_passwd."';";
    //Creamos una variable con el resultado de la sentencia
    $result = mysqli_query($conn,$query);

    //Recorremos las tuplas del select
    while ($row = mysqli_fetch_assoc($result)){
        return $row;
    }

    //Cerramos conexión
    closeConnection($conn);
}

//Creamos una función para cuando el rol del usuario sea Administrador
function rolAdministrador(){
    //Llamamos a la función para abrir una conexión
    $conn=getConnection(host,userBD,passBD,nameBD);
    //Creamos una variable con la sentencia sql
    $query = "SELECT nombre,apellido1,apellido2, usuario, passwd FROM usuarios where rol='usuarios';";
    //Creamos una variable con el resultado de la sentencia
    $result = mysqli_query($conn,$query);

    //Inicializamos i
    $i=0;

    //Recorremos las tuplas del select
    while ($row = mysqli_fetch_assoc($result)){
        //Recorremos el array creado y mostramos los datos de este
        foreach ($row as $key => $datos ){
            //Cada 12 filas insertamos doble enter
            if($i%8==0) echo "</br></br>";
            echo $key.": ".$datos."</br>";
            $i=$i+1;
        }
    }

    //Cerramos conexión
    closeConnection($conn);

}

?>
