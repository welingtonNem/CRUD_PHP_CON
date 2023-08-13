<?php

include('conexao/conexao.php');

$sql_clientes = "SELECT * FROM clientes";

$query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
$num_clientes = $query_clientes->num_rows;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de class</title>
</head>

<body>
    <h1>Lista de clientes</h1>
    <p>Este são os clietes cadastrabdo no seu sistema</p>
    <table border="1" cellpadding="10">
        <thead>
            <th>Id</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Nacimento</th>
            <th>Data</th>
            <th>Açoes</th>
        </thead>
        <tbody>
            <?php if ($num_clientes == 0) { ?>
                <tr>
                    <td colspan="7">Nenhun clientes foi cadastrando</td>
                </tr>
                <?php } else {
                while ($cliente = $query_clientes->fetch_assoc()) {
                ?><tr>
                        <td><?php echo $cliente['id']; ?></td>
                        <td><?php echo $cliente['nome']; ?></td>
                        <td><?php echo $cliente['email']; ?></td>
                        <td><?php echo $cliente['telefone']; ?></td>
                        <td><?php echo $cliente['nacimento']; ?></td>
                        <td><?php echo $cliente['date']; ?></td>
                        <td>
                            <a href="#">Editar</a>
                            <a href="#">Deletar</a>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table><br><br>
    <a href="cadastrar_cliente.php">cadastrar</a>
</body>

</html>