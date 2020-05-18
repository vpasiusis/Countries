<?php

include 'libraries/countries.class.php';
$countriesObj = new countries();

include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);
if(isset($_GET['start_date']) or isset($_GET['end_date'])){

    if(isset($_GET['start_date']) and isset($_GET['end_date'])) {
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
        $clause = "WHERE add_date>='" . $start_date . "'" . " AND `add_date` <=" . "'" . $end_date . "'";
    }elseif (isset($_GET['start_date']) and !isset($_GET['end_date'])){
        $start_date = $_GET['start_date'];
        $clause = "WHERE add_date>='" . $start_date . "'";
    }elseif (!isset($_GET['start_date']) and isset($_GET['end_date'])){
        $end_date = $_GET['end_date'];
        $clause = "WHERE add_date<='" . $end_date . "'";
    }
    $elementCount = $countriesObj->getCountriesListCount($clause);
    $paging->process($elementCount, $pageId);
    $data = $countriesObj->getCountriesList($paging->size, $paging->first, null, $clause);

}else {
    if (isset($_GET['text'])) {
        $filter = "\"%" . $_GET['text'] . "%\"";
        $elementCount = $countriesObj->getCountriesListFilteredCount($filter);
        $paging->process($elementCount, $pageId);
        if (isset($_GET['sortByNameAZ'])) {
            $data = $countriesObj->getCountriesListFiltered($paging->size, $paging->first, "ORDER BY name ASC", $filter);
        } else if (isset($_GET['sortByNameZA'])) {
            $data = $countriesObj->getCountriesListFiltered($paging->size, $paging->first, "ORDER BY name DESC", $filter);
        } else {
            $data = $countriesObj->getCountriesListFiltered($paging->size, $paging->first, null, $filter);
        }

    } else {
        $elementCount = $countriesObj->getCountriesListCount(null);
        $paging->process($elementCount, $pageId);
        if (isset($_GET['sortByNameAZ'])) {
            $data = $countriesObj->getCountriesList($paging->size, $paging->first, "ORDER BY name ASC",null);
        } else if (isset($_GET['sortByNameZA'])) {
            $data = $countriesObj->getCountriesList($paging->size, $paging->first, "ORDER BY name DESC",null);
        } else {
            $data = $countriesObj->getCountriesList($paging->size, $paging->first, null,null);
        }
    }



}
include 'templates/countries_list.tpl.php';


