<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "patassolidarias";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para obter todos os animais
$sql = "SELECT nome, foto FROM animal";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animais para Adoção</title>
    <link rel="stylesheet" href="pagina_animais.css">
</head>
<body>

    <header>
            <form action="" method="post"> 
                
                <input type=image src="image 2.png" width="55" height="50" class="botao_hamburguer"> 
                
                </form>
            <div class="titulo">PATAS SOLIDARIAS</div>
            <a class="link_menu" href="https://wordmark.it/"> Menu principal </a></div>
        </header>

<h1>Animais para Adoção</h1>
<div class="animal-container">
    <?php
    // Exibe cada animal como um cartão na página
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="animal-card">';
            echo '<h3>' . htmlspecialchars($row["nome"]) . '</h3>';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row["foto"]) . '" alt="Foto de ' . htmlspecialchars($row["nome"]) . '">';
            echo '<a href="https://wordmark.it/"> Entre em contato com o dono! </a>';
            echo '</div>';
        }
    } else {
        echo "<p>Nenhum animal disponível para adoção.</p>";
    }
    ?>
</div>

</body>
</html>

<?php
$conn->close();
?>
