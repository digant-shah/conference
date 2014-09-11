<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conference_Model extends CI_Model {

    function get_all() {
        # Default value
        
        $query = 'SELECT SQL_CALC_FOUND_ROWS * FROM conference';
        $result = $this->db->query( $query );
        $response = Array();
        $data = Array();
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row){
                $display_name = trim(trim($row->name));
                $row->display_name = $display_name;

               
                $data[] = $row;
            }
            $count_query = 'SELECT FOUND_ROWS() as total_records';
            $result = $this->db->query( $count_query );
            $row = $result->row();

            $response['data'] = $data;
            $response['total_records'] = $row->total_records;
            
            $response['error']['no'] = 1;
            $response['error']['text'] = '';
        }
        else {
            $response['total_records'] = 0;
            
            $response['error']['no'] = -1;
            $response['error']['text'] = 'Query failed!';
        }
        return $response;
    }

    function get_one( $prm_id ){
        $response = Array();
        $query = 'SELECT * FROM conference WHERE id='.$prm_id;
        $result = $this->db->query( $query );
        $row = $result->row();
        if($result->num_rows() > 0){
            $response['data'] = $row;
            $response['error']['no'] = 1;
            $response['error']['text'] = '';
        }
        else {
            $response['error']['no'] = -1;
            $response['error']['text'] = 'Query failed!';
        }
        return $response;
    }

    function add( $prm_form_data ){
        $response = Array();
               
        $data = Array( 'name'=>$prm_form_data['name'], 'date'=>$prm_form_data['date'], 'attendee'=>$prm_form_data['attendee'], 'duration'=>$prm_form_data['duration'], 'start_date'=>$prm_form_data['start_date'], 'end_date'=>$prm_form_data['end_date'], 'time'=>$prm_form_data['time'],'con_type'=>$prm_form_data['con_type'], 'weekdays'=>$prm_form_data['weekdays'], 'month_date'=>$prm_form_data['month_date'],   'groups'=>$prm_form_data['groups'], 'members'=>$prm_form_data['members'], 'dtmf_mode'=>$prm_form_data['dtmf_mode'], 'moderator_phn'=>$prm_form_data['moderator_phn'], 'conference_phn'=>$prm_form_data['conference_phn'], 'mute'=>$prm_form_data['mute'], 'talking_mode'=>$prm_form_data['talking_mode'], 'notification'=>$prm_form_data['notification'], 'description'=>$prm_form_data['description']
                     );

        $result = $this->db->insert( 'conference', $data );
        if( $this->db->_error_number() == 0 ){
            $response['error']['no'] = 0;
            $response['error']['text'] = '';
        }
        else {
            $response['error']['no'] = $this->db->_error_number();
            $response['error']['text'] = 'This Conference name already exists.';
        }
        return $response;
    }

    function update( $prm_form_data ){
        $response = Array();
     
        
$data = Array( 'name'=>$prm_form_data['name'], 'date'=>$prm_form_data['date'], 'attendee'=>$prm_form_data['attendee'], 'duration'=>$prm_form_data['duration'], 'start_date'=>$prm_form_data['start_date'], 'end_date'=>$prm_form_data['end_date'], 'time'=>$prm_form_data['time'],'con_type'=>$prm_form_data['con_type'], 'weekdays'=>$prm_form_data['weekdays'], 'month_date'=>$prm_form_data['month_date'],   'groups'=>$prm_form_data['groups'], 'members'=>$prm_form_data['members'], 'dtmf_mode'=>$prm_form_data['dtmf_mode'], 'moderator_phn'=>$prm_form_data['moderator_phn'], 'conference_phn'=>$prm_form_data['conference_phn'], 'mute'=>$prm_form_data['mute'], 'talking_mode'=>$prm_form_data['talking_mode'], 'notification'=>$prm_form_data['notification'], 'description'=>$prm_form_data['description']
                     );

        $this->db->where('id', $prm_form_data['conference_id']);
        $this->db->update('conference', $data); 

        if( $this->db->_error_number() == 0 ){
            $response['error']['no'] = 0;
            $response['error']['text'] = '';
        }
        else {
            $response['error']['no'] = $this->db->_error_number();
            $response['error']['text'] = $this->db->_error_message();
        }
        return $response;
    }

    function block( $prm_form_data ){
        $response = Array();
        
        

        $this->db->where('id', $prm_form_data['id']);
        $this->db->update('conference', $data); 

        if( $this->db->_error_number() == 0 ){
            $response['error']['no'] = 0;
            $response['error']['text'] = '';
        }
        else {
            $response['error']['no'] = $this->db->_error_number();
            $response['error']['text'] = $this->db->_error_message();
        }
        return $response;
    }

    function unblock( $prm_form_data ){
        $response = Array();
        
        

        $this->db->where('id', $prm_form_data['id']);
        $this->db->update('conference', $data); 

        if( $this->db->_error_number() == 0 ){
            $response['error']['no'] = 0;
            $response['error']['text'] = '';
        }
        else {
            $response['error']['no'] = $this->db->_error_number();
            $response['error']['text'] = $this->db->_error_message();
        }
        return $response;
    }

    function delete( $prm_form_data )
	{
        $response = Array();

        $this->db->delete('conference', array('id' => $prm_form_data['id']));
        if( $this->db->_error_number() == 0 ){
            $response['error']['no'] = 0;
            $response['error']['text'] = '';
        }
        else {
            $response['error']['no'] = $this->db->_error_number();
            $response['error']['text'] = $this->db->_error_message();
        }
        return $response;
    }


}