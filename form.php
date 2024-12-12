<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Simples</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Formulário Simples</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $servername = "railway"; // Alterar conforme necessário
            $username = "root";        // Alterar conforme necessário
            $password = "HkBOvmmNKNqkOIfRCRKCIqIAxcJEEcLp";            // Alterar conforme necessário
            $dbname = "test";          // Alterar conforme necessário

            $name = $_POST["name"];
            $email = $_POST["email"];

            // Validação simples
            if (!empty($name) && !empty($email)) {
                // Conectar ao banco de dados
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Verificar a conexão
                if ($conn->connect_error) {
                    die("Falha na conexão: " . $conn->connect_error);
                }

                // Inserir os dados no banco
                $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
                $stmt->bind_param("ss", $name, $email);

                if ($stmt->execute()) {
                    echo '<div class="alert alert-success">Dados salvos com sucesso!</div>';
                } else {
                    echo '<div class="alert alert-danger">Erro ao salvar dados: ' . $conn->error . '</div>';
                }

                $stmt->close();
                $conn->close();
            } else {
                echo '<div class="alert alert-warning">Por favor, preencha todos os campos.</div>';
            }
        }
        ?>
        <form method="post" action="form.php">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
