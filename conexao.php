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
            $mysqli = new mysqli("remotemysql.com", "xnj1RdzZLL", "Y18wRfWE9o", "xnj1RdzZLL");
            /* check connection */
            if (mysqli_connect_errno()) {
                echo("Erro de conexão: " . mysqli_connect_error()); exit();
            }
        ?>
    </body>
</html>
