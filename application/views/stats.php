<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stats</title>

</head>

<body>
   <div class="clearfix"></div>
   <!-- BEGIN CONTAINER -->
   <div class="page-container">
   <?php

include('headerjscss.php');
include('sidemenu.php');
include('jsinclude.php');
include('header.php');
include('db.php');
?>
    
      <!-- BEGIN PAGE -->
      <div class="page-content">
        
               
         <!-- BEGIN PAGE HEADER-->
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN PAGE TITLE & BREADCRUMB-->
               <h3 class="page-title">
                  Stats <small></small>
               </h3>
               <ul class="page-breadcrumb breadcrumb">
                  
                  <li>
                     <i class="icon-home"></i>
                     <a href="#">Home</a> 
                     <i class="icon-angle-right"></i>
                  </li>
                  <li>
                     <a href="#">Stats</a>
                     <i class="icon-angle-right"></i>
                  </li>
                 
               </ul>
               <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
         </div>
         <!-- END PAGE HEADER-->
         <!-- BEGIN PAGE CONTENT-->
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
               <div class="portlet box blue">
                  <div class="portlet-title">
                     <div class="caption"><i class="icon-edit"></i>Conference Stats</div>
                  </div>
                  <div class="portlet-body">
                     <?php $prm_id = $_GET['conference_id'];?>
						<?php $query1 = "SELECT * FROM conference_config WHERE conference_id=$prm_id"; 
							$result1 = mysql_query($query1); 
							//$values = mysql_fetch_assoc($result); 
							//$num_rows2 = $values['total']; 
							 while($row1 = mysql_fetch_array($result1))
							{
						
							  ?>
                     <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
						
                           <tr>
						   <center><font size="+1"> Conference <strong>"<?php echo $row1['conference_name'];}?>" </strong> Statistics </center>
                              <th>Name of User</th>
                              <th>Joining Date Time</th>
                              <th>Exit Date Time</th>
                              
                           </tr>
                        </thead>
						
                        <tbody>
						<?php $prm_id = $_GET['conference_id'];?>
						<?php $query = "SELECT *, user.name FROM call_detail_record INNER JOIN user ON call_detail_record.user_id = user.user_id WHERE conference_id=$prm_id"; 
							$result = mysql_query($query); 
							 while($row = mysql_fetch_array($result))
							{
							 
						
							  ?>
                           <tr >
                              <td><?php  
                                
                                echo $row['name'].'<br/>'; 
                                
                             ?></td>
                              
                              <td><?php  
                                
                                echo $row['start_datetime'].'<br/>'; 
                                
                             ?></td>
                              <td><?php  
                                
                                echo $row['end_datetime'].'<br/>'; 
                                
                             }?></td>
                              
                           </tr>
                           
                           
                        </tbody>
                     </table>
                  </div>
               </div>
               <!-- END EXAMPLE TABLE PORTLET-->
            </div>
         </div>
         <!-- END PAGE CONTENT -->
      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
  <?php
include('footer.php');
?>
