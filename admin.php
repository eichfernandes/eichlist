<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Administração</title>
        <style>
            table{border-collapse: collapse; width: 100%;}
            th,td{padding: 5px; text-align: left; border: 1px solid #000;}
            div{margin: auto; width: 70%; font-family: sans-serif;}
        </style>
    </head>
    <body>
        <div><h2>Adicionar</h2>
            <form method="post">
                <input name="adtitulo" type="text" placeholder="Titulo*" size="25">
                <input name="adano" type="number" placeholder="Ano*" min="1900" max="2100">
                <input name="addiretor" type="text" placeholder="Diretor*" size="25">
                <input name="adnota" type="number" placeholder="Nota*" step="0.5" min="0" max="10">
                <input type="submit" value="Confirmar" />
            </form>
            <?php include "conexao.php";
                if (!empty($_POST["adtitulo"])&&!empty($_POST["adano"])&&!empty($_POST["addiretor"])&&!empty($_POST["adnota"])){
                    $mysqli->query("insert into movies (titulo,ano,diretor,nota) values ("
                            . "'" . $_POST["adtitulo"] . "'," . $_POST["adano"] . ","
                            . "'" . $_POST["addiretor"] . "'," . $_POST["adnota"] . ")");
                    header("Location: admin.php");
                    exit();
                }
                
            ?>
        </div>
        <div><h2>Alterar</h2>
            <form method="post">
                <input name="upid" type="number" placeholder="ID*" min="0" max="5000"><br><br>
                <input name="uptitulo" type="text" placeholder="Titulo" size="25">
                <input name="upano" type="number" placeholder="Ano" min="1900" max="2100">
                <input name="updiretor" type="text" placeholder="Diretor" size="25">
                <input name="upnota" type="number" placeholder="Nota" step="0.5" min="0" max="10">
                <input type="submit" value="Confirmar" />
                <br><br>A ID definirá o filme a ser alterado, deixar um campo em branco não o afetará.
            </form>
            <?php include "conexao.php";
                if (!empty($_POST["upid"])&&(!empty($_POST["uptitulo"])||!empty($_POST["upano"])||!empty($_POST["updiretor"])||!empty($_POST["upnota"]))){
                    $upid=" where id=".$_POST["upid"];
                    $uptitulo="";$upano="";$updiretor="";$upnota="";
                    if (!empty($_POST["uptitulo"])){////////*TITULO*////////
                        $uptitulo=" titulo='".$_POST["uptitulo"]."'";
                        if (!empty($_POST["upano"])||!empty($_POST["updiretor"])||!empty($_POST["upnota"])) {
                            $uptitulo=$uptitulo.",";
                        }
                    }
                    if (!empty($_POST["upano"])){////////*ANO*////////
                        $upano=" ano=".$_POST["upano"];
                        if (!empty($_POST["updiretor"])||!empty($_POST["upnota"])) {
                            $upano=$upano.",";
                        }
                    }
                    if (!empty($_POST["updiretor"])){////////*DIRETOR*////////
                        $updiretor=" diretor='".$_POST["updiretor"]."'";
                        if (!empty($_POST["upnota"])) {
                            $updiretor=$updiretor.",";
                        }
                    }
                    if (!empty($_POST["upnota"])){////////*NOTA*////////
                        $upnota=" nota=".$_POST["upnota"];
                    }
                    $update="update movies set".$uptitulo.$upano.$updiretor.$upnota.$upid;
                    $mysqli->query($update);
                    header("Location: admin.php");
                    exit();
                }
            ?>
        </div>
        <div><h2>Remover</h2>
            <form method="post">
                <input name="removeid" type="number" placeholder="ID*" min="0" max="5000">
            </form>
            <br>O Filme com o ID específicado será removido permanentemente.
            <?php include "conexao.php";
                if (!empty($_POST["removeid"])){
                    $mysqli->query("DELETE FROM movies WHERE id=".$_POST["removeid"].";");
                    header("Location: admin.php");
                    exit();
                }
            ?>
            <br>
        </div>
        <!-- Ordenar Conteúdo -->
        <div>
            <h2>Lista de Filmes</h2>
            <form method="post" name="proc" style="float: left;">
                Pesquisar: <input type="text" name="procurar" value="<?php
                    if (!empty($_POST["procurar"])){echo $_POST["procurar"];};
                ?>">
                Ordenar: <select name="ordem" onchange="this.form.submit()">
                    <option <?php if (empty($_POST["ordem"])||$_POST["ordem"]=="id"){echo "selected";} ?> 
                        value="id">ID ↓</option>
                    <option <?php if (!empty($_POST["ordem"])&&$_POST["ordem"]=="id desc"){echo "selected";} ?> 
                        value="id desc">ID ↑</option>
                    
                    <option <?php if (!empty($_POST["ordem"])&&$_POST["ordem"]=="titulo"){echo "selected";} ?> 
                        value="titulo">Título ↓</option>
                    <option <?php if (!empty($_POST["ordem"])&&$_POST["ordem"]=="titulo desc"){echo "selected";} ?> 
                        value="titulo desc">Título ↑</option>
                    
                    <option <?php if (!empty($_POST["ordem"])&&$_POST["ordem"]=="ano"){echo "selected";} ?>
                        value="ano">Ano ↓</option>
                    <option <?php if (!empty($_POST["ordem"])&&$_POST["ordem"]=="ano desc"){echo "selected";} ?>
                        value="ano desc">Ano ↑</option>
                    
                    <option <?php if (!empty($_POST["ordem"])&&$_POST["ordem"]=="diretor"){echo "selected";} ?>
                        value="diretor">Diretor ↓</option>
                    <option <?php if (!empty($_POST["ordem"])&&$_POST["ordem"]=="diretor desc"){echo "selected";} ?>
                        value="diretor desc">Diretor ↑</option>
                    
                    <option <?php if (!empty($_POST["ordem"])&&$_POST["ordem"]=="nota"){echo "selected";} ?>
                        value="nota">Nota ↓</option>
                    <option <?php if (!empty($_POST["ordem"])&&$_POST["ordem"]=="nota desc"){echo "selected";} ?>
                        value="nota desc">Nota ↑</option>
                </select>
            </form>
            <script>
                function submitforms(){
                    document.forms["list"].submit();
                }
            </script>
            <button style="float: right;" type="button" value="Enviar Mudanças" onclick="submitforms()">Enviar Mudanças</button>
            <br><br>
            <form method="post" name="list">  
            <table>
                <tr><th>ID</th><th>Título</th><th>Ano</th><th>Diretor</th><th>Nota</th></tr>
                <?php include "conexao.php";
                    if (!empty($_POST["procurar"])){$procurar =
                        " where id like '%".$_POST["procurar"]."%' or titulo like '%".$_POST["procurar"].
                        "%' or ano like '%".$_POST["procurar"]."%' or diretor like '%".$_POST["procurar"]."%'"
                    ;}else{$procurar = "";};
                    if (!empty($_POST["ordem"])){$ordem = " order by ".$_POST["ordem"];}
                    else {$ordem = " order by id";};
                    $sql = "SELECT * FROM movies" . $procurar . $ordem;
                    if ($result = $mysqli->query($sql)) {
                        /* fetch associative array */

                        while ($row = $result->fetch_assoc()) {
                            if (!empty($_POST["nota".$row["id"]])){$mysqli->query("UPDATE movies SET nota=".$_POST["nota".$row["id"]]." WHERE id=".$row["id"]);
                                $row["nota"]=$_POST["nota".$row["id"]];
                            };
                            echo
                                "<tr><td>" . $row["id"] . "</td><td>" . $row["titulo"] . "</td>"
                                    . "<td>" . $row["ano"] . "</td>"
                                    . "<td>" . $row["diretor"] . "</td>"
                                    . "<td><input type='number' step='0.5' min='0' max='10' placeholder='" . $row["nota"]."' name='nota".$row["id"]."'>"
                            . "</td></tr>";
                            
                        }
                        $result->close(); /* free result set */
                    }
                    $mysqli->close(); /* close connection */
                ?>
            </table>
            </form>
        </div>
    </body>
</html>
