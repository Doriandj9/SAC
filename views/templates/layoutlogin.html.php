<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/public/css/styles_component.css">
	<link rel="stylesheet" href="/public/css/styles_layout.css">
	<title> <?= $title; ?></title>
</head>
<body>
	<div class="maincontain">

		<div class="header"></div>
		
		<div class="body">
			<?= $content ?>
		</div>
		
		<div class="footer">
			<div class="cc"></div>
			<div>Esta obra está bajo una Licencia Creative Commons Atribución - No Comercial - Sin Obras Derivadas 3.0 Ecuador <br>This site is powered by Carrera de Software</div>
		</div>
	</div>
</body>
</html>