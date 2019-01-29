<html>    
<head>    
    <title>Home</title>
  	<link href='./lib/fullcalendar.css' rel='stylesheet'/> <!-- Dont Touch -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src='./lib/jquery.min.js'></script> <!-- Dont Touch -->
  	<script src='./lib/moment.min.js'></script> <!-- Dont Touch -->
    <script src='./lib/fullcalendar.min.js'></script> <!-- Dont Touch --> 

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script>
    var j1124 = jQuery.noConflict();
    </script>
    
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    var j1121 = jQuery.noConflict();
    </script>

    <script>
    $(document).ready(function () 
    {
      var starting, ending, isallDay;

      function fmt(date) {return date.format("YYYY-MM-DD HH:mm");}
      function passTime(start,end,allDay){starting = fmt(start); ending = fmt(end); isallDay = allDay;}
      function addEvent()
      {
        var title, description;
        title = $("#title").val(); 
        description = $("#description").val();
        
        if (title) 
        { 
          $.ajax(
          {
            url: 'add_events.php',
            data: 'title=' + title + '&start=' + starting + '&end=' + ending + '&description=' + description,
            type: "POST",
            success: function (json){}
          });
          // $('#calendar').fullCalendar('renderEvent',
          // {
          //   title: title,
          //   start: starting,
          //   end: ending,
          //   allDay: isallDay
          // },
          // true // make the event "stick"
          // );
          $('#calendar').fullCalendar( 'refetchEvents' )     
        }
        document.getElementById("appointmentForm").reset();
        j1121( "#dialog-form" ).dialog("close");
      }   

      var dialog = j1121( "#dialog-form" ).dialog(
      {
	      autoOpen: false,
	      height: 400,
	      width: 350,
	      modal: true,
	      buttons: 
	      {
	        "Add Event": addEvent,
	        Cancel: function(){dialog.dialog( "close" );}
	      }
      });

      var calendar = $('#calendar').fullCalendar(
      {
      	contentHeight: $(window).height()*0.83,
      	titleRangeSeparator: " - ",
        minTime: "07:00:00", maxTime: "21:00:00",
        editable: true,
        header: 
        {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
		    selectable: true,
        selectHelper: true,

        events: "events.php",
        
        select: function (start, end, allDay) 
        {
    	    passTime(start,end,allDay);
    	    dialog.dialog( "open" );    
          calendar.fullCalendar('unselect'); // exits out of the select state
        },

        eventRender: function (event, element, view) 
        {
          if(view.name == 'month')
          {
            $(element).find('.fc-time').html(moment(event.start).format('h:mm') + '-' + moment(event.end).format('h:mma') + ':');

          }

          if (event.allDay === 'true') 
            event.allDay = true;
          else 
            event.allDay = false;
        },

        eventDrop: function (event, delta) 
        {
          var start = fmt(event.start);
          var end = fmt(event.end);
          $.ajax(
          {
            url: 'update_events.php',
            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
            type: "POST",
            success: function (json){}
          });
        },

        eventClick: function (event) 
        {
          console.log(event.id);
          var decision = confirm("Do you want to remove event?");
          if (decision) 
          {
            $.ajax({
              type: "POST",
              url: "delete_event.php",
              data: "&id=" + event.id,
              success: function (json) 
              {
                $('#calendar').fullCalendar('removeEvents', event.id);
              }
            });
          }
        },

        eventResize: function (event) 
        {
          var start = fmt(event.start);
          var end = fmt(event.end);
          $.ajax(
          {
            url: 'update_events.php',
            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
            type: "POST",
            success: function (json){}
          });
        }
      });
    });
  </script>  
</head>    

    <body>    
        <link href = "main_page.css" type = "text/css" rel = "stylesheet" />
		
		<div class = "page">
			<div class = "page menu">
				<div class = "navTop">
					<a class = "active" href="#home">Home</a>
					<a href = "/Add_Patient/index.php">Add Patient</a>
					<a href = "/Find_Patient/index.php">Find Patient</a>
					<a href = "/Table_Query/index.php">Show All Data</a>
				</div>
			</div>

			<div id="dialog-form" title="Create Appointment">
			  <form id = "appointmentForm">
			      <h3>Title</h3>
			      <input type="text" name="title" id="title" class="text ui-widget-content ui-corner-all">
			      <h3>Description</h3>
			      <input type="text" name="description" id="description" class="text ui-widget-content ui-corner-all">
			   </form>
			</div>
		
			<div class='page content'>
				<div id="calendar"></div>
			</div>
		</div>
		
    </body>    
</html> 