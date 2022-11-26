<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Inicial</title>
  <link rel="stylesheet" href="style-carrinho.css">
  <link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>

	<div class="inicio">
		<div class="header">
				  <img src="logotipos/logo-transparente-2.png" alt="Logotipo" height="100px">
				  <ul>
					  <li><a href="index.php" class="link">Home</a></li>
					  <li><a href="menu.php" class="link">Menu</a></li>
					  <li><a href="admin/login.php" class="link">Login</a></li>
				  </ul>
			</div>
	</div>

	<br><h1>Carrinho de Compras</h1><br>
<main>
	<?php
	
		if(!isset($_SESSION['carrinho'])){
			$_SESSION['carrinho'] = array();
		} //adiciona produto
	
		if(isset($_GET['acao'])){
	
			//ADICIONAR CARRINHO
			if($_GET['acao'] === 'adicionar'){
				$idProduto = intval($_GET['idProduto']);
				if(!isset($_SESSION['carrinho'][$idProduto])){
					$_SESSION['carrinho'][$idProduto] = 1;
				} else {
					$_SESSION['carrinho'][$idProduto] += 1;
				}
			}
	
			//REMOVER CARRINHO
			if($_GET['acao'] === 'limpar'){
				unset($_SESSION['carrinho']);
				$_SESSION['carrinho'] = array();
			}
	
			//ALTERAR QUANTIDADE
			if($_GET['acao'] === 'remover'){
				$idProduto = intval($_GET['idProduto']);
				if(isset($_SESSION['carrinho'][$idProduto])){
					$_SESSION['carrinho'][$idProduto] -= 1;
	echo 	$_SESSION['carrinho'][$idProduto];
					if ($_SESSION['carrinho'][$idProduto]<=0){
						unset($_SESSION['carrinho'][$idProduto]);
					}
				}
			}
	   }
	
		?>
		
	<div class="tabela">
		<table width="80%">
	
			<thead>
				<tr>
					<th width="160" colspan="3"><h2>Descrição do Produto</h2></th>
					<th width="95"><h3>Quantidade</h3></th>
					<th width="50"><h3>Pre&ccedil;o</h3></th>
					<th width="120"><h3>SubTotal</h3></th>
					<th width="80"><h3>Remover</h3></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td>
						<form action="menu.php">
							<button class="button" type='submit'>Continuar Comprando</button>
						</form>
					</td>
					<td colspan="5">
					</td>
					<td>
						<form action="pagamento.php" width="100%">
							<button class="button" type='submit'>Pagamento</button>
						</form>
					</td>
				</tr>
			</tfoot>
			<tbody>
		 <?php
			if(count($_SESSION['carrinho']) == 0){
				echo "<tr><td colspan='7'><h3>Não há produto no carrinho</h3></td></tr>";
			} else {
				$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
				$total = 0;
	
				foreach($_SESSION['carrinho'] as $idProduto => $qtd){
					$sql   = "SELECT *  FROM tbProduto WHERE `idProduto`= $idProduto";
					$resultado = mysqli_query($conexao,$sql);
					while($linha = mysqli_fetch_array($resultado)){
						echo "<tr>";
						echo "<td width='100'><img width='100' src='imagens/".$linha["nomeFoto"]."'></td>";
						echo "<td>".$linha["produto"]."</td>";
						echo "<td>".$linha["descricaoProduto"]."</td>";
						if($linha["promocao"]=="s") {
							$precoUnitario = $linha["precoPromocao"];
								} else {
									$precoUnitario = $linha["precoVenda"];
								}
								$subTotal   = $precoUnitario * $qtd;
								$total += $precoUnitario * $qtd;
				  $_SESSION['total']=$total;
	
								echo "<td>".number_format($qtd, 2, ',', '.')."</td>";
								echo "<td>".number_format($precoUnitario, 2, ',', '.')."</td>";
								echo "<td>".number_format($subTotal, 2, ',', '.')."</td>";
								echo "<td><a href='?acao=remover&idProduto=$idProduto'><img width='60' src='imagens/remover.png'></a></td>";
								}
					}
					$total = number_format($total, 2, ',', '.');
					echo '<tr><td colspan="6">Total</td><td>R$ '.$total.'</td></tr>';
			  }
	?>
	</div>
</main>


</body>
</html>


