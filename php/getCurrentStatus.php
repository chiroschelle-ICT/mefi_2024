<?php
$q = $_GET['q'];

include_once("functions.php");

$con = LinkDB();

if (!$con) 
{
  die('Could not connect: ' . mysqli_error($con));
}

switch ($q) 
{
	case "Leiding":
        $sql = "SELECT COUNT(*) AS Count FROM (SELECT DISTINCT CONCAT(Naam, ' ', Voornaam) FROM lid_2021 WHERE Afdeling = 'Leiding' AND wachtrij = '0') AS LID";
        break;
    case "Ribbel Meisjes":
    case "Ribbel Jongens":
        $sql = "SELECT COUNT(*) AS Count FROM (SELECT DISTINCT CONCAT(Naam, ' ', Voornaam) FROM lid_2021 WHERE Afdeling = 'Ribbel Meisjes' OR Afdeling = 'Ribbel Jongens' AND wachtrij = '0') AS LID";
        break;
	case "Speelclub Meisjes":
    case "Speelclub Jongens":
        $sql = "SELECT COUNT(*) AS Count FROM (SELECT DISTINCT CONCAT(Naam, ' ', Voornaam) FROM lid_2021 WHERE Afdeling = 'Speelclub Meisjes' OR Afdeling = 'Speelclub Jongens' AND wachtrij = '0') AS LID";
        break;
	case "Kwiks":
    case "Rakkers":
        $sql = "SELECT COUNT(*) AS Count FROM (SELECT DISTINCT CONCAT(Naam, ' ', Voornaam) FROM lid_2021 WHERE Afdeling = 'Kwiks' OR Afdeling = 'Rakkers' AND wachtrij = '0') AS LID";
        break;
	case "Tippers":
    case "Toppers":
        $sql = "SELECT COUNT(*) AS Count FROM (SELECT DISTINCT CONCAT(Naam, ' ', Voornaam) FROM lid_2021 WHERE Afdeling = 'Tippers' OR Afdeling = 'Toppers' AND wachtrij = '0') AS LID";
        break;
	case "Tiptiens":
    case "Kerels":
        $sql = "SELECT COUNT(*) AS Count FROM (SELECT DISTINCT CONCAT(Naam, ' ', Voornaam) FROM lid_2021 WHERE Afdeling = 'Tiptiens' OR Afdeling = 'Kerels' AND wachtrij = '0') AS LID";
        break;
	case "Aspi Meisjes":
    case "Aspi Jongens":
        $sql = "SELECT COUNT(*) AS Count FROM (SELECT DISTINCT CONCAT(Naam, ' ', Voornaam) FROM lid_2021 WHERE Afdeling = 'Aspi Meisjes' OR Afdeling = 'Aspi Jongens' AND wachtrij = '0') AS LID";
        break;
	case "Kokkie":
    case "Kookploeg":
    case "VB":
        $sql = "SELECT COUNT(*) AS Count FROM (SELECT DISTINCT CONCAT(Naam, ' ', Voornaam) FROM lid_2021 WHERE Afdeling = 'Kokkie' OR Afdeling = 'Kookploeg' OR Afdeling = 'VB' AND wachtrij = '0') AS LID";
        break;
	default:
		$sql = null;
		break;
}

if($sql != null)
{	
	$result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result)) 
	{
	  echo $row['Count'];
	}
}
else
{
	echo "Foute inschrijving. Probeer opnieuw.";
}

mysqli_close($con);
?>