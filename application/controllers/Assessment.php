<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assessment extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->output->enable_profiler($this->config->item('profiler'));

        log_message('debug', 'CI : MY_Controller class loaded');

        $this->load->database();
        $this->load->library('session');
        $this->load->helper('language');
        date_default_timezone_set('Asia/Riyadh');

        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        /* language control */
        $center_type = $this->db->get_where('settings', array('type' => 'center_type'))->row()->description;
        $site_lang = $this->session->userdata('site_lang');

        if ($site_lang == 'arabic') {
            $this->lang->load('arabic', 'arabic');
        } else {
            $this->lang->load('english', 'english');
        }
    }

    public function index() {

        if ($this->session->userdata('user_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($this->session->userdata('user_login') == 1)
            redirect(site_url('user/dashboard'), 'refresh');
    }
}

?>