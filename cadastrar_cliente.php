<?php

include('conexao/conexao.php');

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
        $sql_code = "INSERT INTO clientes ( nome, email, telefone,nacimento,date) VALUES ('$nome','$email','$telefone','$nacimento',NOW())";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if ($deu_certo) {
            echo "Clietes foi cadastrando com susesso";
            unset($_POST);
        }
    }
}

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
        <input type="text" value="<?php if (isset($_POST['nome'])) echo $_POST['nome']; ?>" name="nome" id=""><br><br>
        <label for="">E-mail</label>
        <input type="text" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" name="email" id=""><br><br>
        <label for="">Telefone</label>
        <input type="text" value="<?php if (isset($_POST['telefone'])) echo $_POST['telefone']; ?>" name="telefone" id=""><br><br>
        <label for="">Data_nacimento</label>
        <input type="text" value="<?php if (isset($_POST['nacimento'])) echo $_POST['nacimento']; ?>" name="nacimento" id=""><br><br>
        <button type="submit">Cadastrar</button>
    </form><br><br>
    <a href="clietes.php">clietes</a>



</body>

</html>