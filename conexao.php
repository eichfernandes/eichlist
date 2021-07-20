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
        <?php
            $mysqli = new mysqli("sql10.freesqldatabase.com", "sql10426107", "lUDrLbdY4n", "sql10426107");
            /* check connection */
            if (mysqli_connect_errno()) {
                echo("Erro de conexão: " . mysqli_connect_error()); exit();
            }
        ?>
    </body>
</html>
