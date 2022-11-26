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
		
			//conectar com o banco de dados
			$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
			$sql = "SELECT * FROM `tbproduto` order by produto";
			$resultado = mysqli_query($conexao,$sql);
		
		?>
		
		<h1 align='center'>Lista de Produtos</h1>
		
		
		<table align=center width=90%>
		  <thead>
			<tr>
			  <th>#ID</th>
			  <th>Foto</th>
			  <th>Produto</th>
			  <th>Descrição do Produto</th>
			  <th>Preço Venda</th>
			  <th>Promoção</th>
			  <th>Preço Procoção</th>
			  <th>Ação</th>
			</tr>
		  </thead>
		<tbody>
		
		<?php
		while($linha = mysqli_fetch_array($resultado)){
			echo "<tr align='center'>";
			echo "<td width='5%'>".$linha["idProduto"]."</td>";
			echo "<td width='20%'><img width='30%' src='../imagens/".$linha["nomeFoto"]."'></td>";
			echo "<td width='15%'>".$linha["produto"]."</td>";
			echo "<td>".$linha["descricaoProduto"]."</td>";
			echo "<td>".$linha["precoVenda"]."</td>";
			echo "<td>".$linha["promocao"]."</td>";
			echo "<td>".$linha["precoPromocao"]."</td>";
			$dados="idProduto=".$linha["idProduto"].
				   "&produto=".$linha["produto"].
				   "&descricaoProduto=".$linha["descricaoProduto"].
				   "&precoVenda=".$linha["precoVenda"].
				   "&promocao=".$linha["promocao"].
				   "&precoPromocao=".$linha["precoPromocao"].
				   "&nomeFoto=".$linha["nomeFoto"];
		
			echo "<div class='icons'><td width=120>".
				 "<a href=\"visualizarProduto.php?$dados\"><img width=\"20%\" src=\"visualizacao.png\"> </a>".
				 "<a href=\"alterarProduto.php?$dados\"><img width=\"20%\" src=\"edit.png\"> </a>".
				 "<a href=\"excluirProduto.php?$dados\"><img width=\"20%\" src=\"cancelar.png\"> </a>".
				 "<a href=\"promocaoProduto.php?$dados\"><img width=\"20%\" src=\"promocao1.png\"> </a>".
				 "</td>";
			echo "</div>";
			?>
		
		
		<?php
		
			echo "</td>";
			echo "</tr>";
		}
		
		mysqli_close($conexao);
		?>
		</tbody>
		</table>
		
	</div>

	<a href="incluirProduto.php"><button type='submit'>Novo Produto</button></a>
	<a href="index.php" class="btn-voltar"><button type='submit'>Voltar</button></a>
</main>

</body>
</html>
