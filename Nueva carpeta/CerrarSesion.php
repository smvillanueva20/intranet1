<?php

//Indicamos que trabajamos con sesiones
session_start();

//Eliminamos datos de la sesion
session_unset();

//Eliminamos sesion
session_destroy();

//Redirigir a Login
header('Location: index.php');

?>
