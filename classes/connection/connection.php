<?php

    Class Connection
    {
        private $server;
        private $dbname;
        private $user;
        private $password;
        private $connection;

        function __construct(){
            $data_list = $this->connectionData();
            $this->server = $data_list['server'];
            $this->user = $data_list['user'];
            $this->password = $data_list['password'];
            $this->dbname = $data_list['database'];

            try {
                $this->connection = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->dbname, $this->user, $this->password);
                // set the PDO error mode to exception
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch (PDOException $e){
                $msg = "Database Error: ";
                $msg = $msg . $e->getMessage();
                echo $msg;
            }
        }

        private function connectionData(){
            $dir_name = dirname(__FILE__);
            $dir_conf = $dir_name . "/" . "config.json";
            $json_data = file_get_contents($dir_conf);
            return json_decode($json_data, true);
        }


        private function convertirUTF8($array){
            array_walk_recursive($array, function (&$item, $key){
                if(!mb_detect_encoding($item, 'utf-8', true)){
                    $item = utf8_encode($item);
                }
            });
            return $array;
        }

        public function getData($query){
            $statement = $this->connection->query($query);
            $statementArray = array();
            foreach ($statement as $key){
                $statementArray[] = $key;
            }
            return $this->convertirUTF8($statementArray);
        }

        // function to count the number f affected rows
        public function affectedRows($query){
            $statement = $this->connection->query($query);
            return $statement->rowCount();
        }

        // function to insert data
        public function insertData($query){
            $statement = $this->connection->query($query);
            $rows = $statement->rowCount();
            if($rows>=1){
                return $this->connection->lastInsertId();
            }else{
                return 0;
            }
        }
    }



