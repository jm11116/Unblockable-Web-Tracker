<?php

class IPGetter {
    public function __construct(){
        $this->address;
        $this->getIP();
    }
    private function getIP (){
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])){
            $_SERVER["REMOTE_ADDR"] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        } 
        $this->address = $_SERVER["REMOTE_ADDR"];
    }
}

?>