<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style-login.css">
  <link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    
<?php
	session_start();
 ?>

 <br>


<center>
<img src="../logotipos/logo-transparente.png" alt="logo" height="150px"><br>
        <div id="login">
          <h1 align='center'> Criar cadastro </h1>
            <form action="infoclientes.php">
              <br>
                Email: <input type="email" name="email" required><p></p><br>
                Nome: <input type="text" name="nome" required><p></p><br>
                Apelido: <input type="text" name="nickname" required><p></p><br>
                Senha: <input type="password" name="password" minlength="8" required><p></p><br>
                Endereço: <input type="text" name="endereco" required><p></p><br>
                UF: <input type="text" name="uf" maxlength="2" required><p></p><br>
                Telefone: <input type="text" name="fone" required><p></p><br>
                <button type="submit" class="back">Cadastrar</button><p></p>
             </form>
        </div>
</center>


</body>
</html>