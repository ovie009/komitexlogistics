<?php

    abstract class Dbh
    {
        // private $host = "localhost";
        // private $user = "u252710402_ovie009";
        // private $password = "Ovie@1998";
        // private $dbName = "u252710402_komitexlog";

        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private $dbName = "komitexlogistics";

        protected function connect()
        {
            # code...
            date_default_timezone_set('Africa/Lagos');
            $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
            $pdo = new PDO($dsn, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        }
    }
    
?>