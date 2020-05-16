<?php

// sukuriame sutarčių klasės objektą
include 'libraries/countries.class.php';
$countriesObj = new countries();

// sukuriame puslapiavimo klasės objektą
include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $countriesObj->getCountriesListCount();
// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);
// išrenkame nurodyto puslapio sutartis
$data = $countriesObj->getCountriesList($paging->size, $paging->first);

// įtraukiame šabloną
include 'templates/countries_list.tpl.php';

?>