<?php
include ABS_PATH . 'libs/haanga/haanga.php';

class Skinner extends Haanga {
    private $vars = array();
    
    private $preloaded_css_files = array();
    private $preloaded_js_files = array();
    
    private $css_files = array(
        '/styles/normalize.css',
        '/styles/reset.css',
        '/styles/base.css'
    );
    
    private $js_files = array(
        '/scripts/js/base.js'
    );
    
    private $js_vars = array();
    
    private $breadcrumb = array();
    
    function __construct($css_files = array(), $js_files = array()) {
        Haanga::configure(array(
           'template_dir' => TEMPLATE_DIR,
           'cache_dir' => CACHE_DIR . 'skinner/',
        ));
        
        $this->preloaded_css_files = $css_files;
        $this->preloaded_js_files = $js_files;
        
        // Check if there's a overlay to show
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
    
    // Adds a JS variable that is available from included JS files
    public function addJSVar($name, $value) {
        $this->js_vars[$name] = $value;
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
    
    public function display($template, $page_title = '', $meta_description = '', array $css_files = array(), array $js_files = array()) {
        $this->vars['page_title'] = $page_title ? $page_title : DEFAULT_PAGE_TITLE;
        $this->vars['meta_description'] = $meta_description ? $meta_description : DEFAULT_META_DESCRIPTION;
        
        // Add CSS files from arguments
        if ( $css_files ) {
            foreach ( $css_files as $css_file ) {
                $this->css_files[] = $css_file;
            }
        }
        
        $this->vars['css_files'] = $this->css_files;
        
        // Add JS files from arguments
        if ( $js_files ) {
            foreach ( $js_files as $js_file ) {
                $this->js_files[] = $js_file;
            }
        }
        
        $this->vars['js_files'] = $this->js_files;
        
        // Add preloaded CSS files
        foreach ( $this->preloaded_css_files as $css_file ) {
            $this->vars['css_files'][] = $css_file;
        }
        
        // Add preloaded JS files
        foreach ( $this->preloaded_js_files as $js_file ) {
            $this->vars['js_files'][] = $js_file;
        }
        
        $this->vars['js_vars'] = $this->js_vars;
        
        $this->vars['breadcrumb'] = $this->breadcrumb;
        
        Haanga::Load($template, $this->vars);
    }
}
?>