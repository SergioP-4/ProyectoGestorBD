<?php
spl_autoload_register(function($clase) {
    require_once ("$clase.php");
});
$bd = filter_input(INPUT_POST, "bd");
switch ($_POST['submit']) {
    case "Conectar":
        $host = $_POST['host'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $bd = new bd($host, $user, $pass);
        $consulta = "show databases";
        $dataBases = $bd->consultar($consulta);
        break;
    case "Gestionar":
        header("Location:tablas.php?datos=$datos");
        exit();
        break;
}
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
            <legend>Datos de Conexión</legend>
            <form action="index.php" method="POST">
                Host:
                <input type="text" name="host" value="172.17.0.2">
                Usuario:
                <input type="text" name="user" value="root">
                Password:
                <input type="text" name="pass" value="root">
                <input type="submit" name="submit" value="Conectar">
            </form>
        </fieldset>
        <fieldset>
            <legend>Gestión de las Bases de Datos del host <?php echo $host; ?></legend>
            <form action="index.php" method="POST">
                <?php
                foreach ($dataBases as $baseDatos) {
                    foreach ($baseDatos as $datos) {
                        echo "<form action='index.php' method='POST'>"
                        . "<input type='radio' name='bd' value='$datos'>$datos<br> "
                        . "<input type='hidden' value='$datos' name='bd'>"
                        . "</form>";
                    }
                }
                ?>
                <input type ="submit" name="submit" value="Gestionar">
            </form>
        </fieldset>
    </body>
</html>
