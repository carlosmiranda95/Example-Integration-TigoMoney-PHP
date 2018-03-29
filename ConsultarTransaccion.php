<?php 
	
	if (isset($_POST["enviar"])) {

			if (isset($_POST["norden"]) && isset($_POST["llide"]) && isset($_POST["llenc"]) && isset($_POST["userv"]) && isset($_POST["metodo"]) ) {

				require 'CTripleDes.php';
				require 'lib/nusoap.php';
				require 'LogicaIntegracion.php';

				$servicio = new LogicaIntegracion(trim($_POST["llide"]),trim($_POST["llenc"]),trim($_POST["userv"]));
				echo $servicio->consultarEstado(trim($_POST["metodo"]),trim($_POST["norden"]));
				
			}
			else{
				echo "<h1>Llena los datos</h1>";
			}
	}

 ?>
<!DOCTYPE html>
<head>
	<title>Consultar estado de la Transacción TIGO MONEY - PHP</title>
	<meta charset="utf8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/> 
</head>
<body>
	<section class="container">

		<div class="row">

			<center> <h1>Consultar Estado de Transaccion TIGO MONEY - PHP </h1> </center>

			<form method="post" class="col-xs-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">

				<div class="form-group">
					<label>Numero de Orden:</label>
					<input type="number" name="norden" class="form-control"/>
					<br>
					<label>llave Identificacion:</label>
					<input type="text" name="llide" class="form-control"/>
					<br>
					<label>Llave Encriptacion:</label>
					<input type="text" name="llenc" class="form-control"/>
					<br>
					<label>Url Servicio:</label>
					<input type="text" name="userv" class="form-control"/>
					<br>
					<label>Método de Consumo:</label>
					<input type="text" name="metodo" class="form-control"/>
					<br>
				</div>
				<center><input type="submit" name="enviar" class="btn btn-primary"/></center>
			</form>

		</div>
		
	</section>

</body>
<script type="text/javascript" src="assets/javascript/jquery.js"></script>
</html>
