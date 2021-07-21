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
            <form method="post">
                <div style="text-align: left; width: 50%; float: left;">
                    <input placeholder="Procurar" type="text" name="search" style="width: 50%;" value="<?php 
                        if (!empty($_POST["search"])){echo $_POST["search"];}
                    ?>">
                </div>
                <div style="text-align: right; width: 50%; float: right;">Ordenar:
                <select name="order" id="order" onchange="this.form.submit()">
                    <option <?php if (empty($_POST["order"])||$_POST["order"]=="order by titulo"){echo "selected";} ?> value="order by titulo">Título ↓</option>
                    <option <?php if (!empty($_POST["order"])&&$_POST["order"]=="order by titulo desc"){echo "selected";} ?> value="order by titulo desc">Título ↑</option>
                    
                    <option <?php if (!empty($_POST["order"])&&$_POST["order"]=="order by ano"){echo "selected";} ?> value="order by ano">Ano ↓</option>
                    <option <?php if (!empty($_POST["order"])&&$_POST["order"]=="order by ano desc"){echo "selected";} ?> value="order by ano desc">Ano ↑</option>
                    
                    <option <?php if (!empty($_POST["order"])&&$_POST["order"]=="order by diretor"){echo "selected";} ?> value="order by diretor">Diretor ↓</option>
                    <option <?php if (!empty($_POST["order"])&&$_POST["order"]=="order by diretor desc"){echo "selected";} ?> value="order by diretor desc">Diretor ↑</option>
                    
                    <option <?php if (!empty($_POST["order"])&&$_POST["order"]=="order by nota"){echo "selected";} ?> value="order by nota">Nota ↓</option>
                    <option <?php if (!empty($_POST["order"])&&$_POST["order"]=="order by nota desc"){echo "selected";} ?> value="order by nota desc">Nota ↑</option>
                    
                    <option <?php if (!empty($_POST["order"])&&$_POST["order"]=="order by id desc"){echo "selected";} ?> value="order by id desc">Recentes ↓</option>
                    <option <?php if (!empty($_POST["order"])&&$_POST["order"]=="order by id"){echo "selected";} ?> value="order by id">Recentes ↑</option>
                </select>
                </div>
            </form>
            <br>
            <script>
                const tit = [];
                const ano = [];
                function trclick(x,y){
                    window.open("https://www.google.com/search?q="+x+" "+y, "_blank");
                };
            </script>
            <br>
            <table>
                <tr><th>Título</th><th>Ano</th><th>Diretor</th><th>Nota</th></tr>
                <?php include "conexao.php";
                    /* Barra de Procura */
                    if (!empty($_POST["search"])){$search = " where titulo like '%".$_POST["search"]
                        ."%' or ano like '%".$_POST["search"]."%' or diretor like '%".$_POST["search"]."%'";
                    }else{
                        $search="";
                    }
                    /* Ordenar */
                    if (!empty($_POST["order"])){
                        $order = " ".$_POST["order"];
                    }else{
                        $order = " order by titulo";
                    }
                    
                    $sql = "SELECT * FROM movies".$search.$order;
                    header('Content-Type: text/html; charset=utf-8');
                    if ($result = $mysqli->query($sql)) {
                        /* fetch associative array */

                        while ($row = $result->fetch_assoc()) {
                            echo utf8_encode(
                                "<script>tit[".$row["id"]."]='".$row["titulo"]."'; ano[".$row["id"]."]='".$row["ano"]."';</script>"
                                    
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