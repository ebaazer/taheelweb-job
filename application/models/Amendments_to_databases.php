<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Amendments_to_databases extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function amendments_to_databases() {
        $this->load->dbforge();


    }
}
