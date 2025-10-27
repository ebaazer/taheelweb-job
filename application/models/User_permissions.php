<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author 	: EbaaAbuZer For Name of Academy/Center.com
 *      date		: 28/04/2024  
 *      Blog Controll 	
 * 
 * 	http://Name_of_Academy_Center.com
 *      Academic management system for Name of Academy/Center
 */

class User_permissions extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function description_permissions() {

        $programs_management = array(
            "add" => "0",
            "edit" => "0",
            "export" => "0",
            "print" => "0",
            "delete" => "0",
        );

        $courses_management = array(
            "add" => "0",
            "edit" => "0",
            "export" => "0",
            "print" => "0",
            "delete" => "0",
        );

        $blogs_management = array(
            "add" => "0",
            "edit" => "0",
            "export" => "0",
            "print" => "0",
            "delete" => "0",
        );

        $employees_management = array(
            "add" => "0",
            "edit" => "0",
            "export" => "0",
            "print" => "0",
            "delete" => "0",
            "change_password" => "0",
            "employee_resignation" => "0"
        );

        $job_title_management = array(
            "add" => "0",
            "edit" => "0",
            "delete" => "0",
        );
        
        $permissions = array(
            "powers_according_to_job_title" => "0",
            "powers_of_individuals_in_particular" => "0",
        );
        
        $attendance_registration = array(
            "attendance_registration" => "0",
        );        
        
        
        $messages_management = array(
            "​view" => "0",
            "delete" => "0",
        );      
        $coaches_management = array(
            "​view" => "0",
            "delete" => "0",
        );        
        $job_applications_management = array(
            "​view" => "0",
            "delete" => "0",
        );                
             
        $hr = array(
            "view_employee_attendance_report" => "0",
        );
        
        $requests_employee_admin = array(
            "action" => "0",
        );                
        
        $purchase_orders = array(
            "view_purchase_orders" => "0",
            "review_requests" => "0",
        );          
        
        


                     
        //step 1
        $programs_management_JSON = json_encode($programs_management);
        $courses_management_JSON = json_encode($courses_management);
        $blogs_management_JSON = json_encode($blogs_management);
        $employees_management_JSON = json_encode($employees_management);
        $job_title_management_JSON = json_encode($job_title_management);
        $permissions_JSON = json_encode($permissions);
        $attendance_registration_JSON = json_encode($attendance_registration);
        $messages_management_JSON = json_encode($messages_management);
        $coaches_management_JSON = json_encode($coaches_management);
        $job_applications_management_JSON = json_encode($job_applications_management);
        $hr_JSON = json_encode($hr);
        $requests_employee_admin_JSON = json_encode($requests_employee_admin);
        $purchase_orders_JSON = json_encode($purchase_orders);

        //step 2
        $description_permissions = array(
            $programs_management_JSON,
            $courses_management_JSON,
            $blogs_management_JSON,
            $employees_management_JSON,
            $job_title_management_JSON,
            $permissions_JSON,
            $attendance_registration_JSON,
            $messages_management_JSON,
            $coaches_management_JSON,
            $job_applications_management_JSON,
            $hr_JSON,
            $requests_employee_admin_JSON,
            $purchase_orders_JSON,
        );
        return $description_permissions;
    }

    //user_permissions    
    function type_permissions() {

        //step 3
        $type_permissions = array(
            'programs_management',
            'courses_management',
            'blogs_management',
            'employees_management',
            'job_title_management',
            'permissions',
            'attendance_registration',
            'messages_management',
            'coaches_management',
            'job_applications_management',
            'hr',
            'requests_employee_admin',
            'purchase_orders'
        );

        return $type_permissions;
    }

    function set_user_permissions($employee_id = '') {

        $type_permissions = $this->type_permissions();
        $description_permissions = $this->description_permissions();

        foreach ($type_permissions as $index => $type) {
            $data['employee_id'] = $employee_id;
            $data['type'] = $type;
            $data['description'] = $description_permissions[$index];

            $checker_employee_permissions = $this->db->get_where('user_permissions', array('employee_id' => $employee_id, 'type' => $type));
            if ($checker_employee_permissions->num_rows() == 0) {
                $this->db->insert('user_permissions', $data);
            }
        }
    }

    function get_raw_permissions() {
        $type_permissions = $this->type_permissions();
        $description_permissions = $this->description_permissions();
        $results = array();
        foreach ($type_permissions as $index => $type) {
            $data['employee_id'] = $employee_id;
            $data['type'] = $type;
            $data['description'] = $description_permissions[$index];

            array_push($results, array(
                'type' => $type,
                'description' => $description_permissions[$index]
            ));
        }
        return $results;
    }

    function get_user_permissions($employee_id) {
        $type_permissions = $this->type_permissions();
        $description_permissions = $this->description_permissions();
        foreach ($type_permissions as $index => $type) {
            $data['employee_id'] = $employee_id;
            $data['type'] = $type;
            $data['description'] = $description_permissions[$index];
        }
        return $description_permissions;
    }
}
