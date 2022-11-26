<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Luiza Pastéis - Produtos </title>
  <link rel="stylesheet" href="style-admin.css">
  <link rel="shortcut icon" href="../imagens/favicon.png" type="image/x-icon" />
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
	<div class="tabela">
		<?php
			session_start();
			if (!isset($_SESSION["logado"])||($_SESSION["logado"]!= TRUE) || ($_SESSION["funcao"] != "gerente") && ($_SESSION["funcao"] != "estoquista")){
				header("Location: index.php");
			}
			if (isset($_POST["idProduto"])) {
				//conectar com o banco de dados
				$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
				//Não será realmente excluido. Apenas os será inativado ou seja ativo="n"
				$sql = "DELETE FROM `tbproduto` WHERE `tbproduto`.`idProduto` = ".$_POST["idProduto"].";";
				$resultado = mysqli_query($conexao,$sql);
				header("Location: listarProduto.php");
			}
		
		 ?>
		<br><h1 align='center'> Excluir Produto </h1>
		<br><br>
		<div id="boximg">
		<p></p>
		<h2>ID# <?php echo $_GET["idProduto"]; ?></h2><br><br>
		Produto: <?php echo $_GET["produto"]; ?> <p></p>
		Descrição do produto: <?php echo $_GET["idProduto"]; ?> <p></p>
		Preço de Venda: <?php echo $_GET["precoVenda"]; ?> <p></p>
		Promoção: <?php echo $_GET["promocao"]; ?> <p></p>
		Preco Promoção: <?php echo $_GET["precoPromocao"]; ?> <p></p>
		Foto: <br><br> <img width="300" src="../imagens/<?php echo $_GET["nomeFoto"]; ?>"><p></p>
		<form action="excluirProduto.php" method="post">
		<input type="hidden" name="idProduto" value="<?php echo $_GET["idProduto"];?>">
		<button type='submit'>Excluir este Produto</button>
		</form>
		
		<form action="listarProduto.php">
		<a href="listarProduto.php"><button type='submit'>Voltar</button></a>
		</form>
		</div>
	</div>
</main>

</body>
</html>
