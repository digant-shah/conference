<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stats_Model extends CI_Model {

    function get_all() {
	
	$prm_id = $_GET['conference_id'];
						$query = "SELECT *, user.name FROM call_detail_record INNER JOIN user ON call_detail_record.user_id = user.user_id WHERE conference_id=$prm_id"; 
							$result = mysql_query($query); 
							//$values = mysql_fetch_assoc($result); 
							//$num_rows2 = $values['total']; 
							$row = mysql_fetch_array($result);
							
						
							 
							
}		
}						
							 