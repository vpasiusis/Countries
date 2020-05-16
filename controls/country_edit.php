<?php

include 'libraries/countries.class.php';
$countryObj = new countries();



$formErrors = null;
$data = array();

// nustatome privalomus laukus
// nustatome privalomus laukus
$required = array('name', 'area', 'population', 'phone_nr', 'add_date');
$maxLengths = array (
    'name' => 40
);
// vartotojas paspaudė išsaugojimo mygtuką
if(!empty($_POST['submit'])) {
    include 'utils/validator.class.php';

    // nustatome laukų validatorių tipus
    $validations = array (
        'name' => 'anything',
        'area' => 'anything',
        'population' => 'positivenumber',
        'phone_nr' => 'positivenumber',
        'add_date' => 'date'
    );

	// sukuriame laukų validatoriaus objektą
	$validator = new validator($validations, $required);

	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
		// suformuojame laukų reikšmių masyvą SQL užklausai
		$dataPrepared = $validator->preparePostFieldsForSQL();

		// atnaujiname sutartį
        $countryObj->updateCountry($dataPrepared);

		// atnaujiname užsakytas paslaugas
		//$contractsObj->updateOrderedServices($dataPrepared);


		if($formErrors == null) {
            $editSuccessParameter = '&edit_success=1';
			header("Location: index.php?module={$module}&action=list{$editSuccessParameter}");
			die();
		}
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();

	}
} else {
	//  išrenkame elemento duomenis ir jais užpildome formos laukus.
	$data = $countryObj->getCountryById($id);
	
}

// nustatome požymį, kad įrašas redaguojamas norint išjungti ID redagavimą šablone
$data['editing'] = 1;

// įtraukiame šabloną
include 'templates/country_form.tpl.php';

?>