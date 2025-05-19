{{-- ! rrule github -- https://github.com/jkbrzt/rrule --}}
{{-- ! fullcalendar github -- https://github.com/fullcalendar/fullcalendar --}}

@extends('layouts.newapp')


@section('styles')
    <!-- Added -->
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css' rel='stylesheet' /> --}}
    <style type="text/css">
        .fc-event-time {
            display: none;
        }



        .fc-day-sat .fc-daygrid-day-frame,
        .fc-day-sun .fc-daygrid-day-frame {
            background-color: #d3d3d3;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        #downloadPdfBtn,
        #modifyEventBtn {
            flex: 1;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #888;
            width: 40%;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .modal-body>p {
            font-size: 16px;
        }

        .action-text {
            margin-top: 25px;
            font-size: 16px;
            text-align: center;
        }

        .buttons {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            /* width: 100%; */
            margin-top: 20px;
            margin-bottom: 20px;
            gap: 20px;
        }

        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 20px;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 10px;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .buttons .btn {
            background-color: #282e3f !important;
        }

        .buttons .btn:hover {
            background-color: #070f25 !important;
        }
    </style>
@endsection


@section('content')
    <div class="container">
        <div id='calendar' style="width: 100%; height: 100vh;"></div>
    </div>
    {{-- <p id="calendar-not-found" style="display: none">FullCalendar not found</p> --}}


    <!-- Added -->
    <!-- Modal for Event Options -->
    <div class="modal" id="eventOptionsModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <p class="modal-text"></p>
                <p class="modal-text"></p>
                <p class="action-text"></p>
                <div class="buttons">
                    <button type="button" class="btn btn-primary" id="downloadPdfBtn">Fiche d'intervention PDF</button>
                    <button type="button" class="btn btn-primary" id="modifyEventBtn"></button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger close-modal" data-dismiss="modal">Fermer</button>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <!-- Add jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Keep existing FullCalendar scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.11/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.11/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.11/index.global.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/rrule@2.6.4/dist/es5/rrule.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/rrule@6.1.11/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/multimonth@6.1.11/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/list@6.1.11/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.11/index.global.min.js"></script>

    <script src='https://cdn.jsdelivr.net/npm/moment@2.29.4/min/moment.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/moment-timezone@0.5.40/builds/moment-timezone-with-data.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/moment-timezone@6.1.11/index.global.min.js'></script>

    <script>
        let interventions = @json($interventions);
        console.log('interventions', interventions);
        let events = [];
        document.addEventListener('DOMContentLoaded', function() {
            function truncateLongDescription(description, maxLength = 100) {
                if (description.length > maxLength) {
                    return description.substring(0, maxLength) + '...';
                }
                return description;
            }

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'fr',
                firstDay: 1,
                plugins: [],
                dayMaxEvents: true,
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title', // Show buttons for switching between views
                    right: 'multiMonthYear,dayGridMonth,timeGridWeek,listMonth'
                },
                eventClick: function(info) {
                    // Show the modal when an event is clicked
                    console.log('eventClick', info);
                    console.log('event', info.event);
                    document.getElementById('eventOptionsModal').style.display = "block";
                    document.getElementById('modifyEventBtn').innerText = 'Edit intervention';

                    // Handle download PDF button click
                    document.getElementById('downloadPdfBtn').addEventListener('click', function() {
                        window.location.href = `/printintervention/${info.event.id}`;
                    });
                    document.getElementById('modifyEventBtn').addEventListener('click', function() {
                        window.location.href = `/editintervention/${info.event.id}`;
                    });
                    document.getElementById('modalTitle').innerText = `${info.event.title}`;
                    document.querySelector('.action-text').innerText =
                        'Que voulez-vous faire pour cette intervention ?';
                    document.querySelectorAll('.modal-text')[0].innerText =
                        `Description : ${info.event.extendedProps.description ? truncateLongDescription(info.event.extendedProps.description) : 'Aucune description'}`;
                    recurrenceText = {
                        'daily': 'journalière',
                        'weekly': 'hebdomadaire',
                        'monthly': 'mensuelle',
                        'yearly': 'annuelle'
                    }
                    document.querySelectorAll('.modal-text')[1].innerText =
                        `Recurrence : ${recurrenceText[info.event.extendedProps.recurrence]}` ||
                        '`Recurrence : non récurrent';
                document.getElementsByClassName('close')[0].addEventListener('click', function() {
                    document.getElementById('eventOptionsModal').style.display = "none";
                });
                document.getElementsByClassName('close-modal')[0].addEventListener('click',
                    function() {
                        document.getElementById('eventOptionsModal').style.display = "none";
                    });
                document.getElementById('downloadPdfBtn').style.display = 'block';
            },
            dateClick: function(info) {
                document.getElementById('eventOptionsModal').style.display = "block";
                document.querySelectorAll('.modal-text').forEach(function(element) {
                    element.innerText = '';
                });
                document.getElementsByClassName('close')[0].addEventListener('click', function() {
                    document.getElementById('eventOptionsModal').style.display = "none";
                });
                document.getElementById('modalTitle').innerText = `${info.dateStr}`;
                document.querySelector('.action-text').innerText =
                    'Que voulez-vous faire pour cette journée ?';
                document.getElementById('modifyEventBtn').innerText = 'Add intervention';
                document.getElementById('modifyEventBtn').addEventListener('click', function() {
                    window.location.href = `/newintervention?date=${info.dateStr}`;
                    });
                    document.getElementById('downloadPdfBtn').style.display = 'none';
                    document.getElementsByClassName('close-modal')[0].addEventListener('click',
                        function() {
                            document.getElementById('eventOptionsModal').style.display = "none";
                        });
                },
                events: interventions.map(function(intervention) {
                    let event = {
                        title: intervention.client.nom,
                        id: intervention.id,
                        backgroundColor: intervention.color || '#3788d8', // Add default color
                        borderColor: intervention.color || '#3788d8',
                        recurrence: intervention.repeat_type,
                        extendedProps: {
                            description: intervention.description,
                            intervenant: intervention.intervenant.name,
                            recurrence: intervention.repeat_type
                        }
                    }

                    if (intervention.repeat_type) {
                        event.rrule = {
                            freq: intervention.repeat_type.toUpperCase(), // Fix: Convert to uppercase
                            dtstart: intervention.date,
                            until: intervention.datefin,
                            interval: 1
                        }

                        // Adjust frequency and interval based on repeat type
                        switch(intervention.repeat_type) {
                            case 'daily':
                                event.rrule.freq = 'DAILY';
                                break;
                            case 'weekly':
                                event.rrule.freq = 'WEEKLY';
                                break;
                            case 'biweekly':
                                event.rrule.freq = 'WEEKLY';
                                event.rrule.interval = 2;
                                break;
                            case 'monthly':
                                event.rrule.freq = 'MONTHLY';
                                break;
                            case 'bimonthly':
                                event.rrule.freq = 'MONTHLY';
                                event.rrule.interval = 2;
                                break;
                        }

                        // Only set dtstart if we have a valid date
                        if (intervention.date) {
                            event.rrule.dtstart = intervention.date;
                        }
                    } else {
                        // Non-recurring event
                        event.start = intervention.datefin || intervention.date;
                        event.end = intervention.datefin || intervention.date;
                    }

                    return event;
                }),
            });
            calendar.render();
        });
    </script>
@endsection
