<?php
//variables
    require_once('conexion.php');
    $miPDO = new PDO($hostPDO,$usuarioDB,$contraseyaBD);
    $hostPDO="mysql:host=$hostDB;dbname=$dbase;";

    //Da codigo de leer a borrar 
    $identificacion= isset($_REQUEST['identificacion'])? $_REQUEST['identificacion']:null;
    $idasignatura=isset($_REQUEST['idasignatura'])? $_REQUEST['idasignatura']:null;

    //da la opcion de borrar o delete
    $miConsulta = $miPDO->prepare("DELETE FROM estudiantes WHERE identificacion = '$identificacion';");
    //Ejecuta la sentencia SQL
    $miConsulta->execute();
    //redirecciona a php los datos
    header('Location: leer.php');
?>