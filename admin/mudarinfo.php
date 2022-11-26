<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Luiza Pastéis - Mudar Informações </title>
  <link rel="stylesheet" href="style-cliente.css">
  <link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>

<div class="inicio">
    <div class="header">
          <img src="../logotipos/logo-transparente-2.png" alt="Logotipo" height="100px">
    </div>
    <ul>
              <li><a href="infologin.php" class="link">Voltar</a></li>
          </ul>
  </div>
  
<main>
  <div class="mudar-infos">
    <?php
  
  
  
    session_start();
    if (!isset($_SESSION["logado"])||($_SESSION["logado"]!= TRUE)){
        header("Location: ../index.php");
    }
    ?>
    <br><br>
  
  
  
    <center>
    <h2>Mudar Informações</h2>
    <br>
        <form action="mudarinfo2.php" method="get">
            Email: <input type="email" name="email" value="<?php echo $_SESSION["email"]; ?>" required> <br><br>
            Nome: <input type="text" name="nome" value="<?php echo $_SESSION["nome"]; ?>" required><br><br>
            Nickname: <input type="text" name="nick" value="<?php echo $_SESSION["nickname"]; ?>" required> <br><br>
            Endereço: <input type="text" name="endereco" value="<?php echo $_SESSION["endereco"]; ?>" required><br><br>
            UF: <input type="text" name="uf" value="<?php echo $_SESSION["uf"]; ?>" required maxlength="2"><br><br>
            Fone: <input type="text" name="fone" value="<?php echo $_SESSION["fone"]; ?>" required><br><br>
            <button type="submit" id="salvar"> Salvar </button><br>
        </form>
  </div>
  
  <br>
    <form action="infologin.php">
        <button type="submit" class="voltar">Voltar</button>
    </form>
    </center>
</main>
