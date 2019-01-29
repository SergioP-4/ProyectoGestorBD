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
$tabla = $_SESSION['tabla'];

$bd = new bd($host, $user, $pass, $baseDatos);
$valores = $_SESSION['valores'];
$datos = unserialize($valores);
if (isset($_POST['guardar'])) {
    $valorNuevo = $_POST['valor'];
    $valorAnt= $_POST['valorAnt'];
    $consulta = generarUpdate($tabla, $datos, $valorAnt, $valorNuevo);
    $res = $bd->update_tables($consulta);
    header("location:gestionTablas.php");
    exit();
}

function generarUpdate($tabla, $datos, $valorAnt, $valorNuevo) {
    $indice = 0;
    
    foreach ($datos as $nombreCampo=>$p) {
        $set .= "$nombreCampo = '" . $valorNuevo[$indice] . "' ,";
        if ($indice == 0) {
        $where .= "$nombreCampo = '" . $valorAnt[$indice] . "' ";    
        }
        $indice++;
    }
    $set = substr($set, 0, strlen($set) - 2);
    $sentencia = "update $tabla set $set where $where";
    echo $sentencia;
    return $sentencia;
}
?>

<!DOCTYPE html>
<!--
<a href="editar.php"></a>
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
            <legend>Editando registro de la tabla <?php $tabla ?></legend>
            <form action="editar.php" method="POST">
                <?php
                foreach ($datos as $nombreC => $valorAnt) {
                    echo "<label>$nombreC</label>";
                    echo "<input type='text' name = 'valor[]' value = '$valorAnt' ></br>";
                    echo "<input type='hidden' name = 'valorAnt[]' value = '$valorAnt' ></br>";
                }
                ?>
                <input type="submit" value="Guardar"  name="guardar">
                <input type="submit" value="cancelar" name="cancelar">
            </form>
        </fieldset>
    </body>
</html>

