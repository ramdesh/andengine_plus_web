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
	case 'sprite_save':
		$userActionController = new UserController();
		$position = array();
		$position['position_left'] = $_POST['position_left'];
		$position['position_top'] = $_POST['position_top'];
		$userActionController->saveSpritePosition($_POST['name'], $position, $_POST['resource']);
		break;
    case 'build':
        $buildController = new BuildController();
        $buildController->buildGame();
}