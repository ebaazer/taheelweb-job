<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('Assessment.php');

class Api extends Assessment {

    function __construct() {
        parent::__construct();
    }
}
