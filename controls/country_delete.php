<?php

include 'libraries/countries.class.php';
$contractsObj = new countries();

include 'libraries/cities.class.php';
$citiesObj = new cities();

if(isset($_POST['delete_country_btn'])) {

    $citiesObj->deleteCityByCountry($id);
	$contractsObj->deleteCountry($id);
    $removeSuccessParameter = '&remove_success=1';
	header("Location: index.php?module={$module}&action=list{$removeSuccessParameter}");
	die();
}

?>