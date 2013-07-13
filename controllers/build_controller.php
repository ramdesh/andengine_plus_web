<?php
/**
 * Class to handle APK build process
 * @package Andengine_plus_web.controllers
 * @author Ramindu
 *
 */
class BuildController {
    var $_build_logger;
    var $_build_db;
    function __construct() {
        $this->_build_logger = new Logger();
        $this->_build_db = DatabaseManager::getInstance();
    }
    public function buildGame() {
        $this->build_xml();
    }
    private function build_xml() {
        $query = "SELECT *
                  FROM project_log
                  WHERE project_id=1";
        $this->_build_db->setQuery($query);
        $contents = $this->_build_db->loadAssocList();
        $xmldoc = new DOMDocument('1.0', 'UTF-8');
        $xmldoc->formatOutput = true;
        $gameElement = $xmldoc->createElement("game");
        $resources = $xmldoc->createElement("resources");

        for ( $i = 0; $i < count($contents); $i++ ) {
            if ( $contents[$i]['activity'] == "sprite_position" ) {
                $params = json_decode($contents[$i]['activity_params']);
                $single_resource = $xmldoc->createElement("resource");
                $single_resource->appendChild($xmldoc->createTextNode($params->name));
                $single_resource->setAttribute("resource",$params->resource);
                $single_resource->setAttribute("position_left", $params->position_left);
                $single_resource->setAttribute("position_top", $params->position_top);
                $resources->appendChild($single_resource);

            }
        }
        $gameElement->appendChild($resources);
        $xmldoc->appendChild($gameElement);
        if ( !$xmldoc->save("xmloutput/test_project.xml") ) {
            echo "<p>Error occured during XML write</p>";
        }
        else {
            echo "<p>XML written successfully.</p>";
        }
    }
}