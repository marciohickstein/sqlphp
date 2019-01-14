<?php
    define('DEBUG', true);
    require_once("sqlconfig.php");

    class Sql {
        private $conn;
        
        function __construct(){
            global $driver, $hostdb, $portdb, $userdb, $passdb, $dbname;

            $dsn = "$driver:host=$hostdb;port=$portdb;dbname=$dbname";
            if (DEBUG)
                echo "Connecting... $dsn<br/>";
            $this->conn = new PDO($dsn, $userdb, $passdb);
        }
        
        private function setParam($stmt, $key, $value){
            $stmt->bindParam($key, $value);
        }

        private function setParams($stmt, $params = array()){
            foreach($params as $key => $value){
                $this->setParam($stmt, $key, $value);
            }
        }
        
        public function query($query, $params = array()){
            if (DEBUG)
                echo "Executing SQL:  $query<br/>";
            $stmt = $this->conn->prepare($query);
            $this->setParams($stmt, $params);
            $stmt->execute();
            return $stmt;
        }

        public function select($query, $params = array()){
            $stmt = $this->query($query, $params);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (DEBUG){
                print_r ($results);
                echo "<br/>";
            }
            return $results;
        }

    }
?>