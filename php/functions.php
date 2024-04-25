<?php

	if(isset($_POST["function"]))
	{
		if($_POST["function"] == "Login")
		{
			Login($_POST["user"], $_POST["pass"]);
		}

		if($_POST["function"] == "Vegie")
		{
			Vegie();
		}

		if($_POST["function"] == "NieuweFiche")
		{
			 if (isset($_POST["LactoseX"])){
				 $LactoseX = $_POST["LactoseX"];
			 }
			 else{
				$LactoseX = "/";
			 }
			 $link = LinkDB();
			 
			 NieuweFiche($_POST["Zwemmen"]/* , $_POST["VaccinatieCovid"], $_POST["Covid"] */, $link -> real_escape_string($_POST["Mutualiteit"]), $_POST["ToestemmingMedicatieKind"], $_POST["Wachtrij"], $link -> real_escape_string($_POST["Email"]),$_POST["Lactose"],$LactoseX,$_POST["ToestemmingFoto"],$_POST["Afdeling"],$link -> real_escape_string($_POST["Naam"]),$link -> real_escape_string($_POST["Voornaam"]),$_POST["Geboortedatum"],$link -> real_escape_string($_POST["Straat"]),$link -> real_escape_string($_POST["Nummer"]),$link -> real_escape_string($_POST["Postcode"]),$link -> real_escape_string($_POST["Woonplaats"]),$link -> real_escape_string($_POST["Telefoon1"]),$link -> real_escape_string($_POST["Telefoon2"]),$link -> real_escape_string($_POST["NaamVoornaam1"]),$link -> real_escape_string($_POST["NaamVoornaam2"]),$link -> real_escape_string($_POST["Verwantschap1"]),$link -> real_escape_string($_POST["Verwantschap2"]),$link -> real_escape_string($_POST["NaamHuisarts"]),$link -> real_escape_string($_POST["TelefoonArts"]),$link -> real_escape_string($_POST["Bloedgroep"]),$link -> real_escape_string($_POST["RhesusFactor"]), $_POST["ZiektenLijst"], $_POST["GevoeligStoffenVoeding"],$_POST["AndereAllergie"], $_POST["Ingrepen"], $_POST["VaccinatieTetanus"], $_POST["AllergieMedicatie"],$_POST["Vegetarisch"],$_POST["Halal"],$_POST["Incontinent"],$_POST["DeelnemenSport"],$_POST["ToestemmingMedicatie"],$_POST["ToestemmingIngrepen"],$link -> real_escape_string($_POST["AndereInlichtingen"]),$link -> real_escape_string($_POST["NaamInvuller"]), $_POST["MedicatieLijst"]);
             mysqli_close($link);
		}
	}

	if(isset($_GET["function"]))
	{
		if($_GET["function"] == "Logout")
		{
			Logout();
		}
	}

	function LinkDB()
	{
		include 'password.php';

		// Check connection
		if (mysqli_connect_errno())
		{
			$link = false;
			return $link;
		}
		else
		{
			return $link;
		}
	}

	function Login($user, $password)
	{
		$link = LinkDB();
		$user = strtolower($user);
		$password = md5($password);

		if($link != false)
		{
			$sql="SELECT * FROM user";
			$result=mysqli_query($link,$sql);

			// Associative array
			while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				if($row["login"] == $user && $row["password"] == $password)
				{
					$_SESSION["login"] = 1000;
					$_SESSION["user"] = $row["login"];
					$url = "../admin/";
					echo "<meta http-equiv='refresh' content='0;URL=$url' />";
					exit();
				}
			}

			$_SESSION["login"] = 0;
			$_SESSION["meldingLogin"] = "Login Fout!";
			$url = "../login/";
			//echo "<meta http-equiv='refresh' content='0;URL=$url' />";
		}
		else
		{
			echo "Error connecting to database";
			$_SESSION["login"] = 0;
		}
	}

	function Logout()
	{
		session_destroy();

		$url = "../login/";
		echo "<meta http-equiv='refresh' content='0;URL=$url' />";
	}

	function Zoeken($zoek, $query)
	{
		$link = LinkDB();
		$html = null;

		if($link != false)
		{
			if ($zoek == null) {
				$html .= "<p style='color: red; margin-bottom: 20px; font-size: 150%; text-align: center;'>Voer een zoekopdracht in!</p>";
			}
			else
			{
				if($zoek == "*")
				{
					$sql="SELECT DISTINCT Naam, Voornaam, Afdeling, IDlid FROM lid_2024";
					$sql .= $query;
					//echo $sql;
				}
				else
				{


					
					$sql="
					SELECT DISTINCT Naam, Voornaam, Afdeling, IDlid 
					FROM lid_2024 
					WHERE Voornaam LIKE '%$zoek%'
					OR Naam LIKE '%$zoek%' 
					OR Afdeling LIKE '%$zoek%' 
					ORDER BY Naam ASC;
					";

				}

				
				$result=mysqli_query($link,$sql);

				// Associative array
				$html .= "<br>";
				
				if(mysqli_num_rows($result) > 0)
				{
					while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
						$html .= "<p><a href='?function=Fiche&id=".$row["IDlid"]."'> " . $row["Naam"] . " - " . $row["Voornaam"] . " - " . $row["Afdeling"] . "</a></p><br>";
					}
				}
				else {
					$html .= "<p>Geen resultaten</p>";
				}
				
			}
		}

		return $html;
	}

	function NieuweFiche($Zwemmen, $Mutualiteit, $ToestemmingMedicatieKind, $wachtrij, $Email, $Lactose ,$LactoseX, $ToestemmingFoto, $Afdeling ,$Naam ,$Voornaam ,$Geboortedatum ,$Straat ,$Nummer ,$Postcode ,$Woonplaats ,$Telefoon1 ,$Telefoon2 ,$NaamVoornaam1 ,$NaamVoornaam2 ,$Verwantschap1 ,$Verwantschap2 ,$NaamHuisarts ,$TelefoonArts ,$Bloedgroep ,$ResusFactor ,$ZiektenLijst ,$GevoeligStoffenVoeding , $AndereAllergie, $Ingrepen ,$VaccinatieTetanus, $AllergieMedicatie ,$Vegetarisch , $Halal ,$Incontinent ,$DeelnemenSport ,$ToestemmingMedicatie ,$ToestemmingIngrepen ,$AndereInlichtingen ,$NaamInvuller , $MedicatieLijst)
	{		
		$Afdeling = ucwords((strtolower($Afdeling)));
		$Naam = ucwords((strtolower($Naam)));
		$Voornaam = ucwords((strtolower($Voornaam)));
		$Straat = ucwords((strtolower($Straat)));
		$Woonplaats = ucwords((strtolower($Woonplaats)));
		if (empty($Telefoon2)) { 
		    $Telefoon2 = "/";
		}
		$NaamVoornaam1 = ucwords((strtolower($NaamVoornaam1)));
		if (!empty($NaamVoornaam2)){
		    $NaamVoornaam2 = ucwords((strtolower($NaamVoornaam2)));
		}
		else {
		    $NaamVoornaam2 = "/";
		}
		$Verwantschap1 = ucwords((strtolower($Verwantschap1)));
		if (!empty($Verwantschap2)){
		    $Verwantschap2 = ucwords((strtolower($Verwantschap2)));
		}
		else {
		    $Verwantschap2 = "/";
		}
		$NaamHuisarts = ucwords((strtolower($NaamHuisarts)));
		$NaamInvuller = ucwords((strtolower($NaamInvuller)));

		date_default_timezone_set("Europe/Brussels");
		$Datum = date("d/m/Y H:i");

        //Dit fuckte met de database
        //$Geboortedatum = date("d/m/Y", strtotime($Geboortedatum));

		//ZiektenLijst ja, text
		$temp = null;
		$teller = 0;

		foreach ($ZiektenLijst as $value)
		{
			if($value == "") {
			    $temp .= "<br> Andere ";
			}

			$temp .= $value . ", ";
		}
		$ZiektenLijst = $temp;
		
		//Einde ZiektenLijst

		//GevoeligStoffenVoeding ja, text
		$temp = null;
		$teller = 0;
		foreach ($GevoeligStoffenVoeding as $value)
		{
			if($teller == 0)
			{
				$temp .= $value . ", ";
				$teller++;
			}
			else
			{
				$temp .= $value;
			}
		}
		$GevoeligStoffenVoeding = $temp;
		//Einde GevoeligStoffenVoeding
		
		//Andere allergie ja, text
		$temp = null;
		$teller = 0;
		foreach ($AndereAllergie as $value)
		{
			if($teller == 0)
			{
				$temp .= $value . ", ";
				$teller++;
			}
			else
			{
				$temp .= $value;
			}
		}
		$AndereAllergie = $temp;
		//Einde GevoeligStoffenVoeding

		//Ingrepen ja, text
		$temp = null;
		$teller = 0;
		foreach ($Ingrepen as $value)
		{
			if($teller == 0)
			{
				$temp .= $value . ", ";
				$teller++;
			}
			else
			{
				$temp .= $value;
			}
		}
		$Ingrepen = $temp;
		//Einde Ingrepen

		//VaccinatieTetanus ja, text
		$temp = null;
		$teller = 0;
		foreach ($VaccinatieTetanus as $value)
		{
			if($teller == 0)
			{
				$temp .= $value . ", ";
				$teller++;
			}
			else
			{
				$temp .= $value;
			}
		}
		$VaccinatieTetanus = $temp;
		//Einde VaccinatieTetanus

		/*SerumTetanus ja, text
		$temp = null;
		$teller = 0;
		foreach ($SerumTetanus as $value)
		{
			if($teller == 0)
			{
				$temp .= $value . ", ";
				$teller++;
			}
			else
			{
				$temp .= $value;
			}
		}
		$SerumTetanus = $temp;
		//Einde SerumTetanus */

		//AllergieMedicatie ja, text
		$temp = null;
		$teller = 0;
		foreach ($AllergieMedicatie as $value)
		{
			if($teller == 0)
			{
				$temp .= $value . ", ";
				$teller++;
			}
			else
			{
				$temp .= $value;
			}
		}
		$AllergieMedicatie = $temp;
		//Einde AllergieMedicatie

		$AndereInlichtingen = ucfirst(strtolower($AndereInlichtingen));
		$NaamInvuller = ucfirst(strtolower($NaamInvuller));

		//MedicatieLijst Medicatie, Tijdstip, Reden
		$temp = null;
		$teller = 0;
		foreach ($MedicatieLijst as $value)
		{
			if($teller == 2)
			{
				$temp .= $value . "<br>";
				$teller = 0;
			}
			else
			{
				$temp .= $value . ", ";
				$teller++;
			}
		}
		$MedicatieLijst = $temp;
		//Einde MedicatieLijst


		$sql = "INSERT INTO `lid_2024`(`Zwemmen`, `Mutualiteit`, `ToestemmingMedicatieKind`, `wachtrij`, `Email`, `Lactose`, `LactoseX`, `ToestemmingFoto`,`Afdeling`, `Naam`, `Voornaam`, `Geboortedatum`, `Straat`, `Nummer`, `Postcode`, `Woonplaats`, `Telefoon1`, `Telefoon2`, `NaamVoornaam1`, `NaamVoornaam2`, `Verwantschap1`, `Verwantschap2`, `NaamHuisarts`, `TelefoonArts`, `Bloedgroep`, `ResusFactor`, `ZiektenLijst`, `GevoeligStoffenVoeding`, `AndereAllergie`, `Ingrepen`, `VaccinatieTetanus`, `AllergieMedicatie`, `Vegetarisch`,`Halal`, `Incontinent`, `DeelnemenSport`, `ToestemmingMedicatie`, `ToestemmingIngrepen`, `AndereInlichtingen`, `NaamInvuller`, `Datum`, `MedicatieLijst`)
		VALUES ('$Zwemmen', '$Mutualiteit', '$ToestemmingMedicatieKind', '$wachtrij', '$Email', '$Lactose', '$LactoseX', '$ToestemmingFoto', '$Afdeling', '$Naam', '$Voornaam', '$Geboortedatum', '$Straat', '$Nummer', '$Postcode', '$Woonplaats', '$Telefoon1', '$Telefoon2', '$NaamVoornaam1', '$NaamVoornaam2', '$Verwantschap1', '$Verwantschap2', '$NaamHuisarts', '$TelefoonArts', '$Bloedgroep', '$ResusFactor', '$ZiektenLijst', '$GevoeligStoffenVoeding', '$AndereAllergie', '$Ingrepen', '$VaccinatieTetanus', '$AllergieMedicatie', '$Vegetarisch', '$Halal', '$Incontinent', '$DeelnemenSport', '$ToestemmingMedicatie', '$ToestemmingIngrepen', '$AndereInlichtingen', '$NaamInvuller', '$Datum', '$MedicatieLijst')";

		$link = LinkDB();

		if($link != false)
		{
			if (!mysqli_query($link,$sql)) {
				printf("Error: %s\n", mysqli_error($link)); /////////////////////////////////////////////////////////////////////////////////
			} else {
				$_SESSION["melding"] = "Medische Fiche Succesvol Ingediend!";
				$url = "../bivakinschrijving/succes/";
				
				if(true) //$wachtrij == 0
				{
					//API CALL
					$paymentLink = ApiCall($Afdeling, $Voornaam, $Naam, $Email);
					
					GoToSuccess($paymentLink, true);
					//echo "<meta http-equiv='refresh' content='0;URL=$url?PaymentLink=".$paymentLink."' />";
				}
				else
				{
					GoToSuccess('U staat in de wachtrij, Chiro Schelle neemt contact met u op van zodra er een plekje vrijkomt.', false);
				}
			}
		}
		else
		{
			$_SESSION["melding"] = "Er Is Iets Fout Gelopen, Probeer Opnieuw!";
		}
	}

	function IndividueleFiche($id)
	{
		$link = LinkDB();
		$html = null;

		if($link != false)
		{
			$sql="SELECT * FROM lid_2024 WHERE IDlid = $id";
			$result=mysqli_query($link,$sql);

			// Associative array
			while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				$_SESSION["afdeling"] = $row["Afdeling"];

				$html = '<br>
							<table class="table table-bordered" id="fiche">
							<thead>
								<tr>
									<th class="text-center" colspan="2"><h3 style="color:#E51937;">'.$row["Naam"]." ".$row["Voornaam"]." - ".$row["Afdeling"].'</h3></th>
								</tr>
							</thead>
							<tr>
								<td width="30%">Geboortedatum</td>
								<td width="70%">'.$row["Geboortedatum"].'</td>
							</tr>
							<tr>
								<td>Adres</td>
								<td>'.$row["Straat"]." ".$row["Nummer"].", ".$row["Postcode"]." ".$row["Woonplaats"].'</td>
							</tr>
							<tr>
								<td>Gezinslid 1</td>
								<td>'.$row["NaamVoornaam1"].", ".$row["Telefoon1"].", ".$row["Verwantschap1"].'</td>
							</tr>
							<tr>
								<td>Gezinslid 2</td>
								<td>'.$row["NaamVoornaam2"].", ".$row["Telefoon2"].", ".$row["Verwantschap2"].'</td>
							</tr>
							<tr>
							    <td>Email</td>
							    <td>'.$row["Email"].'</td>
							</tr>
							<tr>
								<td>Huisarts</td>
								<td>'.$row["NaamHuisarts"].", ".$row["TelefoonArts"].'</td>
							</tr>
							<tr>
								<td>Mutualiteit</td>
								<td>'.$row["Mutualiteit"].'</td>
							</tr>
							<tr>
								<td>Bloedgroep</td>
								<td>'.$row["Bloedgroep"].'</td>
							</tr>
							<tr>
								<td>Rhesusfactor</td>
								<td>'.$row["ResusFactor"].'</td>
							</tr>
							<tr>
								<td>Ziektes</td>
								<td>'.$row["ZiektenLijst"].'</td>
							</tr>
							<tr>
								<td>Gevoelig aan voedingsmiddelen?</td>
								<td>'.$row["GevoeligStoffenVoeding"].'</td>
							</tr>
							<tr>
								<td>Andere allergieën?</td>
								<td>'.$row["AndereAllergie"].'</td>
							</tr>
							<tr>
								<td>Lactose intolerant?</td>
								<td>'.$row["Lactose"].'</td>
							</tr>
							<tr>
								<td>Indien \'Ja\', helemaal geen lactose? Of verwerkt in voeding?</td>
								<td>'.$row["LactoseX"].'</td>
							</tr>
							<tr>
								<td>Ingrepen</td>
								<td>'.$row["Ingrepen"].'</td>
							</tr>
							<tr>
								<td>Tetanus vaccin</td>
								<td>'.$row["VaccinatieTetanus"].'</td>
							</tr>
							<tr>
								<td>COVID19</td>
								<td>'.$row["Covid"].'</td>
							</tr>
							<tr>
								<td>COVID19 vaccin</td>
								<td>'.$row["VaccinatieCovid"].'</td>
							</tr>
							<tr>
								<td>Allergiën aan medicatie</td>
								<td>'.$row["AllergieMedicatie"].'</td>
							</tr>
							<tr>
								<td>Vegetarisch</td>
								<td>'.$row["Vegetarisch"].'</td>
							</tr>
							<tr>
								<td>Halal</td>
								<td>'.$row["Halal"].'</td>
							</tr>
							<tr>
								<td>Incontinent</td>
								<td>'.$row["Incontinent"].'</td>
							</tr>
							<tr>
								<td>Deelnemen aan sport</td>
								<td>'.$row["DeelnemenSport"].'</td>
							</tr>
							<tr>
								<td>Zwemmen</td>
								<td>'.$row["Zwemmen"].'</td>
							</tr>
							<tr>
								<td>Medicatielijst</td>
								<td>'.$row["MedicatieLijst"].'</td>
							</tr>
							<tr>
								<td>Toestemming om medicatie te geven?</td>
								<td>'.$row["ToestemmingMedicatie"].'</td>
							</tr>
							<tr>
								<td>Toestemming om medicatie zelf te nemen?</td>
								<td>'.$row["ToestemmingMedicatieKind"].'</td>
							</tr>
							<tr>
								<td>Toestemming om ingrepen te laten ondergaan?</td>
								<td>'.$row["ToestemmingIngrepen"].'</td>
							</tr>
							<tr>
								<td>Toestemming fotos</td>
								<td>'.$row["ToestemmingFoto"].'</td>
							</tr>
							<tr>
								<td>Andere inlichtingen</td>
								<td>'.$row["AndereInlichtingen"].'</td>
							</tr>
							<tr>
								<td>Naam van de invuller</td>
								<td>'.$row["NaamInvuller"].'</td>
							</tr>
							<tr>
								<td>Datum van het invullen</td>
								<td>'.$row["Datum"].'</td>
							</tr>
							<!--<thead>
								<tr>
									<th class="text-center" colspan="2"><h3 style="color:#f4d442;">'."Medicatielijst".'</h3></th>
								</tr>
								<tr>
									<td>Medicatie, Tijdstip, Reden</td>
									<td>'.$row["MedicatieLijst"].'</td>
								</tr>
							</thead>-->
						</table>';
			}
		}

		return $html;

		mysqli_free_result($result);
		mysqli_close($link);
	}

	function Vegie()
	{
		$link = LinkDB();
		$html = null;

		if($link != false)
		{
			$sql="SELECT DISTINCT Naam, Voornaam, Afdeling, IDlid FROM lid_2024 WHERE Vegetarisch = 'Ja' ORDER BY Naam ASC";


			$result=mysqli_query($link,$sql);

			// Associative array
			$html = "<ul class='nav'><hr>";

			while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				$html .= "<li><a href='?function=Fiche&id=".$row["IDlid"]."'> " . $row["Naam"] . " - " . $row["Voornaam"] . " - " . $row["Afdeling"] . "</a></li><hr>";
			}

			$html .= "</ul>";
		}

		return $html;
	}

	function Halal() // Function Not Used
	{
		$sql="SELECT DISTINCT Naam, Voornaam, Afdeling, IDlid FROM lid_2024 WHERE Halal = 'Ja' ORDER BY Naam ASC";


			$result=mysqli_query($link,$sql);

			// Associative array
			$html = "<ul class='nav'><hr>";

			while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				$html .= "<li><a href='?function=Fiche&id=".$row["IDlid"]."'> " . $row["Naam"] . " - " . $row["Voornaam"] . " - " . $row["Afdeling"] . "</a></li><hr>";
			}

			$html .= "</ul>";
	}

	function Allergie()//Voedselallergie
	{
		$link = LinkDB();
		$html = null;

		if($link != false)
		{
			$sql="SELECT DISTINCT Naam, Voornaam, Afdeling, IDlid FROM lid_2024 WHERE GevoeligStoffenVoeding like '%Ja%' ORDER BY Naam ASC";

			$result=mysqli_query($link,$sql);

			// Associative array
			$html = "<ul class='nav'><hr>";

			while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				$html .= "<li><a href='?function=Fiche&id=".$row["IDlid"]."'> " . $row["Naam"] . " - " . $row["Voornaam"] . " - " . $row["Afdeling"] . "</a></li><hr>";
			}

			$html .= "</ul>";
		}

		return $html;
	}
	
	function Foto()
	{
		$link = LinkDB();
		$html = null;

		if($link != false)
		{
			$sql="SELECT DISTINCT Naam, Voornaam, Afdeling, IDlid FROM lid_2024 WHERE ToestemmingFoto = 'Nee' ORDER BY Naam ASC";


			$result=mysqli_query($link,$sql);

			// Associative array
			$html = "<ul class='nav'><hr>";

			while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				$html .= "<li><a href='?function=Fiche&id=".$row["IDlid"]."'> " . $row["Naam"] . " - " . $row["Voornaam"] . " - " . $row["Afdeling"] . "</a></li><hr>";
			}

			$html .= "</ul>";
		}

		return $html;
	}
	
	function Suikerziekte()
	{
		$link = LinkDB();
		$html = null;

		if($link != false)
		{
			$sql="SELECT DISTINCT Naam, Voornaam, Afdeling, IDlid FROM lid_2024 WHERE ZiektenLijst = '%suikerziekte%' ORDER BY Naam ASC";


			$result=mysqli_query($link,$sql);

			// Associative array
			$html = "<ul class='nav'><hr>";

			while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				$html .= "<li><a href='?function=Fiche&id=".$row["IDlid"]."'> " . $row["Naam"] . " - " . $row["Voornaam"] . " - " . $row["Afdeling"] . "</a></li><hr>";
			}

			$html .= "</ul>";
		}

		return $html;
	}
	
	function ApiCall(string $afdeling, string $voornaam, string $achternaam, string $email)
	{	
		$webshopID = null;
		
		//CASE ($webshopID  invullen adhv afdeling)
		switch ($afdeling) 
		{
			case "Ribbel Meisjes":
				$webshopID = "53ffa81a-3f9f-4d55-b9bf-ba9d29828d63";
				break;
			case "Ribbel Jongens":
				$webshopID = "df6e747a-3abb-4e7d-8c98-9b39d7456453";
				break;
			case "Speelclub Meisjes":
				$webshopID = "b3ac965d-b0d3-47d7-b73d-92109a3faf83";
				break;
			case "Speelclub Jongens":
				$webshopID = "fcad6ec9-aa8d-464b-965f-1b2aeaa1ba7b";
				break;
			case "Kwiks":
				$webshopID = "6977560f-9e2f-4412-b9bd-07f0ad5b0b7a";
				break;
			case "Rakkers":
				$webshopID = "b88be805-45fd-4d4c-8656-21b0e1c40500";
				break;
			case "Tippers":
				$webshopID = "6c40330b-f04c-4095-92c8-62c213e79b1c";
				break;
			case "Toppers":
				$webshopID = "eb4d8cfd-b87e-4ae2-9013-a46f07e1ac06";
				break;
			case "Tiptiens":
				$webshopID = "b57fbd4d-bb5b-4e71-a79b-23541a571ba6";
				break;
			case "Kerels":
				$webshopID = "91736d85-b466-4afb-8ac2-6420e7bcb5bc";
				break;
			case "Aspi Meisjes":
				$webshopID = "b600c425-c1ff-45e7-92a4-a9b0bd262a53";
				break;
			case "Aspi Jongens":
				$webshopID = "9ff3932f-1468-4d87-846a-3d84f3e0f585";
				break;
			case "Kokkie":
				$webshopID = "cf55dd58-5ff1-4ced-a557-9c6732108867";  //Gezamelijke link Kookploeg & VB
				break;
			case "Kookploeg":
				$webshopID = "cf55dd58-5ff1-4ced-a557-9c6732108867";  //Gezamelijke link Kookploeg & VB
				break;
			case "Vb":
				$webshopID = "cf55dd58-5ff1-4ced-a557-9c6732108867";  //Gezamelijke link Kookploeg & VB
				break;
			case "Leiding":
				$webshopID = "2806c532-4eee-498b-a922-092b1ee64df9";
				break;
		}

		$token = RequestToken();
		$paymentLink = RequestPaymentLink($token, $webshopID, $voornaam, $achternaam, $email);
		
		return $paymentLink;
	}
	
	function RequestToken()
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,"https://api.tikket.be/v1/token/");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "username=service_chiroschelle_mefi&password=aXQp38Ckk7PVCVgiF");

		// Receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec($ch);

		curl_close ($ch);
		
		$jsonDecode = json_decode($server_output, true);
		
		return $jsonDecode["access"];
	}
	
	function RequestPaymentLink(string $token, string $webshopID, string $voornaam, string $achternaam, string $email)
	{		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,"https://api.tikket.be/v1/events/ea3e327e-cd72-4bbc-bcfe-9fbc4c0c4a6a/webshops/".$webshopID."/invites/");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Authorization: Bearer '.$token,));
	  
		curl_setopt($ch, CURLOPT_POSTFIELDS, "recipient=".$email."&first_name=".$voornaam."&last_name=".$achternaam."&sendmail=true");

		// Receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec($ch);

		curl_close ($ch);
		
		$jsonDecode = json_decode($server_output, true);
		
		/*echo "<pre>".print_r($jsonDecode, true)."</pre>";
		exit();*/
		
		return $jsonDecode["url"];
	}
	
	function GoToSuccess($paymentLink, $paymentBool)
	{
		$url = 'http://mefi.2023.chiroschelle.be/succes/index.php';

		// what post fields?
		$fields = array(
		   'PaymentLink' => $paymentLink,
		   'PaymentBool' => $paymentBool,
		);

		// build the urlencoded data
		$postvars = http_build_query($fields);

		// open connection
		$ch = curl_init();

		// set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);

		// execute post
		$result = curl_exec($ch);

		// close connection
		curl_close($ch);
	}
?>
