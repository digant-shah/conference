<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_calendar extends CI_Controller 
{
	function index($year = NULL, $month=NULL){
	$this->showcal($year, $month);
	}
	
	function showcal($year = NULL, $month=NULL){
	$pref = array(
	'show_next_prev'=>'TRUE',
	'next_prev_url'=>'/conference/index.php/my_calendar/showcal'
	);
	include("/application/config/database.php");
		$con = mysqli_connect('localhost','memblue_master','?[)iUGugEeKQ','memblue_master');
			if (!$con)
  			{
  			die('Could not connect: ' . mysqli_error($con));
  			}
			 mysqli_select_db($con,"memblue_master");
									$sql="SELECT start_date,conference_name FROM conference_config" ;

									$result = mysqli_query($con,$sql);
								
                            while($row = mysqli_fetch_array($result))
							{
							
							echo $n = $row['conference_name']."<br/>"; 
                            
	}
	$events = $this->get_events($year,$month);
	print_r($events); 
	
	$this->load->library('calendar',$pref);
	echo $this->calendar->generate($year,$month,$events);
	}

function get_events($year,$month){
$events = array();
$query = $this->db->select('start_date, conference_name')->from ('conference_config')->like('start_date',"$year-$month")->get();
$query = $query->result();
foreach ($query as $row){
$day = (int)substr($row->start_date,8,2);
$events[$day]=$row->conference_name;
} 
return $events;
}	
}			
		    
                           