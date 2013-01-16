<?php
class PDOMysql {
    protected $pdo;
    protected $sql;
    protected $query;
    function __construct($config) {
        if (empty ( $config ) || ! is_array ( $config ))
            dir ( 'database config is error!' );
        $dsn = $config ['dbtype'] . ':host=' . $config ['dbhost'] . ';dbname=' . $config ['dbname'];
        $this->pdo = new PDO ( $dsn, $config ['dbroot'], $config ['dbpwd'] );
    }
    public function setSql($sql) {
        if ($sql) {
            $this->sql = $sql;
        }
    }
    public function query($sql = '') {
        if ($sql) {
            $thissql = $sql;
        } else {
            $thissql = $this->sql;
        }
        $this->query = $query = $this->pdo->query ( $thissql );
        return $query;
    }
    public function result($sql = '', $row = 1000) {
        $query = $this->query ( $sql );
        $result = array();
        $num = 0;
        if (is_object ( $query )) {
            while ( $num <= $row && $row = $query->fetch ( PDO::FETCH_ASSOC ) ) {
                $result [] = $row;
                $num ++;
            }
        } else {
            return null;
        }
        return $result;
    }
}