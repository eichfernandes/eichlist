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
            <script>
                const tit = [];
                const ano = [];
                function trclick(x,y){
                    window.open("https://www.google.com/search?q="+x+" "+y, "_blank");
                }
            </script>
            <table>
                <tr><th>Título</th><th>Ano</th><th>Diretor</th><th>Nota</th></tr>
                <?php include "conexao.php";
                    $sql = "SELECT * FROM movies order by titulo, ano";
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