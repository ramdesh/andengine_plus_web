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
    public function build() {
        $this->build_xml();
    }
    private function build_xml() {
        $query = "SELECT *
                  FROM project_log
                  WHERE project_id=1";
        $this->_build_db->setQuery($query);
        $contents = $this->_build_db->loadAssocList();
        $xmldoc = new DOMDocument();
        $xmldoc->formatOutput = true;
        $gameElement = $xmldoc->createElement("game");
        $resources = $gameElement->appendChild("resources");

        for ( $i = 0; $i < count($contents); $i++ ) {
            if ( $contents[$i]['activity'] == "sprite_position" ) {
                $params = json_decode($contents[$i]['activity_params']);
                $single_resource = $resources->appendChild("resource");
                $single_resource->appendChild($xmldoc->createTextNode($params['resource']));
            }
        }

        $xmldoc->save("../xmloutput/test_project.xml");
    }
}