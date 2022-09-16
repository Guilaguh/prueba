<?php
//Identifica variables
    $identificacion=isset($_REQUEST['identificacion'])? $_REQUEST['identificacion']:null;
    $nombre=isset($_REQUEST['nombre'])? $_REQUEST['nombre']:null;
    $apellido=isset($_REQUEST['apellido'])? $_REQUEST['apellido']:null;
    $nota1=isset($_REQUEST['nota1'])? $_REQUEST['nota1']:null;
    $nota2=isset($_REQUEST['nota2'])? $_REQUEST['nota2']:null;
    $nota3=isset($_REQUEST['nota3'])? $_REQUEST['nota3']:null;
    $definitiva=($nota1+$nota2+$nota3)/3;
    $idasignatura=isset($_REQUEST['idasignatura'])? $_REQUEST['idasignatura']:null;
    //modificar se conecta a la base de datos
    require_once('conexion.php');
    $miPDO=new PDO ($hostPDO, $usuarioDB, $contraseyaBD);
    $hostPDO="mysql:host=$hostDB; dbname=$dbase;";

    //$hostPDO="mysql:host=$hostDB;dbname=$nombreDB;";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //Consultar UPDATE o Actualizar
        $miUpdate=$miPDO->prepare("UPDATE estudiantes SET nombre='$nombre',apellido='$apellido', nota1='$nota1', nota2='$nota2',nota3='$nota3', definitiva= '$definitiva', idasignatura='$idasignatura' WHERE identificacion='$identificacion';");
        //Ejecutar 
        $miUpdate->execute();
        //envia a leer
        header ('Location: leer.php');
    }else{
        //selecciona from estuadiantes en donde tiene encuenta la variable identificacion
        $miConsulta=$miPDO->prepare("SELECT*FROM estudiantes WHERE identificacion='$identificacion';");
        //Ejecutar consulta
        $miConsulta->execute();
    }
    //Obtener resultado
    $estudiantes=$miConsulta->fetch();
    ?>
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title >modificar</title> 
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        </head>
        <body>
        <h1 class="p-3 mb-3 bg-danger text-white text-center"  >Actualizar datos</h1>
        
        <div class="p-3 mb-2 bg-info text-white text-left">
        
            <form action="" method="POST">
            <div class="card" style="width: 30rem">
            <div class="border border-dark bg-warning p-2 mt-2 mr-2">
                       <label for="identificacion"  class="form-label">Identificacion</label><br>
                       <input type="text" placeholder="Ingrese Identificacion" id="identificacion" class="form-control" name="identificacion" VALUES="<?=$estudiantes['identificacion']?>"> 
                </div>
                <div class="border border-dark bg-warning p-2 mt-2 mr-2">
                       <label for="nombre"  class="form-label">Nombres</label><br>
                       <input id="nombre" placeholder="Ingrese Nombres" class="form-control" type="text" name="nombre" VALUES="<?=$estudiantes['nombre']?>">
                       </div>
                       <div class="border border-dark bg-warning p-2 mt-2 mr-2">
                       <label for="apellido">Apellidos</label><br>
                       <input id="apellido"  placeholder="Ingrese Apellidos" class="form-control" type="text" name="apellido" VALUES="<?=$estudiantes['apellido']?>"></p>
                       </div>
                       <div class="border border-dark bg-warning p-2 mt-2 mr-2">
                       <label for="nota1" class="form-label">Nota 1</label><br>
                       <input id="nota1"  placeholder="Ingrese la nota 1" class="form-control" type="text" name="nota1" VALUES="<?=$estudiantes['nota1']?>"></p>
                       </div>
                       <div class="border border-dark bg-warning p-2 mt-2 mr-2">
                       <label for="nota2" class="form-label">Nota 2</label><br>
                       <input id="nota2"  placeholder="Ingrese la nota 2" class="form-control" type="text" name="nota2" VALUES="<?=$estudiantes['nota2']?>"></p>
                       </div>
                       <div class="border border-dark bg-warning p-2 mt-2 mr-2">
                       <label for="nota3" class="form-label">Nota 3</label><br>
                       <input id="nota3"  placeholder="Ingrese la nota 3" class="form-control" type="text" name="nota3" VALUES="<?=$estudiantes['nota3']?>"></p>
                       </div>
                <div class="page-header">
                    <label for="idasignatura"  class="form-label">Materia</label><br>
                    <select name="idasignatura" id="idasignatura" type="selected">
                    <option value="idasignatura" type="selected">Materia</option>
                <?php
                //Conectar a la base de datos
                require_once('conexion.php');
                $miPDO = new PDO($hostPDO,$usuarioDB,$contraseyaBD);
                $consultaCbo=$miPDO->prepare('SELECT * FROM asignatura;');
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
                   <br> <input class="btn btn-danger" type="submit" value="Modificar">
                </p>
                </div>
        </div>
            </form>   
    </body>
</html>