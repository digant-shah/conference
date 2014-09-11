<?php include("/application/config/database.php"); ?> 
		<?php $con = mysqli_connect('localhost','memblue_master','?[)iUGugEeKQ','memblue_master');;
			if (!$con)
  			{
  			die('Could not connect: ' . mysqli_error($con));
  			}?>
<?php



?>

<script src="/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="/assets/js/conference.js" type="text/javascript"></script>		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Conference Details</title>

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
?>
<script src="/assets/js/conference.js" type="text/javascript"></script>
    
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
                 Conference<small></small>
               </h3>
               <ul class="page-breadcrumb breadcrumb">
                  
                  <li>
                     <i class="icon-home"></i>
                     <a href="#">Home</a> 
                     <i class="icon-angle-right"></i>
                  </li>
                  <li>
                     <a href="#">Conference</a>
                     <i class="icon-angle-right"></i>
                  </li>
				  <li>
                     <a href="#">Conference Status</a>
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
                     <div class="caption"><i class="icon-edit"></i>Admin Conference Panel</div>
                     
                  </div>
                  <div class="portlet-body">
                     <div class="table-toolbar">
                        <div class="btn-group">
                           
                        </div>
                        <div class="btn-group pull-right">
                           <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
                           </button>
                           <ul class="dropdown-menu pull-right">
                              <li><a href="#">Print</a></li>
                              <li><a href="#">Save as PDF</a></li>
                              <li><a href="#">Export to Excel</a></li>
                           </ul>
                        </div>
                     </div>
                     <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                           <tr>
                              <th>Conference</th>
                              <th>Status</th>
							  <th>Start Date</th>
                              <th>Time</th>
							  <th>Duration</th>
							  <th>Attendee</th>
                              <th>Description</th>
                              <th>Join</th>
                             
                           </tr>
                        </thead>
                        <tbody>
						

                         

               <?php mysqli_select_db($con,"memblue_master");
									$sql="SELECT * FROM conference_config" ;

									$result = mysqli_query($con,$sql); ?>
								<?php
                            while($row = mysqli_fetch_array($result))
							{
                           ?>          

					 <?php 
					
					 if ($row['start_date'] < date('Y-m-d H-m-s')){
					 $status = 'active' ;
					
					 }
					elseif($row['start_date'] > date('Y-m-d H-m-s'))
					{
					$status = 'scheduled' ;
					 
					}
					
					 ?> 
                        
                           <tr >
                              <td width="200"><?php echo $row['conference_name'].'<br/>';?></td>
                              <td width="100"><?php echo $status;  ?> </td>
                              <td width="100"><?php echo $row['start_date'].'<br/>'; ?></td>
							  <td><?php echo $row['start_time'].'<br/>'; ?></td>
							  <td> <?php echo $row['duration'].'<br/>'; ?></td>
							  <td width="100"> </td>
                              <td width="200"><?php echo $row['description'].'<br/>';?></td>
                              <td><button type="button" >join </button></td> 
                          
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
