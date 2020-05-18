<?php

class cities {
	
	
	private $cities_table = '';
	
	public function __construct() {
		$this->cities_table = config::DB_PREFIX . 'miestai';
	
	}


	public function getCitiesList($limit = null, $offset = null, $countryId,$orderProp,$clause) {
		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}
		$query = "  SELECT *
					FROM `{$this->cities_table}` WHERE `{$this->cities_table}`.`fk_salys`={$countryId}  $orderProp $clause $limitOffsetString ";
		$data = mysql::select($query);
		return $data;
	}
    public function getCitiesListFilteredCount($filter,$countryId) {

        $query = "  SELECT COUNT(`name`) as `kiekis`
                FROM {$this->cities_table} WHERE `{$this->cities_table}`.`fk_salys`={$countryId} AND Concat(`id`,'',`name`,'',`area`,'',`population`,'',`postal_code`) like $filter";
        $data = mysql::select($query);
        return $data[0]['kiekis'];
    }
    public function getCitiesListFiltered($limit, $offset, $orderProp, $filter,$countryId) {
        $limitOffsetString = "";
        if(isset($limit)) {
            $limitOffsetString .= " LIMIT {$limit}";
        }
        if(isset($offset)) {
            $limitOffsetString .= " OFFSET {$offset}";
        }
        $query = "  SELECT *
					FROM {$this->cities_table} WHERE `{$this->cities_table}`.`fk_salys`={$countryId} AND Concat(`id`,'',`name`,'',`area`,'',`population`,'',`postal_code`) like $filter {$orderProp} {$limitOffsetString}";
		$data = mysql::select($query);
        return $data;
    }
	

	public function getCitiesListCount($coutry_id,$clause) {

		$query = "  SELECT COUNT(`{$this->cities_table}`.`id`) as `kiekis`
					FROM `{$this->cities_table}`
					WHERE `{$this->cities_table}`.`fk_salys`={$coutry_id}.$clause";
		$data = mysql::select($query);
		return $data[0]['kiekis'];
	}
	
	
	


	public function getCity($id) {
		$query = "  SELECT *
					FROM `{$this->cities_table}`
					WHERE `id`='{$id}'";
		$data = mysql::select($query);

		return $data[0];
	}
	

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
	

	public function deleteCity($id) {
		$query = "  DELETE FROM `{$this->cities_table}`
					WHERE `id`='{$id}'";
		mysql::query($query);
	}

    public function deleteCityByCountry($id) {
        $query = "  DELETE FROM `{$this->cities_table}`
					WHERE `fk_salys`='{$id}'";
        mysql::query($query);
    }
	

}