<?php $this->load->view('headerjscss');?>
<?php include('jsinclude.php'); ?>
<?php $this->load->view('header'); ?>
<?php include('db.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dashboard</title>

<script src="/assets/js/dashboard.js" type="text/javascript"></script>
<link href='/js/fullcalendar.css' rel='stylesheet' />

</head>

<body>
<div id="loading"></div>
<div class="page-container">
<?php $this->load->view('sidemenu'); ?>

<!-- BEGIN PAGE -->
<div class="page-content">
<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <h4 class="modal-title">Conference Stats Details</h4>
                  </div>
                  <div class="modal-body">
                     Stats of conference
                  </div>
                  <div class="modal-footer">
                     
                     <button type="button" class="btn default" data-dismiss="modal">Close</button>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
    <!-- BEGIN PAGE HEADER-->
  <div class="row">
            <div class="col-md-12">
               <!-- BEGIN PAGE TITLE & BREADCRUMB-->
               <h3 class="page-title">
                  Admin Dashboard <small> Conference statistics and more</small>
               </h3>
               <ul class="page-breadcrumb breadcrumb">
                  <li>
                     <i class="icon-home"></i>
                     <a href="#">Home</a> 
                     <i class="icon-angle-right"></i>
                  </li>
                  <li><a href="#">Dashboard</a></li>
                  
               </ul>
               <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
         </div>
         <!-- END PAGE HEADER-->

         <div class="clearfix"></div>
         <div class="row">
            <div class="col-md-6 col-sm-6">
               
            </div>
            <div class="col-md-6 col-sm-6">
               <!-- BEGIN PORTLET-->
               
               <!-- END PORTLET-->
               <!-- BEGIN PORTLET-->
               
               <!-- END PORTLET-->
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="row ">
            <div class="col-md-6 col-sm-6">
               <div class="portlet box blue">
                  <div class="portlet-title">
                     <div class="caption"><i class="icon-bell"></i>Recent Activities</div>
                                       </div>
                  <div class="portlet-body">
                     <div class="scroller" style="height: 200px;" data-always-visible="1" data-rail-visible="0">
                        <ul class="feeds">
                           <li>
                             <div class="cont-col2">
                              <div class="desc">
							  <table class="table table-striped table-hover table-bordered" id="sample_editable_">
                        <thead>
                           <tr>
                              <th>Phone Number</th>
                              <th>Name</th>
                              <th>End Time</th>
							  <th>Duration</th>
							  <th>Attendee</th>
                              <th>Check Details</th>
                           </tr>
                        </thead>
						<tbody>
						<?php $d = date('Y-m-d');
						$t = date('H:i:s');?>
						<!--Display recently finished conference.-->
						<?php $query = "SELECT *,plivo_number.phone_number FROM conference_config INNER JOIN plivo_number ON conference_config.plivo_number_id = plivo_number.plivo_number_id WHERE start_date!='$d' OR start_time!='$t' AND end_time<'$t'"; 
							$result = mysql_query($query); 
							//$values = mysql_fetch_assoc($result); 
							//$num_rows2 = $values['total']; 
							 while($row = mysql_fetch_array($result))
							{
							
							?> 
						<tr >
                              <td width="200"><?php echo $row['phone_number'].'<br/>'; ?></td>
                              <td width="250"><?php echo $row['conference_name']. '<br/>';?> </td>
                              <td width="80" class="center"><?php echo $row['end_time'].'<br/>'; ?></td>
							 <td><?php echo $row['duration'].'<br/>';?></td>
							 <!--display the number of user who attended conference-->
							 <?php
							$query1 = "SELECT COUNT(*) AS total FROM call_detail_record WHERE conference_id=".$row['conference_id']; 
							$result1 = mysql_query($query1);
							$values1 = mysql_fetch_assoc($result1);
							$num_row = $values1['total'];
							?>
							 <td><?php echo $num_row.'<br/>'; ?></td>
							 
                              <td><button type="button" onClick="fn_details(<?php echo $row['conference_id']?>)">Stats</button></td>
                          
						   </tr>
						   <?php }
                       
						?>
						</tbody>
                     </table>
						      </div>
                             </div>
                           </li>
						</ul>
					</div>

                     <div class="scroller-footer">
                        <div class="pull-right">
                           <a href="#">See All Records <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-sm-6">
               <div class="portlet box green tasks-widget">
                  <div class="portlet-title">
                     <div class="caption"><i class="icon-check"></i>Active Tasks</div>
                     <div class="tools" style="display:none;">
                        <a href="#portlet-config" data-toggle="modal" class="config"></a>
                        <a href="" class="reload"></a>
                     </div>
                     
                  </div>
				 
                  <div class="portlet-body">
				  
                     <div class="task-content">
                        <div class="scroller" style="height: 200px;" data-always-visible="1" data-rail-visible1="1">
                        <div class="desc">
						<table class="table table-striped table-hover table-bordered" id="sample_editable_">
                        <thead>
                           <tr>
                              <th>Conference</th>
                              <th>Time</th>
                              <th>Duration</th>
							  <th>Online Users</th>
							  <th>Conference Number</th>
                              <th>Join</th>
                           </tr>
                        </thead>
						<tbody>
						<?php $d = date('Y-m-d');
						$t = date('H:i:s');
						$w = date('w');
						$month_date = ('d');
						?>
						<!--this will show the active running conference-->
						<?php $query = "SELECT *,plivo_number.phone_number FROM conference_config INNER JOIN plivo_number ON conference_config.plivo_number_id = plivo_number.plivo_number_id WHERE start_date='$d' AND end_time>'$t' AND start_time<'$t' OR repeat_type=1 AND end_time>'$t' AND start_time<'$t' OR repeat_type=2 AND repeat_value='$w' AND end_time>'$t' AND start_time<'$t' OR repeat_type=3 AND repeat_value='$month_date' AND end_time>'$t' AND start_time<'$t'"; 
							$result = mysql_query($query); 
							//$values = mysql_fetch_assoc($result); 
							//$num_rows2 = $values['total']; 
							 while($row = mysql_fetch_array($result))
							{
						
							  ?> 
						<tr >
                              <td width="200"><?php echo $row['conference_name'].'<br/>';?> </td>
                              <td width="250"><?php echo $row['start_time']. '<br/>';?>  </td>
                              <td width="80" class="center"><?php echo $row['duration'].'<br/>';?>
							 <!--fetch online users in running conference.-->
							 </td>
							 <?php $query2 = "SELECT COUNT(*) AS total FROM call_detail_record WHERE end_datetime=0 AND conference_id=".$row['conference_id']; 
							$result2 = mysql_query($query2); 
							$values2 = mysql_fetch_assoc($result2); 
							$num_row2 = $values2['total']; 
							
							  ?>
							 <td><?php echo $num_row2.'<br/>'; ?></td>
							 <td><?php echo $row['phone_number'].'<br/>';?></td>
							 <!--for joining into conference-->
                              <td><button type="button" onClick="fn_joining(<?php echo $row['conference_id']?>)">Join</button></td>
                           <?php  }?>
						   </tr>
						   
                        </tbody>
                     </table>
						
                              </div>
                         </div>
                     </div>
                     <div class="task-footer">
                        <span class="pull-right">
                        <a href="#">See All Tasks <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="row ">
            <div class="col-md-6 col-sm-6">
               <div class="portlet box purple">
                  <div class="portlet-title">
                     <div class="caption"><i class="icon-calendar"></i>Conference Stats</div>
                     <!--<div class="actions">
                        <a href="javascript:;" class="btn btn-sm yellow easy-pie-chart-reload"><i class="icon-repeat"></i> Reload</a>
                     </div>-->
                  </div>
                  <div class="portlet-body">
				  <!--fetch the number of users online in all the running conference.-->
				  <?php $query = "SELECT COUNT(*) AS total FROM call_detail_record WHERE end_datetime=0"; 
							$result = mysql_query($query); 
							$values = mysql_fetch_assoc($result); 
							$num_row = $values['total']; 
							
							  ?>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="easy-pie-chart">
                              <div class="number transactions" data-percent="<?php echo $num_row; ?>"><span><?php echo $num_row; ?></span></div>
                              <a class="title" href="#"> Users in Conference <i class="m-icon-swapright"></i></a>
                           </div>
                        </div>
                        <div class="margin-bottom-10 visible-sm"></div>
						<?php $d = date('Y-m-d');
						$t = date('H:i:s');?>
						<!--display the number of running conferences.-->
						<?php $query = "SELECT COUNT(*) AS total FROM conference_config WHERE start_date='$d' AND end_time>'$t' AND start_time<'$t' OR repeat_type=1 AND end_time>'$t' AND start_time<'$t' OR repeat_type=2 AND repeat_value='$w' AND end_time>'$t' AND start_time<'$t' OR repeat_type=3 AND repeat_value='$month_date' AND end_time>'$t' AND start_time<'$t'"; 
							$result = mysql_query($query); 
							$values = mysql_fetch_assoc($result); 
							$num_rows2 = $values['total']; 
							
							  ?>  
                        <div class="col-md-4">
                           <div class="easy-pie-chart">
                              <div class="number visits" data-percent="<?php echo $num_rows2; ?>"><span><?php echo $num_rows2; ?></span></div>
                              <a class="title" href="#">Running Conference <i class="m-icon-swapright"></i></a>
                           </div>
                        </div>
                        <div class="margin-bottom-10 visible-sm"></div>
						<!--display total number of conferences both active and finished.-->
						<?php $query = "SELECT COUNT(*) AS total FROM conference_config"; 
							$result = mysql_query($query); 
							$values = mysql_fetch_assoc($result); 
							$num_rows1 = $values['total']; 
							
							  ?>
                        <div class="col-md-4">
                           <div class="easy-pie-chart">
                              <div class="number bounce" data-percent="<?php echo $num_rows1; ?>"><span><?php echo $num_rows1; ?></span></div>
                              <a class="title" href="#">Total number of Conference <i class="m-icon-swapright"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
			</div>
            <div class="col-md-6 col-sm-6">
               
         </div>
         
                                 
         <div class="clearfix"></div>
         <div class="row ">
            <div class="col-md-6 col-sm-6">
               <!-- BEGIN PORTLET-->
               <div class="portlet box blue calendar">
                  
				  <div class="portlet-title">
                     <div class="caption"><i class="icon-calendar"></i> Calendar</div>
                  </div>
                  <div class="portlet-body light-grey">
                     <div id="calendar"></div>
                  </div>
               </div>
               <!-- END PORTLET-->
            </div>
            <div class="col-md-6 col-sm-6">
              
               <!-- END PORTLET-->
            </div>
         </div>
      </div>
      <!-- END PAGE -->
</div>
</body>
</html>
<?php
include('footer.php');

?>
