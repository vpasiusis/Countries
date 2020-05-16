<?php

include 'libraries/countries.class.php';
$contractsObj = new countries();

include 'libraries/cities.class.php';
$citiesObj = new cities();

if(!empty($id)) {

    $citiesObj->deleteCityByCountry($id);
	$contractsObj->deleteCountry($id);

	// nukreipiame į sutarčių puslapį
	header("Location: index.php?module={$module}&action=list");
	die();
}

?>