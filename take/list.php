<?php
/* Consomation Gazoil 
 * Copyright (C) 2013	Florian HENRY 		<florian.henry@open-concept.pro>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * \file consogazoil/take/list.php
 * \ingroup consogazoil
 */
$res = @include '../../main.inc.php'; // For root directory
if (! $res)
	$res = @include '../../../main.inc.php'; // For "custom" directory

require_once '../class/html.formconsogazoil.class.php';
require_once '../class/consogazoilvehtake.class.php';

// Load translation files required by the page
$langs->load("consogazoil@consogazoil");

// Security check
if (! $user->rights->consogazoil->lire)
	accessforbidden();

$filterdate = GETPOST('filterdate', 'alpha');

$optioncss = GETPOST('optioncss', 'alpha');

/*
 * VIEW
 *
 * Put here all code to build page
 */
$TJs = array(
	dol_buildpath('/consogazoil/includes/datatables/js/jquery.dataTables.min.js', 1)
	,dol_buildpath('/consogazoil/includes/datatables/media/js/jquery.dataTables.min.js', 1)
	,dol_buildpath('/consogazoil/includes/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js', 1)
	,dol_buildpath('/consogazoil/includes/datatables/extensions/ColVis/js/dataTables.colVis.min.js', 1)
	,dol_buildpath('/consogazoil/includes/datatables/extensions/TableTools/js/dataTables.tableTools.min.js', 1)
);
$TCss = array(
	dol_buildpath('/consogazoil/includes/datatables/css/datatables.min.css', 1)
	,dol_buildpath('/consogazoil/includes/datatables/media/css/jquery.dataTables.min.css', 1)
	,dol_buildpath('/consogazoil/includes/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css', 1)
	,dol_buildpath('/consogazoil/includes/datatables/extensions/ColVis/css/dataTables.colVis.min.css', 1)
	,dol_buildpath('/consogazoil/includes/datatables/extensions/TableTools/css/dataTables.tableTools.min.css', 1)
);

llxHeader('', $langs->trans('ConsoGazManageTake') . '-' . $langs->trans('ConsoGazList'), '', '', 0, 0, $TJs, $TCss);

$form = new Form($db);
$formconsogaz = new FormConsoGazoil($db);

echo load_fiche_titre($langs->trans('ConsoGazManageTake') . '-' . $langs->trans('ConsoGazList'), '', 'consogazoil@consogazoil');

print '<form action="' . $_SERVER["PHP_SELF"] . '" method="POST" name="filterdate">' . "\n";
print '<input type="hidden" name="token" value="' . $_SESSION['newtoken'] . '" / >';
print '<table><tr><td>';
$selectdate = $formconsogaz->select_date_filter('filterdate', $filterdate, 'take');
if ($selectdate != - 1) {
	print $selectdate;
} else {
	setEventMessage($formconsogaz->error, 'errors');
}
print '</td><td><input type="submit" value="' . $langs->trans('ConsoGazFilterDate') . '"/></td></tr></table>';
print '</form>';

include 'tpl/list.tpl.php';

// End of page
llxFooter();
$db->close();