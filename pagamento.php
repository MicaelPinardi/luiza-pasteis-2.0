<?php
	session_start();
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagamento</title>
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

<main>
    <div class="tabela">
    
        <?php
    
        if(!isset($_SESSION['carrinho']) || ($_SESSION['carrinho']==NULL)){
            echo"<br><br><center><h2>Não há produtos no carrinho a serem comprados</h2>";?>
    
        <a href="index.php"><button>Voltar</button></a></center>
    
        <?php
        } else {
        ?>
        <center>
        <h2>Forma de pagamento:</h2>
            <br>
            <form action="finalizarCompra.php" method="POST">
            <input type="radio" name="pag" value="credito">Cartão de Crédito
            <input type="radio" name="pag" value="pix" checked> Pix
            <input type="radio" name="pag" value="boleto"> Boleto <br><br>
            <button class='button' type="submit">Concluir</button>
            </form>
    
        </center>
        <?php
        }
        ?>
    </div>
</main>


</body>
</html>


