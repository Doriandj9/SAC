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
		
		<div class="body">
			
			<div><div class="menu_box" id="bxs">
				<div class="menu_head">Menu Principal</div>
					<div class="menu_body">
						<div class="menu">
						<a href="/home">Inicio</a>
						<?php  if(!empty($user->getResponsability()) && $user->getResponsability()[0]->nombre_responsabilidad  
						== \web\Responsability::EVALUADOR):?>
						<a href="/evaluation/evidences">Evaluación</a>
						<a href="/generate/reports">Reportes</a>
						<?php else: if($user->hashPermission(\entity\Teachers::ADMINSTRADOR)):?>
							<a href="/admin/upload/information">Cargar Informacion</a>
						<a href="/admin/permises/access">Permisos de Acceso</a>
						<a href="/generate/reports">Configuracion Basica</a>
						<?php else: ?>
							<a href="/entry/evidences">Ingreso</a>
						<a href="/show/evidences">Evidencias</a>
						<a href="/generate/reports">Reportes</a>
						<?php endif; ?>
							<?php endif; ?>					
						<a href="/change/password">Cambiar clave</a>
						<a href="/exit">Salir</a>
						
						</div>
					</div>
			</div></div>

			<div><div class="contain_box" id="bxs">
				<div class="contain_head">
					<div id="ico"><img src="/public/img/perfil.svg" alt="perfil-icon" width="30px"></div>
					<div id="wel">Bienvenido(a): <?= $user->nombre_profesor?> </div>
					<div id="car">Carrera de: {nombre_carrera}</div>
				</div>
				<div class="contain_body">
					<?= $content; ?>
				</div>
			</div></div>

		</div>
		
		<div class="footer">
			<div class="cc" style="background-image: url(/public/img/cc.png);"></div>
			<div>Esta obra está bajo una Licencia Creative Commons Atribución - No Comercial - Sin Obras Derivadas 3.0 Ecuador <br>This site is powered by Carrera de Software</div>
		</div>
	</div>
</body>
<script src="/public/js/jss.js"></script>
</html>