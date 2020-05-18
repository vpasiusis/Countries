<?php

include 'libraries/countries.class.php';
$countryObj = new countries();



$formErrors = null;
$data = array();

$required = array('name', 'area', 'population', 'phone_nr', 'add_date');
$maxLengths = array (
    'name' => 40
);
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

        $countryObj->updateCountry($dataPrepared);



		if($formErrors == null) {
            $editSuccessParameter = '&edit_success=1';
			header("Location: index.php?module={$module}&action=list{$editSuccessParameter}");
			die();
		}
	} else {
		$formErrors = $validator->getErrorHTML();

	}
} else {
	$data = $countryObj->getCountryById($id);
	
}

$data['editing'] = 1;

include 'templates/country_form.tpl.php';

?>