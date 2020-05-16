<?php
	
include 'libraries/countries.class.php';
$countriesObj = new countries();

include 'libraries/cities.class.php';
$citiesObj = new cities();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('name', 'area', 'population', 'postal_code', 'fk_salys');
$countryName=($_GET['countryname']);
$country = $countriesObj->getCountry($countryName);
// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'name' => 40,
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// nustatome laukų validatorių tipus
	$validations = array (
		'name' => 'anything',
		'area' => 'positivenumber',
		'population' => 'positivenumber',
		'postal_code' => 'anything',
        'fk_salys' => 'positivenumber',
    );

	// sukuriame validatoriaus objektą
	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();
		
		// įrašome naują pasaugą ir gauname jos id
		$dataPrepared['id'] = $citiesObj->insertCity($dataPrepared,$country['id']);


		header("Location: index.php?module={$module}&action=list&cid={$country['id']}");
		die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus

	}
}

// įtraukiame šabloną
include 'templates/city_form.tpl.php';

?>