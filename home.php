<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Corretores</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <header class="cabecalho">

    </header>
    <h2>Cadastro de Corretores</h2>
    <div class="formulario">

        <form action="home.php" method="post" onsubmit="return validacao()">
            <div class="campo1">
                <input type="text" id="cpf" name="cpf" required placeholder="Digite seu CPF">
                <input type="text" id="creci" name="creci" required placeholder="Digite seu Creci">
            </div>
            <div class="campo2">
                <input type="text" id="nome" name="nome" required placeholder="Digite seu Nome">
            </div>
            <div class="campo3">
                <input type="submit" value="Enviar" id="btnEnviar" onclick="validacao()">
            </div>
        </form>
    </div>
    <script src="home.js"></script>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "teste";

    $conecta = new mysqli($hostname = "localhost", $username = "root", $password = "", $dbname = "teste");

    
    if ($conecta->connect_error) {
        die("Falha: " . $conecta->connect_error);
    }

    $banco = "SELECT * FROM corretores";
    $dados = $conecta->query($banco);

    if ($dados->num_rows > 0) { 
        echo "<hr></hr>";
        echo "<h3>Corretores Cadastrados:</h3>";
        echo "<table class='tabela'>";
        echo "<tr><th>ID</th><th>Nome</th><th>CPF</th><th>Creci</th><th>Ações</th></tr>";

        
        while ($celula = $dados->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $celula["id"] . "</td>";
            echo "<td>" . $celula["nome"] . "</td>";
            echo "<td>" . $celula["cpf"] . "</td>";
            echo "<td>" . $celula["creci"] . "</td>";
            echo "<td class='acoes'>";
            echo "<input type='hidden' name='id' value='" . $celula["id"] . "'>";
            echo "<input type='submit' name='editar' value='' class='btn_edicao'>";
            echo "</form>";
            echo "<form action='home.php' method='get' onsubmit='return deletar();'>";
            echo "<input type='hidden' name='deleta' value='" . $celula["id"] . "'>";
            echo "<input type='submit' value='' class='btn_excluir'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>Não há cadastros</h3>";
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cpf = htmlspecialchars($_POST['cpf']);
        $creci = htmlspecialchars($_POST['creci']);
        $nome = htmlspecialchars($_POST['nome']);

        $banco = "INSERT INTO corretores (nome, cpf, creci) VALUES ('$nome', '$cpf', '$creci')";

        if ($conecta->query($banco) === TRUE) {
            echo "<script>alerta('Cadastrado com sucesso!') , window.location.href = '/Teste_ImovelGuide/home.php';</script>";
        } else {
            echo "<p>Erro ao criar registro: " . $conecta->error . "</p>";
        }
    }

    if (isset($_GET['deleta'])) {
        $id_deletado = intval($_GET['deleta']);
        $deleta_banco = "DELETE FROM corretores WHERE id = $id_deletado";

        if ($conecta->query($deleta_banco) === TRUE) {
            echo "<script>alerta('Registro excluído com sucesso!') ; window.location.href = '/Teste_ImovelGuide/home.php';</script>";
        } else {
            echo "<p>Erro ao excluir registro: " . $conecta->error . "</p>";
        }
    }
    ?>
</body>
</html>