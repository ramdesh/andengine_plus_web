<?php
/**
 * Class to handle resources
 * @package Andengine_plus_web.controllers
 * @author Ramindu
 *
 */
class ResourceManager {
	var $_resource_ids = array();
	var $_logger;
	
	function __construct() {
		$this->_logger = new Logger();
	}
	function resource_upload() {
		if ( (($_FILES["resourceFile"]["type"] == "image/gif")
				|| ($_FILES["resourceFile"]["type"] == "image/jpeg")
				|| ($_FILES["resourceFile"]["type"] == "image/png")
				|| ($_FILES["resourceFile"]["type"] == "image/pjpeg"))
				&& ($_FILES["resourceFile"]["size"] < 20000) )
		{
			if ($_FILES["resourceFile"]["error"] > 0)
			{
				echo "error";
			}
			else
			{
				/*echo "Upload: " . $_FILES["resourceFile"]["name"] . "<br>" .
				 "Type: " . $_FILES["resourceFile"]["type"] . "<br>".
				"Size: " . ($_FILES["resourceFile"]["size"] / 1024) . " kB<br>".
				"Temp file: " . $_FILES["resourceFile"]["tmp_name"] . "<br>";*/
		
				if (file_exists("resources/" . $_FILES["resourceFile"]["name"]))
				{
					echo "error";
				}
				else
				{
					move_uploaded_file($_FILES["resourceFile"]["tmp_name"],
					"../resources/" . $_FILES["resourceFile"]["name"]);
					$this->_logger->writeLog(1, __CLASS__, __FUNCTION__, "resource_upload", 
							array("file"=>$_FILES["resourceFile"]["name"]));
					echo $_FILES["resourceFile"]["name"];
				}
			}
		}
		else
		{
			echo "error";
		}
	}
	/**
	 * function to check resources in a folder and send them to the front end
	 */
	function serve_resources() {
		foreach(glob('resources/*.*') as $filename){
			$id = $this->generate_resourceid();
			echo '<img src="'.$filename.'" class="draggable" id="'.$id.'" alt="'.$id.'" />';
		}
	}
	/**
	 * Function to generate a random id for a resource
	 * @return string
	 */
	function generate_resourceid() {
		$imgid = 'sprite-'.rand();
		$this->_resource_ids[] = $imgid;
		return $imgid;
	}
}