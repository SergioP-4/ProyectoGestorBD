<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
spl_autoload_register(function($clase) {
    require_once ("$clase.php");
});
$host = $_SESSION['host'];
$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
//$bd = new bd($host, $user, $pass);
$basedatos= $_GET['bd'];
echo $bd;
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
            <legend>Listado base de datos</legend>
            <form action="index.php" method="POST">
                <input type="submit" name="submit" value="Volver">
            </form>
        </fieldset>
        <fieldset>
            <legend>Gestión de las Bases de Datos <?php echo $basedatos; ?></legend>
            <form action="index.php" method="POST">
                <?php
                foreach ($dataBases as $baseDatos) {
                    foreach ($baseDatos as $datos) {
                        echo "<form action='index.php' method='POST'>"
                        . "<input type='radio' name='bd' value='$datos'>$datos<br> "
                        ;
                    }
                }
                echo "<input type ='submit' name='submit' value='Gestionar'></form>";
                ?>
                
            </form>
        </fieldset>
    </body>
</html>
