<?php include('header.php');?>
<?php


//include_once('load.php');

include_once('load.php');
include_once("db.php");
		 
 
foreach($all_contacts as $record)
	  					{
						$all_contacts = $record; 
 $data = $all_contacts['FirstName'];
 $data1 = $all_contacts['Id'];
 $data2 = $all_contacts['groups'];
 mysqli_select_db($con,"conference");
 $sql="INSERT into user (name,user_id,group_id) VALUES ('$data','$data1','$data2')" ;
 $result = mysql_query($sql);
}

?>
<body>
   <div class="clearfix"></div>
   <!-- BEGIN CONTAINER -->
   <div class="page-container">
   <?php

include('headerjscss.php');
include('sidemenu.php');
include('jsinclude.php');
?>
    <script type="text/javascript">
    $(window).load(function(){
        $('#myModal').modal('show');
    });
</script>
      <!-- BEGIN PAGE -->
      <div class="page-content">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <h4 class="modal-title">Synchronise Contact Notice</h4>
                  </div>
                  <div class="modal-body">
                     Contacts Synchronised Successfully
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn blue" onClick="location.href='/conference/index.php/contacts_details'">Ok</button>
                     <button type="button" class="btn default" data-dismiss="modal" onClick="location.href='/conference/index.php/contacts_details'">Close</button>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
   </div>
   <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
  <?php
include('footer.php');

?>
