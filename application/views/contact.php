<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Contacts</title>

</head>
<script src="/assets/js/sync.js" type="text/javascript"></script>
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

//include_once('load.php');
?>
    
      <!-- BEGIN PAGE -->
      <div class="page-content">
         <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->               
         <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <h4 class="modal-title">Modal title</h4>
                  </div>
                  <div class="modal-body">
                     Widget settings form goes here
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn blue">Save changes</button>
                     <button type="button" class="btn default" data-dismiss="modal">Close</button>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
         <!-- /.modal -->
               
         <!-- BEGIN PAGE HEADER-->
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN PAGE TITLE & BREADCRUMB-->
               <h3 class="page-title">
                  Contacts<small></small>
               </h3>
               <ul class="page-breadcrumb breadcrumb">
                  <li>
                     <i class="icon-home"></i>
                     <a href="#">Home</a> 
                     <i class="icon-angle-right"></i>
                  </li>
                  <li>
                     <a href="#">Contact</a>
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
                     <div class="caption"><i class="icon-edit"></i>Contacts</div>
                     
                  </div>
                  <div class="portlet-body">
                     <div class="table-toolbar">
                        <div class="btn-group">
                            <button id="" class="btn green btn-sm default" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" onclick="fn_sync();">
                           Select Tag & Sync Contacts from InfusionSoft <i class="icon-plus"></i>
                           </button>
						   <div class="dropdown-menu hold-on-click dropdown-checkboxes">
                              <label><input id="1" type="checkbox" checked="checked" value="1376" /> Test-1376</label>
                              
                           </div>
                        </div>
						
                        <div class="btn-group pull-right">
                           <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
                           </button>
                           <ul class="dropdown-menu pull-right">
                              <li><a href="#">Print</a></li>
                           </ul>
                        </div>
                     </div>
                     <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
						
                           <tr>
                              <th>Name</th>
                              <th>Pin Number to join</th>
							  <th>Conference Name</th>
                              <th>Conference Phone Number</th>
                              <th>Email</th>
							  <th>phone Number</th>
                              <th>Delete</th>
                           </tr>
                        </thead>
				
                        <tbody>
						<!--Display the contacts which are selected for conference.-->
						 <?php
						 mysqli_select_db($con,"memblue_master");
						$sql = "SELECT conference_user.user_id,conference_config.start_date, conference_config.start_time ,conference_config.duration,conference_config.conference_name,plivo_number.phone_number, conference_user.pin_to_join_conference, user.email_address ,user.name
FROM conference_user INNER JOIN user ON conference_user.user_id = user.user_id INNER JOIN conference_config ON conference_user.conference_id = conference_config.conference_id INNER JOIN plivo_number ON conference_config.plivo_number_id = plivo_number.plivo_number_id";
						 
						 //$sql="SELECT * FROM contacts" ;
						 $result = mysqli_query($con,$sql);
						 while($row = mysqli_fetch_array($result))
							{
                           ?>  
						   
                           <tr >
						      <td><?php echo $row['name'].'<br/>'; ?></td>
                              <td><?php echo $row['pin_to_join_conference'].'<br/>'; ?></td>
							  <td><?php echo $row['conference_name'].'<br/>'; ?></td>
                              <td><?php echo $row['phone_number'].'<br/>'; ?></td>
							  <td><?php echo $row['email_address'].'<br/>'; ?></td>
                              <td><?php // echo $row['email_address'].'<br/>'; ?></td>
                              <td><a class="delete" href="javascript:;">Delete</a></td>
							  <?php } ?>
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
