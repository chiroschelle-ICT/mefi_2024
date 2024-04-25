<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Medische Fiches Online!</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
		integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<!-- Required meta tags-->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Colorlib Templates">
	<meta name="author" content="Colorlib">
	<meta name="keywords" content="Colorlib Templates">

	<!-- Title Page-->
	<title>Medische Fiche Online!</title>

	<!-- Icons font CSS-->
	<link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
	<link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
	<!-- Font special for pages-->
	<link
		href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet">

	<!-- Vendor CSS-->
	<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
	<link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

	<!-- Main CSS-->
	<link href="../css/main.css" rel="stylesheet" media="all">
	<?php
		include('../php/functions.php');
	?>
</head>

<body>
	<div class="page-wrapper bg-gra-03 p-t-30 p-b-100 font-poppins">
		<div class="wrapper wrapper--w500 p-b-30">
			<img class="chiro-logo" src="../img/chiro.png" alt="Chiro Schelle">
		</div>
		<div class="wrapper wrapper--w500">
			<div class="card card-4">
				<div class="card-body">

                    <form method="POST">

					<div class="row row-space">
						<div class="col-1">
							<div class="input-group">
								<label class="label">Gebruikersnaam</label>
								<input class="input--style-4" type="text" name="user" required>
							</div>
						</div>
					</div>
					<div class="row row-space">
						<div class="col-1">
							<div class="input-group">
								<label class="label">Wachtwoord</label>
								<input class="input--style-4" type="password" name="pass" required>
							</div>
						</div>
					</div>


					<br><input type="submit" class="btn btn-danger btn-block" value="Login" name="function" />
					
					</form>
					
					<?php
						if(isset($_SESSION["meldingLogin"]))
						{
							echo $_SESSION["meldingLogin"];
						}
					?>
					
				</div>
			</div>

			<br>
			<div class="card card-4" style="background-color: #afafaf;">
				<div class="card-body" style="padding-top: 0px;">
					<div class="row row-space credit">
						<div class="col-1">
							<br>
							<p>Medische Fiche v2.1 Beta © Chiro Schelle<br>
								Made by Jonas Morel en Samme Robbroeckx</p>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>



	<!-- Main JS-->
	<script src="js/global.js"></script>
</body>

</html>