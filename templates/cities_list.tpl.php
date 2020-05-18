<ul id="pagePath">
	<li><a href="index.php?module=country&action=list">Back</a></li>
    <li><a href='index.php?module=cities&action=list&cid=<?php echo $country['id']; ?>' title=\"Miestai\"<?php if($module == 'cities') { echo 'class=\"active\"'; } ?>>Cities</a></li>
</ul>
<div id="actions">

    <input type="text" id="search" onkeyup="success()" placeholder="Search by..." class="textbox textbox-200" value="<?php if(isset($_GET['text'])) echo $_GET['text']; ?>">
    <input type="submit" class="submit button" disabled="disabled" id="searchButton" onclick="searchReplaceCity('cities',<?php echo $country['id']; ?>)" value="Search">
    <a href="index.php?module=cities&action=filter_date&cid=<?php echo $country['id']; ?>">Filter By Date</a>
    <a href='index.php?module=<?php echo $module; ?>&action=create&countryname=<?php echo $country['name']; ?>'>New city</a>
    <?php
    if(isset($_GET['text'])) {
        ?>
        <a href="index.php?module=cities&action=list&cid=<?php echo $country['id']; ?>&sortByNameAZ=1&text=<?php echo $_GET['text']; ?>"<?php if ($module == 'cities') {
            echo 'class="active"';
        } ?>>Sort by name(a-z)</a>
        <a href="index.php?module=cities&action=list&cid=<?php echo $country['id']; ?>&sortByNameZA=1&text=<?php echo $_GET['text']; ?>"<?php if ($module == 'cities') {
            echo 'class="active"';
        } ?>>Sort by name(z-a)</a>
        <?php
    }else {
        ?>
        <a href='index.php?module=cities&action=list&cid=<?php echo $country['id']; ?>&sortByNameAZ=1'<?php if ($module == 'cities') {
            echo 'class="active"';
        } ?>>Sort by name(a-z)</a>
        <a href='index.php?module=cities&action=list&cid=<?php echo $country['id']; ?>&sortByNameZA=1'<?php if ($module == 'cities') {
            echo 'class="active"';
        } ?>>Sort by name(z-a)</a>
        <?php
    }
    ?>
</div>
<div class="float-clear"></div>


<?php
include 'utils/messages.php';
$messagesObj = new messages("City");
$messagesObj->contructMessage();
if(isset($_GET['start_date']) or isset($_GET['end_date'])){?>
    <div class="successBox">
        Cities filtered by date
    </div>

    <?php

}
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