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
        $this->build_code();
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


                        public class MainGameActivity extends SimpleBaseGameActivity {
                            private float cameraWidth;
                            private float cameraHeight;';

        $xml = file_get_contents('xmloutput/test_project.xml');
        $game_element = new SimpleXMLElement($xml);
        /*$resources = $xmldoc->getElementsByTagName("resources");
        $resource_list = $resources->item(0)->childNodes;
        foreach($resource_list as $resource) {

        }*/
        //Initializing sprite variables
        foreach($game_element->sprites->sprite as $sprite) {
            $file_output .= 'private ITexture m'.$sprite.'Texture;';
            $file_output .= 'private ITextureRegion m'.$sprite.'TextureRegion;';
            $file_output .= 'private Sprite '.$sprite.';';
        }
        /*---------------------------------------------onCreateEngineOptions start-------------------------------------------*/
        $file_output .= 'public EngineOptions onCreateEngineOptions() {
		                    final Display display = getWindowManager().getDefaultDisplay();
                            cameraWidth = display.getWidth();
                            cameraHeight = display.getHeight();

                            final Camera camera = new Camera(0, 0, cameraWidth, cameraHeight);

                            final EngineOptions engineOptions = new EngineOptions(true,
                                    ScreenOrientation.LANDSCAPE_SENSOR, new RatioResolutionPolicy(
                                            cameraWidth, cameraHeight), camera);
                            final ConfigChooserOptions configChooserOptions = engineOptions
                                    .getRenderOptions().getConfigChooserOptions();
                            configChooserOptions.setRequestedRedSize(8);
                            configChooserOptions.setRequestedGreenSize(8);
                            configChooserOptions.setRequestedBlueSize(8);
                            configChooserOptions.setRequestedAlphaSize(8);
                            configChooserOptions.setRequestedDepthSize(16);
                            return engineOptions;
	                    }';
        /*---------------------------------------------onCreateEngineOptions end-------------------------------------------*/
        /*---------------------------------------------onCreateResources start---------------------------------------------*/
        $file_output .= 'public void onCreateResources throws IOException {';
        foreach($game_element->sprites->sprite as $sprite) {
            $file_output .= 'm'.$sprite.'Texture = new AssetBitmapTexture(getTextureManager(), getAssets(),
				                "gfx/'.$sprite['resource'].'");
                            m'.$sprite.'TextureRegion = TextureRegionFactory.extractFromTexture(m'.$sprite.'Texture);
                            m'.$sprite.'Texture.load();';
        }
        $file_output .= '}';
        /*---------------------------------------------onCreateResources end-------------------------------------------*/
        /*---------------------------------------------onCreateScene start-----------------------------------------------*/
        $file_output .= 'public Scene onCreateScene() {
                            mEngine.registerUpdateHandler(new FPSLogger());

                            Scene scene = new Scene();
                            scene.getBackground().setColor(Color.BLACK);';
        foreach($game_element->sprites->sprite as $sprite) {
            $file_output .= $sprite.' = new Sprite(200, 200,
				            m'.$sprite.'TextureRegion, this.getVertexBufferObjectManager());';
            $file_output .= 'scene.attachChild('.$sprite.');';
        }
        $file_output .= '}';
        /*---------------------------------------------onCreateScene end-----------------------------------------------*/
        $file_output .= '}';
        if (!file_put_contents(CODE_PATH, $file_output)) {
            echo "<p>Code save failed</p>";
        }
        else echo "<p>Code saved.</p>";
    }
}