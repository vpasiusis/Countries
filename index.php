<?php
	include 'config.php';

	include 'utils/mysql.class.php';

	$module = 'countries';
	if(isset($_GET['module'])) {
		$module = mysql::escape($_GET['module']);
	}

	$id = '';
	if(isset($_GET['id'])) {
		$id = mysql::escape($_GET['id']);
	}

	$action = '';
	if(isset($_GET['action'])) {
		$action = mysql::escape($_GET['action']);
	}

	$pageId = 1;
	if(!empty($_GET['page'])) {
		$pageId = mysql::escape($_GET['page']);
	}

	$actionFile = "list";
	if(!empty($module) && !empty($action)) {
		$actionFile = "controls/{$module}_{$action}.php";
	}

	include 'templates/main.tpl.php';
?>