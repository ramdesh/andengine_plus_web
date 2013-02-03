<?php
/**
 * Class to encapsulate Session functions
 * @package Andengine_plus_web.controllers
 * @author Ramindu
 *
 */
class Session {
	static function getSessionVar($param) {
		return $_SESSION[$param];
	}
	static function setSessionVar($param, $value) {
		$_SESSION[$param] = $value;
	}
}