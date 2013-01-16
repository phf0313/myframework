<?php
class Model {
    private $tablename = '';
    private $db;
    private $dbobj;
    function __construct($tablename = '') {
        if ($tablename) {
            $this->tablename = $tablename;
        }
        
        // import db.class.php
        import ( '', 'db' );
        
        $this->dbobj = new DB ();
    }
    public function table($table) {
        $this->tablename = $table;
    }
    public function getTable($shortname) {
    }
    public function getLastSQL() {
    }
    public function setSql($sql) {
        if (is_array ( $sql )) {
            $defaults = array(
                'select' => '*',
                'from' => $this->tablename,
                'where' => '',
                'limit' => '0,10',
                'order by' => 'addtime desc' 
            );
            $arraysql = array_merge ( $defaults, $sql );
            foreach ( $arraysql as $k => $v ) {
                if ($v) {
                    $arraysql [$k] = $k . ' ' . $v;
                } else {
                    unset ( $arraysql [$k] );
                }
            }
            
            if (empty ( $arraysql ['from'] ) || empty ( $arraysql ['select'] )) {
                $this->error ( '数据库字段错误！' );
            }
            
            $sql = implode ( ' ', $arraysql );
        }
        $this->dbobj->setSql ( $sql );
    }
    public function query($sql = '') {
        return $this->dbobj->query ( $sql );
    }
    public function result($sql = '') {
        return $this->dbobj->result ( $sql );
    }
    
    /**
     * 返回一行数据
     *
     * @param string $sql            
     * @return array
     */
    public function result_row($sql = '') {
        return $this->dbobj->result_row( $sql );
    }
}

?>