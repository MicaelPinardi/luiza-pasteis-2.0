<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finalizar Compra</title>
  <link rel="stylesheet" href="style-carrinho.css">
  <link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<div class="inicio">
		<div class="header">
				  <img src="logotipos/logo-transparente-2.png" alt="Logotipo" height="100px">
				  <ul>
					  <li><a href="index.php" class="link">Home</a></li>
					  <li><a href="menu.php" class="link">Menu</a></li>
				  </ul>
			</div>
	</div>


 <main>
   <div class="tabela">
     <?php
      session_start();
      if (!isset($_SESSION["logado"])||$_SESSION["logado"]!= TRUE) {
        header("Location: admin/loginCompra.php");
      }
      $pag = $_POST["pag"];
      $status='Aguardando aprovação';
      $data = date('Y/m/d');
      $conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
     
      foreach($_SESSION['carrinho'] as $idProduto => $qtd){
     
        $sql   = "SELECT *  FROM tbProduto WHERE `idProduto`= $idProduto";
        $resultado = mysqli_query($conexao,$sql);
     
        while($linha = mysqli_fetch_array($resultado)){
     
          $idProduto = $linha['idProduto'];
          if($linha['promocao']=='s'){
            $total=$linha['precoPromocao'];
          }else{
          $total = $linha['precoVenda'];
          }
        }
     
          $sql   = "INSERT INTO `tbpedido` (`idPedido`, `idCliente`, `idProduto`, `data`, `endereco`,`uf`, `precoPago`,`status`,`pag`) VALUES (NULL,$_SESSION[id], '$idProduto', '$data', '$_SESSION[endereco]', '$_SESSION[uf]', '$total','$status','$pag')";
          $resultado = mysqli_query($conexao,$sql);
     
      }
     
      unset($_SESSION['carrinho']);
      $_SESSION['carrinho'] = array();
      echo "<h1>Compra registra com sucesso!</h1>";
     ?>
     
     <a href="menu.php"><button type='submit' class="button">Realizar outra compra</button></a>
   </div>
 </main>
