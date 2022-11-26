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
		 ?>
		<br><h1 align='center'> Alterar Produto </h1>
		<br>
		<div id="boximg2">
		<form enctype="multipart/form-data" action="upload.php" method="post">
		
			<input type="hidden" name="acao" value="alterar">
			<input type="hidden" name="idProduto" value="<?php echo $_GET["idProduto"]; ?>">
		
			Produto<input type="text" name="produto" value="<?php echo $_GET["produto"]; ?>"> <p></p>
			Descrição do produto<input type="text" name="descricaoProduto" value="<?php echo $_GET["descricaoProduto"]; ?>"><p></p>
			Preço de Venda<input type="text" name="precoVenda" value="<?php echo $_GET["precoVenda"]; ?>"><br><br>
		
			<input type="hidden" name="nomeFotoAntiga" value="<?php echo $_GET["nomeFoto"]; ?>">
		
			<img width="300" src="../imagens/<?php echo $_GET["nomeFoto"]; ?>" id="preview"><p></p>
			Selecione a foto: <p></p>
			<input type="file" name="imagemProduto" id="img-input"><br><br>
			<center><button type="submit">Salvar</button></center><p></p>
		 </form>
		 <center>
			<form action="listarProduto.php">
			<button type='submit'>Voltar</button>
			</form>
		 </center>
		
		
		</div>
		
		<script>
			/*
			Este código javascript é responsável por carregar a imagem
			selecionada no componente <img> que esta na tela
			isto permite que a pessoa possa visualizar a fonto antes dela ser enviada para o servidor
			*/
			document.getElementById("img-input").onchange = function () {
				var reader = new FileReader();
		
				reader.onload = function (e) {
					// get loaded data and render thumbnail.
					document.getElementById("preview").src = e.target.result;
				};
		
				// read the image file as a data URL.
				reader.readAsDataURL(this.files[0]);
			};
		</script>
	</div>
</main>
</body>
</html>
