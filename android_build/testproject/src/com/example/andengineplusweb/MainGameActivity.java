package com.packt.andengine.demo;
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
                            private float cameraHeight;private ITexture msprite-1148562093Texture;private ITextureRegion msprite-1148562093TextureRegion;private Sprite sprite-1148562093;private ITexture msprite-1857782972Texture;private ITextureRegion msprite-1857782972TextureRegion;private Sprite sprite-1857782972;public EngineOptions onCreateEngineOptions() {
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
	                    }public void onCreateResources throws IOException {msprite-1148562093Texture = new AssetBitmapTexture(getTextureManager(), getAssets(),
				                "gfx/sandbag.png");
                            msprite-1148562093TextureRegion = TextureRegionFactory.extractFromTexture(msprite-1148562093Texture);
                            msprite-1148562093Texture.load();msprite-1857782972Texture = new AssetBitmapTexture(getTextureManager(), getAssets(),
				                "gfx/traffic_cone.png");
                            msprite-1857782972TextureRegion = TextureRegionFactory.extractFromTexture(msprite-1857782972Texture);
                            msprite-1857782972Texture.load();}\npublic Scene onCreateScene() {
                            mEngine.registerUpdateHandler(new FPSLogger());

                            Scene scene = new Scene();
                            scene.getBackground().setColor(Color.BLACK);sprite-1148562093 = new Sprite(200, 200,
				            msprite-1148562093TextureRegion, this.getVertexBufferObjectManager());scene.attachChild(sprite-1148562093);sprite-1857782972 = new Sprite(200, 200,
				            msprite-1857782972TextureRegion, this.getVertexBufferObjectManager());scene.attachChild(sprite-1857782972);}}