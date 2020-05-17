<ul id="pagePath">
    <li><a href="index.php?module=cities&action=list&cid=<?php echo $country['id']?>">Back</a></li>
	<li><?php if(!empty($id)) echo "Editing City"; else echo "New city"; ?></li>
</ul>
<div class="float-clear"></div>
<div id="formContainer">
	<?php if($formErrors != null) { ?>
		<div class="errorBox">
			Check these fields
			<?php 
				echo $formErrors;
			?>
		</div>
	<?php } ?>
	<form action="" method="post">
		<fieldset>
			<legend>Information</legend>
			<p>
				<label class="field" for="name">Name<?php echo in_array('name', $required) ? '<span> *</span>' : ''; ?></label>
				<input type="text" id="name" name="name" class="textbox textbox-200" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>">
				<?php if(key_exists('name', $maxLengths)) echo "<span class='max-len'>(max {$maxLengths['name']} let.)</span>"; ?>
			</p>
            <p>
                <label class="field" for="area">Area<?php echo in_array('area', $required) ? '<span> *</span>' : ''; ?></label>
                <input type="text" id="area" name="area" class="textbox textbox-200" value="<?php echo isset($data['area']) ? $data['area'] : ''; ?>">
                <?php if(key_exists('area', $maxLengths)) echo "<span class='max-len'>(max {$maxLengths['area']} let.)</span>"; ?>
            </p>
            <p>
                <label class="field" for="population">Population<?php echo in_array('population', $required) ? '<span> *</span>' : ''; ?></label>
                <input type="text" id="population" name="population" class="textbox textbox-200" value="<?php echo isset($data['population']) ? $data['population'] : ''; ?>">
                <?php if(key_exists('population', $maxLengths)) echo "<span class='max-len'>(max {$maxLengths['population']} let.)</span>"; ?>
            </p>
            <p>
                <label class="field" for="postal_code">Postal code<?php echo in_array('postal_code', $required) ? '<span> *</span>' : ''; ?></label>
                <input type="text" id="postal_code" name="postal_code" class="textbox textbox-200" value="<?php echo isset($data['postal_code']) ? $data['postal_code'] : ''; ?>">
                <?php if(key_exists('postal_code', $maxLengths)) echo "<span class='max-len'>(max {$maxLengths['postal_code']} let.)</span>"; ?>
            </p>
            <p>
                <label class="field" for="add_date">Adding Date</label>
                <input type="text" id="add_date" name="add_date" class="textbox textbox-200" value="<?php echo date("Y/m/d"); ?>" readonly>
            </p>
            <p>
                <label class="field" for="add_date">Country</label>
                <input type="text" id="add_date" name="add_date" class="textbox textbox-200" value="<?php echo $country['name']; ?>" readonly>
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