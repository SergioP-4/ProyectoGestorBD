<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$tabla = $_GET['tabla'];
$pep= $_GET['datos'];
$valores = unserialize($pep);
var_dump($valores);
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
            <form action="gestionTablas.php" method='POST'>
                <input type="submit" value="Volver" name="volver">
            </form>
        </fieldset>
        <fieldset style="">
            <?php 
            foreach ($valores as $datos){
                echo $datos;
            }
            ?>
            
        </fieldset>
    </body>
</html>

