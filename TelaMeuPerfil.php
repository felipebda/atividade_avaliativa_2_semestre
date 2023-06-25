<?php
        #Variaveis globais relevantes
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

        //#1 - FAZER CONEXAO COM BANCO DE DADOS (Alterar usuario e senha de acordo com a autorizacao do banco de dados)
        try
        {
            $pdo = new PDO("mysql:dbname=check_pet;host=localhost","usuario_apl","usuario123");
        }
        catch(PDOException $e)
        {
            echo "Erro ao conectar com banco de dados: ".$e.getMessage();
        }

        //TENTANDO FAZER CONEXAO VIA COOKIE
        if(isset($_COOKIE['emailteste']) && !isset($_POST["tipo_query"]))
        {
            $pega_id = intval($_COOKIE['idteste']); //Pegar a informacao no id no COOKIE e por no tipo INT
            
            $query6 = $pdo->prepare("SELECT * from usuario WHERE id_usuario = :i");
            $query6->bindValue(":i", $pega_id);
            $query6->execute();

            $lista = $query6->fetchAll(PDO::FETCH_ASSOC);

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

        

        //#2 - FAZER A LEITURA DO USUARIO
        
        if(isset($_POST["tipo_query"]))
        {
            //#3 - Pegar as informacoes na tela de LOGIN            
            if($_POST["tipo_query"] == "leitura")
            {
                //Fazer Validacao das informacoes, caso estejam incorretos ou corrompidos
                try
                {
                    $email = $_POST["email"];
                    $senha = hash("sha256",$_POST["senha"],false); // codificacao do algoritmo para identidficacao de senha no BD.
                    $query2 = $pdo->prepare("SELECT * FROM usuario WHERE email = :e AND senha = :s");
                    $query2->bindValue(":e", $email);
                    $query2->bindValue(":s", $senha);       
                    $query2->execute();

                    $lista = $query2->fetchAll(PDO::FETCH_ASSOC);                    
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

                    //FAZER COOKIES COM AS INFORMACOES PEGAS NO BANCO DE DADOS
                    setcookie('emailteste', $email, time()+30); //Tempo de 30 segundos para facil visualizacao
                    setcookie('idteste', $id, time()+30);
                }
                catch(Exception $e)
                {
                    header("Location: TelaLogin.php");
                    echo "Excecao capturada: ".$e->getMessage()."\n";
                }   
            }

            //PARA ATUALIZAR INFORMACOES VINDAS EM TelaGerenciarCadastro
            if($_POST["tipo_query"] == "atualizar")
            {
                $id = intval($_POST["id_usuario"]);
                $cpf = $_POST['cpf'];
                $data_nascimento = $_POST['data_nascimento'];
                $sexo = $_POST['sexo'];
                $cidade = $_POST['cidade'];
                $endereco = $_POST['endereco'];
                $complemento = $_POST['complemento'];

                $query3 = $pdo->prepare("UPDATE usuario SET cpf = :c, data_nascimento = :d, sexo = :s, cidade = :ci, endereco = :e, complemento = :co WHERE id_usuario = :id");
                $query3->bindValue(":id", $id);
                $query3->bindValue(":c", $cpf);
                $query3->bindValue(":d", $data_nascimento);
                $query3->bindValue(":s", $sexo);
                $query3->bindValue(":ci", $cidade);
                $query3->bindValue(":e", $endereco);
                $query3->bindValue(":co", $complemento);
                $query3->execute();

                //RETORNAR A LEITURA DEPOIS DE ATUALIZAR AS INFORMACOES
                $query4 = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = $id");
                $query4->execute();

                $lista2 = $query4->fetchAll(PDO::FETCH_ASSOC);
                $id = $lista2[0]["id_usuario"];
                $nome = $lista2[0]['nome'];
                $email = $lista2[0]['email'];
                $senha = $lista2[0]['senha'];
                $cpf = $lista2[0]['cpf'];
                $data_nascimento = $lista2[0]['data_nascimento'];
                $sexo = $lista2[0]['sexo'];
                $cidade = $lista2[0]['cidade'];
                $endereco =$lista2[0]['endereco'];
                $complemento = $lista2[0]['complemento'];                
            }   
        }

        //CASO NAO TENHA FEITO ACESSO OU NAO TENHA COOKIE DO USUARIO, AVISE DO ERRO E JOGUE-O NA TELA DE LOGIN
        if(!isset($_COOKIE['emailteste']) && !isset($_POST["tipo_query"]))
        {
            echo '<script>alert(" Acesso não autorizado. É necessário fazer login")</script>';
        }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Meu Perfil</title>
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

        label {
            display: block;
            color: #333333;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"], button {
            color: white;
            background-color: #6495ED;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        input[type="submit"]:hover, button:hover {
            background-color: #4169E1;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Meu Perfil</h1>
        <h2><?php if(isset($_COOKIE["idteste"]) || isset($_POST["tipo_query"]))echo "Bem vindo, ".$nome."!"; ?></h2>
        <br>

        <div clas="box">
            <h2>Dados Cadastrais</h2>
            <p>Nome Completo: <?php echo $nome; ?></p>
            <p>E-mail: <?php echo $email; ?></p>
            <p>CPF: <?php echo $cpf ?></p>
            <p>Sexo: <?php echo $sexo; ?></p>
            <p>Data de Nascimento: <?php echo $data_nascimento ?></p>
            <p>Cidade: <?php echo $cidade ?></p>
            <p>Endereco: <?php echo $endereco ?></p>
            <p>Complemento: <?php echo $complemento ?></p>
        </div>
        <br><br>
        
        <a href=""><button>Meus Pets</button></a>
        
        <form action="TelaGerenciarCadastro.php" method="post">
            <input type="hidden" name="id_utilizado" value="<?php echo $id; ?>">
            <input type="submit" value="Gerenciar Cadastro">
        </form>
    </div>


</body>
</html>