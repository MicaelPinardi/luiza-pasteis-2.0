<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Luiza Pastéis - Cliente </title>
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
  </div>
 
<main>
    
  <div class="infos">
    <?php
    
    
    
    session_start();
    if (!isset($_SESSION["logado"])||($_SESSION["logado"]!= TRUE)){
      header("Location: ../index.php");
    }
    if ((isset($_SESSION["logado"]))&&($_SESSION["logado"]== TRUE)) {
      echo"<br><div id='boxlogin'><h1>Olá, ".$_SESSION['nickname']."</h1>";
      echo"<br>ID de usuário: ".$_SESSION['id'];
      echo"<br>Email: ".$_SESSION['email'];
      echo"<br>Nome: ".$_SESSION['nome'];
      echo"<br>Endereço: ".$_SESSION['endereco'];
      echo"<br>UF: ".$_SESSION['uf'];
      echo"<br>Telefone: ".$_SESSION['fone'];
      $_SESSION['idFunc'] = $_SESSION['id']."</div>";
    } else {
      header("location: login.php");
      }
    ?>
  </div>
  
  <br><br>
  <div class="acoes">
    <form action="compras.php">
    <button type="submit">Compras efetuadas</button>
    </form>
    <br>
    <form action="mudarinfo.php">
    <button type="submit">Mudar informações</button>
    </form>
  </div>
  <br>
  <div class="btn-voltar">
    <form action="../index.php">
      <button type="submit">Voltar</button>
    </form>
    <br>
    <form action="sair.php">
      <button type="submit">Sair da conta</button>
    </form>
  </div>
</main>