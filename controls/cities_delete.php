<?php

include 'libraries/cities.class.php';
include 'libraries/countries.class.php';
$citiesObj = new cities();
$countriesObj = new countries();


if(isset($_POST['delete_city_btn'])) {

    $city = $citiesObj -> getCity($id);
    $country=$countriesObj->getCountryById($city['fk_salys']);
    $citiesObj->deleteCity($id);

    $removeSuccessParameter = '&remove_success=1';
    header("Location: index.php?module={$module}&action=list&cid={$country['id']}{$removeSuccessParameter}");
    die();
}
	
?>