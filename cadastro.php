<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root"; // Substitua pelo seu nome de usuário do MySQL
$password = ""; // Substitua pela sua senha do MySQL
$dbname = "patassolidarias";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $nome = $_POST['name'];
    $data_nascimento = $_POST['data_nascimento'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];

    // Inserindo os dados no banco de dados
    $sql = "INSERT INTO pessoa (nome,  data_nascimento, endereco, cep, cpf, email, telefone, senha) 
            VALUES ('$nome','$data_nascimento', '$endereco', '$cep', '$cpf', '$email', '$telefone','$senha')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}

// Fechando a conexão
$conn->close();
?>