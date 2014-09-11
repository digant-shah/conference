<?php
error_reporting(E_ALL); 
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


//$contactID = 67496;

//$result = $app->loadCon($contactID, array('email'));

//$conDat = array('FirstName' => 'John',
//                'LastName'  => 'Doe',
//                'Email'     => 'JDoe@email.com');
//$returnFields = array('Id', 'FirstName', 'LastName');
//$conDat = $app->dsLoad1("Contact", $returnFields);
//$cid = 67496;
//$gid = 13;
//$conDat = $app->grpAssign($cid, $gid);
// An array is returned.
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
		
      //print_r($all_contacts);
	  
	  
	//echo $all_contacts['Id'] . $all_contacts['FirstName'] . "<br>";
	  

		
?>
