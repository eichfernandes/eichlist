<html>
    <head>
        <meta charset="UTF-8">
        <title>Filmes</title>
		<link href="style.css" rel="stylesheet">
                <style>#filmes{background-color: #152621;}#filmes:hover{font-weight: bolder;}</style>
    </head>
    <body>
	<!--Cabeçalho-->
        <?php include "header.php" ?>
	<!--Barra de Navegação-->
        <div id="movies">
            <?php if (empty($_POST["order"])){$order = "SELECT * FROM movies order by titulo, ano";}
                    else{$order = $_POST["order"];}; ?>
            <form method="post">
                <div style="text-align: left; width: 50%; float: left;">
                    Procurar: <input type="text" name="search" style="width: 50%;" value="<?php 
                        if (!empty($_POST["search"])){echo $_POST["search"];}
                    ?>">
                </div>
                <div style="text-align: right; width: 50%; float: right;">Ordenar:
                <select name="order" id="order" onchange="this.form.submit()">
                    <option <?php if (empty($_POST["order"])||$_POST["order"]=="SELECT * FROM movies order by titulo, ano"){echo "selected";} ?> value="SELECT * FROM movies order by titulo, ano">Título</option>
                    <option <?php if (!empty($_POST["order"])&&$_POST["order"]=="SELECT * FROM movies order by ano, titulo"){echo "selected";} ?> value="SELECT * FROM movies order by ano, titulo">Ano</option>
                    <option <?php if (!empty($_POST["order"])&&$_POST["order"]=="SELECT * FROM movies order by diretor, titulo, ano"){echo "selected";} ?> value="SELECT * FROM movies order by diretor, titulo, ano">Diretor</option>
                    <option <?php if (!empty($_POST["order"])&&$_POST["order"]=="SELECT * FROM movies order by nota desc, titulo"){echo "selected";} ?> value="SELECT * FROM movies order by nota desc, titulo">Nota</option>
                    <option <?php if (!empty($_POST["order"])&&$_POST["order"]=="SELECT * FROM movies order by id desc"){echo "Recentes";} ?> value="SELECT * FROM movies order by id desc">Recentes</option>
                </select>
                </div>
            </form>
            <br>
            <script>
                const tit = [];
                const ano = [];
                function trclick(x,y){
                    window.open("https://www.google.com/search?q="+x+" "+y, "_blank");
                }
            </script>
            <br>
            <table>
                <tr><th>Título</th><th>Ano</th><th>Diretor</th><th>Nota</th></tr>
                <?php include "conexao.php";
                    
                    if (!empty($_POST["search"])){$sql="SELECT * FROM movies where titulo like '%".$_POST["search"].
                            "%' or ano like '%".$_POST["search"]."%' or diretor like '%".$_POST["search"].
                            "%' order by titulo, ano";}
                    else {$sql = $order;};
                    header('Content-Type: text/html; charset=utf-8');
                    if ($result = $mysqli->query($sql)) {
                        /* fetch associative array */

                        while ($row = $result->fetch_assoc()) {
                            echo utf8_encode(
                                "<script>tit[".$row["id"]."]='".$row["titulo"]." '; ano[".$row["id"]."]='".$row["ano"]."';</script>"
                                    
                                . "<tr onclick='trclick(tit[".$row["id"]."],ano[".$row["id"]."]);'>"
                                . "<td>" . $row["titulo"] . "</td><td>" . $row["ano"] . "</td><td>"
                                . $row["diretor"] . "</td><td>" . $row["nota"]
                                . "</td></tr>");
                        }
                        $result->close(); /* free result set */
                    }
                    $mysqli->close(); /* close connection */
                ?>
            </table>
            </div>
    </body>
</html>