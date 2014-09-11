<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mycal_model extends CI_Model {
	function generate_calendar ($year, $month){  
	$pref = array(
	'show_next_prev'=>'TRUE',
	'next_prev_url'=>'/conference/index.php/my_calendar/showcal'
	);
	$events = array(
	'1'=>"rent",
	'10'=>"bill",
	'25'=>"trip",
	);
	
	$this->load->library('calendar',$pref);
	return $this->calendar->generate($year,$month,$events);

}
}