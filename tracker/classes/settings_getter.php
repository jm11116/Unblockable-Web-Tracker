<?php

class Settings extends IPGetter {
    public function __construct(){
        parent::__construct();
        $this->settings;
        $this->getSettings();
    }
    private function getSettings(){
        $this->settings = simplexml_load_file(dirname($_SERVER["DOCUMENT_ROOT"], 1) . "/tracking_info/tracking_settings.xml");
    }
}

?>