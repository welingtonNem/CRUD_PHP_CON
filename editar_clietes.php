<?php

include('conexao/conexao.php');
$id = intval($_GET['id']);


function limpar_texto($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}
$erro = false;
if (count($_POST) > 0) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $nacimento = $_POST['nacimento'];

    if (empty($nome)) {
        $erro = "Precha o nome";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Preecha o email";
    }

    if (!empty($nacimento)) {
        $pedacos = explode('/', $nacimento);
        if (count($pedacos) == 3) {
            $nacimento = implode('-', array_reverse($pedacos));
        } else {
            $erro = "A data de nacimento deve seguir o padão dia/mes/ano.";
        }
    }

    if (!empty($telefone)) {
        $telefone = limpar_texto($telefone);
        if (strlen($telefone) != 11) {
            $erro = "O telefone deve ser preenchido no padrão (11) 9999-0000";
        }
    }

    if ($erro) {
        echo "<p><b>$erro</b></p>";
    } else {

        $sql_code = "UPDATE clientes SET nome = '$nome', email = '$email', telefone = '$telefone', nacimento = '$nacimento' WHERE id = '$id'";

        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);

        if ($deu_certo) {
            echo "Clietes foi cadastrando com susesso";
            unset($_POST);
        }
    }
}


$sqli_cliente = "SELECT * FROM clientes WHERE id = '$id'";
$query_cliente = $mysqli->query($sqli_cliente) or die($mysqli->error);
$cliente = $query_cliente->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar cliente</title>
</head>

<body>
    <form action="" method="POST">
        <label for="">Nome</label>
        <input type="text" value="<?php echo $cliente['nome']; ?>" name="nome" id=""><br><br>
        <label for="">E-mail</label>
        <input type="text" value="<?php echo $cliente['email']; ?>" name="email" id=""><br><br>
        <label for="">Telefone</label>
        <input type="text" value="<?php if (!empty($cliente['telefone'])) echo formatar_telefon($cliente['telefone']); ?>" name="telefone" id=""><br><br>
        <label for="">Data_nacimento</label>
        <input type="text" value="<?php if (!empty($cliente['nacimento'])) echo formatar_data($cliente['nacimento']); ?>" name="nacimento" id=""><br><br>
        <button type="submit">Cadastrar</button>
    </form><br><br>
    <a href="clietes.php">clietes</a>

</body>

</html>