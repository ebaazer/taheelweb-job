<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    protected $theme;

    function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        $this->load->helper('language');
        $this->load->model('frontend_model');

        $this->theme = $this->frontend_model->get_frontend_settings('theme');

        $center_type = $this->db->get_where('settings', array('type' => 'center_type'))->row()->description;
        $site_lang = $this->session->userdata('site_lang');

        if ($site_lang == 'english') {
            $this->lang->load('english', 'english');
        } else {
            $this->lang->load('arabic', 'arabic');
        }
    }

    public function index() {
        $this->home();
    }

    function home() {
        $page_data['page_name'] = 'home';
        $page_data['page_title'] = $this->lang->line('home');
        $this->load->view('frontend/' . $this->theme . '/index', $page_data);
    }

    function submit_job_application_form() {

        $errors = [];
        $data = [];

        if (empty($_POST['contact_name'])) {
            $errors['contact_name'] = $this->lang->line('is_required');
        }

        if (empty($_POST['contact_email'])) {
            $errors['contact_email'] = $this->lang->line('is_required');
        } else {
            $check_email = $this->test_input($_POST["contact_email"]);
            if (!filter_var($check_email, FILTER_VALIDATE_EMAIL)) {
                $errors['contact_email'] = "Invalid email format";
            }
        }

        if (empty($_POST['contact_phone'])) {
            $errors['contact_phone'] = $this->lang->line('is_required');
        }

        if (empty($_POST['contact_bio'])) {
            $errors['contact_bio'] = $this->lang->line('is_required');
        }

        if (empty($_POST['contact_degree'])) {
            $errors['contact_degree'] = $this->lang->line('is_required');
        }

        if (empty($_POST['contact_nationality'])) {
            $errors['contact_nationality'] = $this->lang->line('is_required');
        }

        if (empty($_POST['contact_current_country'])) {
            $errors['contact_current_country'] = $this->lang->line('is_required');
        }

        if (empty($_POST['contact_cv_link'])) {
            $errors['job_application_cv'] = $this->lang->line('is_required');
        }

        if (empty($_POST['contact_photo_link'])) {
            $errors['job_application_photo'] = $this->lang->line('is_required');
        }

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {

            $data_contact['apply_for'] = $this->test_input($_POST["contact_apply_for"]);
            $data_contact['name'] = $this->test_input($_POST["contact_name"]);
            $data_contact['email'] = $this->test_input($_POST["contact_email"]);
            $data_contact['phone'] = $this->test_input($_POST["contact_phone"]);
            $data_contact['bio'] = $this->test_input($_POST["contact_bio"]);
            $data_contact['degree'] = $this->test_input($_POST["contact_degree"]);
            $data_contact['years_experience'] = $this->test_input($_POST["contact_years_experience"]);
            $data_contact['nationality'] = $this->test_input($_POST["contact_nationality"]);
            $data_contact['current_country'] = $this->test_input($_POST["contact_current_country"]);
            $data_contact['cv_link'] = $this->test_input($_POST["contact_cv_link"]);
            $data_contact['photo_link'] = $this->test_input($_POST["contact_photo_link"]);
            $data_contact['date'] = date("Y-m-d H:i:s");

            $this->db->insert('job_application', $data_contact);

            $data['success'] = true;
            $data['message'] = $this->lang->line('thank_you');
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    function add_cv_job_application_form() {

        $response = array();

        $filename = $_FILES['file']['name'];
        $info = new SplFileInfo($filename);
        $uname = bin2hex(random_bytes(24));
        $folder = 'uploads/cv_job_application_form/';

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        move_uploaded_file($_FILES['file']['tmp_name'], $folder . $uname . '.' . $info->getExtension());
        $relative_path = base_url() . $folder . $uname . '.' . $info->getExtension();
        $name = $uname . '.' . $info->getExtension();
        $response = array(
            'url' => $relative_path,
            'name' => $name
        );

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    function add_photo_job_application_form() {

        $response = array();

        $filename = $_FILES['file']['name'];
        $info = new SplFileInfo($filename);
        $uname = bin2hex(random_bytes(24));
        $folder = 'uploads/photo_job_application_form/';

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        move_uploaded_file($_FILES['file']['tmp_name'], $folder . $uname . '.' . $info->getExtension());
        $relative_path = base_url() . $folder . $uname . '.' . $info->getExtension();
        $name = $uname . '.' . $info->getExtension();
        $response = array(
            'url' => $relative_path,
            'name' => $name
        );

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function change_language($language = "") {
        $this->session->set_userdata('site_lang', $language);
        $this->session->set_userdata('language', $language);

        if ($language == 'arabic') {
            $this->session->set_userdata('site_folder', 'rtl');
        } else {
            $this->session->set_userdata('site_folder', 'ltr');
        }

        echo 'true';
        return;
    }
}
