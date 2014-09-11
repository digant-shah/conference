<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Conference</title>
<link rel="stylesheet" type="text/css" href="/assets/css/ui.dropdownchecklist.standalone.css" />
<script type="text/javascript" src="/src/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="/src/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="/src/ui.dropdownchecklist.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $("#s4").dropdownchecklist({ maxDropHeight: 200 });
      });
</script>
					
</head>
<body>
   <div class="clearfix"></div>
   <!-- BEGIN CONTAINER -->
   <div class="page-container">
<script src="/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="/assets/js/conference.js" type="text/javascript"></script>
<!--for counting the number of members in the tag selected..-->
<script>                          
                function myCall(thissel1) {
				//alert(thissel1.value);
				var formData = thissel1.value;
                    var request = $.ajax({
                        url: "../getuser.php?q="+formData,
						type: "POST",            
                        dataType: "html"
                    });
 					var num1 = $("#mybox").val();
                    request.done(function(msg) {
                        var num2 = +num1 + +msg;
							num1 = num2;
						$("#mybox").val(num1);          
                    });
 							
                    request.fail(function(jqXHR, textStatus) {
                        alert( "Request failed: " + textStatus );
                    });
                }
             
        </script>

<?php
include('headerjscss.php');
include('sidemenu.php');
include('jsinclude.php');
include('header.php');
include("db.php");?>


<div class="page-content">
	<div class="row">
            <div class="col-md-7">
               <!-- BEGIN PAGE TITLE & BREADCRUMB-->
               <h3 class="page-title">
                  Add Confernce
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
                     <a href="#">Add Conference</a>
                     <i class="icon-angle-right"></i>
                  </li>
                
               </ul>
               <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
         </div>
<div class="row">
            <div class="col-md-7 ">
               <!-- BEGIN SAMPLE FORM PORTLET-->   
               <div class="portlet box blue">
                  <div class="portlet-title">
                     <div class="caption">
                        <i class="icon-reorder"></i> Add Conference
                     </div>
                     
                  </div>
                  <div class="portlet-body form">
                     <form action="/conference/index.php/add_conference/process" method="post" id="form_sample_1" enctype="multipart/form-data">
					 <div class="form-body">
					 <div class="form-body">
					
                           <div class="form-group">
                              <label class="control-label" for="exampleInputEmail1">Conference Title</label>
                              <input type="text" class="form-control tooltips" id="name" name="name" data-placement="right" title="Name of Conference" placeholder="Enter name of Conference">
                             
                           </div>
						   
                           <div class="form-group">
                              <label class="control-label" >Conference Description</label>
                               <textarea class="form-control tooltips" data-placement="right" id="description" title="Description of Conference" name="description" rows="3"></textarea>
                           </div>
						   <hr/>
						   <div class="row">
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <label class="control-label" >Start Date</label>
                                             <div class="input-group input-small date date-picker tooltips" data-date="2013-11-01" data-date-format="yyyy-mm-dd" data-date-viewmode="years" data-placement="top" title="Starting Date of Conference">
		                                    <input type="text" style="width:100px;" id="start_date" name="start_date"class="form-control" readonly>
											<span class="input-group-btn">
     	   	                               <button class="btn default" type="button"><i class="icon-calendar"></i></button>
       		                            </span>
									</div>
                                   </div>
                                  </div>
								  
                                       <!--/span-->
                                  <div class="col-md-3">
									   <div class="form-group input-small">
                              <label class="control-label" >Time Zone</label>
                              <select  class="form-control" name="time_zone" style="width:150px;font-size:10px;">
                                <?php $sql_tz="SELECT * FROM timezones";
						 $result_tz = mysqli_query($con,$sql_tz);
						 while($row_tz = mysqli_fetch_array($result_tz))
							{ ?>
                                 <option style="font-size:8px;" value="<?php echo $row_tz['timezone'];  ?>"><?php echo $row_tz['name']; } ?></option>
                              </select>
                           </div></div>
						   <!--/span-->
									   <div class="col-md-3">
                                          <div class="form-group">
                                             <label class="control-label" >Time</label>
                                             <div class="input-group bootstrap-timepicker input-small tooltips" data-placement="right" title="Time of Conference">                                       
                                             <input type="text" name="time" id="time" value="<?php echo date('H:i A');?>" style="width:100px;" class="form-control timepicker-default">
                                             <span class="input-group-btn">
                                             <button class="btn default" type="button"><i class="icon-time"></i></button>
                                             </span>
                                           </div>
                                          </div>
                                       </div>
                                       <!--/span-->
									   
									   
									   <div class="col-md-3">
                                          <div class="form-group">
                                             <label class="control-label">Duration</label>
                                             <div class="input-group bootstrap-timepicker input-small tooltips" data-placement="right" title="Set the duration of Confernece">                                       
                                             <input type="text" name="duration" value="00:30:00" class="form-control timepicker-24" >
                                             <span class="input-group-btn">
                                             <button class="btn default" type="button"><i class="icon-time"></i></button>
                                             </span>
                                           </div>
                                          </div>
                                       </div> <!--/span-->
									</div><!--/row-->
									
									
									<div class="row">
						   <div class="col-md-3">
									<div class="form-group input-small">
									<label class="control-label">Repeat Type</label>
									<div class="make-switch switch-mini" style="height:20px;" onClick="document.getElementById('type').focus();">
									<input type="radio" name="onoff" id="chk_1"  style="height:20px;"  class="toggle"/>
                                    </div>
									</div>
									</div></div>
									


                           <div class="row">
						   <div class="col-md-3">
                           <div class="form-group input-small tooltips" id="conftype" style="display:none;">
                              <label class="control-label">Repeat Type</label>
                              <select  class="form-control" name="con_type" id="type"  data-placement="top" title="Select the mode of Confernece">
                                 <option value="0">Select Type</option>
								 <option value="1">Daily</option>
                                 <option  value="2">Weekly</option>
                                 <option  value="3">Monthly</option>
                              </select>
                           </div>
						   </div><!--/span-->
						   
						   </div><!--/row-->
						   <div class="form-group" id="weekdays">
                              <label  class="control-label">Weekdays</label>
                              <div class="checkbox-list" id="all">
                                 <label class="checkbox-inline control-label">
                                 <input type="checkbox" id="inlineCheckbox1" name="weekdays" value="1">Monday
                                 </label> &nbsp;&nbsp;
                                 <label class="checkbox-inline control-label">
                                 <input type="checkbox" id="inlineCheckbox2" name="weekdays" value="2">Tuesday
                                 </label>
                                 <label class="checkbox-inline control-label">
                                 <input type="checkbox" id="inlineCheckbox3" name="weekdays" value="3">Wednesday
                                 </label>
							</div>
							<div class="checkbox-list" id="all">
								 <label class="checkbox-inline control-label">
                                 <input type="checkbox" id="inlineCheckbox3" name="weekdays" value="4">Thursday
                                 </label>
								 <label class="checkbox-inline control-label">
                                 <input type="checkbox" id="inlineCheckbox3" name="weekdays" value="5">Friday
                                 </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								 <label class="checkbox-inline control-label">
                                 <input type="checkbox" id="inlineCheckbox3" name="weekdays" value="6">Saturday
                                 </label>
								 <label class="checkbox-inline control-label">
                                 <input type="checkbox" id="inlineCheckbox3" name="weekdays" value="7">Sunday
                                 </label> 
                              <input id="txtbox" type="hidden" name="weekdays1" Height="100px"  Width="770px"  />
							  </div>
							   
                           </div>
						   
						   <div class="form-group input-small" id="monthly">
                              <label class="control-label" >Select Day</label>
                              <select  class="form-control" name="month_date">
                                 <option>Select Day</option>
                                 <option>1</option>
                                 <option>2</option>
                                 <option>3</option>
                                 <option>4</option>
                              </select>
                           </div>
						   <hr/>
						   <div class="row">
						   <div class="col-md-6">
						   <div class="form-group">
                           <label class="control-label" >Tagged Members</label>
						   <label class="control-label" style="margin-left:55px;">Selected Tag</label>
					

	   
                           <select name="multiple[]" multiple="" id="my_multi_select4" onChange="myCall(this);">
						   
						  <?php 
						  mysqli_select_db($con,"memblue_master");
						  $sql1="SELECT * FROM group_config";
						 $result1 = mysqli_query($con,$sql1);
						 while($row1 = mysqli_fetch_array($result1))
							{ ?>
        <option style="font-size:9px;" value="<?php echo $row1['group_id']?>"><?php echo $row1['group_name'];}  ?></option>
		</select>
		<br>
		<label class="control-label">Total Tagged Members:</label>
		<input name="mybox" disabled="disabled" type="text" id="mybox" value="0" style="width:120px;margin-left:16px;">		  
					 </div>
					 
						   </div>   <!--span-->
						   
						  
							
						   <div class="col-md-6">
                           <div class="form-group">
						     <label class="control-label" >Members</label>
							 <label class="control-label" style="margin-left:100px;">Selected Members</label>
								 <select class="multi-select" multiple="" name="multiple1[]" id="my_multi_select3" onChange="valList(this);">
								 <?php
						 mysqli_select_db($con,"memblue_master");
						 $sql="SELECT * FROM user WHERE group_id IS NULL" ;
						 $result = mysqli_query($con,$sql);
						 while($row = mysqli_fetch_array($result))
							{
                           ?>
                                    <option style="font-size:10px;" value="<?php echo $row['user_id'].'<br/>'; ?>" ><?php echo $row['name'].'<br/>'; } ?></option>
		</select>
		<br>
		<label class="control-label" style="margin-left:30px;">Total Members:</label>
		<input name="text" disabled="disabled" type="text" id="text" value="" style="width:120px;margin-left:30px;">
<script>
function valList(thissel){

var selCount = 0;
for (var i=0; i<thissel.length; i++) {
if (thissel[i].selected) {
selCount += 1;
}
}
text.value= selCount;
}
</script>
                            
                        </div>
                           </div>
						   </div>
						   <hr/>
						   
						   <div class="row">
						   <div class="col-md-6">
						   <div class="form-group">
                              <label class="control-label">Conference Type</label>
								
								<select  class="form-control input-medium" name="select_conference" id="select_conference" title="Select Type of Conference">
											
												<option>Conference Type</option>
								 				<option>Live Conference</option>
                                 				<option>Pre-recorded</option>
                                 				
                             				</select>	

                                       
                           </div>
						   </div>
						   <div class="col-md-6">
						   <div class="form-group" id="mp3">
                              <label class="control-label">Add mp3 file</label>
       <div class="row form-action">
       <div class="col-md-12">
              
<form method="post" enctype="multipart/form-data">               
<input type="file" name="file" title="Please select only .mp3 file for pre-recorded conference.">
</form>

                   
                    </div>
				 </div>
				 </div>
				 </div>
              </div>
						   <hr/>
						   
						   
						   <div class="form-group tooltips" id="mute">
                              <label class="control-label">Admin Muted On Join Conference</label>

                              <div class="radio-list">
								<div class="make-switch switch-mini form-group" style="height:20px;">
                                <input type="checkbox" style="height:20px;" name="mute" checked class="toggle"/>
                                </div>
							  </div>
							 </div>
                           <div class="form-group" id="mute1">
                              <label class="control-label">Talking Mode</label>
								<div class="radio-list">
									<label class="radio-inline">
										<input type="checkbox" name="talking_mode" id="optionsRadios10" value="Talking mode-on" title="Activate this to allow moderator to speak by pressing DTMF key during live conference"> On </label>
										<label class="radio-inline control-label" >DTMF mode
											<select  class="form-control input-xsmall" data-toggle="dropdown" data-hover="dropdown"  name="dtmf_mode" title="Select DTMF mode to speak during live conference" >
											
												<option>1</option>
								 				<option>2</option>
                                 				<option>3</option>
                                 				<option>4</option>
                               				    <option>5</option>
								  				<option>6</option>
								 				<option>7</option>
                               				    <option>8</option>
                                 				<option>9</option>
                                 				<option>0</option>
								 				<option>*</option>
                                 				<option>#</option>
                             				</select>
										</label>

                                      </div> <!--/radio list--> 
									  <span> (This feature allows admin to speak in Pre-recorded conference by pressing DTMF key during call) </span>
                           <hr/>  </div>
						  
						   <div class="row">
						   <div class="col-md-6">
                           <div class="form-group input-medium">
                              <label class="control-label" >Conference phone Number</label>
                              <select  class="form-control" name="conference_phn" title="conference number from plivo">
							  <option value=" ">Select Phone Number</option>
							  
							  <?php
						 mysqli_select_db($con,"memblue_master");
						 $sql="SELECT * FROM plivo_number" ;
						 $result = mysqli_query($con,$sql);
						 while($row = mysqli_fetch_array($result))
							{
                           ?> 
                                 <option value="<?php echo $row['plivo_number_id']; ?>"><?php echo $row['phone_number'].'<br/>'; }?></option>
                              </select>
                           </div>
						   </div>
						   
							<div class="col-md-5">
                            <div class="form-group input-medium">
                              <label class="control-label" title="Set the reminder minutes before the conference starts for sending reminder sms" >Add Reminder (in mins)</label><br>
                              <select id="s4" class="form-control" name="reminder_min" multiple="multiple" title="Set the reminder minutes before the conference starts for sending reminder sms">
							  <option >01</option>
							  <option >02</option>
							  <option >03</option>
							  <option >04</option>
							  <option >05</option>
							  <option >06</option>
							  <option >10</option>
							  <option >12</option>
							  <option >15</option>
							  <option >20</option>
						   	  <option >30</option>
						      <option >45</option>
						      <option >60</option>
							  </select>
						    </div> 
						    </div>
						    </div>
           </div>
        
      
                        
                        <div class="form-actions right">
                           <button type="submit" class="btn blue">Submit</button>
                           <button type="button" class="btn default">Cancel</button>                              
                        </div>
                     </form>
                  </div>
               </div>
</div>
</div>
</div>
</div>
</body>
</html>
			   <?php
			   
include('footer.php');

?>
<script>
$('#name').val(sessionStorage.conference_name);
$('#start_date').val(sessionStorage.date);
</script>
