<?php

$formErrors = "";
$country_id=($_GET['cid']);
if (!empty($_POST['submit'])) {
    if ($_POST['start_date'] != "" or $_POST['end_date'] != "") {
        if ($_POST['start_date'] != "" and $_POST['end_date'] != "") {
            if ($_POST['start_date'] > $_POST['end_date']) {
                $formErrors = ", enter dates correctly";
            }
            if ($formErrors == null) {
                $dateStartParameter = '&start_date=' . $_POST['start_date'];
                $dateEndParameter = '&end_date=' . $_POST['end_date'];
                header("Location: index.php?module={$module}&action=list&cid={$country_id}{$dateStartParameter}{$dateEndParameter}");
                die();
            }
        } elseif (($_POST['start_date'] != "") and ($_POST['end_date'] == "")) {
            if ($formErrors == null) {
                $dateStartParameter = '&start_date=' . $_POST['start_date'];
                header("Location: index.php?module={$module}&action=list&cid={$country_id}{$dateStartParameter}");
                die();
            }
        } elseif (($_POST['start_date'] == "") and ($_POST['end_date'] != "")) {
            if ($formErrors == null) {
                $dateEndParameter = '&end_date=' . $_POST['end_date'];
                header("Location: index.php?module={$module}&action=list&cid={$country_id}{$dateEndParameter}");
                die();
            }
        }
    } else {
        $formErrors = "Enter at least one date";
    }


}
include "templates/cities_filterDate.tpl.php";

