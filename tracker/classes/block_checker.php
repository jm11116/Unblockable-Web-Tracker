<?php

class BlockChecker extends Settings {
    public function __construct(){
        parent::__construct();
        $this->blocked = false;
        $this->blocked_ips = [];
        $this->checkCookieBlock();
        $this->queryBlockCheck();
        $this->getBlockList();
        $this->checkBlock();
    }
    private function checkCookieBlock(){
        if (isset($_COOKIE["tracking_block"])){
            $this->blocked = true;
        }
    }
    private function queryBlockCheck(){
        if ($_SERVER['QUERY_STRING'] == $this->settings->no_track_query){
            $this->blocked = true;
            setcookie("tracking_block", "1", time() + (86400 * 30), "/");
        }
    }
    private function getBlockList(){
        $exploded = explode(",", $this->settings->blocked_ips);
        foreach ($exploded as $entry) {
            array_push($this->blocked_ips, trim($entry));
        }
    }
    private function checkBlock(){
        if (in_array($this->address, $this->blocked_ips)){
            $this->blocked = true;
        } else {
            $this->blocked = false;
        }
    }
}

?>