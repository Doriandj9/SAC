<?php
	if(isset($_SESSION['email'])){
		header('location: /home');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/public/css/styles_component.css">
	<link rel="stylesheet" href="/public/css/styles_layout.css">
	<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
	<title><?= $title; ?></title>
</head>
<body>
	<div class="maincontain">

		<div class="header" style="background-image: url(/public/img/sac.png);"></div>
	
		 <div >
		 <?= $content ?>
		</div> 
		
		
		<div class="footer">
			<div class="cc" style="background-image: url(/public/img/cc.png);"></div>
			<div>Esta obra está bajo una Licencia Creative Commons Atribución - No Comercial - Sin Obras Derivadas 3.0 Ecuador <br>This site is powered by Carrera de Software</div>
		</div>
	</div>
</body>
<script src="/public/js/jss.js"></script>
</html>