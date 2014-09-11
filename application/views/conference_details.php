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
include("db.php"); 
include('headerjscss.php');
include('sidemenu.php');
include('jsinclude.php');
include('header.php');
?>
<script src="/assets/js/conference.js" type="text/javascript"></script>
<script>
$(document).on("click",".config",function () {
     var myBookId = $(this).data('id');
     $(".modal-body #bookId").val( myBookId );
});
</script>    
      <!-- BEGIN PAGE -->
      <div class="page-content">
	

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
                     <a href="#">View Conference Details</a>
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
                           <button id="sample_editable_1_ne" class="btn green" onClick="location.href='add_conference';">
                           Add New <i class="icon-plus"></i>
                           </button>
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
                              <th>Conference</th>
                              <th>Date Time</th>
                              <th>Duration</th>
							  <th>Conference Number</th>
                              <th>Description</th>
							  <th>Attendee</th>
                              <th>Edit</th>
                              <th>Delete</th>
							  <th>Copy</th>
                           </tr>
                        </thead>
                        <tbody>
						

                         
				<!--displaying conference details from database-->
               <?php mysqli_select_db($con,"memblue_master");
									$sql="SELECT *,plivo_number.phone_number FROM conference_config INNER JOIN plivo_number ON conference_config.plivo_number_id = plivo_number.plivo_number_id" ;

									$result = mysqli_query($con,$sql); ?>
								<?php
                            while($row = mysqli_fetch_array($result))
							{
							$data = $row['duration'];
							$duration = date('H:i',strtotime($data));
                           //date_default_timezone_set('EST');
						   //echo date('H:i:s');
						   
						   
						   $t = $row['start_time'];
						   $time = date('H:i A',strtotime($t));
						   
						   $time1 = $t; //$_POST['time'];
		 $tz = $row['timezone'];
	
			$userTimezonePreference = $tz;
			$storedDateTimeAsUtc    = $time1;
			$dateTime = new DateTime($storedDateTimeAsUtc, new DateTimeZone('EST'));
			//echo 'ORIG: ', $dateTime->format('H:i:s');
			$dateTime->setTimezone(new DateTimeZone($userTimezonePreference));
			$time_save = $dateTime->format('H:i:s');
			
				$time2 = date('H:i A',strtotime($time_save));		   
						   
						   ?>          
  <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->               
         <div class="modal fade" id="portlet-config"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <h4 class="modal-title">Copy Conference</h4>
                  </div>
                  <div class="modal-body">
                     <input type="text" name="bookId" id="bookId" class="input-medium form-control" value=""/> <br />
					 <input type="date" class="input-medium form-control" />
					 
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn blue" onClick="location.href='/conference/index.php/add_conference/copy_conf'">Save changes</button>
                     <button type="button" class="btn default" data-dismiss="modal">Close</button>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
         <!-- /.modal -->
         <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                        
                           <tr>
                              <td width="200"><?php echo $row['conference_name'].'<br/>';?> </td>
                              <td width="250"><?php echo $row['start_date'].'--&nbsp;' .$time2.'--&nbsp;'.$tz.'<br/>';?> </td>
                              <td width="80" class="center"><?php echo $duration.'<br/>';?></td>
							  <td><?php echo $row['phone_number'].'<br/>'; ?></td>
							  <td width="200"><?php echo $row['description'].'<br/>';?></td>
							  <?php
							 $query1 = "SELECT COUNT(*) AS total FROM conference_user WHERE conference_id=".$row['conference_id']; //count total number of attendee
						   	 $result1 = mysql_query($query1);
							 $values1 = mysql_fetch_assoc($result1); 
							 $num_row = $values1['total'];
							 ?>
							  <td><?php echo $num_row.'<br/>'; ?></td>
                              <td><button type="button" onClick="fn_edit(<?php echo $row['conference_id']?>)">edit </button></td>
                              <td><button type="button" onClick="fn_delete(<?php echo $row['conference_id']?>)">Delete </button></td>
							  <td><a data-toggle="modal" data-id="<?php echo $row['conference_name']?>" class="config" href="#portlet-config">Copy</a></td>
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
 <?php include('footer.php'); ?>