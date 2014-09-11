<?php

include('header.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Conference</title>


</head>


<body>
   <div class="clearfix"></div>
   <!-- BEGIN CONTAINER -->
   <div class="page-container">
  
   
   <?php

include('headerjscss.php');
include('sidemenu.php');
include('jsinclude.php');
?>

     
      <!-- BEGIN PAGE -->
      <div class="page-content">
	 <div class="container">
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
            <div class="col-md-6">
               <!-- BEGIN PAGE TITLE & BREADCRUMB-->
               <h3 class="page-title">
                  Add Confernce
               </h3>
               <ul class="page-breadcrumb breadcrumb">
                  <li class="btn-group">
                     <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                     <span>Actions</span> <i class="icon-angle-down"></i>
                     </button>
                     <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                     </ul>
                  </li>
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
         <!-- END PAGE HEADER-->
         <!-- BEGIN PAGE CONTENT-->
        <div class="portlet box blue col-md-6 ">

                           <div class="portlet-title">

                              <div class="caption"><i class="icon-reorder"></i>Add Conference</div>

                              <div class="tools">

                                 <a href="javascript:;" class="collapse"></a>

                                 <a href="#portlet-config" data-toggle="modal" class="config"></a>

                                 <a href="javascript:;" class="reload"></a>

                                 <a href="javascript:;" class="remove"></a>

                              </div>

                           </div>

                           <div class="portlet-body form">

                              <!-- BEGIN FORM-->

                              <form  id="form_sample_1" action="/conference/index.php/add_conference/process" method="POST"  class="horizontal-form">

                                 <div class="form-body">
								 <div class="alert alert-danger display-hide">
                              <button class="close" data-dismiss="alert"></button>
                              You have some form errors. Please check below.
                           </div>
                           <div class="alert alert-success display-hide">
                              <button class="close" data-dismiss="alert"></button>
                              Your form validation is successful!
                           </div>


                                    <h3 class="form-section">Conference Info</h3>

                                    <div class="row">

                                       <div class="col-md-6">

                                          <div class="form-group">

                                             <label class="control-label">Name<span class="required">*</span></label>

                                             <input type="text" id="name"  name="name" class="form-control" placeholder="Conference Name">

                                             <span class="help-block"></span>

                                          </div>

                                       </div>

                                       <!--/span-->

                                       <div class="col-md-6">

                                          <div class="form-group">

                                             <label class="control-label">Date</label>

                                             <div class="input-group input-medium date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">

                                    <input type="text"  name="date"class="form-control" readonly>

                                    <span class="input-group-btn">

                                    <button class="btn default" type="button"><i class="icon-calendar"></i></button>

                                    </span>

                                 </div>


                                          </div>

                                       </div>

                                       <!--/span-->

                                    </div>

                                    <!--/row-->
									<div class="row">

                                       <div class="col-md-12 ">

                                          <div class="form-group">

                                             <label class="control-label" >Description </label>

                                             <textarea class="form-control" name="description"></textarea>

                                          </div>

                                       </div>

                                    </div>
									
									<div class="row">

                                       <div class="col-md-6">

                                          <div class="form-group">

                                             <label class="control-label radio-inline">Start Date</label>
											 <label class="control-label radio-inline"></label>
											 <label class="control-label radio-inline">End Date</label>


        
        <div class="input-group input-medium date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">

                                    <input type="text"  name="start_date" class="form-control" name="from">

                                    <span class="input-group-addon">to</span>

                                    <input type="text" name="end_date" class="form-control" name="to">

                                 </div>

                                 <!-- /input-group -->

                                 <span class="help-block">Start Date &nbsp; & &nbsp; End Date</span>
								 

                                            

                                          </div>

                                       </div>

                                       <!--/span-->

                                       <div class="col-md-6">

                                          <div class="form-group">

                              <label class="control-label" >Time</label>
							<div class="input-group bootstrap-timepicker input-medium">                                       

                                    <input type="text"  name="time" class="form-control timepicker-default">

                                    <span class="input-group-btn">

                                    <button class="btn default" type="button"><i class="icon-time"></i></button>

                                    </span>

                                 </div>

                           </div>
                                       </div><!--/span-->                           
                                    </div> <!--/row-->   




                                    <div class="row">

                                       <div class="col-md-6">

                                          <div class="form-group">

                                              <label class="control-label">Conference Type</label>
											   <select  class="select2_category form-control" id="type" name="con_type">

                                 <option>Daily</option>
								 <option>Weekly</option>
                                 <option>Monthly</option>
                                
                              </select>
                                            

                                          </div>

                                       </div>

                                       <!--/span-->

                                       <div class="col-md-6">

                                          <div class="form-group">

                              <label class="control-label">Duration of Conference</label>
							 <div class="input-group bootstrap-timepicker input-medium">                                       

                                    <input type="text"  name="duration" class="form-control timepicker-24">

                                    <span class="input-group-btn">

                                    <button class="btn default" type="button"><i class="icon-time"></i></button>

                                    </span>

                                 </div>

                           </div>
							 
							

                       


                                       </div><!--/span-->

                                       

                                    </div> <!--/row-->   


 
                                        
									
									 <div class="row">

<div>                    
						<div class="form-group col-md-10" id="weekdays">

                                             
                              <label  class="control-label">Weekdays</label>
                              <div class="checkbox-list">
                                 <label class="checkbox-inline control-label">
                                 <input type="checkbox" id="inlineCheckbox1" value="Monday">Monday
                                 </label> &nbsp;&nbsp;
                                 <label class="checkbox-inline control-label">
                                 <input type="checkbox" id="inlineCheckbox2" value="tuesday">Tuesday
                                 </label>
                                 <label class="checkbox-inline control-label">
                                 <input type="checkbox" id="inlineCheckbox3" value="wednesday">Wednesday
                                 </label>
							</div>
							<div class="checkbox-list">
								 <label class="checkbox-inline control-label">
                                 <input type="checkbox" id="inlineCheckbox3" value="thrusday">Thursday
                                 </label>
								 <label class="checkbox-inline control-label">
                                 <input type="checkbox" id="inlineCheckbox3" value="friday">Friday
                                 </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								 <label class="checkbox-inline control-label">
                                 <input type="checkbox" id="inlineCheckbox3" value="saturday">Saturday
                                 </label>
								 <label class="checkbox-inline control-label">
                                 <input type="checkbox" id="inlineCheckbox3" value="sunday">Sunday
                                 </label> 
                              </div>
                           </div>
   						 <!--/form grp-->
						 
						   <div class="col-md-6">

                                          <div class="form-group" id="monthly">

                                             <label class="control-label">Date</label>

                                             <div class="input-group input-medium date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">

                                    <input type="text"  name="month_date" class="form-control" readonly>

                                    <span class="input-group-btn">

                                    <button class="btn default" type="button"><i class="icon-calendar"></i></button>

                                    </span>

                                 </div>


                                          </div>

                                       </div>
						 
                    </div> <!--/span-->
		  </div>   <!--/row-->  

                                        

                                    <div class="row">

                                       <div class="col-md-6">

                                          <div class="form-group">

                                             <label class="control-label">Group</label>

                                             <select class="select2_category form-control" name="groups" data-placeholder="Choose a Category" tabindex="1">

                                                <option value="Category 1">Category 1</option>

                                                <option value="Category 2">Category 2</option>

                                                <option value="Category 3">Category 5</option>

                                                <option value="Category 4">Category 4</option>

                                             </select>

                                          </div>

                                       </div>

                                       <!--/span-->

                                      <div class="col-md-6">

                                          <div class="form-group">

                                             <label class="control-label">Mute</label>

                                             <div class="radio-list">

                                                <label class="radio-inline">

                                                <input type="radio" name="mute" id="optionsRadios1" value="option1" checked> On

                                                </label>

                                                <label class="radio-inline">

                                                <input type="radio" name="mute" id="optionsRadios2" value="option2" > Off

                                                </label>

                                             </div>

                                          </div>

                                       </div>


                                       <!--/span-->

                                    </div>

                                    <!--/row--> 
									<div class="row">

                                       <div class="col-md-6">

                                          <div class="form-group">

                                             <label class="control-label">Members</label>
                              <select multiple class="form-control">
                                 <option>Option 1</option>
                                 <option>Option 2</option>
                                 <option>Option 3</option>
                                 <option>Option 4</option>
                                 <option>Option 5</option>
                              </select>

                                          </div>

                                       </div>

                                       <!--/span-->

                                 <div class="col-md-6">

                                     <div class="form-group">

                                               <label class="control-label">Talking Mode</label>

                                        <div class="radio-list">

                                                      <label class="radio-inline">

                                                          <input type="radio" name="talking_mode" id="optionsRadios10" value="optionon" checked> On

                                                       </label>

                                                    <label class="radio-inline">

                                                         <input type="radio" name="talking_mode" id="optionsRadios11" value="optionoff" > Off

                                                    </label>

                                             

                                       
										  <label class="radio-inline control-label" >DTMF mode

                                                  <select  class="form-control input-xsmall"  name="dtmf_mode" >
								
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
   							</div>  <!--/form grp--> 
  					 </div>  <!--/span--> 
 
					</div>  <!--/row--> 							

                                           

                                   
									<div class="row">

                                       <div class="col-md-6">

                                          <div class="form-group">

                                             <label class="control-label">Moderator Phone Number</label>
<input type="text" id="mod_phn" class="form-control"  name="moderator_phn" placeholder="Enter Moderator's Phn Number">
                                             
                                          </div>

                                       </div>

                                       <!--/span-->

                                       <div class="col-md-6">

                                          <div class="form-group">

                                             <label class="control-label">Add mp3 file</label>
 <!-- BEGIN PAGE CONTENT-->
       <div class="row form-action">
           <div class="col-md-12">
              
               <form id="fileupload" action="" method="POST" enctype="multipart/form-data">
                  <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
             <div class="row fileupload-buttonbar">
                     <div class="col-md-12">
                        <!-- The fileinput-button span is used to style the file input field as button -->
                       
					    <span class="btn green fileinput-button">
                        <i class="icon-plus"></i>
                        <span>Add files...</span>
                        <input type="file" name="files[]" multiple>
                        </span>
                               
                        <button type="button" class="btn red delete">
                        <i class="icon-trash"></i>
                        <span>Delete</span>
                        </button>
                     
                        <!-- The loading indicator is shown during file processing -->
                        <span class="fileupload-loading"></span>
                     </div>
                     <!-- The global progress information -->
                     <div class="col-lg-5 fileupload-progress fade">
                        <!-- The global progress bar -->
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                           <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                        </div>
                        <!-- The extended global progress information -->
                        <div class="progress-extended">&nbsp;</div>
                     </div>
                  </div>
                  <!-- The table listing the files available for upload/download -->
                  <table role="presentation" class="table table-striped clearfix">
                     <tbody class="files"></tbody>
                  </table>
               </form>
               
                   
                  </div>
               </div>
            </div>
          </div>
         <!-- END PAGE CONTENT-->
      </div>
      <!-- END PAGE --> 
   
                                             

                                            

                                       

                                    <!--/row--> 
									
									<div class="row">

                                       <div class="col-md-6">

                                          <div class="form-group">

                                             <label class="control-label">Conference Phone Number</label>

                                             <select  class="form-control"  name="dtmf_mode" >
								
                                 				<option>Select Conference Phone Number</option>
												<option>9638981722</option>
								 				<option>9166427242</option>
                                 				
                             						 </select>

                                          </div>

                                       </div>

                                       <!--/span-->

                                       <div class="col-md-6">

                                          <div class="form-group">

                                             <label class="control-label">Notification</label>

                                             <div class="radio-list">

                                                <label class="radio-inline">

                                                <input type="checkbox" name="notification" id="optionsCheck1" value="SMS" checked> SMS

                                                </label>

                                                <label class="radio-inline">

                                                <input type="checkbox" name="notification" id="optionsCheck2" value="E-mail" > E-mail

                                                </label>

                                             </div>

                                          </div>

                                       </div>

                                       <!--/span-->

                                    </div>

                                    <!--/row--> 

                                   

                                    

                                    

                                 <div class="form-actions right">

                                    <button type="button" class="btn default">Cancel</button>

                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Save</button>

                                 </div>

                              </form>

                              <!-- END FORM--> 

                           </div>

                        </div>

                     </div>

		
		
         <!-- END PAGE CONTENT -->
      </div>
	  </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
   
  <?php
include('footer.php');

?>
<script type="text/javascript" src="/assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
   <script type="text/javascript" src="/assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>

<script src="/assets/scripts/form-validation.js"></script> 
<script>
      jQuery(document).ready(function() {   
         // initiate layout and plugins
         App.init();
         FormValidation.init();
      });
   </script>



