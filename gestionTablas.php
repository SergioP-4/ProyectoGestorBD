<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
spl_autoload_register(function($clase) {
    require_once ("$clase.php");
});

session_start();
$host = $_SESSION['host'];
$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$baseDatos = $_SESSION['basedatos'];

$tabla = filter_input(INPUT_POST, 'nombreTablas');

if (!isset($tabla)) {
    $tabla = $_SESSION['tabla'];
} else {
    $_SESSION['tabla'] = $tabla;
}
$bd = new bd($host, $user, $pass, $baseDatos);
$contenido = $bd->select("select * from $tabla");
$nombreCampos = $bd->select("DESC $tabla"); 

if(isset($_POST['submit'])){
    switch ($_POST['submit']){
        case "Add":
            break;
        case "editar":
            $datos  = $_POST['datos'];
            $valores = serialize($datos);
            header("location:editar.php?tabla=$tabla&datos=$valores");
            exit();
      
            break;
        case "borrar":
            break;
    }
}
$container = [];
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            table, tr, td {
                border: 1px solid grey;
            }
            tr:nth-child(even) {background-color: #f2f2f2;}
        </style>
    </head>
    <body>
        <fieldset>
            <legend>Listado bases de datos</legend>
            <form action="tablas.php" method='POST'>
                <input type="submit" value="Volver" name="volver">
            </form>
        </fieldset>
        <fieldset style="">
            <legend>Administración de la tabla <?php echo " $tabla "; ?></legend>
                <table>
                    <tr>
                        <?php
                        foreach ($nombreCampos as $nombre) {
                            echo"<td>$nombre[0]</td>";
                        }
                        echo "<td>Acciones</td>";
                        echo "<td>Acciones</td></tr>";
                        foreach ($contenido as $array) {
                            $c = 0;
                            echo "<tr><form action='gestionTablas.php' method='POST'>";
                            foreach ($array as $datos) {
                                
                                echo "<td>$datos</td>"
                                     . "<input type='hidden' value='$datos' name=datos[".$datos [$c]."] >";
                                $c++;
                            }
                            echo "<td><input type='submit' value='editar' name='submit'></td>"
                            . "<td><input type='submit' value='borrar' name='submit'></td>";
                            echo "</form></tr>";
                        }
                        $bd->cerrar();
                        ?>
                </table>
        </fieldset>
    </body>
</html>