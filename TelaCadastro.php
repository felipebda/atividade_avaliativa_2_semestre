<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Cadastro</title>
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

        .back-button {
            margin-bottom: 20px;
        }

        h2 {
            color: #333333;
        }

        p {
            color: #666666;
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

        input[type="text"], input[type="password"] {
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
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="TelaLogin.php"><button>&#8592; Voltar</button></a>
        <h2>Crie sua conta</h2>
        <p>Preencha seus dados</p>
        <form action="TelaLogin.php" method="POST">
            <label for="nome">Nome Completo</label>
            <input type="text" id="nome" name="nome">
            <br>
            <label for="">E-mail</label>
            <input type="text" id="email" name="email" >
            <br>
            <label for="">Senha</label>
            <input type="text" id="senha" name="senha">
            <br>
            <label for="">Confirmar Senha</label>
            <input type="text" id="csenha" name="csenha">
            <br> 
            <input type="hidden" name="tipo_query" value="criar">
            <input type="submit" id="novo_cadastro" name="novo_cadastro" value="Cadastrar">                       
        </form>
    </div>

</body>
</html>