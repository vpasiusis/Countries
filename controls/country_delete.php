<?php

include 'libraries/countries.class.php';
$contractsObj = new countries();

if(!empty($id)) {
	// pašaliname užsakytas paslaugas
	//$contractsObj->deleteOrderedServices($id);

	// šaliname sutartį
	$contractsObj->deleteCountry($id);

	// nukreipiame į sutarčių puslapį
	header("Location: index.php?module={$module}&action=list");
	die();
}

?>