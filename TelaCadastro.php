<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Cadastro</title>
</head>
<body>
    <a href="TelaLogin.php"><button><- Voltar</button></a>
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

</body>
</html>