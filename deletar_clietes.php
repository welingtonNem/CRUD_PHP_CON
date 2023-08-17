<?php

if (isset($_POST['confirmar'])) {

    include('conexao/conexao.php');
    $id = intval($_GET['id']);
    $sql_code = "DELETE FROM clientes WHERE id = '$id'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);


    if ($sql_query) { ?>
        <h1>Clietes deletado com sucesso</h1>
        <p><a href="clietes.php">Clietes aqui</a> para volta para a lista de clientes</p>

<?php
        die();
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Deseja deletar linha da lista</h2>
    <form action="" method="post">
        <a href="clietes.php">Não</a>
        <button style="margin-left: 10px;" name="confirmar" value="1" type="submit">Sim</button>
    </form>

</body>

</html>