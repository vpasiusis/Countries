<?php
	
include 'libraries/countries.class.php';
$countriesObj = new countries();

include 'libraries/cities.class.php';
$citiesObj = new cities();

$formErrors = null;
$data = array();

$required = array('name', 'area', 'population', 'postal_code', 'fk_salys');
$countryName=($_GET['countryname']);
$country = $countriesObj->getCountry($countryName);
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

	include 'utils/validator.class.php';
	$validator = new validator($validations, $required, $maxLengths);

	if($validator->validate($_POST)) {
		$dataPrepared = $validator->preparePostFieldsForSQL();

		$dataPrepared['id'] = $citiesObj->insertCity($dataPrepared,$country['id']);

        $createSuccessParameter="&create_success=1";
		header("Location: index.php?module={$module}&action=list&cid={$country['id']}{$createSuccessParameter}");
		die();
	} else {
		$formErrors = $validator->getErrorHTML();

	}
}

include 'templates/city_form.tpl.php';

?>