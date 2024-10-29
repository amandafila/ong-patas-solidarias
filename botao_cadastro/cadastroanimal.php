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
    $tipo = $_POST['selecione_tipo'];
    $raca = $_POST['selecione_raca'];
    $temperamento = $_POST['selecione_temperamento'];
    $porte = $_POST['selecione_porte'];
    $idade = $_POST['idade'];
    $espaco = $_POST['espaco'];
    $comentarios = $_POST['comentarios'];

    // Verifica se a foto foi enviada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        // Lê o conteúdo do arquivo da imagem
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
        // Escapa os dados binários da imagem para inserção no SQL
        $foto = $conn->real_escape_string($foto);

        // SQL para inserir o registro, incluindo a foto
        $sql = "INSERT INTO animal (nome, tipo, raca, temperamento, porte, idade, necessita_espaco, comentários, foto) VALUES ('$nome', '$tipo', '$raca', '$temperamento', '$porte', '$idade', '$espaco', '$comentarios', '$foto')";
    } else {
        echo "Erro ao fazer o upload da foto.";
        exit; // Encerra a execução do script em caso de erro no upload
    }

    // Executa a query
    if ($conn->query($sql) === TRUE) {
        header('Location: /login_cadastro/cadastro/sucesso.html');
        exit(); // Adicione exit após o redirecionamento
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}

$conn->close();
?>

