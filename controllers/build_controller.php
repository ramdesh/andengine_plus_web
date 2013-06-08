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
        $xmldoc = new DOMDocument();
        $xmldoc->formatOutput = true;
        $gameElement = $xmldoc->createElement("game");

        $xmldoc->save("../xmloutput/test_project.xml");
    }
}