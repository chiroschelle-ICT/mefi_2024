<?php
	session_start();
	
	if($_SESSION["login"] != 1000)
	{
		$url = "../login/";
		echo "<meta http-equiv='refresh' content='0;URL=$url' />";
	}
	
?>
<!DOCTYPE html>
<html lang="nl">

<head>
	<title>Medische Fiches Online!</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
		integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<!-- Required meta tags-->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Colorlib Templates">
	<meta name="author" content="Colorlib">
	<meta name="keywords" content="Colorlib Templates">

	<!-- Title Page-->
	<title>Medische Fiche Online!</title>

	<!-- Icons font CSS-->
	<link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
	<link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
	<!-- Font special for pages-->
	<link
		href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet">

	<!-- Vendor CSS
	<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
	<link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">-->

	<!-- Main CSS-->
	<link href="../css/main.css" rel="stylesheet" media="all">

	<script>
		function clearTable() {
			document.getElementById("individueleFiche").innerHTML = "";
		}

		function printTable() {
			var table = document.getElementById("fiche");
			if (table) {
				var newWin = window.open("");
				newWin.document.write(table.outerHTML);
				newWin.print();
				newWin.close();
			}
		}
	</script>
	
	<?php
		include('../php/functions.php');
	?>
	

</head>

<body>
	<div class="page-wrapper bg-gra-03 p-t-30 p-b-100 font-poppins">
		<div class="wrapper wrapper--w960 p-b-30">
			<img class="chiro-logo" src="../img/chiro.png" alt="Chiro Schelle">
		</div>
		<div class="wrapper wrapper--w960">
			<div class="card card-4">
				<div class="card-body">
					<h2 class="title">Admin pagina</h2>
                    
                    
                    <form method="POST">
    					<div class="row row-space">
    						<div class="col-1">
    							<div class="input-group">
    							    
    								<input class="input--style-4" type="text" name="zoek"
    									placeholder="Zoek op naam, voornaam of afdeling" required>
    								<input name="function" value="Zoeken" hidden>
    								<span class="input-group-addon">
										<button type="submit"></button>  
									</span>
    							</div>
    						</div>
    					</div>
					
    					<div class="row row-space">
    						<div class="col-5">
    							<div class="checkbox checkbox-inline checkbox-danger">
    								<input type="checkbox" class="styled" id="inlineCheckbox1" name="veggie"
    									value="Veggie">
    								<label for="inlineCheckbox1"> Veggie </label>
    							</div>
    						</div>
    						<div class="col-5">
    							<div class="checkbox checkbox-inline checkbox-danger">
    								<input type="checkbox" class="styled" id="inlineCheckbox2" name="allergie"
    									value="Allergie">
    								<label for="inlineCheckbox2"> Voedselalergieën </label>
    							</div>
    						</div>
    						<div class="col-5">
    							<div class="checkbox checkbox-inline checkbox-danger">
    								<input type="checkbox" class="styled" id="inlineCheckbox3" name="foto"
    									value="Foto">
    								<label for="inlineCheckbox3">Geen foto site </label>
    							</div>
    						</div>
    						<div class="col-5">
    							<div class="checkbox checkbox-inline checkbox-danger">
    								<input type="checkbox" class="styled" id="inlineCheckbox4" name="suikerziekte"
    									value="Suikerziekte">
    								<label for="inlineCheckbox4"> Suikerziekte </label>
    							</div>
    						</div>
    						<div class="col-5">
    							<div class="checkbox checkbox-inline checkbox-danger">
    								<input type="checkbox" class="styled" id="gevoeligStoffenVoeding" name="gevoeligStoffenVoeding"
    									value="gevoeligStoffenVoeding">
    								<label for="gevoeligStoffenVoeding"> Gevoelig aan... </label>
    							</div>
    						</div>
    						<div class="col-5">
    							<div class="checkbox checkbox-inline checkbox-danger">
    								<input type="checkbox" class="styled" id="lactose" name="lactose"
    									value="lactose">
    								<label for="lactose"> Lactose... </label>
    							</div>
    						</div>
    						<div class="col-5">
    							<div class="checkbox checkbox-inline checkbox-danger">
    								<input type="checkbox" class="styled" id="MedicatieLijst" name="MedicatieLijst"
    									value="MedicatieLijst">
    								<label for="MedicatieLijst"> MedicatieLijst... </label>
    							</div>
    						</div>
    						
    						<div class="col-5">
    							<div class="checkbox checkbox-inline checkbox-danger">
    								<input type="checkbox" class="styled" id="inlineCheckbox5" name="leeg"
    									value="Leeg">
    								<label for="inlineCheckbox5"> Andere allergieën </label>
    							</div>
    						</div>
    					</div>
					</form>
					<br><hr><br>
					<button class="btn btn-danger print-button" onclick="printTable()">Printen</button>
					<br>


                    <div id="individueleFiche">
                    <?php
							if(isset($_GET["function"]))
    						{
    							if($_GET["function"] == "Fiche")
    							{
    							    echo IndividueleFiche($_GET["id"]);
    							}
    						}

                            if(isset($_POST["function"]))
    						{
    						    $query = " WHERE 1 = 1";


        						if(isset($_POST["veggie"]) && $_POST["veggie"] == "Veggie")
        						{
        							$query .= ' AND Vegetarisch = "Ja"';
        						}
        						if(isset($_POST["gevoeligeStoffenVoeding"]) && $_POST["gevoeligStoffenVoeding"] == "gevoeligStoffenVoeding")
        						{
        							$query .= ' AND GevoeligStoffenVoeding != "Nee,"';
        						}
        						if(isset($_POST["lactose"]) && $_POST["lactose"] == "lactose")
        						{
        							$query .= ' AND Lactose != "Nee"';
        						}
        						if(isset($_POST["allergie"]) && $_POST["allergie"] == "Allergie")
        						{
        							$query .= ' AND AllergieMedicatie LIKE "Ja%"';
        						}
        						if(isset($_POST["foto"]) && $_POST["foto"] == "Foto")
        						{
        							$query .= ' AND ToestemmingFoto = "Nee"';
        						}
        						if(isset($_POST["suikerziekte"]) && $_POST["suikerziekte"] == "Suikerziekte")
        						{
        							$query .= ' AND ZiektenLijst LIKE "%suikerziekte%"';
        						}
        						if(isset($_POST["MedicatieLijst"]) && $_POST["MedicatieLijst"] == "MedicatieLijst")
        						{
        							$query .= ' AND MedicatieLijst != ", , <br>"';
        						}
        						if(isset($_POST["AndereAllergie"]) && $_POST["AndereAllergie"] == "AndereAllergie")
        						{
        							$query .= ' AND AndereAllergie != "Nee,"';
        						}
        						if($_POST["function"] == "Zoeken")
        						{
									echo "<script>clearTable();</script>";
        							echo Zoeken($_POST["zoek"], $query);
        						}
    						}
    						
    					?>
                    </div>

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

</body>

</html>