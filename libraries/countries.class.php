<?php
/**
 * Sutarčių redagavimo klasė
 *
 * @author ISK
 */

class countries {

	private $saliu_lentele = '';
	private $lazybos_lentele = '';
	private $kliento_busenos_lentele = '';
	private $uzsakytos_paslaugos_lentele = '';
	private $aiksteles_lentele = '';
	private $paslaugu_kainos_lentele = '';
	
	public function __construct() {
		$this->saliu_lentele = config::DB_PREFIX . 'šalys';
	}
	
	/**
	 * Sutarčių sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	//INSERT INTO `KLIENTAI` (`vardas`, `pavarde`, `statymu_kiekis`, `balansas`, `registravimo_data`, `asmens_kodas`, `telefonas`, `gimimo_data`, `ip`, `kliento_busena`, `fk_LAZYBOS_PUNKTASid_LAZYBOS_PUNKTAS`) VALUES

	public function getCountriesList($limit, $offset) {
        $limitOffsetString = "";
        if(isset($limit)) {
            $limitOffsetString .= " LIMIT {$limit}";
        }
        if(isset($offset)) {
            $limitOffsetString .= " OFFSET {$offset}";
        }

        $query = "  SELECT *
					FROM {$this->saliu_lentele}{$limitOffsetString}";
        $data = mysql::select($query);

		return $data;
	}
	
	/**
	 * Sutarčių kiekio radimas
	 * @return type
	 */
	public function getCountriesListCount() {
		$query = "  SELECT COUNT(`name`) AS `kiekis` FROM {$this->saliu_lentele}";
		$data = mysql::select($query);
		return $data[0]['kiekis'];
	}

	public function getCountry($name) {
		$query = "  SELECT *
					FROM `{$this->saliu_lentele}` WHERE `name`='{$name}'";

		$data = mysql::select($query);
		return $data[0];
	}
    public function getCountryById($id) {
        $query = "  SELECT *
					FROM `{$this->saliu_lentele}` WHERE `id`='{$id}'";

        $data = mysql::select($query);
        return $data[0];
    }
	
	
	
	/**
	 * Sutarties atnaujinimas
	 * @param type $data
	 */
	public function updateCountry($data) {
		$query = "  UPDATE `{$this->saliu_lentele}`
					SET    `name`='{$data['name']}',
						   `population`='{$data['population']}',
						   `area`='{$data['area']}',
						   `phone_nr`='{$data['phone_nr']}',
						   `add_date`='{$data['add_date']}'
					WHERE `id`='{$data['id']}'";
		mysql::query($query);
	}
	
	/**
	 * Sutarties įrašymas
	 * @param type $data
	 */
	//INSERT INTO `KLIENTAI` (`vardas`, `pavarde`, `statymu_kiekis`, `balansas`, `registravimo_data`, `asmens_kodas`, `telefonas`, `gimimo_data`,
	// `ip`, `kliento_busena`, `fk_LAZYBOS_PUNKTASid_LAZYBOS_PUNKTAS`) VALUES

	public function insertCountry($data) {
	    $datee=date("Y/m/d");
		$query = "  INSERT INTO `{$this->saliu_lentele}`
								(
									`name`,
									`area`,
									`population`,
									`phone_nr`,
									`add_date`
								)
								VALUES
								(
									'{$data['name']}',
									'{$data['area']}',
									'{$data['population']}',
									'{$data['phone_nr']}',
									'{$datee}'
								)";
		mysql::query($query);
	}
	
	/**
	 * Sutarties šalinimas
	 * @param type $id
	 */
	public function deleteCountry($id) {
		$query = "  DELETE FROM `{$this->saliu_lentele}`
					WHERE `id`='{$id}'";
		mysql::query($query);
	}

	

	

	
}