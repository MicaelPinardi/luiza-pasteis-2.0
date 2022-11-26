<?php
	session_start();
	if (!isset($_SESSION["logado"])||($_SESSION["logado"]!= TRUE)) {
		header("Location: login.php");
	}
		
	if ($_POST["acao"]==="incluir")	{
		// Inclusão de produto
		$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
					
		$produto = $_POST['produto'];					
		$descricaoProduto = $_POST['descricaoProduto'];
		$precoVenda = $_POST['precoVenda'];	
					
				    
		// criando a linha de INSERT
		$sql =  "INSERT INTO `tbproduto` ".
				"(`idProduto`, `produto`,".
				"`descricaoProduto`, `precoVenda`, ".
				"`promocao`, `precoPromocao`, `nomeFoto`) ".
				"VALUES (NULL,'$produto', '$descricaoProduto', ".
				"'$precoVenda', 'n', '0.0', 'sem-foto.png');";
				// executando instrução SQL
				$resultado = @mysqli_query($conexao, $sql);
				$idProduto = mysqli_insert_id($conexao);
				if (!$resultado) {
					die('Query Inválida: ' . @mysqli_error($conexao));
					echo "<form action='listarProduto.php'>";
					echo "<button type='submit'>Voltar</button>";
					echo "</form>";
				}
		mysqli_close($conexao);
	} elseif ($_POST["acao"]==="alterar") {
		// Alteração de produto
		$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
				
		$idProduto = $_POST["idProduto"];
		$produto = $_POST['produto'];					
		$descricaoProduto = $_POST['descricaoProduto'];
		$precoVenda = $_POST['precoVenda'];	
					
				    
		// criando a linha de Alteração
		
		$sql = "UPDATE `tbproduto` SET".
			   "`produto` = '$produto',".
		       "`descricaoProduto` = '$descricaoProduto',".
		       "`precoVenda` = '$precoVenda' ".
		       "WHERE `tbproduto`.`idProduto` = $idProduto;";
			   echo $idProduto;
			   echo $sql;
		
		// executando instrução SQL
		$resultado = @mysqli_query($conexao, $sql);
		if (!$resultado) {
			die('Query Inválida: ' . @mysqli_error($conexao));
			echo "<form action='listarProduto.php'>";
			echo "<button type='submit'>Voltar</button>";
			echo "</form>";				
		} 
		mysqli_close($conexao);
		
		
	} else {
		// erro
		echo "<h1 style=\"color:red;\">Erro na Operação. Não foi possível alterar ou incluir</h1>";
		echo "<form action='listarProduto.php'>";
		echo "<button type='submit'>Voltar</button>";
		echo "</form>";
	}
		
	// upload da imagem	
		
	if ( isset( $_FILES[ 'imagemProduto' ][ 'name' ] ) && ($_FILES[ 'imagemProduto' ][ 'error' ] == 0 )) {
		
		
		// upload do nova imagem
		$arquivo_tmp = $_FILES[ 'imagemProduto' ][ 'tmp_name' ];
		$nome = $_FILES[ 'imagemProduto' ][ 'name' ];
 	
		$extensao = strtolower ( pathinfo ( $nome, PATHINFO_EXTENSION ) );
 
		if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
				    
        	$novoNome = uniqid ( time () ) . '.' . $extensao;
			$destino = '../imagens/'.$novoNome;
			
			if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
				
				// registrando o nome da imagem no banco de dados
				
				$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
				
				if($_POST["acao"]==="alterar") {$idProduto = $_POST["idProduto"];}
				    
				// criando a linha de Alteração
		
				$sql =  "UPDATE `tbproduto` SET".
						"`nomeFoto` = '$novoNome' ".
						"WHERE `tbproduto`.`idProduto` = $idProduto;";
		
				// executando instrução SQL
				$resultado = @mysqli_query($conexao, $sql);
				if (!$resultado) {
					die('Query Inválida: ' . @mysqli_error($conexao));
					echo "<form action='listarProduto.php'>";
					echo "<button type='submit'>Voltar</button>";
					echo "</form>";				
				} 
				mysqli_close($conexao);
		
				// removendo a imagem antiga
				$nomeFotoAntiga = $_POST["nomeFotoAntiga"];
				if (file_exists("../imagens/".$nomeFotoAntiga)&&($nomeFotoAntiga!=="sem-foto.png")) {
					unlink("../imagens/".$nomeFotoAntiga);
				}				
				header("Location: listarProduto.php");
        	} else {
					echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
					echo "<form action='listarProduto.php'>";
					echo "<button type='submit'>Voltar</button>";
					echo "</form>";	
			}
		} else {
			echo "<p>Somente são permitidos extensões: .jpg;.jpeg;.gif;.png</p>";
			echo "<form action='listarProduto.php'>";
			echo "<button type='submit'>Voltar</button>";
			echo "</form>";	
			
		}
	} else {
		header("Location: listarProduto.php");
	}
?>
