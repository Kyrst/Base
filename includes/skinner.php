<?php
include ABS_PATH . 'libs/haanga/haanga.php';

class Skinner extends Haanga {
    private $vars = array();
    
    private $css_files = array();
    private $js_files = array();
    
    private $css_autoloaded_files = array();
    private $js_autoloaded_files = array();
    
    private $breadcrumb = array();
    
    function __construct($css_autoloaded_files = array(), $js_autoloaded_files = array()) {
        Haanga::configure(array(
           'template_dir' => TEMPLATE_DIR,
           'cache_dir' => CACHE_DIR . 'skinner/',
        ));
        
        $this->css_autoloaded_files = $css_autoloaded_files;
        $this->js_autoloaded_files = $js_autoloaded_files;
        
        if ( isset($_SESSION['overlay']) ) {
            $this->vars['overlay'] = $_SESSION['overlay'];
            
            unset($_SESSION['overlay']);
        }
    }
    
    public function showOverlay($title, $message) {
        $_SESSION['overlay'] = array(
            'title' => $title,
            'message' => $message
        );
    }
    
    public function addCSS($css_file) {
        $this->css_files[] = $css_file;
    }
    
    public function addJS($js_file) {
        $this->js_files[] = $js_file;
    }
    
    public function addBreadcrumb($title, $link = '') {
        $this->breadcrumb[] = array(
            'title' => $title,
            'link' => $link
        );
    }
    
    public function assign($key, $value) {
        $this->vars[$key] = $value;
    }
    
    public function display($template, $page_title, array $extra_js_files = array(), array $extra_css_files = array()) {
        $this->vars['page_title'] = $page_title;
        
        if ( $extra_css_files ) {
            foreach ( $extra_css_files as $css_file ) {
                $this->css_files[] = $css_file;
            }
        }
        
        $this->vars['css_files'] = $this->css_files;
        
        if ( $extra_js_files ) {
            foreach ( $extra_js_files as $js_file ) {
                $this->js_files[] = $js_file;
            }
        }
        
        $this->vars['js_files'] = $this->js_files;
        
        foreach ( $this->js_autoloaded_files as $js_file ) {
            $this->vars['js_files'][] = $js_file;
        }
        
        foreach ( $this->css_autoloaded_files as $css_file ) {
            $this->vars['css_files'][] = $css_file;
        }
        
        $this->vars['breadcrumb'] = $this->breadcrumb;
        
        Haanga::Load($template, $this->vars);
    }
}
?>