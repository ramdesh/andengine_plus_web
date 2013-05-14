<?php
/**
 * Simple HTTP router for AJAX Requests
 */
require_once 'controllers.php';
$get_param = $_GET['function'];
switch($get_param) {
	case 'resource_upload':
		$resourceManager = new ResourceManager();
		$resourceManager->resource_upload();
		break;
}