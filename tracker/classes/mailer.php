<?php

class Mailer extends Writer {
    public function __construct(){
        $this->checkAlert();
    }
    private function checkAlert(){
        if ($this->settings->alert_email != ""){
            if ($this->settings->email === "all"){
                $this->sendAlert();
            } else {
                $exploded = explode(",", $this->settings->email);
                foreach ($exploded as $page) {
                    if (trim($page) === basename($_SERVER["PHP_SELF"])){
                        $this->sendAlert();
                    }
                }
            }
        }
    }
    private function sendAlert(){
        $to = $this->settings->alert_email;
        $subject = "New hit from " . $this->settings->website . "!";
        $message = "Page: " . $this->page .
                   "Date: " . $this->date .
                   "Time: " . $this->time .
                   "IP: " . $this->address .
                   "Country: " . $this->country . 
                   "State: " . $this->state . 
                   "Suburb: " . $this->suburb .
                   "Came from: " . $this->referer . 
                   "OS: " . $this->os .
                   "Browser: " . $this->browser . 
                   "Query string: " . $this->query .
                   "Requested resource: " . $this->requested_url;
        if (strpos($this->website, "www.")){
            $exploded = explode("www.", $this->website);
            $from = "From: alerts@" . $exploded[1];
        } else {
            $from = "From: alerts@" . $this->website;
        }
        mail($to, $subject, $message, $from);
    }
}

?>