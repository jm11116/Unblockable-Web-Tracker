<?php

class Settings extends IPGetter {
    public function __construct(){
        parent::__construct();
        $this->settings;
        $this->getSettings();
    }
    private function getSettings(){
        $this->settings = simplexml_load_file($_SERVER["DOCUMENT_ROOT"] . "/../tracking_info/tracking_settings.xml");
    }
}

?>