<?php
class DB {
    protected $dbobj;
    function __construct() {
        $dbconf = import ( 'db', 'config' );
        $this->connect ( $dbconf );
    }
    public function connect($config) {
        if ($config ['conntype'] == 'pdo' && $config ['dbtype'] == 'mysql') {
            require dirname ( __FILE__ ) . '/PDOMysql.class.php';
            $this->dbobj = new PDOMysql ( $config );
        }
    }
    public function getLastSQL() {
    }
    public function setSql($sql) {
        $this->dbobj->setSql ( $sql );
    }
    public function query($sql = '') {
        return $this->dbobj->query ( $sql );
    }
    
    /**
     * 返回数据集
     * 
     * @param unknown_type $sql            
     * @param unknown_type $row            
     * @return Ambigous <NULL, multitype:mixed >
     */
    public function result($sql = '', $row = 10000) {
        return $this->dbobj->result ( $sql, $row );
    }
    
    /**
     * 返回一行数据
     *
     * @param string $sql            
     * @return array
     */
    public function result_row($sql = '') {
        $result=$this->result ( $sql, 1 );
        if($result){
            return $result[0];
        }
        else 
            return null;
        
    }
}

?>