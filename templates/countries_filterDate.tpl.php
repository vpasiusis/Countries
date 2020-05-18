<ul id="pagePath">
    <li><a href="index.php?module=<?php echo $module; ?>&action=list">Countries</a></li>
    <li>Filter By Date</li>
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
            <legend>Dates</legend>
            <p>
                <label class="field" for="start_date">Start</label>
                <input type="text" id="start_date" name="start_date" class="textbox textbox-200 date" value="" >
            </p>
            <p>
                <label class="field" for="end_date">End</label>
                <input type="text" id="end_date" name="end_date" class="textbox textbox-200 date" value="" >
            </p>

        </fieldset>


        <p>
            <input type="submit" class="submit button" name="submit" value="Search">
        </p>

        <input type="hidden" name="id" value="<?php echo isset($data['id']) ? $data['id'] : ''; ?>" />
    </form>
</div>