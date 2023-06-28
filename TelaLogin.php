<?php  
        //CRIANDO PDO PARA CONEXAO COM BANCO DE DADOS (Alterar usuario e senha de acordo com a autorizacao do banco de dados)
        try
        {
            $pdo = new PDO("mysql:dbname=check_pet;host=localhost","usuario_apl","usuario123");
        }
        catch(PDOException $e)
        {
            echo "Erro ao conectar com banco de dados: ".$e->getMessage();
        }

        //CONFIRMAR A EXCLUSAO DA CONTA VINDO DA PAGINA TelaGerenciarCadastro

        if(isset($_POST["tipo_query"]))
        {
            if($_POST["tipo_query"] == "deletar")
            {           
            $id = intval($_POST["id"]);
            $query5 = $pdo->prepare("DELETE FROM usuario WHERE id_usuario = $id");
            $query5->execute();
            }

            if($_POST["tipo_query"] == "criar")
            {                    
                $nome = $_POST["nome"];
                    $email = $_POST["email"];
                    $senha = hash("sha256",$_POST["senha"],false); // codificacao do algoritmo para modificacao de senha no BD.
    
                    $query = $pdo->prepare("INSERT INTO usuario(nome, email, senha) VALUES(:n, :e, :s)");
                    $query->bindValue(":n", $nome);
                    $query->bindValue(":e",$email);
                    $query->bindValue(":s",$senha); 
                    $query->execute();
            }
        }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Login</title>
    <style>
                body {
            background-color: #DDA0DD;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px;
        }

        .form-container {
            background-color: #E6E6FA;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            width: 40%;
            font-size: 16px;
        }

        .additional-content {
            background-color: #FFFFFF;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            width: 50%;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">    
        <div class="additional-content">
            <h2>Ainda nao possue conta?</h2>
            <p>Crie sua conta agora mesmo</p>
            <a href="TelaCadastro.php"><button>Registre-se</button></a>
            <br>
        </div>

        <div class="form-container">
            <h2>Digite seu Login</h2>
            <p>Preencha seus dados</p>
            <form action="TelaMeuPerfil.php" method="POST">
                <label for="email">E-mail</label>
                <input type="text" id="email" name="email">
                <br>
                <label for="senha">Senha</label>
                <input type="text" id="senha" name="senha">
                <br>
                <input type="hidden" name="tipo_query" value="leitura">
                <input type="submit" value="Entrar">
            </form>
        </div>
    </div>
</body>
</html>