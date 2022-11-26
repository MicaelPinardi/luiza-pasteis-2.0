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
			if (isset($_POST["novoPrecoPromocao"])) {
				//conectar com o banco de dados
				$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
				if($_POST["promocao"]==="n") {
					// colocar em promoção
					$sql = "UPDATE `tbproduto` SET `promocao` = 's' , `precoPromocao`='".$_POST["novoPrecoPromocao"]."' WHERE `tbproduto`.`idProduto` = ".$_POST["idProduto"].";";
				} else {
					// retira da promocao
					$sql = "UPDATE `tbproduto` SET `promocao` = 'n' WHERE `tbproduto`.`idProduto` = ".$_POST["idProduto"].";";
				}
				//Não será realmente excluido. Apenas os será inativado ou seja ativo="n"
	
				$resultado = mysqli_query($conexao,$sql);
				header("Location: listarProduto.php");
			}
		 ?>
		<br><h1 align='center'> Colocar/Retirar produto em promoção </h1><br>
		<div id="boximg3">
		<p></p>
		<h2>ID# <?php echo $_GET["idProduto"]; ?></h2><p></p>
		Produto: <?php echo $_GET["produto"]; ?> <p></p>
		Descrição do produto: <?php echo $_GET["descricaoProduto"]; ?> <p></p>
		Preço de Venda: <?php echo $_GET["precoVenda"]; ?> <p></p>
		Promoção: <?php echo $_GET["promocao"]; ?> <p></p>
		Preco Promoção: <?php echo $_GET["precoPromocao"]; ?> <p></p>
		Foto: <br><br> <img width="300" src="../imagens/<?php echo $_GET["nomeFoto"]; ?>"><p></p>
		<p></p>
		<p></p>
	
		<form action="promocaoProduto.php" method="post" onsubmit="verificarPreco()">
	
			<input type="hidden" name="idProduto" value="<?php echo $_GET["idProduto"]; ?>">
			<input type="hidden" name="promocao" value="<?php echo $_GET["promocao"]; ?>" id="htPromocao">
			<input type="hidden" name="precoVenda" value="<?php echo $_GET["precoVenda"]; ?>" id="htPrecoVenda">
			<input type="hidden" name="precoPromocao" value="<?php echo $_GET["precoPromocao"]; ?>">
	
			Preço de Promoção <input type="text" name="novoPrecoPromocao" value="<?php echo $_GET["precoPromocao"]; ?>" id="htPrecoPromocao"><p></p>
			<button type="submit"><?php if($_GET["promocao"]==="n"){ echo "Colocar em promoção";} else { echo "Retirar da promoção";} ?></button><p></p>
		 </form>
	
	
		<form action="listarProduto.php">
		<button type='submit'>Voltar</button>
		</form>
		</div>
	
		<script>
			function verificarPreco() {
				var promocao = document.getElementById("htPromocao").value;
				var precoVenda = parseFloat(document.getElementById("htPrecoVenda").value);
				var precoPromocao = parseFloat(document.getElementById("htPrecoPromocao").value);
				var menorPrecoPossivel = precoVenda*0.70; // equivale a 30% de desconto
				if ((precoPromocao<precoVenda)&&(precoPromocao>=menorPrecoPossivel)) {
					return true;
				} else {
					alert("Preço de promoção: R$ "+precoPromocao+
					"\nPreço de Promoção deve ser menor que o preço de venda: R$ "+
					precoVenda+"\n e maior ou igual a R$ "+
					menorPrecoPossivel);
					// abortando submit
					window.onsubmit = function() { return false; };
				}
			}
	
		</script>
	</div>
</main>

</body>
</html>
