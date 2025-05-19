@extends('layouts.newapp')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-7">
                        <div class="seipkon-breadcromb-left">
                            <h3>Ajouter une intervention</h3>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">
                            <button type="button" class="btn btn-info " onclick="saveintervention()">
                                <i class="fa fa-check"></i> Enregistrer l'intervention
                            </button>
                            <a href="{{ route('interventions.index') }}">
                                <button type="button" class="btn btn-warning btn_retour" style=" margin-left: 120px;">
                                    <i class="fa-solid fa-backward"></i>Retour
                                </button>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcromb Row -->


    <!-- Form Layout Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-box">
                <div class="form-example">
                    <div class="form-wrap top-label-exapmple form-layout-page">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Date: <span class="obligatoire">*</span></label>
                                        <input type="date" placeholder="Date" class="form-control" name="date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Intervenant: <span class="obligatoire">*</span></label>
                                        <select class="form-control" name="intervenant_id" id="intervenant_id">
                                            <option value="">Selectionner un intervenant</option>
                                            @foreach ($intervenants as $intervenant)
                                                <option value="{{ $intervenant->id }}">{{ $intervenant->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Choisir le client: <span
                                                class="obligatoire">*</span></label>
                                        <select class="form-control select2" id="client_id" name="client_id">
                                            <option value="">Selectionner un client</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->nom }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Choisir le client: <span
                                                class="obligatoire">*</span></label>
                                        <select class="form-control select2" id="client_id" name="client_id">
                                            <option value="">Selectionner un client</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Choisir l'entreprise: <span
                                                class="obligatoire">*</span></label>
                                        <select class='form-control' id="entreprise_id" name="entreprise_id">
                                            @foreach ($entreprises as $entreprise)
                                                <option value='{{ $entreprise->id }}'>
                                                    {{ $entreprise->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="repeat_type" class="control-label">Recurrence Type:<span
                                                class="obligatoire">*</span></label>
                                        <br>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" id="repeat_type" name="repeat_type" value="" checked> Aucune
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" id="repeat_type" name="repeat_type" value="daily"> Journaliere
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" id="repeat_type" name="repeat_type" value="weekly"> Chaque semaine
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" id="repeat_type" name="repeat_type" value="monthly"> Chaque mois
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" id="repeat_type" name="repeat_type" value="yearly"> Chaque année
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row date-inputs" style="display: none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Date de début: </label>
                                        <input type="date" placeholder="Date de début" class="form-control"
                                            name="datedebut" id="datedebut">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Date de fin: </label>
                                        <input type="date" placeholder="Date de fin" class="form-control" name="datefin"
                                            id="datefin">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Description:</label>
                                        <textarea placeholder="Description" class="form-control" name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Form Layout Row -->
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[name="repeat_type"]').on('change', function() {

                if ($(this).val() === '') {
                    $('.date-inputs').hide();
                } else {
                    $('.date-inputs').show();
                }
            });
        });
        //error_message
        function error_message(messages, input) {
            return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
                .insertAfter(input);
        }
        //test_number
        function test_number(number) {

            if (!isNaN(number)) {
                return true
            } else {
                return false
            }
        }

        function saveintervention() {
            $('.erreur').empty();
            var obligatoire =
                "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"

            var number =
                "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ doit etre un telephone</p>"

            var date =
                "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ doit etre une date</p>"

            // var intervenant = $("input[name='intervenant']").val();
            var intervenant_id = $("#intervenant_id").val();
            var date = $("input[name='date']").val();
            var description = $("textarea[name='description']").val();
            var client_id = $("#client_id").val();
            var entreprise_id = $("#entreprise_id").val();
            var datedebut = $("#datedebut").val();
            var datefin = $("#datefin").val();
            var repeat_type = $("input[name='repeat_type']:checked").val();
            console.log(repeat_type);

            var form = new FormData();

            form.append('date', date);
            form.append('client_id', client_id);
            form.append('repeat_type', repeat_type);
            form.append('intervenant_id', intervenant_id);
            // form.append('intervenant', intervenant);
            form.append('entreprise_id', entreprise_id);
            form.append('description', description);
            form.append('datedebut', datedebut);
            form.append('datefin', datefin);

            console.log(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                url: "{{ url('/storeintervention') }}",
                method: 'post',
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    console.log(result)
                    if (result.error) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'Un erreur est survenu',
                            showConfirmButton: true,
                            timer: 3000
                        })
                        if (result.error.intervenant_id) {
                            error_message(result.error.intervenant[0], "input[name='intervenant_id']")
                        }
                        if (result.error.date) {
                            error_message(result.error.date[0], "input[name='date']")
                        }
                        if (result.error.datedebut) {
                            error_message(result.error.date[0], "input[name='datedebut']")
                        }
                        if (result.error.datefin) {
                            error_message(result.error.date[0], "input[name='datefin']")
                        }
                        if (result.error.repeat_type) {
                            error_message(result.error.date[0], "select[name='repeat_type']")
                        }
                        if (result.error.client_id) {
                            error_message(result.error.entreprise_id[0], "#client_id")
                        }
                        if (result.error.entreprise_id) {
                            error_message(result.error.entreprise_id[0], "#entreprise_id")
                        }

                    } else if (result.success) {

                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Intervention ajouté avecc succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })

                        setTimeout(function() {
                            window.location.href = "{{ url('interventions') }}";
                        }, 1000);
                        console.log(result.success_id)
                    }
                }
            });
        }
    </script>
@endsection
