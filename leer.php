<?php
    require_once('conexion.php');
    $miPDO=new PDO ($hostPDO, $usuarioDB, $contraseyaBD);
    $miConsulta = $miPDO->prepare('SELECT*FROM estudiantes;');
    $miConsulta->execute();

    
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>estudiantesnotas</title>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </head>
    <body style="background-color: orange">
        <br><br>
        <p>&nbsp;&nbsp;<a  button class="btn btn-outline-success" href="nuevo.php">Crear</button></a></p>
        <div>
            <div>
                <table class="table table-dark table-striped">
                <h1 class="p-3 mb-2 bg-danger text-white text-center"><kbd>Tabla de calificaciones</kbd> </h1>
                    <tr>
                        <th> <kbd>Identificacion</kbd></th>
                        <th>Nombres</th>
                        <th><kbd>Apellidos</kbd></th>
                        <th>Asignatura</th>
                        <th><kbd>Nota #1</kbd></th>
                        <th>Nota #2</th>
                        <th><kbd>Nota #3</kbd></th>
                        <th>Definitiva</kbd></th>
                        <th><kbd>Observacion</kbd></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php foreach ($miConsulta as $clave=>$valor):?>
                    <tr>
                        <td><?=$valor['identificacion'];?></td>
                        <td><?=$valor['nombre'];?></td>
                        <td><?=$valor['apellido'];?></td>
                        <td><?=$valor['idasignatura'];?></td>
                        <td><?=$valor['nota1'];?></td>
                        <td><?=$valor['nota2'];?></td>
                        <td><?=$valor['nota3'];?></td>
                        <td><?=$valor['definitiva'];?></td>
                        <td>
                        <?php
                        if($valor['definitiva']>=3){
                            echo "Aprobo";
                        }else{
                            echo "No aprobo";
                        }
                        ?></td>

                        <td><a  button class="btn btn-outline-success" href="modificar.php?identificacion=<?=$valor['identificacion']?>">Modificar</button></a></td>
                        <td><a  button class="btn btn-outline-danger" href="borrar.php?identificacion=<?=$valor['identificacion']?>">Borrar </button></a></td>
                    <?php endforeach;?>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>