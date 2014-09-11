<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sync_Model extends CI_Model {

    function sync_contacts() {
	
			 
			set_time_limit(0);
			 ini_set("display_errors", 1); 
			include("src/xmlrpc/lib/xmlrpc.inc");
			include('src/isdk.php');

			$app = new iSDK();
			$app->cfgCon("familylife", "5578d0615a091ed8ddc85d1bdbec34ec");
			if(!$app->cfgCon("familylife", "5578d0615a091ed8ddc85d1bdbec34ec"))     // 'myapp' must be the connection name in the config file.
				{
 				  echo 'No connection';
   
				}
			else
				{
					echo 'connection Successfull' ; 
				} 

###Set our Infusionsoft application as the client###
$client = new xmlrpc_client("https://familylife.infusionsoft.com/api/xmlrpc");

###Return Raw PHP Types###
$client->return_type = "phpvals";

###Dont bother with certificate verification###
$client->setSSLVerifyPeer(FALSE);

###Our API Key###
$key = "5578d0615a091ed8ddc85d1bdbec34ec";

echo "<br>";
//print_r($conDat); 

 $all_contacts = array(); 
 $response = array();       
        $page = 0;
        
        $returnFields = array('Id','FirstName','groups');
        $query = array('groups' => 1376);

        while(true)
        {
            $results = $app->dsQuery("Contact", 10, $page, $query, $returnFields);
                        
            $all_contacts = array_merge($all_contacts, $results);
            
            if(count($results) < 1000)
            {
                break;
            }
        
            $page++;
        }
	


foreach($all_contacts as $record)
	  					{
						$all_contacts = $record; 
 $data = $all_contacts['FirstName'];
 $data1 = $all_contacts['Id'];
 $sql="INSERT into contacts (name,id) VALUES ('$data','$data1')" ;
  $result = $this->db->query( $sql );
   if( $this->db->_error_number() == 0 ){
            $response['error']['no'] = 0;
            $response['error']['text'] = '';
        }
        else {
            $response['error']['no'] = $this->db->_error_number();
            $response['error']['text'] = 'This Customer id already exists.';
        }
        return $response;
	}

}



function display_contacts(){

$query = 'SELECT * FROM contacts';
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

}