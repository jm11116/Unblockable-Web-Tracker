<?php

class Tracker extends Settings {
    public function __construct(){
        parent::__construct();
        $this->website = $this->settings->website;
        $this->time;
        $this->date;
        $this->address;
        $this->user_agent;
        $this->os;
        $this->browser;
        $this->userstack_url;
        $this->ipstack_url;
        $this->ipstack_xml;
        $this->country;
        $this->state;
        $this->suburb;
        $this->query_string;
        $this->referer;
        $this->page;
        $this->requested_url = htmlspecialchars($_SERVER['REQUEST_URI']);
        $this->getUserAgentInfo();
        $this->getIPInfo();
        $this->getQueryString();
        $this->getReferer();
        $this->getTime();
    }
    private function getTime(){
        $time = new DateTime(null, new DateTimeZone($this->settings->timezone));
        $this->time = $time->format("h:i:s A");
        $this->date = $time->format("D d M Y");
    }
    private function getUserAgentInfo(){
        $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $this->userstack_url = "http://api.userstack.com/detect?access_key=" . 
            $this->settings->userstack_key . "&ua=" . $this->user_agent . "&output=xml";
        $userstack_xml = simplexml_load_file($this->userstack_url);
        $this->os = $userstack_xml->os->name;
        $this->browser = $userstack_xml->browser->name;
    }
    private function getIPInfo(){
        $this->ipstack_url = "http://api.ipstack.com/" . $this->address . "?access_key=" . 
            $this->settings->ipstack_key . "&output=xml";
        $this->ipstack_xml = simplexml_load_file($this->ipstack_url);
        $this->country = $this->ipstack_xml->country_name;
        $this->state = $this->ipstack_xml->region_name;
        $this->suburb = $this->ipstack_xml->city;
    }
    private function getQueryString(){
        if (isset($_SERVER['QUERY_STRING'])){
            $this->query_string = stripslashes(htmlspecialchars($_SERVER['QUERY_STRING']));
        } else {
            $this->query_string = "N/A";
        }
    }
    private function getReferer(){
        if (isset($_SERVER['HTTP_REFERER'])){
            $this->referer = $_SERVER['HTTP_REFERER'];
        } else {
            $this->referer = "N/A";
        }
        $this->page = htmlspecialchars(basename($_SERVER['PHP_SELF']));
    }
}

?>