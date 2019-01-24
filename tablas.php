<?php
spl_autoload_register(function($clase) {
    require_once ("$clase.php");
});

session_start();
$host = $_SESSION['host'];
$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$baseDatos = filter_input(INPUT_POST, 'nombreBD');

if (!isset($baseDatos)) {
    $baseDatos = $_SESSION['basedatos'];
} else {
    $_SESSION['basedatos'] = $baseDatos;
}

$bd = new bd($host, $user, $pass, $baseDatos);
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
    </head>
    <body>
        <fieldset>
            <legend>Listado bases de datos</legend>
            <form action="index.php" method='POST'>
                <input type="submit" value="Volver" name="volver">
            </form>
        </fieldset>
        <fieldset style="">
            <legend>Gestion de las Bases de Datos<?php echo " $baseDatos "; ?></legend>
            <form action="gestionTablas.php" method="POST">
                <?php
                $tablas = $bd->select("show TABLES from $baseDatos");
                foreach ($tablas as $array) {
                    foreach ($array as $nombreTablas) {
                        echo "<input type=submit value='$nombreTablas' name=nombreTablas>";
                    }
                }
                $bd->cerrar();
                ?>
            </form>
        </fieldset>
    </body>
</html>
