<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Luiza Pastéis - Compras Efetuadas </title>
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
    
    <?php
    
    session_start();
    if (!isset($_SESSION["logado"])||($_SESSION["logado"]!= TRUE)){
      header("Location: login.php");
    }
    ?>
    
    
    <br>
    <div class="tabela">
      <h1>Compras Efetuadas</h1><br>
      <table width="90%" align="center">
        <thead>
          <tr align="center">
        <th width="100">ID do Pedido</th>
            <th width="80">ID do Cliente</th>
            <th width="80">ID do Produto</th>
          <th width="80">Preço Pago</th>
          <th width="80">Pagamento</th>
            <th width="80">Data</th>
          <th width="80">Status</th>
          <th width="80"> Quer denovo?</th>
          </tr>
        </thead>
        <tbody>
       <?php
          $conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
          $sql   = "SELECT * FROM `tbpedido` WHERE `idCliente` = $_SESSION[id]";
          $resultado = mysqli_query($conexao,$sql);
            while($linha = mysqli_fetch_array($resultado)){
              echo "<tr>";
              echo "<td align=center>".$linha['idPedido']."</td>";
              echo "<td align=center>".$linha['idCliente']."</td>";
              echo "<td align=center>".$linha['idProduto']."</td>";
            echo "<td align=center>".$linha['precoPago']."</td>";
            echo "<td align=center>".$linha["pag"]."</td>";
            echo "<td align=center>".$linha["data"]."</td>";
            echo "<td align=center>".$linha["status"]."</td>";
            echo "<td align=center><a href=\"../carrinho.php?acao=adicionar&idProduto=".$linha['idProduto']."\"> Comprar novamente</a></td>";
            }
    ?>
    
  </main>
</div>
