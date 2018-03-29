<?php 


if (isset($_POST["enviar"])) {
	
	if (isset($_POST["tel"]) && isset($_POST["monto"]) && isset($_POST["ordenid"]) &&
		 isset($_POST["llide"]) && isset($_POST["llenc"]) && isset($_POST["metodo"]) && isset($_POST["userv"])) 
	{
			require 'CTripleDes.php';
			require 'lib/nusoap.php';
			require 'LogicaIntegracion.php';
	
		$servicio = new LogicaIntegracion(trim($_POST["llide"]),trim($_POST["llenc"]),trim($_POST["userv"]));

		echo  $servicio->realizarPago(trim($_POST["metodo"]),true,trim($_POST["ordenid"]),trim($_POST["monto"]),trim($_POST["tel"]));
	}
	else{
		echo "<h1>Proporciona los datos</h1>";
	}	
}

?>
<html>
<head>
	<title>Prueba Integracion</title>
	<meta charset="utf8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/> 
</head>
<body>
	<section class="container">

		<div class="row">

			<center> <h1>Pruebas de Integracion con Tigo Money - PHP </h1> </center>

			<form method="post" class="col-xs-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">

				<div class="form-group">
					<br>
					<label>Linea:</label>
					<input type="number" name="tel" class="form-control"/>
					<br>
					<label>Monto:</label>
					<input type="number" name="monto" class="form-control"/>
					<br>
					<label>Número de orden:</label>
					<input type="number" name="ordenid" class="form-control"/>
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
					<select name="metodo">
						<option value="solicitarPago">Sincrono</option>
						<option value="solicitarPagoAsincrono">Asincrono</option>
					</select>
				</div>
				<center><input type="submit" name="enviar" class="btn btn-primary"/></center>
			</form>

		</div>
		
	</section>

</body>
<script type="text/javascript" src="assets/javascript/jquery.js"></script>
</html>
