<?php
abstract class BaseHandler {
    protected $db;
    
    function __construct() {
        $this->db = new Db();
    }
    
    public static function slugify($str) {
        if ( function_exists('iconv') ) {
            $str = @iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        }
        
        $str = strtolower(preg_replace('/[^a-zA-Z0-9 -]/', '', $str));
        $str = preg_replace('/[\s-]+/', '-', $str);
        
        return $str;
    }
}
?>