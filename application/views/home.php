<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pilgrimage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.10/index.global.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
      body {
        font-family: 'Inter', sans-serif;
        background-image:url('https://images.unsplash.com/photo-1704972841788-86fac20fc87e?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
        background-repeat:no-repeat;
        background-size:cover;
      }

      /* .calendar {
        padding: 64px 128px;
      } */

      .calendar .fc-header-toolbar button {
        text-transform: capitalize;
      }

      .calendar .fc-license-message {
        display: none;
      }

      .event {
        padding: 2px;
        border-radius: 0;
      }

      .event-container {
        top:50%;
        left:25%;
            z-index: 5;
            position: absolute;
            display:grid;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            width: 80%;
            max-width: 600px;
        }

        .event-header {
          display:flex;
          justify-content:space-between;
            background-color: #3498db;
            color: #fff;
            padding: 1px;
            text-align: center;
        }

        .event-details {
            padding: 20px;
        }

        .event-details label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .event-details p {
            margin: 0;
            line-height: 1.5;
        }

        .hidden{
          display:none;
        }

        .event-header button {
          background-color: #fff;
          color: #3498db;
          border: 1px solid #3498db;
          padding: 8px 16px;
          cursor: pointer;
          border-radius: 4px;
          transition: background-color 0.3s, color 0.3s;
          }

            .event-header button:hover {
              background-color: #3498db;
              color: #fff;
            }

          .calendar-box{
            background-color:white;
            padding:15px;
            border-radius:10px;
            width:40%;
          }

  
          nav{
            padding:8px 0;
            text-align:center;
            margin-bottom:10px;
          }
            #nav-bar{
              background-color:white;
            }

            .close{
              font-size:2rem;
              color:white;
              border:none;
              background-color:transparent;
              border-radius:50px;
            }
        @media only screen and (max-width: 600px) {
            .event-container {
                width: 100%;
            }
            #fc-dom-1{
              font-size:1.20em;
            }
            .fc-button-group{
              font-size:.8rem
            }
            .calendar-box{
              height:100%;
              width:100%;
            }
        }
    </style>
  </head>
  <body>

  <nav id="nav-bar">
    <h3>Pilgrimage</h3>
  </nav>
    
    <section class="calendar-box container">
      <h3>Event Calender</h3>
      <hr>
      <div id="calendar" class="calendar"></div>
    </section>

  
    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                    <button type="button" id="close_btn" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-4">Event:</dt>
                        <dd class="col-sm-8" id="title"></dd>

                        <dt class="col-sm-4">Description:</dt>
                        <dd class="col-sm-8" id="description"></dd>

                        <dt class="col-sm-4">Start Date:</dt>
                        <dd class="col-sm-8" id="start_date"></dd>

                        <dt class="col-sm-4">End Date:</dt>
                        <dd class="col-sm-8" id="end_date"></dd>

                        <dt class="col-sm-4">Location:</dt>
                        <dd class="col-sm-8" id="location"></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>

      var event_data= JSON.parse('<?php echo json_encode($events)?>');
      $(() => {

        const calendarOptions = {
          headerToolbar: {
            left: "title",
            center: "",
            right: "today prev,next",
          },
          initialView: "dayGridMonth", // Set the initial view
          selectable: true,
          events: event_data, // Initialize with an empty array
          dateClick: (e) => {},
          select: (e) => {},
          eventClick: (e) => {
            
            // console.log(e.event.id, e.event.title, e.event.extendedProps);
            const start_date_f= new Date(e.event.start);
            const start=start_date_f.toLocaleDateString();
            const end_date_f= new Date(e.event.end);
            const end=end_date_f.toLocaleDateString();
            // console.log(e.event.start)
            $('#title').html(e.event.title);
            $('#description').html(e.event.extendedProps.description);
            $('#start_date').html(start);
            $('#end_date').html(end);
            $('#location').html(e.event.extendedProps.location);
            
            $('#eventModal').modal('show');
          },
        };

        $('#close_btn').on('click',()=>{
          $('#eventModal').modal('hide');
        })
        const calendar = new FullCalendar.Calendar($("#calendar")[0], calendarOptions);

        calendar.render();
      });
    </script>
  </body>
</html>
