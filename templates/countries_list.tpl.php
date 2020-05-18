<ul id="pagePath">
	<li><a href="index.php?module=country&action=list"<?php if($module == 'country') { echo 'class="active"'; } ?>>Countries</a></li>



</ul>
<div id="actions">

    <input type="text" id="search" onkeyup="success()" placeholder="Search by..." class="textbox textbox-200" value="<?php if(isset($_GET['text'])) echo $_GET['text']; ?>">
    <input type="submit" class="submit button" disabled="disabled" id="searchButton" onclick="searchReplace('country')">
    <a href="index.php?module=country&action=filter_date">Filter By Date</a>
	<a href='index.php?module=<?php echo $module; ?>&action=create'>New country</a>
    <?php
    if(isset($_GET['text'])) {
        ?>
        <a href="index.php?module=country&action=list&sortByNameAZ=1&text=<?php echo $_GET['text']; ?>"<?php if ($module == 'country') {
            echo 'class="active"';
        } ?>>Sort by name(a-z)</a>
        <a href="index.php?module=country&action=list&sortByNameZA=1&text=<?php echo $_GET['text']; ?>"<?php if ($module == 'country') {
            echo 'class="active"';
        } ?>>Sort by name(z-a)</a>
        <?php
    }else {
        ?>
        <a href="index.php?module=country&action=list&sortByNameAZ=1"<?php if ($module == 'country') {
            echo 'class="active"';
        } ?>>Sort by name(a-z)</a>
        <a href="index.php?module=country&action=list&sortByNameZA=1"<?php if ($module == 'country') {
            echo 'class="active"';
        } ?>>Sort by name(z-a)</a>
        <?php
    }
 ?>
</div>
<div class="float-clear"></div>
<?php
include 'utils/messages.php';
$messagesObj = new messages("Country");
$messagesObj->contructMessage();
if(isset($_GET['start_date']) or isset($_GET['end_date'])){?>
    <div class="successBox">
    Countries filtered by date
    </div>

    <?php

}
if(count($data)==0){
    ?>
    <div class="errorBox">
        No countries found
    </div>
    <?php
}else {
    ?>

<table class="table">
    <thead>
    <tr>
        <th >ID</th>
        <th>Name</th>
        <th>Population(Millions)</th>
        <th>Area(squared km)</th>
        <th>Phone nr.</th>
        <th>Actions</th>
        <th>Cities</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // suformuojame lentelę
    foreach($data as $key => $val) {
        echo
            "<tr>"
            . "<td>{$val['id']}</td>"
            . "<td>{$val['name']}</td>"
            . "<td>{$val['population']}</td>"
            . "<td>{$val['area']}</td>"
            . "<td>{$val['phone_nr']}</td>"
            . "<td>"
            .   "<button class=\"submit button\" onclick='showConfirmDialog(\"{$module}\", \"{$val['id']}\"); return false;' title='' class=\"btn btn-info\">Remove</button>"
            .   "<button class=\"submit button\" onclick=\"location.href='index.php?module={$module}&action=edit&id={$val['id']}'\" title=''>Edit</button>"
            . "</td>"
            . "<td><button class=\"submit button\" onclick=\"location.href='index.php?module=cities&action=list&cid={$val['id']}'\" title=\"Miestai\"<?php if($module == 'cities') { echo 'class=\"active\"'; } ?>Cities</button></td>"
            . "</tr>";
    }
    ?>
    </tbody>
</table>
<?php
    }
	include 'templates/paging.tpl.php';
?>