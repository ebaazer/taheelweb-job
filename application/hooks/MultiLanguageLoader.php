<?php
class MultiLanguageLoader extends CI_Model  
{
    function initialize() {
        $ci =& get_instance();
        // load language helper
        $ci->load->helper('language');
        $siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
            // difine all language files
            $ci->lang->load($siteLang,$siteLang);
            $ci->lang->load('pagination',$siteLang);
        } else {
            // default language files
            $ci->lang->load('arabic','arabic');
            $ci->lang->load('pagination','arabic');
        }
    }
}