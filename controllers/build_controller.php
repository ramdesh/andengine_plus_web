<?php
/**
 * Class to handle APK build process
 * @package Andengine_plus_web.controllers
 * @author Ramindu
 *
 */
define('CODE_PATH','../android_build/testproject/src/com/example/andengineplusweb/MainGameActivity.java');
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
        $sprites = $xmldoc->createElement("sprites");

        for ( $i = 0; $i < count($contents); $i++ ) {
            if ( $contents[$i]['activity'] == "sprite_position" ) {
                $params = json_decode($contents[$i]['activity_params']);
                $single_resource = $xmldoc->createElement("resource");
                $single_resource->appendChild($xmldoc->createTextNode($params->resource));
                $resources->appendChild($single_resource);

                $single_sprite = $xmldoc->createElement("sprite");
                $single_sprite->setAttribute("resource",$params->resource);
                $single_sprite->setAttribute("position_left", $params->position_left);
                $single_sprite->setAttribute("position_top", $params->position_top);
                $single_sprite->appendChild($xmldoc->createTextNode($params->name));
                $sprites->appendChild($single_sprite);


            }
        }
        $gameElement->appendChild($resources);
        $gameElement->appendChild($sprites);
        $xmldoc->appendChild($gameElement);
        if ( !$xmldoc->save("xmloutput/test_project.xml") ) {
            echo "<p>Error occured during XML write</p>";
        }
        else {
            echo "<p>XML written successfully.</p>";
        }
    }
    private function build_code() {
        $file_output = '';
        $file_output .= 'package com.packt.andengine.demo;
                        import java.io.IOException;
                        import org.andengine.engine.camera.Camera;
                        import org.andengine.engine.options.ConfigChooserOptions;
                        import org.andengine.engine.options.EngineOptions;
                        import org.andengine.engine.options.ScreenOrientation;
                        import org.andengine.engine.options.resolutionpolicy.RatioResolutionPolicy;
                        import org.andengine.entity.scene.Scene;
                        import org.andengine.entity.sprite.Sprite;
                        import org.andengine.entity.util.FPSLogger;
                        import org.andengine.opengl.texture.ITexture;
                        import org.andengine.opengl.texture.bitmap.AssetBitmapTexture;
                        import org.andengine.opengl.texture.region.ITextureRegion;
                        import org.andengine.opengl.texture.region.TextureRegionFactory;
                        import org.andengine.ui.activity.SimpleBaseGameActivity;
                        import org.andengine.util.adt.color.Color;

                        import android.view.Display;


                        public class MainGameActivity extends SimpleBaseGameActivity {';

        $xmldoc = new DOMDocument();
        $xmldoc->load("xmloutput/test_project.xml");
        $resources = $xmldoc->getElementsByTagName("resources");
        $resource_list = $resources->item(0)->childNodes;
        foreach($resource_list as $resource) {

        }
        $sprites = $xmldoc->getElementsByTagName("sprites");
        $sprite_list = $sprites->item(0)->childNodes;
        foreach($sprite_list as $sprite) {

        }

        $file_output .= '}';
        file_put_contents(CODE_PATH, $file_output);
    }
}