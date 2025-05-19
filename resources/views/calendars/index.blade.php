@extends('layouts.app')

@section('content')
    <div id='calendar'></div>
    <!-- Add Modal -->
    <button class="btn btn-primary" data-toggle="modal" data-target="#new_event" id="affiche-modal"
        style="display:none">test</button>
    <div class="modal fade" id="new_event" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Ajouter un réunion</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Choisir l'opportunité<span
                                class="obligatoire">*</span> </label>
                        <div class="col-md-8">
                            <select class="js-example-basic-single js-states form-control calend"style="width: 100%"
                                id="contact-calendar">
                                @foreach ($opportunites as $opportunite)
                                    <option value="{{ $opportunite->id }}" style="float:left">
                                        {{ $opportunite->titre }} ({{ $opportunite->contact->nom }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Type <span
                                class="obligatoire">*</span></label>
                        <div class="col-md-8">
                            <select class="js-example-basic-single js-states form-control calend"style="width: 100%"
                                id="type">
                                <option value="en_ligne" style="float:left">
                                    En ligne
                                </option>
                                <option value="presence" style="float:left">
                                    Présentiel
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Date de l'évenement <span
                                class="obligatoire">*</span></label>
                        <div class="col-md-8">
                            <input type="datetime-local" class="form-control" id="date-event">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Fin de l'évenement <span
                                class="obligatoire">*</span></label>
                        <div class="col-md-8">
                            <input type="datetime-local" class="form-control" id="date_fin">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" id="add_event" onclick="add_event()">Ajouter</button>
                </div>

            </div>
        </div>
    </div>



    <!-- Update Modal -->
    <button class="btn btn-primary" data-toggle="modal" data-target="#update_event" id="affiche-modal-update"
        style="display:none">test</button>
    <div class="modal fade" id="update_event" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Modifier le réunion</h4>
                    <div style="text-align: center;">
                        <button class="btn btn-danger" id="delete_reuinion">Supprimer</button>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Choisir l'opportunité<span
                                class="obligatoire">*</span> </label>
                        <div class="col-md-8">
                            <select class="js-example-basic-single js-states form-control calend"style="width: 100%"
                                id="contact-calendar-update">
                                @foreach ($opportunites as $opportunite)
                                    <option value="{{ $opportunite->id }}" style="float:left">
                                        {{ $opportunite->titre }} ({{ $opportunite->contact->nom }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Type <span
                                class="obligatoire">*</span></label>
                        <div class="col-md-8">
                            <select class="js-example-basic-single js-states form-control calend"style="width: 100%"
                                id="type-update">
                                <option value="en_ligne" style="float:left">
                                    En ligne
                                </option>
                                <option value="presence" style="float:left">
                                    Présentiel
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Date de l'évenement <span
                                class="obligatoire">*</span></label>
                        <div class="col-md-8">
                            <input type="datetime-local" class="form-control" id="date-event-update">
                            <input type="hidden" class="form-control" id="event-update-id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Fin de l'évenement <span
                                class="obligatoire">*</span></label>
                        <div class="col-md-8">
                            <input type="datetime-local" class="form-control" id="date_fin-update">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" id="add_event-update" onclick="update_event()">Modifier</button>
                </div>

            </div>
        </div>
    </div>


@section('scripts')
    @parent
    <script>
        function error_message(messages, input) {
            return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
                .insertAfter(input);
        }
        $(document).ready(function() {

            $('#delete_reuinion').click(function() {
                var id_event = $('#event-update-id').val()
                $('.close').click()
                delete_event(id_event)
            })


            var reunions = {{ Js::from($reunions) }}
            console.log(reunions)


            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'agendaWeek',
                slotDuration: '00:30:00',
                minTime: '08:30:00',
                maxTime: '17:30:00',
                events: reunions,
                allDaySlot: false,
                viewRender: function(view, element) {
                    var header = element.find('.fc-toolbar');
                    var text = '<div class="my-text">My Custom Text</div>';
                    header.prepend(text);
                },

                eventClick: function(event) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: "{{ url('/getevent') }}/" + event.id,
                        method: 'get',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(result) {
                            console.log(result)

                            $('#date-event-update').val(moment(result.start).subtract(1,
                                'hours').format(
                                'YYYY-MM-DDTHH:mm'))
                            $('#date_fin-update').val(moment(result.end).subtract(1,
                                'hours').format(
                                'YYYY-MM-DDTHH:mm'))
                            $('#event-update-id').val(result.id)

                            $("#type-update option[value='" + result.type + "']").prop(
                                'selected', true);

                            $("#contact-calendar-update option[value='" + result
                                .oportunity_id +
                                "']").prop(
                                'selected', true);

                            $('#affiche-modal-update').click()
                        },
                        error: function(result) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'Vérifier la base de donnés',
                                showConfirmButton: true,
                            })
                        },
                    });
                },
                eventDrop: function(event, delta, revertFunc) {
                    var start = moment(event.start).format('YYYY-MM-DDTHH:mm')
                    var end = moment(event.end).format('YYYY-MM-DDTHH:mm')
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: "{{ url('/updateevent') }}",
                        method: 'post',
                        data: {
                            id: event.id,
                            start: start,
                            end: end,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(result) {
                            console.log(result)
                        },
                        error: function(result) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'Vérifier la base de donnés',
                                showConfirmButton: true,
                            })
                        },
                    });
                },
                dayClick: function(date, jsEvent, view) {
                    $('.erreur').empty()
                    var date_limite = moment(date).add(30, 'minutes').format('YYYY-MM-DDThh:mm');
                    var date_start = moment(date).format('YYYY-MM-DDThh:mm');
                    $('#date-event').val(date_start)
                    $('#date_fin').val(date_limite)
                    $('#titre').val('')
                    $('#affiche-modal').click()
                }
            });
            $('.fc-today-button').after(
                "<p class='filtre-calendar element-1' >Réunion en ligne</p><p class='filtre-calendar element-2'  >Réunion présentiel</p>"
            )


            console.log(calendar)
        });

        function add_event() {
            $('.erreur').empty()
            $('#add_event').attr('disabled', 'disabled');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var opportunie_id = $('#contact-calendar').val()
            var type = $('#type').val()
            var date = $('#date-event').val()
            var date_fin = $('#date_fin').val()
            jQuery.ajax({
                url: "{{ url('/addevent') }}",
                method: 'post',
                data: {
                    opportunie_id: opportunie_id,
                    type: type,
                    date: date,
                    date_fin: date_fin,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {

                    if (result.error) {
                        $('#add_event').removeAttr('disabled');
                        if (result.error.opportunie_id) {
                            error_message(result.error.opportunie_id[0], "#contact-calendar")
                        }
                        if (result.error.date) {
                            error_message(result.error.date[0], "#date-event")
                        }
                        if (result.error.date_fin) {
                            error_message(result.error.date_fin[0], "#date_fin")
                        }
                        if (result.error.type) {
                            error_message(result.error.type[0], "#type")
                        }
                    } else if (result.error_compare) {
                        $('#add_event').removeAttr('disabled');
                        error_message("La date début doit etre supérieur ou égale a la date fin ", "#date_fin")
                    } else if (result == 200) {
                        $('.close').click()
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Oportunité ajouté avecc succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }

                },
                error: function(result) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'Vérifier la base de donnés',
                        showConfirmButton: true,
                    })
                },

            });
        }



        function update_event() {
            $('.erreur').empty()
            $('#add_event-update').attr('disabled', 'disabled');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var opportunie_id = $('#contact-calendar-update').val()
            var type = $('#type-update').val()
            var date = $('#date-event-update').val()
            var date_fin = $('#date_fin-update').val()
            var id_event = $('#event-update-id').val()
            jQuery.ajax({
                url: "{{ url('/update_events') }}",
                method: 'post',
                data: {
                    opportunie_id: opportunie_id,
                    id: id_event,
                    type: type,
                    date: date,
                    date_fin: date_fin,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {

                    if (result.error) {
                        $('#add_event-update').removeAttr('disabled');
                        if (result.error.opportunie_id) {
                            error_message(result.error.opportunie_id[0], "#contact-calendar-update")
                        }
                        if (result.error.date) {
                            error_message(result.error.date[0], "#date-event-update")
                        }
                        if (result.error.date_fin) {
                            error_message(result.error.date_fin[0], "#date_fin-update")
                        }
                        if (result.error.type) {
                            error_message(result.error.type[0], "#type-update")
                        }
                    } else if (result.error_compare) {
                        $('#add_event-update').removeAttr('disabled');
                        error_message("La date début doit etre supérieur ou égale a la date fin ",
                            "#date_fin-update")
                    } else if (result == 200) {
                        $('.close').click()
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Oportunité modifié avecc succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }

                },
                error: function(result) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'Vérifier la base de donnés',
                        showConfirmButton: true,
                    })
                },

            });
        }
    </script>
@endsection


@endsection
