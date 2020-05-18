<?php
	
include 'libraries/countries.class.php';
$countriesObj = new countries();


$formErrors = null;
$formMessage = null;
$data = array();
$maxLengths = array (
	'pavadinimas' => 20
);
$required = array('name', 'area', 'population', 'phone_nr', 'add_date');

if(!empty($_POST['submit'])) {
	include 'utils/validator.class.php';

	$validations = array (
		'name' => 'anything',
		'area' => 'positivenumber',
		'population' => 'positivenumber',
		'phone_nr' => 'positivenumber',
		'add_date' => 'date'
	);

	$validator = new validator($validations, $required);

	if($validator->validate($_POST)) {
		$dataPrepared = $validator->preparePostFieldsForSQL();

		$tmp = $countriesObj->getCountry($dataPrepared['name']);

		if(isset($tmp['name'])) {
			$formErrors = "Country already exists";
			$data = $_POST;
		} else {
			$countriesObj->insertCountry($dataPrepared);
		}

		if($formErrors == null) {
            $createSuccessParameter = '&create_success=1';
			header("Location: index.php?module={$module}&action=list{$createSuccessParameter}");
            die();
		}
	} else {
		$formErrors = $validator->getErrorHTML();

	}
}

include 'templates/country_form.tpl.php';

?>