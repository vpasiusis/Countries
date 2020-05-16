<?php
/**
 * Papildomų paslaugų redagavimo klasė
 *
 * @author ISK
 */

class cities {
	
	
	private $cities_table = '';
	private $sutartys_lentele = '';
	private $paslaugu_kainos_lentele = '';
	private $uzsakytos_lazybos_bendroves_lentele = '';
	
	public function __construct() {
		$this->cities_table = config::DB_PREFIX . 'miestai';
	
	}

	/**
	 * Paslaugų sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getCitiesList($limit = null, $offset = null, $coutry_id) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}
		
		$query = "  SELECT *
					FROM `{$this->cities_table}` WHERE `{$this->cities_table}`.`fk_salys`={$coutry_id} " . $limitOffsetString;
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Paslaugų kiekio radimas
	 * @return type
	 */
	public function getCitiesListCount($coutry_id) {

		$query = "  SELECT COUNT(`{$this->cities_table}`.`id`) as `kiekis`
					FROM `{$this->cities_table}`
					WHERE `{$this->cities_table}`.`fk_salys`={$coutry_id}";
		$data = mysql::select($query);
		return $data[0]['kiekis'];
	}
	
	
	
	/**
	 * Sutarčių, į kurias įtraukta paslauga, kiekio radimas
	 * @param type $serviceId
	 * @return type
	 */
	public function getContractCountOfService($serviceId) {
		$query = "  SELECT COUNT(`kodas`) as `kiekis`
					FROM `{$this->lazybos_bendroves_lentele}`";

		$data = mysql::select($query);
		
		return $data[0]['kiekis'];
	}
	
	/**
	 * Paslaugos išrinkimas
	 * @param type $id
	 * @return type
	 */
	public function getCity($id) {
		$query = "  SELECT *
					FROM `{$this->cities_table}`
					WHERE `id`='{$id}'";
		$data = mysql::select($query);

		return $data[0];
	}
	
	/**
	 * Paslaugos įrašymas
	 * @param type $data
	 * @return įrašytos paslaugos ID
	 */
		//INSERT INTO `LAZYBOS_BENDROVES` (`pavadinimas`, `kodas`, `punktu_skaicius`, `pelnas`) VALUES

	public function insertCity($data, $countryId) {
	    $dates = date("Y/m/d");

		$query = "  INSERT INTO `{$this->cities_table}`
								(
									`name`,
									`area`,
									`population`,
									`postal_code`,
									`add_date`,
									`fk_salys`
								)
								VALUES
								(
									'{$data['name']}',
									'{$data['area']}',
									'{$data['population']}',
									'{$data['postal_code']}',
									'{$dates}',
									'{$countryId}'
								)";
		mysql::query($query);
		return mysql::getLastInsertedId();
	}
	
	/**
	 * Paslaugos atnaujinimas
	 * @param type $data
	 */
	public function updateCity($data,$countryId,$id) {
        $dates = date("Y/m/d");

		$query = "  UPDATE `{$this->cities_table}`
					SET    `name`='{$data['name']}',
							`area`='{$data['area']}',
							`population`='{$data['population']}',
							`postal_code`='{$data['postal_code']}',
							`add_date`='{$dates}',
							`fk_salys`='{$countryId}'
					WHERE `id`='{$id}'";

		mysql::query($query);
	}
	
	/**
	 * Paslaugos šalinimas
	 * @param type $id
	 */
	public function deleteCity($id) {
		$query = "  DELETE FROM `{$this->cities_table}`
					WHERE `id`='{$id}'";
		mysql::query($query);
	}
	
	/**
	 * Paslaugos kainų įrašymas
	 * @param type $data
	 */
	public function insertServicePrices($data) {
		if(isset($data['kainos']) && sizeof($data['kainos']) > 0) {
			foreach($data['kainos'] as $key=>$val) {
				if($data['neaktyvus'] == array() || $data['neaktyvus'][$key] == 0) {
					$query = "  INSERT INTO `{$this->lazybos_bendroves_lentele}`
											(
												`pavadinimas`,
												`kodas`,
												`punktu_skaicius`,
												`pelnas`
											)
											VALUES
											(
												'{$data['pavadinimas']}',
												'{$data['kodas']}',
												'{$data['kodas']}',
												'{$data['datos'][$key]}',
												'{$val}'
											)";
					mysql::query($query);
				}
			}
		}
	}
	
	/**
	 * Paslaugos kainų šalinimas
	 * @param type $serviceId
	 * @param type $clause
	 */
	public function deleteServicePrices($serviceId, $clause = "") {
		$query = "  DELETE FROM `{$this->paslaugu_kainos_lentele}`
					WHERE `fk_paslauga`='{$serviceId}'" . $clause;
		mysql::query($query);
	}
	
	public function getOrderedServices($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " WHERE `{$this->sutartys_lentele}`.`sutarties_data`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->sutartys_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " WHERE `{$this->sutartys_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		}
		$query = "  SELECT `id`,
						   `pavadinimas`,
						   sum(`kiekis`) AS `uzsakyta`,
						   sum(`kiekis`*`{$this->uzsakytos_lazybos_bendroves_lentele}`.`kaina`) AS `bendra_suma`
					FROM `{$this->lazybos_bendroves_lentele}`
						INNER JOIN `{$this->uzsakytos_lazybos_bendroves_lentele}`
							ON `{$this->lazybos_bendroves_lentele}`.`id`=`{$this->uzsakytos_lazybos_bendroves_lentele}`.`fk_paslauga`
						INNER JOIN `{$this->sutartys_lentele}`
							ON `{$this->uzsakytos_lazybos_bendroves_lentele}`.`fk_sutartis`=`{$this->sutartys_lentele}`.`nr`
					{$whereClauseString}
					GROUP BY `{$this->lazybos_bendroves_lentele}`.`id` ORDER BY `bendra_suma` DESC";
		$data = mysql::select($query);

		return $data;
	}

	public function getStatsOfOrderedServices($dateFrom, $dateTo) {
		$whereClauseString = "";
		if(!empty($dateFrom)) {
			$whereClauseString .= " WHERE `{$this->sutartys_lentele}`.`sutarties_data`>='{$dateFrom}'";
			if(!empty($dateTo)) {
				$whereClauseString .= " AND `{$this->sutartys_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		} else {
			if(!empty($dateTo)) {
				$whereClauseString .= " WHERE `{$this->sutartys_lentele}`.`sutarties_data`<='{$dateTo}'";
			}
		}
		
		$query = "  SELECT sum(`kiekis`) AS `uzsakyta`,
						   sum(`kiekis`*`{$this->uzsakytos_lazybos_bendroves_lentele}`.`kaina`) AS `bendra_suma`
					FROM `{$this->lazybos_bendroves_lentele}`
						INNER JOIN `{$this->uzsakytos_lazybos_bendroves_lentele}`
							ON `{$this->lazybos_bendroves_lentele}`.`id`=`{$this->uzsakytos_lazybos_bendroves_lentele}`.`fk_paslauga`
						INNER JOIN `{$this->sutartys_lentele}`
							ON `{$this->uzsakytos_lazybos_bendroves_lentele}`.`fk_sutartis`=`{$this->sutartys_lentele}`.`nr`
					{$whereClauseString}";
		$data = mysql::select($query);

		return $data;
	}
}