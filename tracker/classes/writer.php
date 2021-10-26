<?php

class Writer extends Tracker {
    public function __construct(){
        parent::__construct();
        $this->servername;
        $this->database;
        $this->username;
        $this->connection;
        $this->getCredentials();
        $this->connect();
    }
    private function getCredentials(){
        $this->servername = $this->settings->servername;
        $this->database = $this->settings->database;
        $this->username = $this->settings->username;
    }
    private function connect(){
        require_once dirname($_SERVER["DOCUMENT_ROOT"], 1) . "/dbp.php";
        $this->connection = new mysqli($this->servername, $this->username, $password, $this->database);
        if ($this->connection->connect_error) {
            if (!file_exists("log.txt")){
                file_put_contents("log.txt", $this->connection->connect_error);
            } else {
                $existing = file_get_contents("log.txt");
                $file = fopen("log.txt", "r+");
                fwrite($file, "\n" . $this->connection->connect_error);
                fwrite($file, $existing);
                fclose($file);
            }
        } else {
            $this->writeToSQL();
        }
    }
    private function writeToSQL(){
        $statement = $this->connection->prepare("INSERT INTO Test 
        (Website, Date, Time, Page, Country, State, Suburb, Browser, 
            OS, IP, Query, Referer, Requested)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->bind_param("sssssssssssss", 
            $this->website,
            $this->date, 
            $this->time,
            $this->page, 
            $this->country, 
            $this->state, 
            $this->suburb, 
            $this->browser, 
            $this->os, 
            $this->address, 
            $this->query_string, 
            $this->referer,
            $this->requested_url);
        if (!$statement->execute()){
            if (!file_exists("log.txt")){
                file_put_contents("log.txt", "MySQL execution error!");
            } else {
                $existing = file_get_contents("log.txt");
                $file = fopen("log.txt", "r+");
                fwrite($file, "\n" . "MySQL execution error!");
                fwrite($file, $existing);
                fclose($file);
            }
        }
        $statement->close();
        $this->connection->close();
    }
}

?>