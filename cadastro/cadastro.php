<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "patassolidarias";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['name'];
    $data_nascimento = $_POST['data_nascimento'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];

    
    $sql = "INSERT INTO pessoa (nome,  data_nascimento, endereco, cep, cpf, email, telefone, senha) 
            VALUES ('$nome','$data_nascimento', '$endereco', '$cep', '$cpf', '$email', '$telefone','$senha')";

    if ($conn->query($sql) === TRUE) {
        header('Location: sucesso.html');
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}


$conn->close();
?>