<ul id="pagePath">
	<li><a href="index.php?module=country&action=list">Back</a></li>
    <li><a href='index.php?module=cities&action=list&cid=<?php echo $country['id']; ?>' title=\"Miestai\"<?php if($module == 'cities') { echo 'class=\"active\"'; } ?>>Cities</a></li>
</ul>
<div id="actions">
	<a href='index.php?module=<?php echo $module; ?>&action=create&countryname=<?php echo $country['name']; ?>'>New city</a>
    <a href='index.php?module=cities&action=list&cid=<?php echo $country['id']; ?>&sortByNameAZ=1' title=\"Miestai\"<?php if($module == 'cities') { echo 'class=\"active\"'; } ?>>Sort by name(a-z)</a>
    <a href='index.php?module=cities&action=list&cid=<?php echo $country['id']; ?>&sortByNameZA=1' title=\"Miestai\"<?php if($module == 'cities') { echo 'class=\"active\"'; } ?>>Sort by name(z-a)</a>

</div>
<div class="float-clear"></div>


<?php
include 'utils/messages.php';
$messagesObj = new messages("City");
$messagesObj->contructMessage();

?>
<?php
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
		<th>Actions</th>
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
                    .  "<button class=\"submit button\"  onclick='showConfirmDialog(\"{$module}\", \"{$val['id']}\", \"{$country['id']}\"); return false;' title=''>Remove</button>"
                    .  "<button class=\"submit button\" onclick=\"location.href='index.php?module={$module}&action=edit&id={$val['id']}&countryname={$country['name']}'\" title=''>Edit</button>"
                    . "</td>"
                    . "</tr>";
            }
        }
	?>
</table>

<?php
	include 'templates/paging.tpl.php';
?>