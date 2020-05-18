<?php

class countries {

	private $saliu_lentele = '';
	
	public function __construct() {
		$this->saliu_lentele = config::DB_PREFIX . 'šalys';
	}
	


	public function getCountriesList($limit, $offset,$orderProp,$dates) {
        $limitOffsetString = "";
        if(isset($limit)) {
            $limitOffsetString .= " LIMIT {$limit}";
        }
        if(isset($offset)) {
            $limitOffsetString .= " OFFSET {$offset}";
        }

        $query = "  SELECT *
					FROM {$this->saliu_lentele} {$orderProp} {$dates} {$limitOffsetString}";
        $data = mysql::select($query);
		return $data;
	}

    public function getCountriesListFilteredCount($filter) {

        $query = "  SELECT COUNT(`name`) as `kiekis`
                FROM {$this->saliu_lentele} WHERE Concat(`id`,'',`name`,'',`area`,'',`population`,'',`phone_nr`) like $filter";
        $data = mysql::select($query);
        return $data[0]['kiekis'];
    }
    public function getCountriesListFiltered($limit, $offset, $orderProp, $filter) {
        $limitOffsetString = "";
        if(isset($limit)) {
            $limitOffsetString .= " LIMIT {$limit}";
        }
        if(isset($offset)) {
            $limitOffsetString .= " OFFSET {$offset}";
        }
        $query = "  SELECT *
					FROM {$this->saliu_lentele} WHERE Concat(`id`,'',`name`,'',`area`,'',`population`,'',`phone_nr`) like $filter {$orderProp} {$limitOffsetString}";
        $data = mysql::select($query);
        return $data;
    }

	public function getCountriesListCount($dates) {
		$query = "  SELECT COUNT(`name`) AS `kiekis` FROM {$this->saliu_lentele} $dates";
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

	public function deleteCountry($id) {
		$query = "  DELETE FROM `{$this->saliu_lentele}`
					WHERE `id`='{$id}'";
		mysql::query($query);
	}

	

	

	
}