<?php
/**
 * Papildomų paslaugų redagavimo klasė
 *
 * @author ISK
 */

class services {
	
	
	private $lazybos_bendroves_lentele = '';
	private $sutartys_lentele = '';
	private $paslaugu_kainos_lentele = '';
	private $uzsakytos_lazybos_bendroves_lentele = '';
	
	public function __construct() {
		$this->lazybos_bendroves_lentele = config::DB_PREFIX . 'LAZYBOS_BENDROVES';
	
	}

	/**
	 * Paslaugų sąrašo išrinkimas
	 * @param type $limit
	 * @param type $offset
	 * @return type
	 */
	public function getServicesList($limit = null, $offset = null) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}
		
		$query = "  SELECT *
					FROM `{$this->lazybos_bendroves_lentele}`" . $limitOffsetString;
		$data = mysql::select($query);
		
		return $data;
	}
	
	/**
	 * Paslaugų kiekio radimas
	 * @return type
	 */
	public function getServicesListCount() {
		$query = "  SELECT COUNT(`{$this->lazybos_bendroves_lentele}`.`kodas`) as `kiekis`
					FROM `{$this->lazybos_bendroves_lentele}`";
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
	public function getService($id) {
		$query = "  SELECT *
					FROM `{$this->lazybos_bendroves_lentele}`
					WHERE `kodas`='{$id}'";
		$data = mysql::select($query);

		return $data[0];
	}
	
	/**
	 * Paslaugos įrašymas
	 * @param type $data
	 * @return įrašytos paslaugos ID
	 */
		//INSERT INTO `LAZYBOS_BENDROVES` (`pavadinimas`, `kodas`, `punktu_skaicius`, `pelnas`) VALUES

	public function insertService($data) {
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
									'{$data['punktu_skaicius']}',
									'{$data['pelnas']}'
								)";
		mysql::query($query);
		return mysql::getLastInsertedId();
	}
	
	/**
	 * Paslaugos atnaujinimas
	 * @param type $data
	 */
	public function updateService($data) {
		$query = "  UPDATE `{$this->lazybos_bendroves_lentele}`
					SET    `pavadinimas`='{$data['pavadinimas']}',
							`kodas`='{$data['kodas']}',
							`punktu_skaicius`='{$data['punktu_skaicius']}',
							`pelnas`='{$data['pelnas']}'
					WHERE `kodas`='{$data['kodas']}'";
		mysql::query($query);
	}
	
	/**
	 * Paslaugos šalinimas
	 * @param type $id
	 */
	public function deleteService($id) {
		$query = "  DELETE FROM `{$this->lazybos_bendroves_lentele}`
					WHERE `kodas`='{$id}'";
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