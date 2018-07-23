
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Exercicio 3</title>
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
		<legend>Upload Arquivos</legend>
		<form action="exercicio3.php" method="POST" enctype="multipart/form-data">
			<div>
				<label for="mp4">Arquivo .mp4</label>
				<input type="file" name="mp4"><br>
			</div>
			<div>
				<label for="mov">Arquivo .mov</label>
				<input type="file" name="mov"><br>
			</div>
			<div>
				<label for="foto">Arquivo .jpeg</label>
				<input type="file" name="foto"><br>
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
	if (!empty($_FILES["mp4"]["name"])) {
		$file_mp4 = $_FILES["mp4"]["name"];
		$arquivos[] = $file_mp4;
	}
	if (!empty($_FILES["mov"]["name"])) {
		$file_mov = $_FILES["mov"]["name"];
		$arquivos[] = $file_mov;
	}
	if (!empty($_FILES["foto"]["name"])) {
		$file_foto = $_FILES["foto"]["name"];
		$arquivos[] = $file_foto;
	}

	$saida = retornaExtensao($arquivos);
?>
	<ol>
		<?php 
			foreach ($saida as $value) {
				echo "<li>".$value."</li>";
			}
		 ?>
	</ol>

<?php 	
}


function retornaExtensao($dados)
{
	$formatos = array();
	if (count($dados > 0)) {
		foreach ($dados as $value) {
			$position= strpos($value, ".");
			$fileextension= substr($value, $position + 1);
			$fileextension= strtolower($fileextension);
			$formatos[] = ".".$fileextension."<br>";
		}
	}
	sort($formatos);
	return $formatos;
}



?>