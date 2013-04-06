<?php
/**
 * Simple HTTP router for AJAX Requests
 */
require_once 'controllers.php';
$get_param = $_GET['function'];
switch($get_param) {
	case 'resource_upload':
		$resources = new Resource();
		$resources->resource_upload();
		break;
}