<?php
/* Copyright (C) 2012-2013	Regis Houssin	<regis.houssin@capnetworks.com>
 * Copyright (C) 2013	Florian HENRY 		<florian.henry@open-concept.pro>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 *
 */
?>

<!-- BEGIN PHP TEMPLATE -->
<script type="text/javascript">
$(document).ready(function() {
	$("#list").dataTable( {
		<?php
		if ($optioncss == 'print') {
			print '"sDom": "lfrtip",';
		} else {
			print '"sDom": \'TC<"clear">lfrtip\',';
		}
		?>
		"oTableTools": {
			"sSwfPath": "<?php echo dol_buildpath('/consogazoil/includes/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf',1); ?>"
		},
		"oColVis": {"buttonText": "<?php echo $langs->trans('Showhidecols')?>" },
		"sPaginationType": "full_numbers",
		"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?php echo $langs->trans('ConsoGazAll'); ?>"]],
		"oLanguage": {
			"sLengthMenu": "<?php echo $langs->trans('Show'); ?> _MENU_ <?php echo $langs->trans('Entries'); ?>",
			"sSearch": "<?php echo $langs->trans('ConsoGazSearch'); ?>:",
			"sZeroRecords": "<?php echo $langs->trans('NoRecordsToDisplay'); ?>",
			"sInfoEmpty": "<?php echo $langs->trans('NoEntriesToShow'); ?>",
			"sInfoFiltered": "(<?php echo $langs->trans('FilteredFrom'); ?> _MAX_ <?php echo $langs->trans('TotalEntries'); ?>)",
			"sInfo": "<?php echo $langs->trans('Showing'); ?> _START_ <?php echo $langs->trans('To'); ?> _END_ <?php echo $langs->trans('ConsoGazOf'); ?> _TOTAL_ <?php echo $langs->trans('Entries'); ?>",
			"oPaginate": {
				"sFirst": "<?php echo $langs->transnoentities('First'); ?>",
				"sLast": "<?php echo $langs->transnoentities('Last'); ?>",
				"sPrevious": "<?php echo $langs->transnoentities('Previous'); ?>",
				"sNext": "<?php echo $langs->transnoentities('Next'); ?>"
			}
		},
		"aaSorting": [[9,'desc']],
		"bProcessing": true,
		"stateSave": true,
		"bServerSide": true,
		"sAjaxSource": "<?php echo dol_buildpath('/consogazoil/take/ajax/list.php',1).'?filterdate='.$filterdate; ?>"
	});
});
</script>

<table cellpadding="0" cellspacing="0" border="0" class="display"
	id="list">
	<thead>
		<tr>
			<?php echo getTitleFieldOfList($langs->trans('Date'),1); ?>
			<?php echo getTitleFieldOfList($langs->trans('ConsoGazStation').' '.$langs->trans('Ref'),1); ?>
			<?php echo getTitleFieldOfList($langs->trans('ConsoGazStation').' '.$langs->trans('Label'),1); ?>
			<?php echo getTitleFieldOfList($langs->trans('ConsoGazVeh').' '.$langs->trans('Ref'),1); ?>
			<?php echo getTitleFieldOfList($langs->trans('ConsoGazVeh').' '.$langs->trans('ConsoGazImmat'),1); ?>
			<?php echo getTitleFieldOfList($langs->trans('ConsoGazDriver').' '.$langs->trans('Ref'),1); ?>
			<?php echo getTitleFieldOfList($langs->trans('ConsoGazDriver').' '.$langs->trans('Name'),1); ?>
			<?php echo getTitleFieldOfList($langs->trans('ConsoGazConsoAvg'),1); ?>
			<?php echo getTitleFieldOfList($langs->trans('ConsoGazColVol'),1); ?>
			<?php echo getTitleFieldOfList($langs->trans('ConsoGazColProd'),1); ?>
			<?php echo getTitleFieldOfList($langs->trans('ConsoGazColKM'),1); ?>
			<?php echo getTitleFieldOfList($langs->trans('ConsoGazColKMCtrole'),1); ?>
			<?php
			$object = new ConsogazoilVehTake($db);
			$extrafields = new ExtraFields($db);
			$extralabels = $extrafields->fetch_name_optionals_label($object->table_element);
			
			if (count($extrafields->attribute_label) > 0) {
				foreach ( $extrafields->attribute_label as $key => $label ) {
					echo getTitleFieldOfList($label, 1);
				}
			}
			?>
			<?php
			if ($user->rights->consogazoil->modifier) {
				echo getTitleFieldOfList($langs->trans('Edit'), 1);
			}
			?>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="5" class="dataTables_empty"><?php echo $langs->trans('LoadingDataFromServer'); ?></td>
		</tr>
	</tbody>
</table>
<!-- END PHP TEMPLATE -->