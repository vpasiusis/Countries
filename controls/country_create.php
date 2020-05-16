<?php
	
include 'libraries/countries.class.php';
$countriesObj = new countries();


$formErrors = null;
$data = array();
//'vardas', 'pavarde', 'statymu_kiekis', 'balansas', 'registravimo_data', 'asmens_kodas', 'telefonas', 'gimimo_data',
	// 'ip', 'kliento_busena', 'fk_LAZYBOS_PUNKTASid_LAZYBOS_PUNKTAS'
$maxLengths = array (
	'pavadinimas' => 20
);
// nustatome privalomus laukus
$required = array('name', 'area', 'population', 'phone_nr', 'add_date');

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

		// patikriname, ar nėra sutarčių su tokiu pačiu numeriu
		$tmp = $countriesObj->getCountry($dataPrepared['name']);

		if(isset($tmp['nr'])) {
			// sudarome klaidų pranešimą
			$formErrors = "Sutartis su įvestu numeriu jau egzistuoja.";
			// laukų reikšmių kintamajam priskiriame įvestų laukų reikšmes
			$data = $_POST;
		} else {
			// įrašome naują sutartį
			$countriesObj->insertCountry($dataPrepared);
		}
		
		// nukreipiame vartotoją į sutarčių puslapį
		if($formErrors == null) {
			header("Location: index.php?module={$module}&action=list");
			die();
		}
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();

		// laukų reikšmių kintamajam priskiriame įvestų laukų reikšmes
		$data = $_POST;
		if(isset($_POST['kiekiai']) && sizeof($_POST['kiekiai']) > 0) {
			$i = 0;
			foreach($_POST['kiekiai'] as $key => $val) {
				$data['uzsakytos_paslaugos'][$i]['kiekis'] = $val;
				$i++;
			}
		}
	}
}


// įtraukiame šabloną
include 'templates/country_form.tpl.php';

?>