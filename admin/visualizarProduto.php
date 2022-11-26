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
	 
	<?php
		session_start();
		if (!isset($_SESSION["logado"])||($_SESSION["logado"]!= TRUE) || ($_SESSION["funcao"] != "gerente") && ($_SESSION["funcao"] != "estoquista")){
			header("Location: index.php");
		}
	 ?>
	<br><h1 align='center'> Dados do Produto </h1>
	<br>
	<div class="tabela">
	<br>
	<h2>ID# <?php echo $_GET["idProduto"]; ?></h2>  <br><br>
	Produto: <?php echo $_GET["produto"]; ?> <br>
	Descrição do produto: <?php echo $_GET["descricaoProduto"]; ?> <br>
	Preço de Venda: <?php echo $_GET["precoVenda"]; ?> <br><br>
	Promoção: <?php echo $_GET["promocao"]; ?> <br>
	Preco Promoção: <?php echo $_GET["precoPromocao"]; ?> <br>
	Foto: <br><br><img width="300" src="../imagens/<?php echo $_GET["nomeFoto"]; ?>"><br><br>
	
	<center>
		<form action="listarProduto.php">
		<button type='submit'>Voltar</button>
		</form>
	</center>
	</div>
 </main>

</body>
</html>
