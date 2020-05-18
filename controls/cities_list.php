<?php
	
include 'libraries/countries.class.php';
$countriesObj = new countries();

include 'libraries/cities.class.php';
$citiesObj= new cities();

$country_id=($_GET['cid']);
$country = $countriesObj->getCountryById($country_id);
include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);
if(isset($_GET['start_date']) or isset($_GET['end_date'])){
    if(isset($_GET['start_date']) and isset($_GET['end_date'])) {
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
        $clause = "AND add_date>='" . $start_date . "'" . " AND `add_date` <=" . "'" . $end_date . "'";
    }elseif (isset($_GET['start_date']) and !isset($_GET['end_date'])){
        $start_date = $_GET['start_date'];
        $clause = "AND add_date>='" . $start_date . "'";
    }elseif (!isset($_GET['start_date']) and isset($_GET['end_date'])){
        $end_date = $_GET['end_date'];
        $clause = "AND add_date<='" . $end_date . "'";
    }
    $elementCount = $citiesObj->getCitiesListCount($country_id,$clause);
    $paging->process($elementCount, $pageId);
    $data = $citiesObj->getCitiesList($paging->size, $paging->first, $country_id,null,$clause);

}
else {
    if (isset($_GET['text'])) {
        $filter = "\"%" . $_GET['text'] . "%\"";
        $elementCount = $citiesObj->getCitiesListFilteredCount($filter, $country_id);
        $paging->process($elementCount, $pageId);
        if (isset($_GET['sortByNameAZ'])) {
            $data = $citiesObj->getCitiesListFiltered($paging->size, $paging->first, "ORDER BY name ASC", $filter, $country_id);
        } else if (isset($_GET['sortByNameZA'])) {
            $data = $citiesObj->getCitiesListFiltered($paging->size, $paging->first, "ORDER BY name DESC", $filter, $country_id);
        } else {
            $data = $citiesObj->getCitiesListFiltered($paging->size, $paging->first, null, $filter, $country_id);
        }

    } else {

        $elementCount = $citiesObj->getCitiesListCount($country_id,null);
        $paging->process($elementCount, $pageId);
        if (isset($_GET['sortByNameAZ'])) {
            $data = $citiesObj->getCitiesList($paging->size, $paging->first, $country_id, "ORDER BY name ASC",null);
        } else if (isset($_GET['sortByNameZA'])) {
            $data = $citiesObj->getCitiesList($paging->size, $paging->first, $country_id, "ORDER BY name DESC",null);
        } else {
            $data = $citiesObj->getCitiesList($paging->size, $paging->first, $country_id, null,null);
        }

    }
}
include 'templates/cities_list.tpl.php';
?>