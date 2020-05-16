<ul id="pagePath">
	<li><a href="">Countries</a></li>
</ul>
<div id="actions">
	<a href='index.php?module=<?php echo $module; ?>&action=create'>New country</a>
</div>
<div class="float-clear"></div>

<table class="table">
    <thead>
    <tr>
        <th >ID</th>
        <th>Name</th>
        <th>Population(Millions)</th>
        <th>Area(squared km)</th>
        <th>Phone nr.</th>
        <th></th>
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
            .   "<button type=\"button\" onclick='showConfirmDialog(\"{$module}\", \"{$val['id']}\"); return false;' title='' class=\"btn btn-info\">Remove</button>"
            .   "<a href='index.php?module={$module}&action=edit&id={$val['id']}' title=''>redaguoti</a>"
            . "</td>"
            . "</tr>";
    }
    ?>
    </tbody>
</table>


<?php
	include 'templates/paging.tpl.php';
?>