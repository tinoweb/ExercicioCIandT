<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Exercicio 1</title>
	<link rel="stylesheet" href="">
</head>
<body>
	
</body>
</html>
<?php

$location = array(
    "Brasil" => "Brasilia",
    "Portugal" => "Lisboa",
    "Cabo verde" => "Praia",
    "França" => "Paris",
    "Senegal" => "Dakar",
);


foreach ($location as $key => $value) {
	echo "A Capital do <strong>".$key."</strong> é <strong>".$value."</strong><br>";
}