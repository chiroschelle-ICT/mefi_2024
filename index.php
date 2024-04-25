<?php
	session_start();
	include("php/functions.php");
?>
<!Doctype html>
<html lang="nl">

<head>
    <!-- Jquery JS
    <script src="vendor/jquery/jquery.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Medische Fiche Online!</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css?ver=<?php echo rand(111,999)?>" rel="stylesheet" media="all">

    <script style="text/javascript">
      function creeerElement(){
        var div = document.createElement('div');
        div.classList.add("row");
        div.classList.add("row-space");

        var div1 = document.createElement('div');
        div1.classList.add("col-3");
        div1.classList.add("input-group");
        var div2 = document.createElement('div');
        div2.classList.add("col-3");
        var div3 = document.createElement('div');
        div3.classList.add("col-3");

        var input1 = document.createElement("input");
        var input2 = document.createElement("input");
        var input3 = document.createElement("input");
		  
		input1.name = "MedicatieLijst[]";
        input1.classList.add("input--style-4");
		input2.name = "MedicatieLijst[]";
        input2.classList.add("input--style-4");
		input3.name = "MedicatieLijst[]";
        input3.classList.add("input--style-4");

        div1.appendChild(input1);
        div2.appendChild(input2);
        div3.appendChild(input3);
        div.appendChild(div1);
        div.appendChild(div2);
        div.appendChild(div3);

        var element = document.getElementById("MedicatieLijst");
	    element.appendChild(div);
      }
        
      function enableAndere() {
       if ( document.getElementById("ZLandere").checked == true ) {
            document.getElementById("ZLarea").disabled = false;
       }
        else {
            document.getElementById("ZLarea").disabled = true;
            document.getElementById("ZLarea").value = "";
        }
      }
	  
	  function showCurrentStatus(str) 
	  {
		  document.getElementById("txtHint").innerHTML = "";
		  $("#WachtrijshowCurrentStatusInput").val(0);
		  if (str == "") 
		  {
			document.getElementById("txtHint").innerHTML = "";
			return;
		  } 
		  else 
		  {			  
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() 
			{
			  if (this.readyState == 4 && this.status == 200) 
			  {
				  if(this.responseText != "Foute inschrijving. Probeer opnieuw.")
				  {
					var count = this.responseText;
				
					if(count >= 50)
					{
						$("#BubbleWarning").modal("show");
						$("#WachtrijInput").val(1);
					}
					else
					{
						document.getElementById("txtHint").innerHTML = count + '/50 inschrijvingen, vanaf de limiet bereikt wordt zal deze inschrijving op de wachtlijst komen.';
					}  
				  }
				  else
				  {
					  document.getElementById("txtHint").innerHTML = "Foute inschrijving. Probeer opnieuw.";
				  }
			  }
			};
			
			xmlhttp.open("GET","php/getCurrentStatus.php?q="+str,true);
			xmlhttp.send();
		  }
	  }
    </script>
</head>

<body>
    
    <!--DEADLINE VERSTREKEN-->
<!--     <div class="overlay">
        <div class="modal">Helaas is het op deze moment niet <br> meer mogelijk om je in te schrijven. <br>
    </div> -->
    
    <div class="page-wrapper bg-gra-03 p-t-30 p-b-100 font-poppins">
        <div class="wrapper wrapper--w960 p-b-30">
            <img class="chiro-logo" src="img/chiro.png" alt="Chiro Schelle">
        </div>
        <div class="wrapper wrapper--w960">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Kamp <?php echo date("Y"); ?> &nbsp; | &nbsp;
                        Individuele medische steekkaart</h2>
                    <form action="index.php" method="POST">
					
						<input id="WachtrijInput" name="Wachtrij" value="0" hidden />
						
                        <input name="function" value="NieuweFiche" hidden />
                        <p>Beste ouders, 
                            Om uw kind in te schrijven voor het bivak van Chiro Schelle dient u en/of een arts zorgvuldig deze steekkaart in te vullen. 
                            Zo weet de leiding in geval van nood waar ze moeten op letten. 
                            Na het invullen van deze steekkaart zal u doorverwezen worden naar het betaalportaal om de inschrijving van uw kind te voltooien.
                            <br><br>
                            <span class="required">Gelieve deze velden in te vullen!</span>
                            <br><br>
                        </p>

                        <div class="input-group">
                            <label class="label" style="width: 100%;">Afdeling <span class="required">*</span></label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="Afdeling" required> <!--onChange="showCurrentStatus(this.value)"-->
                                    <option disabled="disabled" selected>Kies een afdeling...</option>
                                    <option value="Ribbel Meisjes">Ribbel Meisjes</option>
                                    <option value="Ribbel Jongens">Ribbel Jongens</option>
                                    <option value="Speelclub Meisjes">Speelclub Meisjes</option>
                                    <option value="Speelclub Jongens">Speelclub Jongens</option>
                                    <option value="Kwiks">Kwiks</option>
                                    <option value="Rakkers">Rakkers</option>
                                    <option value="Tippers">Tippers</option>
                                    <option value="Toppers">Toppers</option>
                                    <option value="Tiptiens">Tiptiens</option>
                                    <option value="Kerels">Kerels</option>
                                    <option value="Aspi Meisjes">Aspi Meisjes</option>
                                    <option value="Aspi Jongens">Aspi Jongens</option>
                                    <option value="Leiding">Leiding</option>
                                    <option value="Kokkie">Kokkie</option>
                                    <option value="Kookploeg">Kookploeg</option>
                                    <option value="VB">VB</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
						
						<p id="txtHint"></p>

                        <h4>Identiteit van het kind</h4>

                        <div class="row row-space">
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="label">Voornaam <span class="required">*</span></label>
                                    <input class="input--style-4" type="text" name="Voornaam"  required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="label">Naam <span class="required">*</span></label>
                                    <input type="text" name="Naam" class="input--style-4"  required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="label">Geboortedatum <span class="required">*</span></label>
                                    <div class="input-group-icon">
                                        <input class="input--style-4 js-datepicker" type="text" name="Geboortedatum" required>
                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4>Adres</h4>

                        <div class="row row-space">
                            <div class="col-4 straat">
                                <div class="input-group">
                                    <label class="label">Straat <span class="required">*</span></label>
                                    <input class="input--style-4" type="text" name="Straat"  required>
                                </div>
                            </div>
                            <div class="col-4 nummer">
                                <div class="input-group">
                                    <label class="label">Nummer <span class="required">*</span></label>
                                    <input type="text" name="Nummer" class="input--style-4"  required>
                                </div>
                            </div>
                            <div class="col-4 postcode">
                                <div class="input-group">
                                    <label class="label">Postcode <span class="required">*</span></label>
                                    <input type="text" name="Postcode" class="input--style-4"  required>
                                </div>
                            </div>
                            <div class="col-4 woonplaats">
                                <div class="input-group">
                                    <label class="label">Woonplaats <span class="required">*</span></label>
                                    <input type="text" name="Woonplaats" class="input--style-4"  required>
                                </div>
                            </div>
                        </div>

                        <!------------------ verborgen ----------------------------------------------------------
                        <div class="row row-space">
                            <div class="col-4 straat">
                                <div class="input-group">
                                    <label class="label">Straat (2)</label>
                                    <input class="input--style-4" type="text" name="Straat2">
                                </div>
                            </div>
                            <div class="col-4 nummer">
                                <div class="input-group">
                                    <label class="label">Nummer (2)</label>
                                    <input type="text" name="Nummer2" class="input--style-4">
                                </div>
                            </div>
                            <div class="col-4 postcode">
                                <div class="input-group">
                                    <label class="label">Postcode (2)</label>
                                    <input type="text" name="Postcode2" class="input--style-4">
                                </div>
                            </div>
                            <div class="col-4 woonplaats">
                                <div class="input-group">
                                    <label class="label">Woonplaats (2)</label>
                                    <input type="text" name="Woonplaats2" class="input--style-4">
                                </div>
                            </div>
                            <br>
                        </div>
                        ----------------------------------------------------------------------------------------->

                        
                        <h4>Contactgegevens gezinsleden</h4>

                        <div class="row row-space">
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="label">Naam en voornaam <span class="required">*</span></label>
                                    <input type="text" name="NaamVoornaam1" class="input--style-4"  required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="label">Telefoonnummer <span class="required">*</span></label>
                                    <input type="text" name="Telefoon1" class="input--style-4"  required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="label">Verwantschap <span class="required">*</span></label>
                                    <input type="text" name="Verwantschap1" class="input--style-4"  required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-3">
                                <div class="input-group">
                                    <input type="text" name="NaamVoornaam2" class="input--style-4">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <input type="text" name="Telefoon2" class="input--style-4">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <input type="text" name="Verwantschap2" class="input--style-4">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email <span class="required">*</span></label>
                                    <input type="email" name="Email" class="input--style-4"  required>
                                    <i>Dit email adres zal gebruikt worden voor de elektronische betaling.</i>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email bevestigen<span class="required">*</span></label>
                                    <input type="email" class="input--style-4"  required>
                                </div>
                            </div>
                        </div>

                        <br>
                        <h4>Medische gegevens en vragenlijst</h4>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Naam huisarts <span class="required">*</span></label>
                                    <input type="text" name="NaamHuisarts" class="input--style-4"  required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Telefoonnummer huisarts <span class="required">*</span></label>
                                    <input type="text" name="TelefoonArts" class="input--style-4"  required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-3 mutualiteit">
                                <div class="input-group">
                                    <label class="label">Mutualiteit <span class="required">*</span></label>
                                    <input type="text" name="Mutualiteit" class="input--style-4"  required>
                                </div>
                            </div>
                            <div class="col-3 bloed-wrap">
                                <div class="input-group">
                                    <label class="label" style="width: 100%;">Bloedgroep <span
                                            class="required">*</span></label>
                                    <div class="rs-select2 js-select-simple select--no-search bloed">
                                        <select name="Bloedgroep"  required>
                                            <option disabled="disabled" selected="selected"></option>
                                            <option value="A">A</option>
                                            <option value="AB">AB</option>
                                            <option value="B">B</option>
                                            <option value="O">O</option>
                                            <option value="Geen idee">Geen idee</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 bloed-wrap">
                                <div class="input-group">
                                    <label class="label" style="width: 100%;">Rhesusfactor <span
                                            class="required">*</span></label>
                                    <div class="rs-select2 js-select-simple select--no-search bloed">
                                        <select name="RhesusFactor"  required>
                                            <option disabled="disabled" selected="selected"></option>
                                            <option value="+">+</option>
                                            <option value="-">-</option>
                                            <option value="Geen idee">Geen idee</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group">
                                    <h5>Beantwoord onderstaande vragen door rechts ja of neen aan te vinken en
                                        verduidelijk uw antwoord indien nodig.</h5>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="input-group">
                                    <label
                                        class="label">Ja&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nee</label>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group no-bot-margin">
                                    <label class="label">Lijdt uw kind aan een van onderstaande ziekten? <span
                                            class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="input-group">
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">
                                            <input type="radio" name="ZiektenLijst[]" value="Ja">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">
                                            <input type="radio" checked="checked" name="ZiektenLijst[]" value="Nee">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-6">
                                <div class="checkbox checkbox-inline checkbox-danger">
                                    <input type="checkbox" class="styled" id="inlineCheckbox1" name="ZiektenLijst[]" value="suikerziekte">
                                    <label for="inlineCheckbox1"> Suikerziekte </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="checkbox checkbox-inline checkbox-danger">
                                    <input type="checkbox" class="styled" id="inlineCheckbox2" name="ZiektenLijst[]" value="astma">
                                    <label for="inlineCheckbox2"> Astma </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="checkbox checkbox-inline checkbox-danger">
                                    <input type="checkbox" class="styled" id="inlineCheckbox3" name="ZiektenLijst[]" value="hartkwaal">
                                    <label for="inlineCheckbox3"> Hartkwaal </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="checkbox checkbox-inline checkbox-danger">
                                    <input type="checkbox" class="styled" id="inlineCheckbox4" name="ZiektenLijst[]" value="epilepsie">
                                    <label for="inlineCheckbox4"> Epilepsie </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="checkbox checkbox-inline checkbox-danger">
                                    <input type="checkbox" class="styled" id="inlineCheckbox5" name="ZiektenLijst[]" value="reuma">
                                    <label for="inlineCheckbox5"> Reuma </label>
                                </div>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="checkbox checkbox-inline checkbox-danger">
                                    <input type="checkbox" class="styled" id="inlineCheckbox6" name="ZiektenLijst[]" value="huidaandoening">
                                    <label for="inlineCheckbox6"> Huidaandoening </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="checkbox checkbox-inline checkbox-danger">
                                    <input type="checkbox" class="styled" id="inlineCheckbox7" name="ZiektenLijst[]" value="slaapwandelen">
                                    <label for="inlineCheckbox7"> Slaapwandelen </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="checkbox checkbox-inline checkbox-danger">
                                    <input type="checkbox" class="styled" id="inlineCheckbox8" name="ZiektenLijst[]" value="hooikoorts">
                                    <label for="inlineCheckbox8"> Hooikoorts </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="checkbox checkbox-inline checkbox-danger">
                                    <input type="checkbox" class="styled" id="inlineCheckbox9" name="ZiektenLijst[]" value="allergieën">
                                    <label for="inlineCheckbox9"> Allergieën </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="checkbox checkbox-inline checkbox-danger">
                                    <input type="checkbox" class="styled" id="ZLandere" name="ZiektenLijst[]" onchange="enableAndere()"
                                        value="">
                                    <label for="ZLandere"> Andere </label>
                                </div>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>

                        <br>

                        <div class="row row-space">
                            <div class="col-1">
                                <div class="input-group">
                                    <label class="label" style="width: 100%;">Indien u Andere heeft aangevinkt,
                                        welke?</label>
                                    <textarea name="Ziektenlijst[]" style="width: 85%;" class="input--style-4"
                                        id="ZLarea" disabled></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-------------HIDDEN-------------------------------------------
                        <div class="row row-space">
                            <div class="col-1">
                                <div class="input-group">
                                    <label class="label" style="width: 100%;">Welke behandeling dient er te worden
                                        toegepast?</label>
                                    <textarea name="Behandeling" style="width: 85%;" class="input--style-4"
                                        id="ZLarea"></textarea>
                                </div>
                            </div>
                        </div>
                        -------------------------------------------------------------->

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="input-group">
                                    <label
                                        class="label">Ja&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nee</label>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group no-bot-margin">
                                    <label class="label">Is uw kind lactose intolerant? <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="p-t-10">
                                    <label class="radio-container m-r-45"  required>
                                        <input type="radio" id="lactose1" name="Lactose" value="Ja" onchange="checkLactose()">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-container">
                                        <input type="radio" id="lactose2" checked="checked" name="Lactose" value="Nee" onchange="checkLactose()">
                                        <span class="checkmark"></span>
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="row row-space" id="lactose3" style="visibility: hidden;">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group no-bot-margin">
                                    <label class="label">&nbsp;&nbsp;Enkel melkproducten in eten verwerkt. <span class="required">* (Indien van toepassing)</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="p-t-10">
                                    <label class="radio-container m-r-45">
                                        <input type="radio" name="LactoseX" value="Verwerkt" id="lactose3a">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space" id="lactose4" style="visibility: hidden;">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group no-bot-margin">
                                    <label class="label">&nbsp;&nbsp;Totaal geen melkproducten. <span class="required">* (Indien van toepassing)</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="p-t-10">
                                    <label class="radio-container m-r-45">
                                        <input type="radio" name="LactoseX" value="Geen" id="lactose4a">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <script style="text/javascript">
                            function checkLactose()
                            {
                                $lactose1 = document.getElementById("lactose1");
                                $lactose2 = document.getElementById("lactose2");
                                $lactose3 = document.getElementById("lactose3");
                                $lactose4 = document.getElementById("lactose4");

                                $lactose3a = document.getElementById("lactose3a");
                                $lactose4a = document.getElementById("lactose4a");

                                if(lactose1.checked == true){
                                    $lactose3.style.visibility = "visible";
                                    $lactose4.style.visibility = "visible";
                                }
                                else{
                                    $lactose3.style.visibility = "hidden";
                                    $lactose3a.checked = false;
                                    $lactose4.style.visibility = "hidden";
                                    $lactose4a.checked = false;
                                }
                            }
                        </script>

                        <br>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group no-bot-margin">
                                    <label class="label">Is uw kind bijzonder gevoelig voor bepaalde voedingsmiddelen? Zo ja, welke? <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="p-t-10">
                                    <label class="radio-container m-r-45">
                                        <input type="radio" name="GevoeligStoffenVoeding[]" value="Ja"  required>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-container">
                                        <input type="radio" checked="checked" name="GevoeligStoffenVoeding[]" value="Nee">
                                        <span class="checkmark"></span>
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-1">
                                <div class="input-group">
                                    <textarea name="GevoeligStoffenVoeding[]" style="width: 85%;" class="input--style-4"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group no-bot-margin">
                                    <label class="label">Is uw kind ooit ernstig ziek geweest of heeft het heelkundige
                                        ingrepen ondergaan? Zo ja, welke? <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="p-t-10">
                                    <label class="radio-container m-r-45">
                                        <input type="radio" name="Ingrepen[]" value="Ja" required>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-container">
                                        <input type="radio" checked="checked" name="Ingrepen[]" value="Nee">
                                        <span class="checkmark"></span>
                                    </label>

                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-1">
                                <div class="input-group">
                                    <textarea name="Ingrepen[]" style="width: 85%;" class="input--style-4"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="input-group">
                                    <label
                                        class="label">Ja&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nee</label>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group no-bot-margin">
                                    <label class="label">Werd uw kind gevaccineerd tegen tetanus volgens het basis schema van Kind en Gezin? <span class="required">*</span><br>Zo ja, in welk jaar? </label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">

                                <div class="p-t-10">
                                    <label class="radio-container m-r-45">
                                        <input type="radio" name="VaccinatieTetanus[]" value="Ja" required>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-container">
                                        <input type="radio" checked="checked" name="VaccinatieTetanus[]" value="Nee">
                                        <span class="checkmark"></span>
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-1">
                                <div class="input-group">
                                    <textarea name="VaccinatieTetanus[]" style="width: 30%; height: 50px;"
                                        class="input--style-4"></textarea>
                                </div>
                            </div>
                        </div>

                        <!--------------------------------Moest verwijderd worden---------------------------------------
                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group no-bot-margin">
                                    <label class="label">Werd uw kind gevaccineerd tegen hersenvliesontsteking (type C)?
                                        <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="p-t-10">
                                    <label class="radio-container m-r-45">
                                        <input type="radio" name="VaccinatieHersenvliesontsteking" value="Ja" required>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-container">
                                        <input type="radio" checked="checked" name="VaccinatieHersenvliesontsteking" value="Nee">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        -------------------------------------------------------------------------------------------------->

                        
                        <!--
                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group no-bot-margin">
                                    <label class="label">Kreeg uw kind reeds serum tegen klem (tetanus)? Zo ja, welk
                                        jaar? <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="p-t-10">
                                    <label class="radio-container m-r-45">
                                        <input type="radio" name="SerumTetanus[]">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-container">
                                        <input type="radio" checked="checked" name="SerumTetanus[]">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            </div>
                        </div>
                        -->

                        <br>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group no-bot-margin">
                                    <label class="label">Is uw kind bijzonder gevoelig of allergisch voor bepaalde
                                        geneesmiddelen? Zo ja, welke? <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="input-group">
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">
                                            <input type="radio" name="AllergieMedicatie[]" value="Ja" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">
                                            <input type="radio" checked="checked" name="AllergieMedicatie[]" value="Nee">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-1">
                                <div class="input-group">
                                    <textarea name="AllergieMedicatie[]" style="width: 85%;"
                                        class="input--style-4"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="input-group">
                                    <label
                                        class="label">Ja&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nee</label>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group no-bot-margin">
                                    <label class="label">Heeft je kind andere allergische klachten die niet bij voeding of geneesmiddelenallergieën horen? Zo ja, welke? <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="p-t-10">
                                    <label class="radio-container m-r-45">
                                        <input type="radio" name="AndereAllergie[]" value="Ja"  required>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-container">
                                        <input type="radio" checked="checked" name="AndereAllergie[]" value="Nee">
                                        <span class="checkmark"></span>
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-1">
                                <div class="input-group">
                                    <textarea name="AndereAllergie[]" style="width: 85%;" class="input--style-4"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!--  vegetarisch -->
                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group">
                                    <label class="label">Eet uw kind vegetarisch <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="input-group">
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">
                                            <input type="radio" name="Vegetarisch" value="Ja" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">
                                            <input type="radio" checked="checked" name="Vegetarisch" value="Nee">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Halal -->
                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group">
                                    <label class="label">Eet uw kind halal? <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="input-group">
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">
                                            <input type="radio" name="Halal" value="Ja" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">
                                            <input type="radio" checked="checked" name="Halal" value="Nee">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group">
                                    <label class="label">Is uw kind incontinent (bedwateren)? <span
                                            class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="input-group">
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">
                                            <input type="radio" name="Incontinent" value="Ja" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">
                                            <input type="radio" checked="checked" name="Incontinent" value="Nee">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group">
                                    <label class="label">Kan uw kind deelnemen aan sport en spel afgestemd op zijn / haar
                                        leeftijd? <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="input-group">
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">
                                            <input type="radio" name="DeelnemenSport" value="Ja" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">
                                            <input type="radio" checked="checked" name="DeelnemenSport" value="Nee">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group">
                                    <label class="label">Kan uw kind zwemmen? <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="input-group">
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">
                                            <input type="radio" name="Zwemmen" value="Ja" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">
                                            <input type="radio" checked="checked" name="Zwemmen" value="Nee">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row row-space">
                            <div class="col-1">
                                <div class="input-group">
                                    <h4>Medicatielijst</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="label">Medicatie</label>
                                    <input class="input--style-4" type="text" name="MedicatieLijst[]">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="label">Tijdstip</label>
                                    <input type="text" name="MedicatieLijst[]" class="input--style-4">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="label">Reden van toediening</label>
                                    <input type="text" name="MedicatieLijst[]" class="input--style-4">
                                </div>
                            </div>
                        </div>
                        <div id="MedicatieLijst"></div>

                        <div class="col-3" style="padding-left: 0px;">
                            <input type="button" id="MeerMedicatie" class="btn btn-danger btn-block" style="color: white; padding-left: 10px; font-size: 17px;" value="Meer medicatie toevoegen"/>
                            <br><br><br>
                            <script style="text/javascript">document.getElementById("MeerMedicatie").addEventListener("click", creeerElement);</script>
                        </div>
                        
                        
                        <div class="row row-space">
                            <div class="col-1">
                                <div class="input-group">
                                    <h4>Medische zorgen</h4><br><br>
                                    <p>Leiding en kampverpleging mag - behalve EHBO - niet op eigen initiatief medische handelingen uitvoeren. Zonder toestemming van de ouders mogen ze zelfs geen lichte pijnstillende of koortswerende medicatie toedienen, zoals Perdolan, Dafalgan of aspirines. *</p>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="input-group">
                                    <label
                                        class="label">Ja&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nee</label>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group no-bot-margin">
                                    <label class="label">Mag uw kind medicatie nemen zonder toestemming van de ouders? <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="p-t-10">
                                    <label class="radio-container m-r-45">
                                        <input type="radio" name="ToestemmingMedicatieKind" value="Ja" required>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-container">
                                        <input type="radio" checked="checked" name="ToestemmingMedicatieKind" value="Nee">
                                        <span class="checkmark"></span>
                                    </label>

                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group no-bot-margin">
                                    <label class="label">Wij geven toestemming aan de leiding/verpleging om bij hoogdringendheid aan onze zoon/ dochter een dosis via de apotheek vrij verkrijgbare pijnstillende en koortswerende medicatie toe te dienen <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="p-t-10">
                                    <label class="radio-container m-r-45">
                                        <input type="radio" name="ToestemmingMedicatie" value="Ja" required>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-container">
                                        <input type="radio" checked="checked" name="ToestemmingMedicatie" value="Nee">
                                        <span class="checkmark"></span>
                                    </label>

                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group no-bot-margin">
                                    <label class="label">Geeft u toestemming om uw kind in dringende gevallen een heelkundige ingreep te laten ondergaan? <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="p-t-10">
                                    <label class="radio-container m-r-45">
                                        <input type="radio" name="ToestemmingIngrepen" value="Ja" required>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-container">
                                        <input type="radio" checked="checked" name="ToestemmingIngrepen"  value="Nee">
                                        <span class="checkmark"></span>
                                    </label>

                                </div>
                            </div>
                        </div>

                        <i>* Gebaseerd op aanbeveling Kind&Gezin 09.12.2009 – Aanpak van koorts / Toedienen van geneesmiddelen in de kinderopvang</i>

                        <br><br>

                        <div class="row row-space">
                            <div class="col-1">
                                <div class="input-group">
                                    <h4>Varia</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2 ja-nee-kolom">
                                <div class="input-group">
                                    <label class="label">Mogen er foto’s van uw kind online geplaats worden? (website,
                                        sociale media, …) <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="col-2 ja-nee">
                                <div class="input-group">
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">
                                            <input type="radio" name="ToestemmingFoto" value="Ja" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">
                                            <input type="radio" checked="checked" name="ToestemmingFoto" value="Nee">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-1">
                                <div class="input-group">
                                    <h4>Andere inlichtingen</h4>
                                    <textarea name="AndereInlichtingen" style="width: 100%;"
                                        class="input--style-4"></textarea>
                                </div>
                            </div>
                        </div>

                        <p>Contactgegevens worden bijgehouden in de online ledenadministratie van Chiro Schelle
                            (Coala) en het online
                            Groepsadministratieportaal (GAP) en zijn nodig voor de dagelijkse werking en de
                            verzekering. De basisgegevens
                            (één adres, één telefoonnummer, de geboortedatum en één mailadres, vanaf
                            ketileeftijd bij voorkeur van de
                            jongere zelf) worden doorgestuurd naar Chirojeugd Vlaanderen. De informatie over de
                            gezondheidstoestand
                            van het kind wordt bijgehouden door de leidingsploeg en wordt dus niet doorgegeven,
                            tenzij aan (medische)
                            hulpverleners. De leidingsploeg heeft afspraken gemaakt om daar vertrouwelijk mee om
                            te gaan. De dieetvoorkeuren
                            worden uiteraard doorgegeven aan de kookploeg. <br>
                            Als er iets verandert aan de gezondheidstoestand van uw kind is het belangrijk om
                            dat door te geven aan de
                            leiding zodat zij altijd op de gepaste manier kunnen reageren. Bij een volgend
                            kamp/werkjaar zal gevraagd
                            worden om de gegevens opnieuw in te vullen, aangezien deze gegevens elk jaar ook
                            verwijderd worden.
                            <br><br>
                            <h5>Contacteer de leiding en/of de verpleging indien u bijkomende informatie wenst
                                te geven of
                                indien er specifieke richtlijnen te volgen zijn in noodsituaties.
                            </h5><br>
                            <!--<h5>Email moekes: <b>moekes@chiroschelle.be</b></h5>-->
                            <br>
                            Ondergetekende verklaart dat de ingevulde gegevens volledig en correct zijn, en gaat
                            akkoord met de verwerking ervan:
                        </p><br>

                        <div class="row row-space">
                            <div class="col-3">
                                <div class="input-group">
                                    <label class="label">Uw naam <span class="required">*</span></label>
                                    <input class="input--style-4" type="text" name="NaamInvuller" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group" style="padding-top: -20px;">
                                    <label class="label">Overeenkomst <span class="required">*</span></label>
                                    <div class="checkbox checkbox-danger">
                                        <input type="checkbox" class="styled" id="inlineCheckbox11" required>
                                        <label for="inlineCheckbox11"> Ik ga akkoord dat Chiro Schelle deze informatie
                                            bewaard.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <div class="g-recaptcha" data-sitekey="6Lf3xBsUAAAAAJgi77tbiZk4sI3dDt93T8hnN0rs" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <input type="submit" id="submit" class="btn btn-danger btn-block" value=" Indienen" />
                    </form>
                
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


    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
	
	<!-- Modal -->
	<!--<div class="modal fade" id="BubbleWarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">De bubbellimiet is bereikt.</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			De inschrijvingslimiet voor deze bubbel is spijtig genoeg bereikt. Deze inschrijving wordt in wachtrij geplaatst.<br>
			
			Chiro Schelle neemt contact met u op van zodra er een plaats vrijkomt.<br>
			
			Gelieve wel deze inschrijving volledig af te ronden om effectief op de wachtlijst te komen.
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>-->
</body>

</html>