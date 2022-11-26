<?php
	session_start();
	if (!isset($_SESSION["logado"])||($_SESSION["logado"]!= TRUE) || ($_SESSION["funcao"] == "cliente")){
		header("Location: ../index.php");
	}
	?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Luiza Pastéis - Admin </title>
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
		<h1>Luiza Pastéis - Página adminstrativa</h1><br>
		<div class="infos">
			<?php
			echo "<h2>Seja Bem-Vindo, ".$_SESSION["nome"]."</h2>";
			if (($_SESSION["funcao"] === "gerente")) {?>
			<div class="acoes">
				<a href="../index.php"><button type="submit">Página inicial</button></a>
				<a href="listarProduto.php"><button type="submit" href="listarProduto.php">Produtos</button></a>
				<a href="listarFuncionario.php"><button type="submit">Funcionários</button></a>
				<a href="aprovar.php"><button type="submit">Pedidos para Aprovar</button></a>
				<a href="transporte.php"><button type="submit">Produtos para Transporte</button></a>
				<a href="relatorio.php"><button type="submit">Relatório de compras</button></a>
				<div class="btn-voltar"><a href="sairfunc.php"><button type="submit">Sair</button></a></div>
			<?php }
			
				if (($_SESSION["funcao"] === "caixa")) {?>
			<div class="boxg">
				<a href="../index.php"><button type="submit">Página inicial</button></a>
				<a href="relatorio.php"><button type="submit">Relatório de compras</button></a>
				<a href="aprovar.php"><button type="submit">Pedidos para Aprovar</button></a>
				<a href="sairfunc.php"><button type="submit">Sair</button></a>
			</div>
			
				<?php }
			if (($_SESSION["funcao"] === "estoquista")) {?>
			<div class="boxg">
				<a href="listarProduto.php"><button type="submit" href="listarProduto.php">Produtos</button></a>
				<a href="../index.php"><button type="submit">Página inicial</button></a>
				<a href="sairfunc.php"><button type="submit">Sair</button></a>
			</div>
			
			
				<?php }
			if (($_SESSION["funcao"] === "transportador")) {?>
			<div class="boxg">
				<a href="../index.php"><button type="submit">Página inicial</button></a>
				<a href="transporte.php"><button type="submit">Produtos para Transporte</button></a>
				<a href="sairfunc.php"><button type="submit">Sair</button></a>
			</div>
			
			
				<?php }
				?>
		</div>
	</main>


</body>
</html> 