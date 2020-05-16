<ul id="pagePath">
	<li><a href="index.php">Pradžia</a></li>
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Papildomos bendroves</a></li>
	<li><?php if(!empty($id)) echo "Bendroves redagavimas"; else echo "Nauja bendrove"; ?></li>
</ul>
<div class="float-clear"></div>
<div id="formContainer">
	<?php if($formErrors != null) { ?>
		<div class="errorBox">
			Neįvesti arba neteisingai įvesti šie laukai:
			<?php 
				echo $formErrors;
			?>
		</div>
	<?php } ?>
	<form action="" method="post">
		<fieldset>
			<legend>Bendroves informacija</legend>
			<p>
				<label class="field" for="pavadinimas">Pavadinimas<?php echo in_array('pavadinimas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="pavadinimas" name="pavadinimas" class="textbox textbox-200" value="<?php echo isset($data['pavadinimas']) ? $data['pavadinimas'] : ''; ?>">
				<?php if(key_exists('pavadinimas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['pavadinimas']} simb.)</span>"; ?>
			</p>
			<p>
					<label class="field" for="kodas">kodas<?php echo in_array('kodas', $required) ? '<span> *</span>' : ''; ?></label>
					<?php if(!isset($data['kodas'])) { ?>
						<input type="text" id="kodas" name="kodas" class="textbox textbox-150" value="<?php echo isset($data['kodas']) ? $data['kodas'] : ''; ?>" />
						<?php if(key_exists('kodas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['kodas']} simb.)</span>"; ?>
					<?php } else { ?>
						<span class="input-value"><?php echo $data['kodas']; ?></span>
						<input type="hidden" name="editing" value="1" />
						<input type="hidden" name="kodas" value="<?php echo $data['kodas']; ?>" />
					<?php } ?>
			</p>
			<p>
				<label class="field" for="punktu_skaicius">punktu_skaicius<?php echo in_array('punktu_skaicius', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="punktu_skaicius" name="punktu_skaicius" class="textbox textbox-200" value="<?php echo isset($data['punktu_skaicius']) ? $data['punktu_skaicius'] : ''; ?>">
				<?php if(key_exists('punktu_skaicius', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['punktu_skaicius']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="pelnas">pelnas<?php echo in_array('pelnas', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="pelnas" name="pelnas" class="textbox textbox-200" value="<?php echo isset($data['pelnas']) ? $data['pelnas'] : ''; ?>">
				<?php if(key_exists('pelnas', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['pelnas']} simb.)</span>"; ?>
			</p>
		</fieldset>
		
		<fieldset>
			<legend>Bendoves</legend>
			<div class="childRowContainer">
		
				<div class="labelLeft<?php if(empty($data['paslaugos_kainos']) || sizeof($data['paslaugos_kainos']) == 0) echo ' hidden'; ?>">Pavadinimas</div>
				<div class="labelRight<?php if(empty($data['paslaugos_kainos']) || sizeof($data['paslaugos_kainos']) == 0) echo ' hidden'; ?>"> Bendroves Kodas</div>
				<div class="labelRight<?php if(empty($data['paslaugos_kainos']) || sizeof($data['paslaugos_kainos']) == 0) echo ' hidden'; ?>"> Punktu skaicius</div>
				<div class="labelRight<?php if(empty($data['paslaugos_kainos']) || sizeof($data['paslaugos_kainos']) == 0) echo ' hidden'; ?>">Pelnas</div>
				<div class="float-clear"></div>
				<?php
					if(empty($data['paslaugos_kainos']) || sizeof($data['paslaugos_kainos']) == 0) {
				?>
					<div class="childRow hidden">
						<input type="text" name="pavadinimai[]" value="" class="textbox textbox-70" disabled="disabled" />
						<input type="text" name="kodas[]" value="" class="textbox textbox-70" disabled="disabled" />
						<input type="text" name="skaicius[]" value="" class="textbox textbox-70" disabled="disabled" />
						<input type="text" name="pelnas[]" value="" class="textbox textbox-70" disabled="disabled" />
						<input type="hidden" class="isDisabledForEditing" name="neaktyvus[]" value="0" />
						<a href="#" title="" class="removeChild">šalinti</a>
					</div>
					<div class="float-clear"></div>
					
				<?php
					} else {
						foreach($data['paslaugos_kainos'] as $key => $val) {
				?>
							<div class="childRow">
								<input type="text" name="pavadinimai[]" value="<?php echo $val['kaina']; ?>" class="textbox textbox-70<?php if(isset($val['neaktyvus']) && $val['neaktyvus'] == 1) echo ' disabledInput'; ?>" />
								<input type="text" name="kodas[]" value="<?php echo $val['galioja_nuo']; ?>" class="textbox textbox-70<?php if(isset($val['neaktyvus']) && $val['neaktyvus'] == 1) echo ' disabledInput'; ?>" />
								<input type="text" name="skaicius[]" value="<?php echo $val['galioja_nuo']; ?>" class="textbox textbox-70<?php if(isset($val['neaktyvus']) && $val['neaktyvus'] == 1) echo ' disabledInput'; ?>" />
								<input type="text" name="pelnas[]" value="<?php echo $val['galioja_nuo']; ?>" class="textbox textbox-70<?php if(isset($val['neaktyvus']) && $val['neaktyvus'] == 1) echo ' disabledInput'; ?>" />
								<input type="hidden" class="isDisabledForEditing" name="neaktyvus[]" value="<?php if(isset($val['neaktyvus']) && $val['neaktyvus'] == 1) echo "1"; else echo "0"; ?>" />
								<a href="#" title="" class="removeChild<?php if(isset($val['neaktyvus']) && $val['neaktyvus'] == 1) echo " hidden"; ?>">šalinti</a>
							</div>
							<div class="float-clear"></div>
				<?php 
						}
					}
				?>
			</div>
			<p id="newItemButtonContainer">
				<a href="#" title="" class="addChild">Pridėti</a>
			</p>
		</fieldset>
		
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>
		<?php if(isset($data['kodas'])) { ?>
			<input type="hidden" name="kodas" value="<?php echo $data['kodas']; ?>" />
		<?php } ?>
	</form>
</div>