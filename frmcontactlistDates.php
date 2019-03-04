<?php
/**
 * frmcontactlist.php
 * calcule la liste des ressources visibles dans un domaine
 * Ce script fait partie de l'application GRR
 * Dernière modification : $Date: 2018-03-26 10:00$
 * @copyright Copyright 2003-2018 Team DEVOME - JeromeB
 * @link      http://www.gnu.org/licenses/licenses.html
 *
 * This file is part of GRR.
 *
 * GRR is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 */
 
include "include/connect.inc.php";
include "include/config.inc.php";
include "include/misc.inc.php";
include "include/functions.inc.php";
include "include/$dbsys.inc.php";
include "include/mincals.inc.php";
include "include/mrbs_sql.inc.php";
$grr_script_name = "contactFormulaire.php";
require_once("./include/settings.class.php");
if (!Settings::load())
	die("Erreur chargement settings");
require_once("./include/session.inc.php");
include "include/resume_session.php";
include "include/language.inc.php";
?>
<link rel="stylesheet" type="text/css" href="themes/default/css/clockpicker.css">
<script type="text/javascript" src="js/clockpicker.js"></script>
<?php
$id = $_GET['id'];

$res = grr_sql_query("SELECT type_affichage_reser FROM ".TABLE_PREFIX."_room WHERE id = '".$id."'");

//Ici on récupère l'area id en fonction de l'id de la ressource
$area_id = grr_sql_query1("SELECT area_id FROM ".TABLE_PREFIX."_room WHERE id = '".$id."'");

//Ici on récupère la resolution_area en fonction de l'area_id trouvé ci-dessus
$duree_par_defaut_reservation_area_sec = grr_sql_query1("SELECT resolution_area FROM ".TABLE_PREFIX."_area WHERE id = '".$area_id."'");

$nbresult = mysqli_num_rows($res);

if ($nbresult != 0) {
	for ($t = 0; ($row_roomName = grr_sql_row($res, $t)); $t++) {
		$tar =  $row_roomName[0];
	}
}
			
if ($tar == "0") {	

?>			
	<div id="DateGenerale">
		
				<?php
					echo "<div id=\"DateReservation\">";
						echo "<br><label> Réserver le : </label>";
						jQuery_DatePicker('start');
					echo "</div>";
					echo "<div id=\"HeureReservation\">";
						echo "<br>";
						jQuery_TimePicker('start_', '', '', $duree_par_defaut_reservation_area_sec);
					echo "</div>";
					echo "<div id=\"DureeReservation\">";
						echo "<br><label> Sélectionnez la durée : </label>";
						jQuery_TimePicker('end_', '', '', $duree_par_defaut_reservation_area_sec);
					echo "</div>";
				?>

	</div>				
<?php
} else {

			    echo "<div id=\"DateReservation\">";
					echo "<br><label> Jour début : </label>";
					jQuery_DatePicker('start');
				echo "</div>";
				echo "<div id=\"HeureReservation\">";
					echo "<br>";
					jQuery_TimePicker('start_', '', '', $duree_par_defaut_reservation_area_sec);
				echo "</div>";

				echo "<div id=\"DateReservation\">";
					echo "<br><label> Jour de fin    : </label>";
					jQuery_DatePicker('end');
				echo "</div>";
				echo "<div id=\"HeureReservation\">";
					echo "<br>";
					jQuery_TimePicker('end_', '', '', $duree_par_defaut_reservation_area_sec);
					echo "<br>";
				echo "</div>";
									
}

?>
