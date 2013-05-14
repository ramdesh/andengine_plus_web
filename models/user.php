<?php
/**
 * User model
 * @package Andengine_plus_web.models
 * @author Ramindu
 *
 */
class User {
	var $id;
	var $name;
	/**
	 *
	 * Whether the user is logged in or not
	 * @var Boolean
	 */
	var $loggedIn;
	/**
	 *
	 * @desc Instantiates a new User object
	 * @param $userId int ID of the user
	 * @param $userName String the username
	 * @param $container int user group id (based on user container)
	 */
	static function instantiateUser($userId, $userName) {
		$user = new User();
		$user->id = $userId;
		$user->name = $userName;
		$user->loggedIn = true;
		return $user;
	}
}