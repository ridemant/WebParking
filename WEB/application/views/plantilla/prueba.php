<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<title>Prueba de nombres</title>
</head>
<body>
	<h1>Karina :(</h1>
	<ol>
		<?php

			$arreglo = arr_genero();
			foreach($arreglo as  $v => $k) echo "<li>".$v." - ".$k['url_seo']."</li>";

		?>
	</ol>
</body>
</html>