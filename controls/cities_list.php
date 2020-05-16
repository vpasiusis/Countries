<?php
	
include 'libraries/countries.class.php';
$countriesObj = new countries();

include 'libraries/cities.class.php';
$citiesObj = new cities();

// suskaičiuojame bendrą įrašų kiekį
$country_id=($_GET['cid']);
$elementCount = $citiesObj->getCitiesListCount($country_id);

include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);	

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio paslaugas
$data = $citiesObj->getCitiesList($paging->size, $paging->first,$country_id);
$country = $countriesObj->getCountryById($country_id);

// įtraukiame šabloną
include 'templates/cities_list.tpl.php';

?>