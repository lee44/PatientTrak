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
      var starting, ending, isallDay, eventObject;

      function fmt(date) {return date.format("YYYY-MM-DD HH:mm");}
            
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
	      },
        open: function(){
            jQuery('.ui-widget-overlay').bind('click',function(){
                jQuery('#dialog-form').dialog('close');
            })
        }
      });

      function addEvent()
      {
        var title, description;
        title = $("#title").val(); 
        description = $("#description").val() || '';
        
        if (title) 
        { 
          $.ajax(
          {
            url: 'add_events.php',
            data: 'title=' + title + '&start=' + starting + '&end=' + ending + '&description=' + description,
            type: "POST",
            success: function (json){$('#calendar').fullCalendar( 'refetchEvents' )}
          });
          j1121( "#dialog-form" ).dialog("close");     
        }        
      }   

      var dialog2 = j1121( "#dialog-form2" ).dialog(
      {
        autoOpen: false,
        height: 400,
        width: 350,
        modal: true,
        buttons: 
        { 
          "Update": updateEvent,
          "Delete": deleteEvent,
          Cancel: function(){dialog2.dialog( "close" );}
        },
        open: function(){
            jQuery('.ui-widget-overlay').bind('click',function(){
                jQuery('#dialog-form2').dialog('close');
            })
        }
      });

      function updateEvent()
      {
        var title, description, start, end;
        start  = fmt(eventObject.start);
        end  = fmt(eventObject.end);
        title = $("#title2").val(); 
        description = $("#edit_delete_description").val() || '';
        
        if (title) 
        {
          $.ajax(
            {
              url: 'update_events.php',
              data: '&title=' + title + '&start=' + start + '&end=' + end + '&id=' + eventObject.id + '&description=' + description,
              type: "POST",
              success: function (json){$('#calendar').fullCalendar( 'refetchEvents' )}
            });
          j1121( "#dialog-form2" ).dialog("close");
        }
      }
      function deleteEvent()
      {
        $.ajax(
        {
          type: "POST",
          url: "delete_event.php",
          data: "&id=" + eventObject.id,
          success: function (json) { $('#calendar').fullCalendar('removeEvents', eventObject.id); }
        });
        j1121( "#dialog-form2" ).dialog("close");
      }

      var calendar = $('#calendar').fullCalendar(
      {
      	contentHeight: $(window).height()*0.83,
      	titleRangeSeparator: " - ",
        minTime: "07:00:00", maxTime: "24:00:00",
        allDaySlot:false,
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
          var view = $('#calendar').fullCalendar('getView');
          if(view.name == 'month')
          {
            $('#calendar').fullCalendar('changeView', 'agendaDay');
            $('#calendar').fullCalendar('gotoDate', start)
          }
          else
          {
      	    starting = fmt(start); ending = fmt(end); isallDay = allDay;
            document.getElementById("appointmentForm").reset();
            $("#description").val('');
      	    dialog.dialog( "open" );    
            //calendar.fullCalendar('unselect'); // exits out of the select state
          }
        },

        eventRender: function (event, element, view) 
        {
          if(view.name == 'month')
          {
            $(element).find('.fc-time').html(moment(event.start).format('h:mm') + '-' + moment(event.end).format('h:mma') + ':');
          }
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
          $("#title2").val(event.title);
          $("#edit_delete_description").val(event.description);
          eventObject = event;
          dialog2.dialog( "open" );
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

			<div class='page content'>
				<div id="calendar"></div>
			</div>
<!-- Appointment Modal Dialog -->
      <div id="dialog-form" title="Create Appointment">
        <form id = "appointmentForm">
            <h3>Title</h3>
            <input type="text" name="title" id="title" class="text ui-widget-content ui-corner-all">
            <h3>Description</h3>
            <textarea id = "description" form="usrform" class="text ui-widget-content ui-corner-all" rows="6" cols="37" style="resize:none"></textarea>
         </form>
      </div>
<!-- Edit/Delete Existing Modal Dialog -->
      <div id="dialog-form2" title="Edit/Delete Appointment">
        <form id = "edit_delete_appointmentForm">
            <h3>Title</h3>
            <input type="text" name="edit_delete_title" id="title2" class="text ui-widget-content ui-corner-all">
            <h3>Description</h3>
            <textarea id = "edit_delete_description" form="usrform" class="text ui-widget-content ui-corner-all" rows="6" cols="37" style="resize:none"></textarea>
         </form>
      </div>
		</div> 
		
    </body>    
</html> 