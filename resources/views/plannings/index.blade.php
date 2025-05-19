@extends('layouts.app')


@section('content')
    <div class="container">

        <div id='calendar'></div>

    </div>
@endsection

@section('scripts')

    <script>

        let interventions = @json($interventions);
        let events = [];
        let calendar = $('#calendar');

        function changeView(view) {
            calendar.changeView(view);
        }


        function generateOneEvent(intervention) {
            let event = {
                title: intervention.numero + ' - ' + intervention.client.nom + ' (' + intervention.intervenants.map(intervenant => intervenant.nom).join(', ') + ')',
                start: intervention.date,
                end: intervention.date,
            }
            return event;
        }
        $(document).ready(function() {
            console.log('fullcalendar from index');
            console.log(interventions);
            calendar.fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,year'
                },
                editable: true,
                firstDay: 1, // 1 means Monday (0 would be Sunday)
                // Add weekend highlighting
                businessHours: {
                    dow: [1, 2, 3, 4, 5] // Monday - Friday
                },
                // Customize the day cell background
                dayRender: function(date, cell) {
                    // 0 is Sunday, 6 is Saturday
                    if (date.day() === 0 || date.day() === 6) {
                        cell.css('background-color', '#ffeded'); // Light red background for weekends
                    }
                },
                events: interventions.map(function(intervention) {
                    if (intervention.repeat_type === 'weekly') {
                        let events = [];
                        let startDate = moment(intervention.date);
                        let endDate = moment(intervention.date).add(10, 'year');
                        
                        while (startDate.isBefore(endDate)) {
                            events.push({
                                title: intervention.client.nom + ' (' + intervention.intervenants.map(intervenant => intervenant.name).join(', ') + ')',
                                start: startDate.format('YYYY-MM-DD'),
                                end: startDate.format('YYYY-MM-DD'),
                                color: startDate.day() === 0 || startDate.day() === 6 ? '#ff4444' : undefined
                            });
                            startDate.add(1, 'week');
                        }
                        return events;
                    } else if (intervention.repeat_type === 'monthly') {
                        let events = [];
                        let startDate = moment(intervention.date);
                        let endDate = moment(intervention.date).add(10, 'year');
                        
                        while (startDate.isBefore(endDate)) {
                            // Skip if it falls on a weekend
                            if (startDate.day() !== 0 && startDate.day() !== 6) {
                                events.push({
                                    title: intervention.client.nom + ' (' + intervention.intervenants.map(intervenant => intervenant.name).join(', ') + ')',
                                    start: startDate.format('YYYY-MM-DD'),
                                    end: startDate.format('YYYY-MM-DD')
                                });
                            }
                            // Move to the same day of next month
                            startDate.add(1, 'month');
                            
                            // Handle month overflow (e.g., 31st of months with 30 days)
                            while (startDate.date() !== moment(intervention.date).date() && startDate.isBefore(endDate)) {
                                startDate.add(1, 'day');
                            }
                        }
                        return events;
                    } else if (intervention.repeat_type === 'daily') {
                        let events = [];
                        let startDate = moment(intervention.date);
                        let endDate = moment(intervention.datefin);
                        
                        while (startDate.isBefore(endDate)) {
                            // Skip if it falls on a weekend
                            if (startDate.day() !== 0 && startDate.day() !== 6) {
                                events.push({
                                    title: intervention.client.nom + ' (' + intervention.intervenants.map(intervenant => intervenant.name).join(', ') + ')',
                                    start: startDate.format('YYYY-MM-DD'),
                                    end: endDate.format('YYYY-MM-DD')
                                });
                            }
                            // Move to the same day of next month
                            startDate.add(1, 'month');
                            
                            // Handle month overflow (e.g., 31st of months with 30 days)
                            while (startDate.date() !== moment(intervention.date).date() && startDate.isBefore(endDate)) {
                                startDate.add(1, 'day');
                            }
                        }
                        return events;
                    } else {
                        let event = {
                            title: intervention.client.nom + ' (' + intervention.intervenants.map(intervenant => intervenant.name).join(', ') + ')',
                        }
                      
                            event.start = intervention.date;
                            event.end = intervention.date;
                            // Check if the event starts on a weekend
                            let eventDate = moment(intervention.date);
                            if (eventDate.day() === 0 || eventDate.day() === 6) {
                                event.color = '#ff4444';
                            }
                    
                        return event;
                    }
                }).flat()
            });
            console.log(events);
        });
    </script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
@endsection
