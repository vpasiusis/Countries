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
	'aprasymas' => 300
);

if(!empty($_POST['submit'])) {
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

		$citiesObj->updateCity($dataPrepared,$country['id'],$id);


        $editSuccessParameter = '&edit_success=1';
        header("Location: index.php?module={$module}&action=list&cid={$country['id']}{$editSuccessParameter}");

        die();
	} else {
		$formErrors = $validator->getErrorHTML();
        $data = $_POST;

	}
} else {
	if(!empty($id)) {
		$data = $citiesObj->getCity($id);
		
	
	}
}

include 'templates/city_form.tpl.php';

?>