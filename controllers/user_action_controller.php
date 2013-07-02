<?php
/**
 * Class to handle save, delete, login user actions
 * @package Andengine_plus_web.controllers
 * @author Ramindu
 *
 */
class UserController {
	var $_logger;
	var $_db;
	function __construct() {
		$this->_logger = new Logger();
		$this->_db = DatabaseManager::getInstance();
	}
	/**
	 * 
	 * @param unknown $name
	 * @param array $position Contains position_left and position_top
	 * @param unknown $resource
	 */
	function saveSpritePosition($name, $position, $resource) {
		$this->_logger->writeLog(1, __CLASS__, __FUNCTION__, 'sprite_position', 
				array("name"=>$name,"position_left"=>$position['position_left']
						,"position_top"=>$position['position_top'], "resource"=>$resource));
	}
}