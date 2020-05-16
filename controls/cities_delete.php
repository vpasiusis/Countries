<?php

include 'libraries/cities.class.php';
include 'libraries/countries.class.php';
$citiesObj = new cities();
$countriesObj = new countries();


if(!empty($id)) {
	// patikriname, ar šalinama paslauga nenaudojama jokioje sutartyje

    $city = $citiesObj -> getCity($id);

    $country=$countriesObj->getCountryById($city['fk_salys']);
    $citiesObj->deleteCity($id);


	// nukreipiame į paslaugų puslapį
    header("Location: index.php?module={$module}&action=list&cid={$country['id']}");
    die();
}
	
?>