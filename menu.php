<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>
  <link rel="stylesheet" href="style-menu.css">
  <link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>

  <div class="inicio">
    <header>
          <img src="logotipos/logo-transparente-2.png" alt="Logotipo" height="100px">
          <ul>
              <li><a href="index.php" class="link">Home</a></li>
              <li><a href="carrinho.php" class="link">Carrinho</a></li>
              <li><a href="admin/login.php" class="link">Login</a></li>
          </ul>
    </header>
</div>
<main>
  
      <?php
      session_start();
      //conectar com o banco de dados
      $conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
      $sql = "SELECT * FROM `tbproduto` WHERE `promocao` LIKE 's' order by produto";
      $resultado = mysqli_query($conexao, $sql);
      ?>
  
      <h1>No precinho para você!</h1>
      <div class="promocao">
        <?php
        while ($linha = mysqli_fetch_array($resultado)) {
          echo '<div class="produto-pro">';
          echo "<img id='foto' width='190px' height='119px' src='imagens/" . $linha["nomeFoto"] . "'<br>";
          echo "<div class='aligntitle'><b>" . $linha['produto'] . "</b></div><br>";
          echo $linha['descricaoProduto'] . "<br><br><b>";
          echo $linha['precoPromocao'] . "</b>";
          echo "<a href=\"carrinho.php?acao=adicionar&idProduto=".$linha['idProduto']."\"><img width=\"25px\" src=\"adicionar.png\"> </a>"
        ?>
  
        <?php
        echo "</div>";
        }
  
  
        $sql = "SELECT * FROM `tbproduto` WHERE `promocao` LIKE 'n' order by produto";
        $resultado = mysqli_query($conexao, $sql);
  
        ?></div>
        <h1>Outras delícias</h1>
        <div class="produtos">
        <?php
        while ($linha = mysqli_fetch_array($resultado)) {
        echo '<div class="produto">';
        echo "<img id='foto' width='190px' height='119px' src='imagens/" . $linha["nomeFoto"] . "'<br>";
        echo "<div class='aligntitle'><b>" . $linha['produto'] . "</b></div><br>";
        echo $linha['descricaoProduto'] . "<br><br><b>";
        echo $linha['precoVenda'] . "</b>";
        echo "<a href=\"carrinho.php?acao=adicionar&idProduto=".$linha['idProduto']."\"><br> <img width=\"25px\" src=\"adicionar.png\"> </a>"
        ?>
        <br>
        <?php
        echo "</div>";
        }
        mysqli_close($conexao);
        ?>
        </div>
  
</main>

</body>

</html>