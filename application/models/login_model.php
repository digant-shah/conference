<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_Model extends CI_Model {

    function validate() {
        $query = 'SELECT * FROM user WHERE username="'.$this->input->post('username').'" AND password="'.$this->input->post('password').'"';
        $result = $this->db->query( $query );
        $response = Array();
        if ($result->num_rows() > 0) {
            $response['data'] = $result->row_array();
            $display_name = $response['data']['first_name'].' '.$response['data']['last_name'];
            if( trim($display_name) == '' ){
                $display_name = '['.$response['data']['username'].']';
            }
            else {
                $display_name = $display_name . '['.$response['data']['username'].']';
            }
            $response['data']['display_name'] = $display_name;
            unset( $response['data']['password'] );
            $response['error']['no'] = 1;
            $response['error']['text'] = 'Logged in successfully!';
        }
        else {
            $response['error']['no'] = -1;
            $response['error']['text'] = 'Log in failed!';
        }
        return $response;
    }

}