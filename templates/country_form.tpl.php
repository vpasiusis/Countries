<ul id="pagePath">
	<li><a href="index.php?module=<?php echo $module; ?>&action=list">Countries</a></li>
	<li><?php if(!empty($id)) echo "Editing Country"; else echo "New Country"; ?></li>
</ul>
<div class="float-clear"></div>
<div id="formContainer">
	<?php if($formErrors != null) { ?>
		<div class="errorBox">
			Data entered incorrectly
			<?php 
				echo $formErrors;
			?>
		</div>
	<?php  } ?>

	<form action="" method="post">
		<fieldset>
			<legend>Country information</legend>
			<p>
				<label class="field" for="name">Name<?php echo in_array('name', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="name" name="name" class="textbox textbox-150" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" />
				<?php if(key_exists('name', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['name']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="area">Area(in squared km)<?php echo in_array('area', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="area" name="area" class="textbox textbox-150" value="<?php echo isset($data['area']) ? $data['area'] : ''; ?>" />
				<?php if(key_exists('pavarde', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['area']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="population">Population(Millions)<?php echo in_array('population', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="population" name="population" class="textbox textbox-150" value="<?php echo isset($data['population']) ? $data['population'] : ''; ?>" />
				<?php if(key_exists('population', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['population']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="phone_nr">Phone number<?php echo in_array('phone_nr', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="phone_nr" name="phone_nr" class="textbox textbox-150" value="<?php echo isset($data['phone_nr']) ? $data['phone_nr'] : ''; ?>" />
				<?php if(key_exists('phone_nr', $maxLengths)) echo "<span class='max-len'>(iki {$maxLengths['phone_nr']} simb.)</span>"; ?>
			</p>
			<p>
				<label class="field" for="add_date">Adding Date</label>
				<input type="text" id="add_date" name="add_date" class="textbox textbox-70 date" value="<?php echo date("Y/m/d"); ?>" readonly>
			</p>
			
		</fieldset>

		
		<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
		<p>
			<input type="submit" class="submit button" name="submit" value="Išsaugoti">
		</p>

		<input type="hidden" name="id" value="<?php echo isset($data['id']) ? $data['id'] : ''; ?>" />
	</form>
</div>