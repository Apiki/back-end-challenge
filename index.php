<!DOCTYPE html>
<html>
	<head>
		<title>Conversor de Moedas</title>
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	</head>
	<body>
		<div class="box">
			<h3 class="text-center">Conversor de Moedas</h3>
			<form method="POST" action="validate.php" class="form" id="form_data">
				<div class="form-row">
					<div class="col-6">
						<label for="value">Valor</label>
						<input type="text" name="value" class="form-control" required>
					</div>
					<div class="col-6">
						<label for="type_coin">Tipo</label>
						<select name="type_coin" class="form-control"required>
							<option>Real</option>
							<option>Dólar</option>
							<option>Euro</option>
						</select>
					</div>
				</div>
				<br>
				<div class="form-row">
					<div class="col-6">
						<label for="to_convert">Converter em</label>
						<select name="to_convert" class="form-control" required>
							<option>Real</option>
							<option>Dólar</option>
							<option>Euro</option>
						</select>
					</div>
					<div class="col-6">
						<label for="quotation">Cotação</label>
						<input type="text" name="quotation" class="form-control" required>
					</div>
				</div>
				<br>
				<div class="form-row">
					<div class="col-12">
						<input type="submit" value="Converter" class="btn btn-dark btn-block">
					</div>
				</div>
			</form>
			<hr>			
			<p class="text-muted">Resultado</p>
			<h1 id="result"></h1>
		</div>

		<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="assets/js/script.js"></script>
	</body>
</html>