
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Exercicio 4</title>
	<link rel="stylesheet" href="">
	<style>
		.styleformat{
		    position: relative;
		    width: 30%;
		    left: 30%;
		    margin-top: 5%;
		}
		legend {
		    background-color: #000;
		    color: #fff;
		    padding: 3px 6px;
		}
		label {
		    margin-top: 1rem;
		    display: block;
		    font-size: .8rem;
		}
	</style>
</head>
<body>
	<fieldset class="styleformat">
		<legend>Cadastro de Usuario</legend>
		<form action="exercicio4.php" method="POST" enctype="multipart/form-data">
			<div>
				<label for="nome">Nome</label>
				<input type="text" name="nome"><br>
			</div>
			<div>
				<label for="sobreNome">Sobre Nome</label>
				<input type="text" name="sobreNome"><br>
			</div>
			<div>
				<label for="email">Email</label>
				<input type="email" name="email" required=""><br>
			</div>
			<div>
				<label for="telefone">Telefone</label>
				<input type="phone" name="telefone" required=""><br>
			</div>
			<div>
				<label for="login">Login</label>
				<input type="text" name="login"><br>
			</div>
			<div>
				<label for="senha">Senha</label>
				<input type="password" name="senha"><br>
			</div>
			<p></p>
			<input type="submit" name="enviar"  value="Enviar">
		</form>
	</fieldset>
</body>
</html>


<?php
$arquivos = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$data["nome"]		=  	$_POST["nome"];
	$data["sobreNome"]	=  	$_POST["sobreNome"];
	$data["email"]		= 	$_POST["email"];
	$data["telefone"]	=  	$_POST["telefone"];
	$data["login"]		=	$_POST["login"]; 
	$senha 				= 	md5($_POST["senha"]);
	$data["senha"]		=   $senha;

	$content = unserialize(file_get_contents('registros.txt'));

	$todos = array();
	if (empty($content)) {

		$data = [$data];
		$saida = serialize($data);
		file_put_contents("registros.txt", $saida);

	}
	else{

		for ($i=0; $i < count($content); $i++) { 
			if (count($content)>1) {
				$todos[$i] = $content[$i];
				$todos[count($content)] = $data;
			}else{
				$todos[$i] = $content[$i];
				$todos[$i+count($content)] = $data;
			}
		}
		$serializado = serialize($todos);
		file_put_contents('registros.txt', $serializado);
	}

	echo "<pre>";
	print_r($todos);

}

