<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conference_Model extends CI_Model {

    function get_all() {
        # Default value
        
        $query = 'SELECT SQL_CALC_FOUND_ROWS * FROM conference_config';
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
	
error_reporting(0);
	
	
		//File Upload Script.
		echo $name = $_FILES['file']['name'];
		//$size = $_FILES['file']['size'];
		$type = $_FILES['file']['type'];

		 $tmp_name = $_FILES['file']['tmp_name'];

		if ((isset($name)) && ($type == "audio/mp3"))
			{
			  if(!empty($name))
				 {
					$location = 'uploads/';     //location of mp3 file when uploaded /conference/uploads.
					  if(move_uploaded_file($tmp_name, $location.$name))
        				{
          				echo 'uploaded';
        				}
					  else 
	  		          {
			        	echo 'please choose file';
      				  }
				  }
			}
						
				$prm_form_data['file'] = $name;
				/*if (isset($prm_form_data['talking_mode']))
				{
      			$prm_form_data['talking_mode'] = 'on';
				}
				else
				{ 
				$prm_form_data['talking_mode'] = 'off';
				}*/


		  if (isset($prm_form_data['mute'])){
          $prm_form_data['mute'] = 1;					//set mute value 0 or 1.
          }
		   else{ $prm_form_data['mute'] = 0;}

		  if( !isset($prm_form_data['weekdays']) ){
            $prm_form_data['weekdays'] = 'N/A';
          }
		  
		  if ($prm_form_data['select_conference']== 'Live Conference' ){
          $prm_form_data['mute'] = 0;
		  $prm_form_data['dtmf_mode'] = NULL;					//set admin mute on join value=0 and dtmf = null for live conference.
          }
		  else{
          $prm_form_data['mute'] = 1;
		  }
		  
		  
		  
		 //caculation for converting different timezone to est.
		 $time1 = $_POST['time'];
		 $tz = $_POST['time_zone'];
	
			$userTimezonePreference = 'EST';  //time will be saved in EST in database.
			$storedDateTimeAsUtc    = $time1;
			$dateTime = new DateTime($storedDateTimeAsUtc, new DateTimeZone($tz));
			//echo 'ORIG: ', $dateTime->format('H:i:s');
			$dateTime->setTimezone(new DateTimeZone($userTimezonePreference));
			$time_save = $dateTime->format('H:i:s');
		
		
		 
		 //Calculation of end_time of conference from start time + duration.		
		 $a = $time_save;
		 $b = $_POST['duration'];					
			list($hr, $min, $sec) = explode(':', $a);
			list($hr1, $min1, $sec1) = explode(':', $b);
			$sec_temp = $sec + $sec1;
			//echo $sec_temp."<br>";
			if($sec_temp > 59)	
			{
				$min1 = $min1+1;
				$sec_temp = $sec_temp-60;
			}
			$length = strlen( $sec_temp);
			//echo $length;
			if($length == 1)
				{
					$sec_temp = "0".$sec_temp;
				}
			else
				{
					$sec_temp = $sec_temp."<br>";
				}
			$min_temp = $min + $min1;
			//echo $min_temp."<br>";
			if($min_temp > 59)
			{
			$hr1 = $hr1+1;
			$min_temp = $min_temp-60;
			}
			$length = strlen( $min_temp);
			//echo $length;
			if($length == 1)
			{
			$min_temp = "0".$min_temp;
			}
			else
			{
			$min_temp = $min_temp;
			}

			$hr_temp = $hr + $hr1;
			echo $hr_temp."<br>";
			//echo $a."<br>";
			//echo $b."<br>";
			$endtime = $hr_temp.":".$min_temp.":".$sec_temp;
			
			$data = Array( 'conference_name'=>$prm_form_data['name'],'duration'=>$prm_form_data['duration'], 'start_date'=>$prm_form_data['start_date'], 'timezone'=>$prm_form_data['time_zone'], 'start_time'=>$time_save ,'end_time'=> $endtime ,'repeat_type'=>$prm_form_data['con_type'],'admin_muted_on_join'=>$prm_form_data['mute'],'plivo_number_id'=>$prm_form_data['conference_phn'],'reminder_min'=>$prm_form_data['reminder_min'], 'repeat_value'=>$prm_form_data['weekdays1'],'dtmf_number_to_unmute'=>$prm_form_data['dtmf_mode'], 'speech_file_path'=>$prm_form_data['file'],'description'=>$prm_form_data['description']);
			//$response = Array();
			$date = $_POST['start_date'];
			//$times = $_POST['time'];
			//$times1 = $_POST['time'];
			//$endtime = $_POST['duration'];
			$plivo = $_POST['conference_phn'];
			$weekdays = $_POST['weekdays1'];
			
			
			//validation query..check for no other conference in same time duration.
			$query_date = mysql_query("SELECT conference_id FROM conference_config WHERE start_date = '$date' AND start_time < '$time_save' AND end_time > '$time_save' AND plivo_number_id ='$plivo' OR repeat_type='1' AND start_time < '$time_save' AND end_time > '$time_save' AND plivo_number_id ='$plivo' OR repeat_type='2' AND repeat_value LIKE '%$weekdays%' AND start_time < '$time_save' AND end_time > '$time_save' AND plivo_number_id ='$plivo'");
			
			
			while($fetch_name=mysql_fetch_array($query_date))
	    	{
	     	$date1 = $fetch_name['conference_id'];
			$name = $fetch_name['conference_name'];
			}
			if ($date1) 
			{
				echo "Opps!!! There is another conference with <br>";			//validation!!--this will not allow to save conference between same date-time & phone number.
				echo "Name =".$name."<br>";
				echo "date =".$date."<br>";
				echo "time =".$time_save."<br>";
				echo "please go back and change the date or time";
				exit();
			}
			
	
		else
	{
		$result = $this->db->insert('conference_config',$data);
        $query = mysql_query('SELECT conference_id FROM conference_config ORDER BY conference_id DESC LIMIT 1');  //will return the recently saved conference id.
		while($fetch_name=mysql_fetch_array($query))
		{ 
			$id = $fetch_name['conference_id'];
		} 
		
		$data1 = Array( 'id'=>$id,'title'=>$prm_form_data['name'],'start'=>$prm_form_data['start_date'],'end'=>$prm_form_data['start_date'],'url'=>'/conference/index.php/add_conference/edit?id='.$id);
		$result = $this->db->insert('evenement',$data1); //display in calendar.
		
		$test = $_POST['multiple1'];  //individual selected members.
		
		foreach($test as $t)
		{
		 
		 $x = 3; // Amount of digits    //random number regenration for conference pin code.
		 $min = pow(10,$x);
		 $max = pow(10,$x+1)-1;
		 $value = rand($min, $max);
		 $test = $t;
		//Will insert the selected members to the conference_user table. 
		$sql = "INSERT into conference_user (conference_id,user_id,pin_to_join_conference) VALUES ($id,'$test','$value')" ;
		$result = $this->db->query( $sql );
		}
		  $x1 = 3; // Amount of digits    admin pin code.
		 $min1 = pow(10,$x1);
		 $max1 = pow(10,$x1+1)-1;
		 $value1 = rand($min1, $max1);
		 //this script will insert default admin for every conference.
		$sql1 = "INSERT into conference_user (conference_id,user_id,member_type,pin_to_join_conference) VALUES ($id,'7','1','$value1')" ;
		$result1 = $this->db->query( $sql1 );
		
		$tag = $_POST['multiple']; //group tag.
		
		
		foreach($tag as $tg)
		{
			$tag = $tg;
			$sql_tag = mysql_query("SELECT user_id FROM user WHERE group_id='$tag'");
			while($tag_name=mysql_fetch_array($sql_tag))
			{ 
				$tag_id = $tag_name['user_id'];
				$x2 = 3; // Amount of digits    //random number regenration for conference pin code.
		 		$min2 = pow(10,$x2);
		 		$max2 = pow(10,$x2+1)-1;
		 		$value2 = rand($min2, $max2);
				$sql2 = "INSERT into conference_user (conference_id,user_id,pin_to_join_conference) VALUES ($id,'$tag_id','$value2')" ;
				$result2 = $this->db->query( $sql2 );
			}
		}	
		 

	 //for sending mail.
		$query = mysql_query("SELECT conference_user.user_id,conference_config.start_date, conference_config.start_time ,conference_config.duration,conference_config.conference_name,plivo_number.phone_number, conference_user.pin_to_join_conference, user.email_address ,user.name
FROM conference_user INNER JOIN user ON conference_user.user_id = user.user_id INNER JOIN conference_config ON conference_user.conference_id = conference_config.conference_id INNER JOIN plivo_number ON conference_config.plivo_number_id = plivo_number.plivo_number_id WHERE conference_config.conference_id='$id'");
						 
						 //$sql="SELECT * FROM contacts" ;
			 while ($row=mysql_fetch_array($query))
		{
                           	require_once 'lib/swift_required.php';

		// Mail Transport
		$transport = Swift_SmtpTransport::newInstance('ssl://smtp.gmail.com', 465)
    	->setUsername('conferenceproject7@gmail.com') // Your Gmail Username
    	->setPassword('conferenceproject@7'); // Your Gmail Password

		// Mailer
		$mailer = Swift_Mailer::newInstance($transport);
		
		// Create a message
				$message = Swift_Message::newInstance('Conference: '.$row['conference_name'].'-'.$row['start_date'].' '.$row['start_time'])
    		->setFrom(array('conferenceproject7@gmail.com' => 'Admin')) // can be $_POST['email'] etc...
    		->setTo(array($row['email_address'])) // your email / multiple supported.
    		->setBody("<table border=1px align=center bgcolor=B0FCF7 ><tr><td> Hi: <strong>".$row['name'].'</strong><br/>'. 
			         "Please join in conference on, ".$row['start_date']." at ".$row['start_time']." EST <br/>"
					 ."<br/>".$row['description']."<br/>".
					 
			 "1. Call in using your Telephone.<br/>

Dial: " .$row['phone_number']."<br/>
Pin Code : ".$row['pin_to_join_conference']."<br><br>
2. Use your microphone and speakers - a headset is recommended <br>

Click the link to join this conference : www.mastermind.memberblueprint.com/Plivo/phone/phone.php?id=".$id."<br/>
Pin Code : ".$row['pin_to_join_conference']."<br>
<br>
<br>
David, President <br>
Mastermind Conference System</td></tr></table>", 'text/html');

		// Send the message
		if ($mailer->send($message)) {
		    echo 'Mail sent successfully.';
		return $response;
		} 
		else{
    		echo 'I am sure, your configuration are not correct. :(';
			}

		} //end while loop for mail.
					
	} //end of else
		
		
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

//update conference function.

    function update( $prm_form_data ){
        error_reporting(0);
		
		$response = Array();
		//error_reporting(0);
if(!isset($prm_form_data['file1']))
{


echo $name = $_FILES['file']['name'];
//$size = $_FILES['file']['size'];
//$type = $_FILES['file']['type'];

echo $tmp_name = $_FILES['file']['tmp_name'];

if (isset($name))
{
  if(!empty($name))
 {
  echo  $location = 'uploads/';

      if(move_uploaded_file($tmp_name, $location.$name))
        {
          echo 'uploaded';
        }

      else 
	  {
        echo 'please choose file';
      }
  }
}
		$prm_form_data['file'] = $name;
		
}
else
{
$prm_form_data['file'] = $prm_form_data['file1'];
}		

if ($prm_form_data['select_conference']== 'Live Conference' ){
          $prm_form_data['mute'] = 0;
		  $prm_form_data['dtmf_mode'] = NULL;					//set admin mute on join value=0 and dtmf = null for live conference.
          }
		  else{
          $prm_form_data['mute'] = 1;
		  }
		  
		  
		  
		 //caculation for converting different timezone to est.
		 $time1 = $_POST['time'];
		 $tz = $_POST['time_zone'];
	
			$userTimezonePreference = 'EST';  //time will be saved in EST in database.
			$storedDateTimeAsUtc    = $time1;
			$dateTime = new DateTime($storedDateTimeAsUtc, new DateTimeZone($tz));
			//echo 'ORIG: ', $dateTime->format('H:i:s');
			$dateTime->setTimezone(new DateTimeZone($userTimezonePreference));
			$time_save = $dateTime->format('H:i:s');
		
		
		 
		 //Calculation of end_time of conference from start time + duration.		
		 $a = $time_save;
		 $b = $_POST['duration'];					
			list($hr, $min, $sec) = explode(':', $a);
			list($hr1, $min1, $sec1) = explode(':', $b);
			$sec_temp = $sec + $sec1;
			//echo $sec_temp."<br>";
			if($sec_temp > 59)	
			{
				$min1 = $min1+1;
				$sec_temp = $sec_temp-60;
			}
			$length = strlen( $sec_temp);
			//echo $length;
			if($length == 1)
				{
					$sec_temp = "0".$sec_temp;
				}
			else
				{
					$sec_temp = $sec_temp."<br>";
				}
			$min_temp = $min + $min1;
			//echo $min_temp."<br>";
			if($min_temp > 59)
			{
			$hr1 = $hr1+1;
			$min_temp = $min_temp-60;
			}
			$length = strlen( $min_temp);
			//echo $length;
			if($length == 1)
			{
			$min_temp = "0".$min_temp;
			}
			else
			{
			$min_temp = $min_temp;
			}

			$hr_temp = $hr + $hr1;
			//echo $hr_temp."<br>";
			//echo $a."<br>";
			//echo $b."<br>";
			$endtime = $hr_temp.":".$min_temp.":".$sec_temp;
		

$data = Array( 'conference_name'=>$prm_form_data['name'],'duration'=>$prm_form_data['duration'], 'start_date'=>$prm_form_data['start_date'], 'timezone'=>$prm_form_data['time_zone'] ,'repeat_type'=>$prm_form_data['con_type'],'admin_muted_on_join'=>$prm_form_data['mute'],'plivo_number_id'=>$prm_form_data['conference_phn'], 'repeat_value'=>$prm_form_data['weekdays1'],'dtmf_number_to_unmute'=>$prm_form_data['dtmf_mode'],'description'=>$prm_form_data['description']);

		
$date = $_POST['start_date'];
			$times = $_POST['time'];
			//$endtime = $_POST['duration'];
			$plivo = $_POST['conference_phn'];
			$weekdays = $_POST['weekdays1'];
			
			$query_date = mysql_query("SELECT conference_id FROM conference_config WHERE start_date = '$date' AND start_time < '$endtime' AND plivo_number_id ='$plivo' OR repeat_type='1' AND start_time < '$times' AND end_time > $times AND plivo_number_id ='$plivo' OR repeat_type='2' AND repeat_value = '$weekdays' AND start_time < '$endtime' AND plivo_number_id ='$plivo'");
			while($fetch_name=mysql_fetch_array($query_date))
	    	{
	     	$date1 = $fetch_name['conference_id'];
			}
			if ($date1) 
			{
				echo "Opps!!! There is another conference with <br>" ;			//validation!!--this will not allow to save conference between same date-time & phone number.
				echo "id =".$date1."<br>";
				echo "date =".$date."<br>";
				echo "time =".$times."<br>";
				echo "please go back and change the date or time";
				exit();
			}
			
	
		else
	{
	
	$id = $_POST['conference_id'];
        $this->db->where('conference_id', $id);
        $this->db->update('conference_config', $data); 
		
		 
		$data1 = Array( 'id'=>$id,'title'=>$prm_form_data['name'],'start'=>$prm_form_data['start_date'],'end'=>$prm_form_data['start_date']);
		$this->db->where('id', $id);
		$result = $this->db->update('evenement',$data1); //display in calendar.
		
		$test = $_POST['multiple1'];  //individual selected members.
		
		foreach($test as $t)
		{
		 
		 $x = 3; // Amount of digits    //random number regenration for conference pin code.
		 $min = pow(10,$x);
		 $max = pow(10,$x+1)-1;
		 $value = rand($min, $max);
		 $test = $t;
		//Will insert the selected members to the conference_user table. 
		$sql = "INSERT into conference_user (conference_id,user_id,pin_to_join_conference) VALUES ($id,'$test','$value')" ;
		$result = $this->db->query( $sql );
		}
		  $x1 = 3; // Amount of digits    admin pin code.
		 $min1 = pow(10,$x1);
		 $max1 = pow(10,$x1+1)-1;
		 $value1 = rand($min1, $max1);
		 
				
		$tag = $_POST['multiple']; //group tag.
		
		
		foreach($tag as $tg)
		{
			$tag = $tg;
			$sql_tag = mysql_query("SELECT user_id FROM user WHERE group_id='$tag'");
			while($tag_name=mysql_fetch_array($sql_tag))
			{ 
				$tag_id = $tag_name['user_id'];
				$x2 = 3; // Amount of digits    //random number regenration for conference pin code.
		 		$min2 = pow(10,$x2);
		 		$max2 = pow(10,$x2+1)-1;
		 		$value2 = rand($min2, $max2);
				$sql2 = "INSERT into conference_user (conference_id,user_id,pin_to_join_conference) VALUES ($id,'$tag_id','$value2')" ;
				$result2 = $this->db->query( $sql2 );
			}
		}	
		 

	 //for sending mail.
		$query = mysql_query("SELECT conference_user.user_id,conference_config.start_date, conference_config.start_time ,conference_config.duration,conference_config.conference_name,plivo_number.phone_number, conference_user.pin_to_join_conference, user.email_address ,user.name
FROM conference_user INNER JOIN user ON conference_user.user_id = user.user_id INNER JOIN conference_config ON conference_user.conference_id = conference_config.conference_id INNER JOIN plivo_number ON conference_config.plivo_number_id = plivo_number.plivo_number_id WHERE conference_config.conference_id='$id'");
						 
						 //$sql="SELECT * FROM contacts" ;
			 while ($row=mysql_fetch_array($query))
		{
                           	require_once 'lib/swift_required.php';

		// Mail Transport
		$transport = Swift_SmtpTransport::newInstance('ssl://smtp.gmail.com', 465)
    	->setUsername('conferenceproject7@gmail.com') // Your Gmail Username
    	->setPassword('conferenceproject@7'); // Your Gmail Password

		// Mailer
		$mailer = Swift_Mailer::newInstance($transport);
		
		// Create a message
		$message = Swift_Message::newInstance('Conference: '.$row['conference_name'].'-'.$row['start_date'].' '.$row['start_time'])
    		->setFrom(array('conferenceproject7@gmail.com' => 'Admin')) // can be $_POST['email'] etc...
    		->setTo(array($row['email_address'])) // your email / multiple supported.
    		->setBody("<table border=1px align=center bgcolor=B0FCF7 ><tr><td> Hi: <strong>".$row['name'].'</strong><br/>'. 
			         "Please join in conference on, ".$row['start_date']." at ".$row['start_time']." EST <br/>"
					 ."<br/>".$row['description']."<br/>".
					 
			 "1. Call in using your Telephone.<br/>

Dial: " .$row['phone_number']."<br/>
Pin Code : ".$row['pin_to_join_conference']."<br><br>
2. Use your microphone and speakers - a headset is recommended <br>

Click the link to join this conference : www.mastermind.memberblueprint.com/Plivo/phone/phone.php?id=".$id."<br/>
Pin Code : ".$row['pin_to_join_conference']."<br>
<br>
<br>
David, President <br>
Mastermind Conference System</td></tr></table>", 'text/html');

		// Send the message
		if ($mailer->send($message)) {
		    echo 'Mail sent successfully.';
		return $response;
		} 
		else{
    		echo 'I am sure, your configuration are not correct. :(';
			}

		} //end while loop for mail.
					
	} //end of else

		
		

        if( $this->db->_error_number() == 0 ){
            $response['error']['no'] = 0;
            $response['error']['text'] = '';
        }
        else {
		
		 
            $response['error']['no'] = $this->db->_error_number();
            $response['error']['text'] = $this->db->_error_message();
        }
        return $response;
    } //end update function
	
	function delete()
	{
        $prm_id = $_GET['id'];

        $this->db->delete('conference_config', array('conference_id' => $prm_id));
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


function decode(){
	$prm_id = $_GET['id'];
	$query = 'SELECT * FROM conference where id='.$prm_id;
	$result = $this->db->query( $query );
	
        $data = Array();
        $response = Array();
		
		if ($result->num_rows() > 0) 
		{
            foreach ($result->result() as $row)
			{
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
            $response['error']['no'] = -1;
            $response['error']['text'] = 'Query failed!';
       }
        return $response;	
	}
	
 }
