<?php
    //Variaveis globais
        $id = 0;
        $nome = "";
        $email = "";
        $senha = "";
        $cpf = "";
        $data_nascimento = "";
        $sexo = "";
        $cidade = "";
        $endereco = "";
        $complemento = "";

        //FAZER CONEXAO COM BANCO DE DADOS (Alterar usuario e senha de acordo com a autorizacao do banco de dados)
        try
        {
            $pdo = new PDO("mysql:dbname=check_pet;host=localhost","usuario_apl","usuario123");
        }
        catch(PDOException $e)
        {
            echo "Erro ao conectar com banco de dados: ".$e.getMessage();
        }

        //# 4 Pegar dados para atualizar cadastro
        if(isset($_POST['id_utilizado']))
        {
            //Fazer Validacao das informacoes, caso estejam incorretos ou corrompidos
            try
            {
                $id =  intval($_POST['id_utilizado']);
                //var_dump ($id);
                $query = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = :i");
                $query->bindValue(":i", $id);
                $query->execute();
    
                $lista = $query->fetchAll(PDO::FETCH_ASSOC);
                if(count($lista) == 0)
                {
                    //Se a querry nao retornar nenhum elemento (lista vazia), jogue um erro(trow).
                    throw new Exception("Deu erro", 1); 
                }

                $id = $lista[0]["id_usuario"];
                $nome = $lista[0]['nome'];
                $email = $lista[0]['email'];
                $senha = $lista[0]['senha'];
                $cpf = $lista[0]['cpf'];
                $data_nascimento = $lista[0]['data_nascimento'];
                $sexo = $lista[0]['sexo'];
                $cidade = $lista[0]['cidade'];
                $endereco =$lista[0]['endereco'];
                $complemento = $lista[0]['complemento'];
            }
            catch(Exception $e)
            {
                header("Location: TelaLogin.php");
                echo "Excecao capturada: ".$e->getMessage()."\n";
            }
        }

        //CASO NAO TENHA FEITO ACESSO OU NAO TENHA COOKIE DO USUARIO, AVISE DO ERRO E JOGUE-O NA TELA DE LOGIN
        if(!isset($_COOKIE['emailteste']) && !isset($_POST["id_utilizado"]))
        {
            echo '<script>alert(" Acesso não autorizado. É necessário fazer login")</script>';
        }       

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cadastro</title>
    <style>
        body {
            background-color: #DDA0DD;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            color: #333333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #CCCCCC;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"], button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        input[type="submit"]:hover, button:hover {
            background-color: #45a049;
        }

        .button-container {
            margin-top: 20px;
        }
        #del:hover{
            background-color: red;
        }        
    </style>
</head>

<body>
    <div class="container">
        <div>       
            <h2>Complete seu Cadastro</h2>
            <form action="TelaMeuPerfil.php" method="POST">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" value = "<?php echo $cpf; ?>">
                <br>
                <label for="data">Data de Nascimento</label>
                <input type="text" id="data" name="data_nascimento" value = "<?php echo $data_nascimento; ?>">
                <br>
                <label for="sexo">Sexo</label>
                <input type="text" is="sexo" name="sexo" value = "<?php echo $sexo; ?>">
                <br>
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" value = "<?php echo $cidade; ?>">
                <br>
                <label for="endereco">Endereco</label>
                <input type="text" id="endereco" name="endereco" value = "<?php echo $endereco; ?>">
                <br>
                <label for="complemento">Complemento</label>
                <input type="text" id="complemento" name="complemento" value = "<?php echo $complemento; ?>">
                <br>
                <input type="hidden" name="id_usuario" value="<?php echo $id; ?>">
                <input type="hidden" name="tipo_query" value="atualizar">
                <input type="submit" value="Salvar">
                <br>
        
            </form>
        </div>
    

        <div class="button-container">
            <button>FAQS</button>
            <button>Contate-nos</button>
            <button>Suporte</button>
            <a href="TelaLogin.php"><button>Sair do perfil</button></a>
            <form action="TelaLogin.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="tipo_query" value ="deletar">
                <input id="del" type="submit" value="Deletar Perfil">
            </form>

        </div>
    </div>
</body>
</html>