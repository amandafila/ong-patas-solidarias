<?php
session_start(); // Inicia uma sessão

// Conexão com o banco de dados
$host = 'localhost'; // ou o endereço do seu servidor
$db = 'patassolidarias';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Processa o login quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prepara a consulta para evitar SQL Injection
    $stmt = $conn->prepare("SELECT id, senha FROM pessoa WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    // Verifica se o email existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $senha_armazenada);
        $stmt->fetch();
        
        // Verifica se a senha está correta
        if ($senha === $senha_armazenada) {
            // Armazena os dados do usuário na sessão
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            echo "Login bem-sucedido! Bem-vindo, " . htmlspecialchars($email);
            // Redirecionar ou carregar outra página
            // header("Location: dashboard.php");
            exit();
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Email não encontrado!";
    }
    
    $stmt->close();
}

$conn->close();
?>