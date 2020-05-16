<?php
	
include 'libraries/countries.class.php';
$contractsObj = new countries();

include 'libraries/cities.class.php';
$servicesObj = new cities();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('name', 'area', 'population', 'postal_code', 'add_date', 'fk_salys');
$countryName=($_GET['countryname']);
var_dump("asd");
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
        'add_date' => 'date',
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
		$dataPrepared['id'] = $servicesObj->insertService($dataPrepared);
		
		// įrašome paslaugų kainas
		$servicesObj->insertServicePrices($dataPrepared);

		// nukreipiame į modelių puslapį
		header("Location: index.php?module={$module}&action=list");
		die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
		if(isset($_POST['kainos']) && sizeof($_POST['kainos']) > 0) {
			$i = 0;
			foreach($_POST['kainos'] as $key => $val) {
				$data['paslaugos_kainos'][$i]['kaina'] = $val;
				$data['paslaugos_kainos'][$i]['galioja_nuo'] = $_POST['datos'][$key];
				$data['paslaugos_kainos'][$i]['neaktyvus'] = $_POST['neaktyvus'][$key];
				$i++;
			}
		}
	}
}

// įtraukiame šabloną
include 'templates/city_form.tpl.php';

?>