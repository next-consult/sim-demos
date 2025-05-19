@extends('layouts.newapp')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style type="text/css">
        /* Modern form styling */
        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 8px 12px;
            height: 42px;
            transition: all 0.3s ease;
            box-shadow: none;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.1);
        }

        .select2-container .select2-selection--single,
        .select2-container .select2-selection--multiple {
            height: 42px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .select2-container--classic .select2-selection--single .select2-selection__rendered {
            line-height: 42px;
            padding-left: 12px;
        }

        /* Section styling */
        .form-section {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            margin-bottom: 20px;
            border: none;
        }

        .form-section-title {
            color: #2c3e50;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f5f6fa;
        }

        /* Button styling */
        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-info {
            background: #4a90e2;
            border: none;
        }

        .btn-warning {
            background: #f5a623;
            border: none;
            color: white;
        }

        .btn-primary {
            background: #3498db;
            border: none;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Radio buttons */
        .radio-inline {
            margin-right: 15px;
            display: inline-block;
        }

        .radio-inline label {
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 6px;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }

        .radio-inline label:hover {
            background: #e9ecef;
        }

        .radio-inline input[type="radio"]:checked + label {
            background: #4a90e2;
            color: white;
        }

        /* Updated Breadcrumb area styling */
        .breadcromb-area {
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            margin-bottom: 25px;
            margin-top: 0px; /* Add top margin to prevent app bar overlap */
        }

        .breadcromb-area .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        .breadcromb-area .btn {
            margin: 0 !important; /* Remove default margins */
            white-space: nowrap;
            min-width: fit-content;
        }

        .btn_retour {
            margin-left: 0 !important; /* Remove the hardcoded margin */
        }

        @media (max-width: 768px) {
            .breadcromb-area {
                margin-top: 100px; /* More space on mobile */
            }
            
            .breadcromb-area .btn-group {
                margin-top: 15px;
                justify-content: flex-start;
            }
            
            .seipkon-breadcromb-left h3 {
                font-size: 20px;
            }
        }

        .seipkon-breadcromb-left h3 {
            color: #2c3e50;
            font-weight: 600;
        }

        .obligatoire {
            color: #e74c3c;
            margin-left: 4px;
        }

        .hidden {
            display: none;
        }

        /* Textarea styling */
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        /* Page box styling */
        .page-box {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
        }

        /* Date inputs */
        input[type="date"].form-control {
            padding: 8px 12px;
        }

        /* Button group spacing */
        .btn-group .btn {
            margin-right: 10px;
        }

        .btn-group .btn:last-child {
            margin-right: 0;
        }
    </style>
@endsection


@section('content')

    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="seipkon-breadcromb-left">
                            <h3>Ajouter une intervention</h3>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">
                            <button type="button" class="btn btn-info" onclick="saveintervention()">
                                <i class="fa fa-check"></i> Enregistrer l'intervention
                            </button>
                            <a href="{{ route('interventions.index') }}">
                                <button type="button" class="btn btn-warning btn_retour">
                                    <i class="fa-solid fa-backward" style="margin-right: 5px"></i>Retour
                                </button>
                            </a>
                            <a href="{{ route('plannings.gear2') }}">
                                <button type="button" class="btn btn-primary">
                                    <i class="fa fa-gear"></i> Planning
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
                            <!-- Section rendez-vous moved before the contrat section -->
                            <div class="row date-inputs">
                                <div class="col-md-4 form-section">
                                    <h4 class="form-section-title">Section rendez-vous</h4>
                                    <div class="form-group">
                                        <label class="control-label">Choisir le client: <span class="obligatoire">*</span></label>
                                        <select class="form-control select2" id="client_id" name="client_id" onchange="populateContractSelect(this.value)">
                                            <option value="">Selectionner un client</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Choisir l'entreprise: <span class="obligatoire">*</span></label>
                                        <select class="form-control" id="entreprise_id" name="entreprise_id">
                                            @foreach ($entreprises as $entreprise)
                                                <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Adresse: <span class="obligatoire">*</span></label>
                                        <input class="form-control" id="address" name="address" type="text" placeholder="{{ $client->adresse }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Intervenants: <span class="obligatoire">*</span></label>
                                        <select class="form-control select2" name="intervenant_ids[]" id="intervenant_ids" multiple>
                                            @foreach ($intervenants as $intervenant)
                                                <option value="{{ $intervenant->id }}">{{ $intervenant->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Type: <span class="obligatoire">*</span></label>
                                        <select class="form-control"  id="divSelector" onchange="toggleDivs()">
                                            <option value="">Select a Div</option>
                                            <option value="div1">Contrat</option>
                                            <option value="div2" selected>Planning</option>
                                        </select>
                                    </div>

                                </div>

                                <!-- Section contrat moved after the rendez-vous section -->
                                <div class="col-md-4 form-section hidden" id="div1">
                                    <h4 class="form-section-title">Section contrat</h4>
                                    <div class="form-group">
                                        <label class="control-label">Contrat: </label>
                                        <select class="form-control select2" name="contrat_id" id="contrat_id" onchange="populateContractDates(this.value, 'contract')">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Début de contrat: </label>
                                        <input type="date" placeholder="Date de début" class="form-control" name="datedebut" id="datedebut" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Fin de contrat: </label>
                                        <input type="date" placeholder="Date de fin" class="form-control" name="datefin" id="datefin" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Date: <span class="obligatoire">*</span></label>
                                        <input type="date" placeholder="Date" class="form-control" name="date" id="date" value="{{ $date ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="repeat_type" class="control-label">Recurrence: <span class="obligatoire">*</span></label>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" id="repeat_type_onshot" name="repeat_type" value="oneshot" checked>
                                                Une fois
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" id="repeat_type_onshot" name="repeat_type" value="daily">
                                                Tous les jours
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" id="repeat_type_weekly" name="repeat_type" value="weekly">
                                                Chaque semaine
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" id="repeat_type_monthly" name="repeat_type" value="monthly">
                                                Chaque mois
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <!-- Section planning remains in its original place -->
                                <div class="col-md-4 form-section" id="div2">
                                    <h4 class="form-section-title">Section planning</h4>
                                    <div class="form-group">
                                        <label class="control-label">Contrat: </label>
                                        <select class="form-control select2" name="contrat_id" id="contrat_id_planning" onchange="populateContractDates(this.value, 'planning')">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Date: <span class="obligatoire">*</span></label>
                                        <input type="date" placeholder="Date" class="form-control" name="dateP" id="dateP" value="{{ $date ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Début de contrat: </label>
                                        <input type="date" placeholder="Date de début" class="form-control" name="datedebutP" id="datedebutP" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Fin de contrat: </label>
                                        <input type="date" placeholder="Date de fin" class="form-control" name="datefinP" id="datefinP" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="repeat_type" class="control-label">Recurrence: <span class="obligatoire">*</span></label>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" id="repeat_type_onshot" name="repeat_type" value="oneshot" checked>
                                                Une fois
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" id="repeat_type_onshot" name="repeat_type" value="daily">
                                                Tous les jours
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" id="repeat_type_weekly" name="repeat_type" value="weekly">
                                                Chaque semaine
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" id="repeat_type_monthly" name="repeat_type" value="monthly">
                                                Chaque mois
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description section remains unchanged -->
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        //error_message
        function error_message(messages, input) {
            return $("<span class='text-danger erreur' style='float:left;font-size:13px'>" + messages + "</span>")
                .insertAfter(input);
        }
        
        $(document).ready(function() {
            $('#contrat_id, #contrat_id_planning').select2({
                placeholder: 'Selectionner un contrat',
                theme: "classic"
            });

            $('#intervenant_ids').select2({
                placeholder: 'Selectionner un ou plusieurs intervenants',
                theme: "classic"
            });
            $('#entreprise_id').select2({
                placeholder: 'Selectionner une entreprise',
                theme: "classic"
            });
            $('#client_id').select2({
                placeholder: 'Selectionner un client',
                theme: "classic"
            });

            $('input[name="repeat_type"]').change(function() {
                if ($(this).val() === 'recurrence') {
                    $('#recurrence-options').show();
                } else {
                    $('#recurrence-options').hide();
                }
            });



            $('input[name="address"]').prop('disabled', false);
            //test_number
            function test_number(number) {

                if (!isNaN(number)) {
                    return true
                } else {
                    return false
                }
            }


            $('#intervenant_id').change(function() {
            var intervenantId = $(this).val();

            if (intervenantId) {
            $.ajax({
                url: '/get-intervenant-color/' + intervenantId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Check if response.color is valid
                    if(/^#[0-9A-F]{6}$/i.test(response.color)) {
                        $('#color').val(response.color);
                    } else {
                        console.warn('Invalid color format:', response.color);
                        $('#color').val('#ff0000'); // Fallback color
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.error('Status:', status);
                    console.error('Response Text:', xhr.responseText);
                }
            });
            } else {
            $('#color').val('#ff0000'); // Fallback color if no intervenant selected
            }})



            });
            function toggleDivs() {
            var selectedValue = document.getElementById("divSelector").value;
            document.getElementById("div1").classList.add("hidden");
            document.getElementById("div2").classList.add("hidden");

            if (selectedValue === "div1") {
                document.getElementById("div1").classList.remove("hidden");
            } else if (selectedValue === "div2") {
                document.getElementById("div2").classList.remove("hidden");
        }
}

            function saveintervention() {
            // Clear previous error messages
            $('.erreur').remove();

            var form = new FormData();
            
            // Get form values
            var intervenant_ids = $("#intervenant_ids").val();
            var client_id = $("#client_id").val();
            var entreprise_id = $("#entreprise_id").val();
            var description = $("textarea[name='description']").val();
            var address = $("input[name='address']").val();
            var color = $("#color").val();
            var repeat_type = $("input[name='repeat_type']:checked").val();
            
            // Validate required fields
            var hasErrors = false;
            
            if (!client_id) {
                error_message("Veuillez sélectionner un client", "#client_id");
                hasErrors = true;
            }
            
            if (!entreprise_id) {
                error_message("Veuillez sélectionner une entreprise", "#entreprise_id");
                hasErrors = true;
            }
            
            if (!intervenant_ids || intervenant_ids.length === 0) {
                error_message("Veuillez sélectionner au moins un intervenant", "#intervenant_ids");
                hasErrors = true;
            }
            
            if (!address) {
                error_message("L'adresse est obligatoire", "input[name='address']");
                hasErrors = true;
            }

            // Get selected type and validate corresponding dates
            var selectedValue = document.getElementById("divSelector").value;
            
            if (selectedValue === "div1") { // Contrat
                var date = $("input[name='date']").val();
                var datedebut = $("#datedebut").val();
                var datefin = $("#datefin").val();
                
                if (!date) {
                    error_message("La date est obligatoire", "input[name='date']");
                    hasErrors = true;
                }
                if (!datedebut) {
                    error_message("La date de début est obligatoire", "#datedebut");
                    hasErrors = true;
                }
                if (!datefin) {
                    error_message("La date de fin est obligatoire", "#datefin");
                    hasErrors = true;
                }
                
                form.append('date', date);
                form.append('datedebut', datedebut);
                form.append('datefin', datefin);
                
            } else if (selectedValue === "div2") { // Planning
                var dateP = $("input[name='dateP']").val();
                var datedebutP = $("input[name='datedebutP']").val();
                var datefinP = $("input[name='datefinP']").val();
                
                if (!dateP) {
                    error_message("La date est obligatoire", "input[name='dateP']");
                    hasErrors = true;
                }
                if (!datedebutP) {
                    error_message("La date de début est obligatoire", "input[name='datedebutP']");
                    hasErrors = true;
                }
                if (!datefinP) {
                    error_message("La date de fin est obligatoire", "input[name='datefinP']");
                    hasErrors = true;
                }
                
                form.append('date', dateP);
                form.append('datedebut', datedebutP);
                form.append('datefin', datefinP);
            } else {
                error_message("Veuillez sélectionner un type (Contrat ou Planning)", "#divSelector");
                hasErrors = true;
            }

            if (hasErrors) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur de validation',
                    text: 'Veuillez corriger les erreurs dans le formulaire',
                    position: 'center'
                });
                return;
            }

            // Append other form data
            if (intervenant_ids) {
                intervenant_ids.forEach(function(id) {
                    form.append('intervenant_ids[]', id);
                });
            }
            form.append('client_id', client_id);
            form.append('entreprise_id', entreprise_id);
            form.append('description', description);
            form.append('color', color);
            form.append('address', address);
            form.append('repeat_type', repeat_type);

            // Send AJAX request
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
                    if (result.error) {
                        // Display server-side validation errors
                        Object.keys(result.error).forEach(function(key) {
                            var message = result.error[key][0];
                            var input = key === 'intervenant_ids' ? '#intervenant_ids' : 
                                       $('[name="' + key + '"]').length ? '[name="' + key + '"]' : '#' + key;
                            error_message(message, input);
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur de validation',
                            text: 'Veuillez corriger les erreurs dans le formulaire',
                            position: 'center'
                        });
                    } else if (result.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Succès',
                            text: 'Intervention ajoutée avec succès',
                            position: 'center',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location.href = "{{ url('interventions') }}";
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur est survenue lors de l\'enregistrement. Veuillez réessayer.',
                        position: 'center'
                    });
                    console.error('Ajax error:', error);
                }
            });
        }

       function populateContractSelect(clientId) {
        // Clear previous address first
        $('#address').val('');
        
        $.ajax({
            url: '/get-contracts/' + clientId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Update both contract selects
                var $contractSelect = $('#contrat_id');
                var $planningContractSelect = $('#contrat_id_planning');
                
                $contractSelect.empty();
                $planningContractSelect.empty();
                
                var defaultOption = '<option value="">Select a contract</option>';
                $contractSelect.append(defaultOption);
                $planningContractSelect.append(defaultOption);
                
                $.each(response.contracts, function(index, contract) {
                    var option = '<option value="' + contract.id + '">' + contract.numero + '</option>';
                    $contractSelect.append(option);
                    $planningContractSelect.append(option);
                });
                
                $contractSelect.trigger('change');
                $planningContractSelect.trigger('change');
                
                // Auto-fill the address if client data is available
                if (response.client && response.client.adresse) {
                    $('#address').val(response.client.adresse);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching contracts:', error);
            }
        });
    }


       function populateContractDates(contractId, type) {
        if (!contractId) {
            if (type === 'planning') {
                $('#datedebutP').val('').prop('readonly', true);
                $('#datefinP').val('').prop('readonly', true);
            } else {
                $('#datedebut').val('').prop('readonly', true);
                $('#datefin').val('').prop('readonly', true);
            }
            return;
        }
        
        $.ajax({
            url: '/get-contract-dates/' + contractId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response && response.start_date && response.end_date) {
                    // Format dates to YYYY-MM-DD
                    var startDate = new Date(response.start_date);
                    var endDate = new Date(response.end_date);
                    
                    var formattedStartDate = startDate.getFullYear() + '-' + 
                        String(startDate.getMonth() + 1).padStart(2, '0') + '-' + 
                        String(startDate.getDate()).padStart(2, '0');
                        
                    var formattedEndDate = endDate.getFullYear() + '-' + 
                        String(endDate.getMonth() + 1).padStart(2, '0') + '-' + 
                        String(endDate.getDate()).padStart(2, '0');
                    
                    if (type === 'planning') {
                        $('#datedebutP').val(formattedStartDate).prop('readonly', true);
                        $('#datefinP').val(formattedEndDate).prop('readonly', true);
                    } else {
                        $('#datedebut').val(formattedStartDate).prop('readonly', true);
                        $('#datefin').val(formattedEndDate).prop('readonly', true);
                    }
                } else {
                    if (type === 'planning') {
                        $('#datedebutP').val('').prop('readonly', true);
                        $('#datefinP').val('').prop('readonly', true);
                    } else {
                        $('#datedebut').val('').prop('readonly', true);
                        $('#datefin').val('').prop('readonly', true);
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching contract dates:', error);
                if (type === 'planning') {
                    $('#datedebutP').val('').prop('readonly', true);
                    $('#datefinP').val('').prop('readonly', true);
                } else {
                    $('#datedebut').val('').prop('readonly', true);
                    $('#datefin').val('').prop('readonly', true);
                }
            }
        });
    }

    // Show planning section by default
    document.getElementById("div1").classList.add("hidden");
    document.getElementById("div2").classList.remove("hidden");

    </script>
@endsection