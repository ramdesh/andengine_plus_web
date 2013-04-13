<?php
/**
 * Simple HTTP router for AJAX Requests
 */
global $global;
require_once 'controllers.php';
$get_param = $_GET['function'];
switch($get_param) {
	case 'resource_upload':
		$global['resource_manager']->resource_upload();
		break;
}