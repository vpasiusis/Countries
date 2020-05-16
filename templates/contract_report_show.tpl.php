<ul id="reportInfo">
	<li class="title">Registruotų klientų ataskaita</li>
	<li>Sudarymo data: <span><?php echo date("Y-m-d"); ?></span></li>
	<li>Registracijos laikotarpis:
		<span>
		<?php
			if(!empty($data['dataNuo'])) {
				if(!empty($data['dataIki'])) {
					echo "nuo {$data['dataNuo']} iki {$data['dataIki']}";
				} else {
					echo "nuo {$data['dataNuo']}";
				}
			} else {
				if(!empty($data['dataIki'])) {
					echo "iki {$data['dataIki']}";
				} else {
					echo "nenurodyta";
				}
			}
		?>
		</span>
	</li>
</ul>



<?php
	if(sizeof($contractData) > 0) { ?>
		<table class="reportTable">
			<tr>
				<th>Didžiausias balansas</th>
				<th>Balanso savininkas</th>
				<th class="width150">Klientų skaičius</th>
				<th class="width150">Bendras klientų balansas</th>
			</tr>

			<?php
				// suformuojame lentelę
				for($i = 0; $i < sizeof($contractData); $i++) {
					
					if($i == 0 || $contractData[$i]['punktaspav'] != $contractData[$i-1]['punktaspav']) {
						echo
							  "<tr>"
								. "<td class='groupSeparator' colspan='4'>Punktas -  {$contractData[$i]['punktaspav']}, Bendrovė - {$contractData[$i]['bendrpav']}</td>"
							. "</tr>";
					}
					echo
						"<tr>"
							. "<td>{$contractData[$i]['maksbala']} &euro;</td>"
							. "<td>{$contractData[$i]['vardas']} {$contractData[$i]['pavarde']}</td>"
							. "<td>{$contractData[$i]['klientusk']} </td>"
							. "<td>{$contractData[$i]['balanasosuma']} &euro;</td>"
						. "</tr>";
					
				}
			?>
		</table>
		<a href="index.php?module=contract&action=report" title="Nauja ataskaita" style="margin-bottom: 15px" class="button large float-right">nauja ataskaita</a>
<?php   
	} else {
?>
		<div class="warningBox">
			Nurodytu laikotartpiu sutarčių sudaryta nebuvo.
		</div>
<?php
	}
?>