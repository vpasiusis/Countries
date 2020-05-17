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
	'aprasymas' => 300
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

		// atnaujiname duomenis
		$citiesObj->updateCity($dataPrepared,$country['id'],$id);


		// nukreipiame į paslaugų puslapį
        $editSuccessParameter = '&edit_success=1';
        header("Location: index.php?module={$module}&action=list&cid={$country['id']}{$editSuccessParameter}");

        die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();


	}
} else {
	if(!empty($id)) {
		$data = $citiesObj->getCity($id);
		
	
	}
}

// įtraukiame šabloną
include 'templates/city_form.tpl.php';

?>