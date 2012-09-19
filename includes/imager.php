<?php
include ABS_PATH . 'libs/WideImage/WideImage.php';

class Imager {
    const FIT_INSIDE = 'inside';
    const FIT_OUTSIDE = 'outside';
    const FIT_FILL = 'fill';
    
    const SCALE_DOWN = 'down';
    const SCALE_UP = 'up';
    const SCALE_ANY = 'any';
    
    const FORCE_GENERATE_CACHE = false;
    
    const DEFAULT_FORMAT = 'jpg';
    const DEFAULT_QUALITY = 90;
    
    private $cache_dir;
    private $no_image_filename;
    
    private $settings = array(
        1 => array(
            'width' => 100,
            'height' => 100,
            'fit' => self::FIT_INSIDE,
            'scale' => self::SCALE_ANY,
            'canvas' => NULL,
            /*'canvas' => array(
                'x' => 'center',
                'y' => 'center',
                'color' => array(
                    'R' => 255,
                    'G' => 0,
                    'B' => 0
                ),
                'merge' => false
            ),*/
            /*'crop' => array(
                'top' => 0,
                'left' => 0,
                'width' => '100%',
                'height' => '100%'
            ),*/
            'crop' => NULL,
            'quality' => 9,
            'rotate' => 0,
            'rounded_corners' => NULL,
            /*'rounded_corners' => array(
                'radius' => 8,
                'color' => array(
                    'R' => 255,
                    'G' => 0,
                    'B' => 255
                ),
                'smoothness' => 2, // 1 - 4
                'corners' => WideImage::SIDE_ALL
            ),*/
            'format' => 'png'
        )
    );
    
    function __construct($cache_dir, $no_image_filename) {
        if ( !is_dir($cache_dir) ) {
            throw new Exception('Cache directory <code>' . $cache_dir . '</code> could not be found.');
        } elseif ( !is_writable($cache_dir) ) {
            throw new Exception('Cache directory <code>' . $cache_dir . '</code> is not writable.');
        }
        
        $this->cache_dir = $cache_dir;
        $this->no_image_filename = $no_image_filename;
    }
    
    private function generateCache($filename, $cache_filename, $setting) {
        $img = WideImage::load($filename);
        
        if ( $setting ) {
            if ( $setting['canvas'] ) {
                $img = $img->resizeCanvas(
                    $setting['width'],
                    $setting['height'],
                    $setting['canvas']['x'],
                    $setting['canvas']['y'],
                    $img->allocateColor($setting['canvas']['color']['R'], $setting['canvas']['color']['G'], $setting['canvas']['color']['B']),
                    $setting['scale'],
                    $setting['canvas']['merge']
                );
            } else {
                $img = $img->resize(
                    $setting['width'],
                    $setting['height'],
                    $setting['fit'],
                    $setting['scale']
                );
            }
            
            if ( $setting['crop'] ) {
                $img = $img->crop(
                    $setting['crop']['left'],
                    $setting['crop']['top'],
                    $setting['crop']['width'],
                    $setting['crop']['height']
                );
            }
            
            if ( $setting['rotate'] ) {
                $img = $img->rotate($setting['rotate']);
            }
            
            if ( $setting['rounded_corners'] ) {
                $img = $img->roundCorners(
                    $setting['rounded_corners']['radius'],
                    $img->allocateColor($setting['rounded_corners']['color']['R'], $setting['rounded_corners']['color']['G'], $setting['rounded_corners']['color']['B']),
                    $setting['rounded_corners']['smoothness'],
                    $setting['rounded_corners']['corners']
                );
            }
            
            $raw = $img->asString($setting['format']);
        } else {
            $raw = $img->asString(self::DEFAULT_FORMAT, self::DEFAULT_QUALITY);
        }
        
        $fp = fopen($cache_filename, 'a+');
        fwrite($fp, $raw);
        fclose($fp);
        
        return $img;
    }
    
    public function display($filename, $setting_index = 0) {
        if ( !file_exists($filename) ) {
            throw new Exception('Image <code>' . $filename . '</code> could not be found.');
        }
        
        // Get size
        if ( isset($this->settings[$setting_index]) ) {
            $setting = $this->settings[$setting_index];
        } else {
            $setting_index = 0;
            
            $setting = NULL;
        }
        
        $cache_filename = $this->cache_dir . md5($filename . $setting_index);
        
        // Remove cache
        if ( file_exists($cache_filename) && (filectime($filename) > filectime($cache_filename) || self::FORCE_GENERATE_CACHE) ) {
            unlink($cache_filename);
        }
        
        // Generate image and cache
        if ( !file_exists($cache_filename) ) {
            $img = $this->generateCache($filename, $cache_filename, $setting);
        } else {
            $img = WideImage::load($cache_filename);
        }
        
        // Display
        if ( $setting ) {
            $img->output($setting['format'], $setting['quality']);
        } else {
            $img->output(self::DEFAULT_FORMAT, self::DEFAULT_QUALITY);
        }
        
        $img->destroy();
    }
}
?>