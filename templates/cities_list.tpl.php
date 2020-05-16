<ul id="pagePath">
	<li><a href="index.php?module=country&action=list">Back</a></li>
    <li>Cities</li>
</ul>
<div id="actions">
	<a href='index.php?module=<?php echo $module; ?>&action=create&countryname=<?php echo $country['name']; ?>'>New city</a>
</div>
<div class="float-clear"></div>

<?php if(isset($_GET['remove_error'])) { ?>
	<div class="errorBox">
		City wasn't removed
	</div>

<?php  }
 if(count($data)==0){
    ?>
    <div class="errorBox">
		No cities found
	</div>
<?php
}else {

    ?>
<table class="listTable">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Area</th>
		<th>Population</th>
        <th>Postal Code</th>
		<th></th>
	</tr>
    <?php

            foreach ($data as $key => $val) {
                echo
                    "<tr>"
                    . "<td>{$val['id']}</td>"
                    . "<td>{$val['name']}</td>"
                    . "<td>{$val['area']}</td>"
                    . "<td>{$val['population']}</td>"
                    . "<td>{$val['postal_code']}</td>"
                    . "<td>"
                    . "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['id']}\", \"{$country['id']}\"); return false;' title=''>Remove</a>&nbsp;"
                    . "<a href='index.php?module={$module}&action=edit&id={$val['id']}&countryname={$country['name']}' title=''>Edit</a>"
                    . "</td>"
                    . "</tr>";
            }
        }
	?>
</table>

<?php
	include 'templates/paging.tpl.php';
?>