<?php
spl_autoload_register(function($clase) {
    require_once ("$clase.php");
});
session_start();
//session_destroy();



if (isset($_POST['submit'])) {
    $_SESSION['host'] = filter_input(INPUT_POST, 'host');
    $_SESSION['user'] = filter_input(INPUT_POST, 'user');
    $_SESSION['pass'] = filter_input(INPUT_POST, 'pass');
}
echo $host;
if (isset($_SESSION['host'])) {
    $host = $_SESSION['host'];
    $user = $_SESSION['user'];
    $pass = $_SESSION['pass'];
    $bd = new bd($host, $user, $pass, null);
} else {

    //Asigno estos valores por defecto (que no haya aportado nadie nada, ni usuarioni sesiones.
    $host = ' ';
    $user = ' ';
    $pass = ' ';
}

//$bd = new bd($host, $user, $pass);
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
                <input type="text" name="host" value=" ">
                Usuario:
                <input type="text" name="user" value="root">
                Password:
                <input type="text" name="pass" value="root">
                <input type="submit" name="submit" value="Conectar">
            </form>
        </fieldset>
        <?php
        if ($bd->conectado()):
            ?>
            <fieldset>
                <legend>Gestión de las Bases de Datos del host <?php echo $host; ?></legend>
                <form action="tablas.php" method="POST">
                    <?php
                    $datos = $bd->select("show DATABASES");
                    foreach ($datos as $array) {
                        foreach ($array as $nombreBD) {
                            echo "<input type=radio value='$nombreBD' name=nombreBD>$nombreBD<br/>";
                        }
                    }
                    ?>
                    <input type ='submit' value='Gestionar'>
                </form>
            </fieldset>
            <?php
            $bd->cerrar();
        endif
        ?>
    </body>
</html>
