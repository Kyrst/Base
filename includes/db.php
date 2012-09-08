<?php
class Db extends PDO {
    function __construct() {
        parent::__construct('mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD,
            array(
                PDO::ATTR_PERSISTENT => DB_PERSISTENT,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );
        
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $this->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('DBStatement', array($this)));
    }
    
    public function query($sql, $die = false) {
        if ( $die ) {
            print('<pre>' . print_r($sql, true) . '</pre>');
        }
        
        return parent::query($sql);
    }
    
    public function exec($sql, $die = false) {
        if ( $die ) {
            die('<pre>' . print_r($sql, true) . '</pre>');
        }
        
        return parent::exec($sql);
    }
    
    public function fetchAll($sql, $fetch_mode = PDO::FETCH_ASSOC) {
        return $this->query($sql)->fetchAll($fetch_mode);
    }
}

class DBStatement extends PDOStatement {
    public $db;
    
    protected function __construct($db) {
        $this->db = $db;
    }
}
?>