<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Exercicio 2 (a,b)</title>
	<link rel="stylesheet" href="">
</head>
<body>
	
</body>
</html>

<?php

function foiMordido()
{
	$mordido = rand(0, 100);

	if ($mordido<=50) {
		$retorno = true;
	}else{
		$retorno = false;
	}

	return $retorno;
}

	if (foiMordido() == true) {
		echo "Joãozinho <strong style='color: green'>Mordeu</strong> o seu dedo !";
	}else{
		echo "Joaozinho <strong style='color: red'>Não mordeu</strong> o seu dedo !";
	}

?>
