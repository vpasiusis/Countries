<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li>Lažybos bendrovės</li>
</ul>
<div id="actions">
	<a href='index.php?module=<?php echo $module; ?>&action=create'>Nauja bendrovė</a>
</div>
<div class="float-clear"></div>

<?php if(isset($_GET['remove_error'])) { ?>
	<div class="errorBox">
		Paslauga nebuvo pašalinta.
	</div>
<?php } ?>

<table class="listTable">
	<tr>
		<th>ID</th>
		<th>pavadinimas</th>
		<th>punktu_skaicius</th>
		<th>pelnas</th>
		<th></th>
	</tr>
	<?php
		// suformuojame lentelę\
			//INSERT INTO `LAZYBOS_BENDROVES` (`pavadinimas`, `kodas`, `punktu_skaicius`, `pelnas`) VALUES
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td>{$val['kodas']}</td>"
					. "<td>{$val['pavadinimas']}</td>"
					. "<td>{$val['punktu_skaicius']}</td>"
					. "<td>{$val['pelnas']}</td>"
					. "<td>"
						. "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['kodas']}\"); return false;' title=''>šalinti</a>&nbsp;"
						. "<a href='index.php?module={$module}&action=edit&id={$val['kodas']}' title=''>redaguoti</a>"
					. "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
	// įtraukiame puslapių šabloną
	include 'templates/paging.tpl.php';
?>