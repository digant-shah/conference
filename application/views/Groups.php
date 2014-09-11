<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tags</title>

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
?>
    
      <!-- BEGIN PAGE -->
      <div class="page-content">               
         <!-- BEGIN PAGE HEADER-->
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN PAGE TITLE & BREADCRUMB-->
               <h3 class="page-title">
                  Tags <small></small>
               </h3>
               <ul class="page-breadcrumb breadcrumb">
                  
                  <li>
                     <i class="icon-home"></i>
                     <a href="#">Home</a> 
                     <i class="icon-angle-right"></i>
                  </li>
                  <li>
                     <a href="#">Tags</a>
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
                     <div class="caption"><i class="icon-edit"></i>Tags</div>
                    <!-- <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                        <a href="#portlet-config" data-toggle="modal" class="config"></a>
                        <a href="javascript:;" class="reload"></a>
                        <a href="javascript:;" class="remove"></a>
                     </div>-->
                  </div>
                  <div class="portlet-body">
                     <div class="table-toolbar">
                        <div class="btn-">
                            <button id="" class="btn green" onclick="fn_sync_group();" >
                           Sync  from InfusionSoft <i class="icon-plus"></i>
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
                              <th>Group Id</th>
                              <th>Tag Name</th>
                              <th>No. of users</th>
                              <th>Delete</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php
						$sql="SELECT * FROM group_config" ;
						$result = mysql_query($sql);
								
                            while($row = mysql_fetch_array($result))
							{ ?>
							
                           <tr >
                              <td><?php echo $row['group_id'].'<br/>';?> </td>
                              <td><?php echo $row['group_name'].'<br/>';?></td>
							  <?php
							 $query1 = "SELECT COUNT(*) AS total FROM user WHERE group_id=".$row['group_id']; 
							$result1 = mysql_query($query1); 
							$values1 = mysql_fetch_assoc($result1); 
							$num_row = $values1['total'];
							?>
							 <td><?php echo $num_row.'<br/>'; ?></td>
                              
                              <td><a class="delete" href="javascript:;">Delete</a></td>
                           </tr>
                           <?php } ?>
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
