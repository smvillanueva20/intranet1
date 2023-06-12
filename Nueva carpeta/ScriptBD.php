<?php
 // Script automatización
 //.....................................................

//Incluimos la biblioteca de funciones
include_once('Biblioteca_funciones.php');

//Establecemos una conexión para borrar y crear la base de datos
$conn=getConnection(host,userBD,passBD,"");

//Sentencia SQL para eliminar la base de datos si existe
$eliminarBD="DROP DATABASE IF EXISTS tfg;";

//Llamamos a la función para ejecutar la sentencia SQL
OperacionesSQL($conn,$eliminarBD);

//Sentencia SQL para crear la base de datos asir
$crearBD="CREATE DATABASE tfg;";

//Llamamos a la función para ejecutar la sentencia SQL
OperacionesSQL($conn,$crearBD);

//Cerramos conexión
closeConnection($conn);

//Abrimos conexión
$conn=getConnection(host,userBD,passBD,nameBD);

//Sentencia SQL para crear la tabla
$crear_tabla="CREATE TABLE usuarios(nombre varchar(255),
                                    apellido1 varchar(255),
                                    apellido2 varchar(255),
                                    usuario varchar(255),
                                    passwd varchar(255),
                                    rol varchar(255),
                                    );";

//Llamamos a la función para ejecutar la sentencia SQL
OperacionesSQL($conn,$crear_tabla);

//Almacenamos los datos del administrador en variables
$usuario=strtoupper("administrador");
$passwd=hash("sha512","Cmadrid21");
$rol=strtoupper("administrador");

//Sentencia SQL para insertar los datos
$insertar_admin="INSERT INTO usuarios(usuario,passwd,rol) values ('".$usuario."','".$passwd."','".$rol."');";

//Llamamos a la función para ejecutar la sentencia SQL
OperacionesSQL($conn,$insertar_admin);

//Cerramos conexión
closeConnection($conn);

?>
