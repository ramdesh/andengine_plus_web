<?php
/**
 * Class to handle logging events
 * @package Andengine_plus_web.controllers
 * @author Ramindu
 *
 */

require_once 'db_controller.php';

class Logger {
	var $_logger_db;
	function __construct() {
		$this->_logger_db = DatabaseManager::getInstance();
	}
	/**
	 * Writes a single line to the project log
	 * @param int $project_id ID of the current project
	 * @param String $class The calling class
	 * @param String $function The calling function
	 * @param String $activity Activity which should be logged
	 * @param array $activity_params Parameters for the logged activity
	 */
	function writeLog($project_id,$class,$function,$activity,$activity_params) {
		$sequence_query = "SELECT seq FROM project_log_seq WHERE project_id=".$project_id;
		$this->_logger_db->setQuery($sequence_query);
		$sequence_result = $this->_logger_db->loadResult();
		$seq = $sequence_result['seq'];
		$this->_logger_db->setQuery("UPDATE project_log_seq SET seq=".($seq+1)." WHERE project_id=".$project_id);
		$this->_logger_db->loadResult();
		$log_object = new stdClass();
		$log_object->project_id = $project_id;
		$log_object->step_id = $seq;
		$log_object->class = $class;
		$log_object->function = $function;
		$log_object->activity = $activity;
		$log_object->activity_params = json_encode($activity_params);
		
		$result = $this->_logger_db->insertObject('project_log',$log_object);
		if ( $result === false ) {
			echo "Error saving position of sprite:".print_r($this->_logger_db, true);
		}
		else {
			echo "Success saving sprite position";
		}
	}
}