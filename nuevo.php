<?php
//Comprobar datos en POST
if($_SERVER['REQUEST_METHOD']=='POST'){
    //Recoger las variables
    $identificacion=isset($_REQUEST['identificacion'])? $_REQUEST['identificacion']:null;
    $nombre=isset($_REQUEST['nombre'])? $_REQUEST['nombre']:null;
    $apellido=isset($_REQUEST['apellido'])? $_REQUEST['apellido']:null;
    $nota1=isset($_REQUEST['nota1'])? $_REQUEST['nota1']:null;
    $nota2=isset($_REQUEST['nota2'])? $_REQUEST['nota2']:null;
    $nota3=isset($_REQUEST['nota3'])? $_REQUEST['nota3']:null;
    $definitiva=($nota1+$nota2+$nota3)/3;
    $idasignatura=isset($_REQUEST['idasignatura'])? $_REQUEST['idasignatura']:null;
    //Conexion a la DB

    require_once('conexion.php');
    $miPDO=new PDO ($hostPDO, $usuarioDB, $contraseyaBD);
    $hostPDO="mysql:host=$hostDB; dbname=$dbase;";
    //Insertar 
    $miInsert = $miPDO->prepare("INSERT INTO estudiantes (identificacion, nombre, apellido, nota1, nota2,nota3, definitiva, idasignatura) values ('$identificacion', '$nombre','$apellido', '$nota1','$nota2','$nota3','$definitiva', '$idasignatura')");
    //Ejecutar insert
    $miInsert->execute();
    //Redireccionar a leer.php
    header('location: leer.php');
}
?>
<!DOCTYPE html>
<html lang=es>
    <head>
        <meta charset="UTF-8">
        <title>Registro de los estudiantes</title>
        <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1 class="p-3 mb-2 bg-danger text-white text-center"><kbd>Registro nuevo estudiante</kbd> </h1>
        <div class="p-3 mb-2 bg-info text-white text-center">
        <form action="" method="POST">
        <div class="mb-3 mt-3">
            <p>
                <label class="border border-dark bg-warning p-2 mt-2 mr-2" for="identificacion"><kbd>Identificacion</kbd></label><br>
                <input id="identificacion" placeholder="Ingrese Identificacion" type="text" name="identificacion">
            </p>
            </div>
            <p>
                <label for="nombre"><kbd>Nombres</kbd></label><br>
                <input id="nombre" placeholder="Ingrese Nombres" type="text" name="nombre">
            </p>
            <p>
                <label for="apellido"><kbd>Apellidos</kbd></label><br>
                <input id="apellido" placeholder="Ingrese Apellidos" type="text" name="apellido">
            </p>
            <p>
                <label for="nota1"><kbd>Nota 1</kbd></label><br>
                <input id="nota1"  placeholder="nota" type="text" name="nota1">
            </p>
            <p>
                <label for="nota2"><kbd>Nota 2</kbd></label><br>
                <input id="nota2"  placeholder="nota" type="text" name="nota2">
            </p>
            <p>
                <label for="nota3"><kbd>Nota 3</kbd></label><br>
                <input id="nota3"  placeholder="nota" type="text" name="nota3">
            </p>
            <p>
                <div class="jumbotron">
                    <label for="idasignatura"><kbd>Materia</kbd></label><br>
                    <select id="idasignatura" type="selected" name="idasignatura">
                        <option value="idasignatura" type="selected" name="idasignatura"> Todas las asignaturas</option>
                    <?php
                    //Conexion a la DB
                    require_once('conexion.php');
                    $miPDO=new PDO ($hostPDO, $usuarioDB, $contraseyaBD);
                    $consultaCbo = $miPDO->prepare('SELECT*FROM asignatura;');
                    $consultaCbo->execute();
                    while($row=$consultaCbo->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row);
                        ?>
                        <option value="<?php echo $idasignatura; ?>"><?php echo $asign; ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    <p>
                     <br>  <input class="btn btn-primary" type="submit" value="Guardar"> 
                    </p>
                </div>
                </div>
            </p>
        </form>
    </body>

</html>