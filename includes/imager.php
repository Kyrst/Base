<?php
class Imager {
    private $original_width, $original_height;
    private $mime;
    
    function __construct($filename) {
        if ( !file_exists($filename) ) {
            throw new Exception('Image (' . $filename . ') could not be found.');
        }
        
        $this->filename = $filename;
        
        $size = getimagesize($this->filename);
        
        $this->original_width = $size[0];
        $this->original_height = $size[1];
        $this->mime = $size['mime'];
    }
    
    public function output($type, $width = 0, $height = 0) {
        switch ( $this->mime ) {
            case 'image/jpeg':
                $im = imagecreatefromjpeg($this->filename);
                
                break;
        }
        
        if ( $width || $height ) {
        }
        
        header('Content-Type: ' . $this->mime);
        
        imagejpeg($im);
        imagedestroy($im);
    }
}
?>