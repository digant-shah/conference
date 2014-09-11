<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dashboard</title>
</head>

<body>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->   
<!--[if lt IE 9]>
<script src="/assets/plugins/respond.min.js"></script>
<script src="/assets/plugins/excanvas.min.js"></script> 
<![endif]-->   

<script src="/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src='/js/fullcalendar.min.js'></script>
<script src="/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>   
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap2-typeahead.min.js" type="text/javascript"></script>
<script src="/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<script src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
<script src="/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
<script src="/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

    

<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<!--<script src="/assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>-->
<script src="/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>  
<script src="/assets/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js" type="text/javascript" ></script>


<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
 <script type="text/javascript" src="/assets/plugins/fuelux/js/spinner.min.js"></script>
  <script type="text/javascript" src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="/assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
   <script type="text/javascript" src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script> 
   <script type="text/javascript" src="/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
 
<script src="/assets/scripts/app.js" type="text/javascript"></script>
<script src="/assets/scripts/index.js" type="text/javascript"></script>
<script src="/assets/scripts/tasks.js" type="text/javascript"></script> 
 <script type="text/javascript" src="/assets/plugins/select2/select2.min.js"></script>
   <script type="text/javascript" src="/assets/plugins/data-tables/jquery.dataTables.js"></script>
   <script type="text/javascript" src="/assets/plugins/data-tables/DT_bootstrap.js"></script>
   <!--new added-->
   <script type="text/javascript" src="/assets/plugins/ckeditor/ckeditor.js"></script>
   <script type="text/javascript" src="/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
   <script type="text/javascript" src="/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
   <script type="text/javascript" src="/assets/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
   
   
   
   
   <script type="text/javascript" src="/assets/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="/assets/plugins/jquery-multi-select/js/jquery.quicksearch.js"></script>
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="/assets/scripts/app.js"></script>

   <script src="/assets/scripts/form-components.js"></script>  
   <script src="/assets/scripts/table-editable.js"></script>
   <script type="text/javascript" src="/assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
   <script type="text/javascript" src="/assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script src="/assets/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript" ></script>
<script src="/assets/scripts/form-validation.js"></script>     
   

<script type="text/javascript" src="/assets/js/ui.dropdownchecklist.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->  
<script>
  jQuery(document).ready(function() {
var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();

  var calendar = $('#calendar').fullCalendar({
   editable: false,
   header: {
    center: 'prev,next today',
    left: 'title',
    right: 'month,agendaWeek,agendaDay'
   },
   
   events: "/fullcalendar/events.php",
   
   // Convert the allDay from string to boolean
   eventRender: function(event, element, view) {
    if (event.allDay === 'true') {
     event.allDay = true;
    } else {
     event.allDay = false;
    }
   },
   selectable: true,
   selectHelper: false,
   select: function(start, end, allDay) {
   location.href='/conference/index.php/add_conference';
   
   //var title = prompt('Event Title:');
	 
   //var url = prompt('Type Event url, if exits:');
   
   
   var start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
   var end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
   test(start); 
   $.ajax({
   url: '/conference/index.php/add_conference',
   data: '&start_date='+ start +'&end='+ end,
   type: "POST",
   success: function(json) {
   alert('Added Successfully');
   }
   });
   calendar.fullCalendar('renderEvent',
   {
   title: title,
   start: start,
   end: end,
   allDay: allDay,
 
   },
   true // make the event "stick"
   );
   
   
   calendar.fullCalendar('unselect');
   },
   
   editable: false,
   eventDrop: function(event, delta) {
   var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
   var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
   $.ajax({
   url: '/fullcalendar/update_events.php',
   data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
   type: "POST",
   success: function(json) {
    alert("Updated Successfully");
   }
   });
   },
   eventResize: function(event) {
   var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
   var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
   $.ajax({
    url: '/fullcalendar/update_events.php',
    data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
    type: "POST",
    success: function(json) {
     alert("Updated Successfully");
    }
   });

}
   
  });
  
 
 $("#s2").dropdownchecklist({ maxDropHeight: 120 });
$('#weekdays').hide();
	$('#monthly').hide();
	 $('#type').on('click',function(){
	 var value=$(this).val();
	 console.log(value);
	 if(value == '2')
	 {
	   $('#weekdays').show();
	    $('#monthly').hide();
	   
	  console.log(value);
	 }
	  else if(value === '3')
	 {
	  $('#weekdays').hide();
	   $('#monthly').show();
	   
	  console.log(value);
	 }
	 else
	 {
	 $('#weekdays').hide();
	 $('#monthly').hide();
	 }
	 });
	 $('#mute').hide();
	$('#mp3').hide();
	$('#mute1').hide();
	 $('#select_conference').on('click',function(){
	 var value=$(this).val();
	 console.log(value);
	 if(value == 'Pre-recorded')
	 {
	   $('#mp3').show();
	    $('#mute').hide();
		$('#mute1').show();
	   
	  console.log(value);
	 }
	  else if(value === 'Live Conference')
	 {
	  $('#mp3').hide();
	   $('#mute').hide();
	   $('#mute1').hide();
	   
	  console.log(value);
	 }
	 else
	 {
	 $('#mp3').hide();
	 $('#mute').hide();
	 $('#mute1').hide();
	 }
});
	 
	    
     App.init();
	 FormValidation.init(); // initlayout and core plugins
     TableEditable.init();

	 Index.init();
     // init index page's custom scripts
     //Index.initCalendar(); // init index page's custom scripts
     Index.initCharts(); // init index page's custom scripts
     Index.initChat();
     Index.initMiniCharts();
     Index.initDashboardDaterange();
     Index.initIntro();
     Tasks.initDashboardWidget();
	 FormComponents.init();



function test(start){
//alert(sessionStorage.conference_name);
	sessionStorage.date=start;
	//alert(sessionStorage.date);
}

  });
</script>
<!-- END JAVASCRIPTS -->

</body>
</html>