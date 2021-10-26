<?php

require_once "classes/ip_getter.php";
require_once "classes/settings_getter.php";
require_once "classes/block_checker.php";
require_once "classes/tracking.php";
require_once "classes/writer.php";

$check = new BlockChecker();
if ($check->blocked == "true"){
    exit();
} else {
    new Mailer(); //Calls parent, which is Writer, which calls their parents
}

?>