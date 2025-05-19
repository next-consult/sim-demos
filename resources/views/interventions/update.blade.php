@extends('layouts.newapp')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --background-color: #f8f9fa;
            --card-shadow: 0 10px 20px rgba(0,0,0,0.05);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            background-color: var(--background-color);
            color: var(--primary-color);
        }

        .page-box {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            padding: 40px;
            margin-bottom: 30px;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .breadcromb-area {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 25px 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .seipkon-breadcromb-left h3 {
            color: var(--primary-color);
            font-weight: 700;
            margin: 0;
            font-size: 26px;
            letter-spacing: -0.5px;
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            padding: 14px 18px;
            transition: var(--transition);
            font-size: 15px;
            background-color: #ffffff;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
            outline: none;
        }

        .select2-container .select2-selection--single {
            height: 52px;
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            transition: var(--transition);
        }

        .select2-container--classic .select2-selection--single .select2-selection__rendered {
            line-height: 50px;
            padding-left: 18px;
            color: var(--primary-color);
        }

        .select2-container--classic .select2-selection--single .select2-selection__arrow {
            height: 50px;
        }

        .select2-container--classic .select2-results__option--highlighted[aria-selected] {
            background-color: var(--secondary-color);
        }

        .btn {
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            transition: var(--transition);
            font-size: 15px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn i {
            font-size: 18px;
        }

        .btn-info {
            background: var(--secondary-color);
            border: none;
            color: white;
        }

        .btn-info:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.2);
        }

        .btn-warning {
            background: var(--warning-color);
            border: none;
            color: white;
        }

        .btn-warning:hover {
            background: #e67e22;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.2);
        }

        .form-group {
            margin-bottom: 30px;
        }

        label.control-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 12px;
            display: block;
            font-size: 15px;
            letter-spacing: 0.3px;
        }

        .obligatoire {
            color: var(--accent-color);
            margin-left: 4px;
        }

        .text-danger {
            font-size: 13px;
            margin-top: 8px;
            display: block;
            color: var(--accent-color);
            font-weight: 500;
        }

        #btn_group {
            display: flex;
            gap: 20px;
            justify-content: flex-end;
        }

        textarea.form-control {
            min-height: 140px;
            line-height: 1.6;
        }

        .is-invalid {
            border-color: var(--accent-color) !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23dc3545' viewBox='0 0 16 16'%3E%3Cpath d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 18px 18px;
        }

        .form-wrap {
            position: relative;
        }

        .form-layout-page {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Elegant loading state */
        .loading {
            opacity: 0.7;
            pointer-events: none;
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 30px;
            height: 30px;
            border: 3px solid rgba(52, 152, 219, 0.3);
            border-radius: 50%;
            border-top-color: var(--secondary-color);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Animation for form elements */
        .form-control, .select2-container {
            transform: translateY(0);
            opacity: 1;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Sweet Alert customization */
        .swal2-popup {
            border-radius: 20px;
            padding: 30px;
        }

        .swal2-title {
            color: var(--primary-color) !important;
            font-weight: 700 !important;
        }

        .swal2-confirm {
            background: var(--secondary-color) !important;
            border-radius: 12px !important;
            padding: 12px 30px !important;
        }
    </style>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Breadcromb Row Start -->
<div class="row">
    <div class="col-md-12">
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-md-7">
                    <div class="seipkon-breadcromb-left">
                        <h3>Modifier l'intervention</h3>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="btn-group" role="group" aria-label="Basic example" id="btn_group"><a href="{{ route('interventions.index') }}">
                        <button type="button" class="btn btn-warning btn_retour" style="margin-left: 120px;">
                            <i class="fa-solid fa-backward"></i> Retour
                        </button>
                    </a>
                        <button type="button" class="btn btn-info" onclick="updateIntervention()">
                            <i class="fa fa-check"></i> Enregistrer l'intervention
                        </button>
                        
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
                    <form id="updateInterventionForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $intervention->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Date: <span class="obligatoire">*</span></label>
                                    <input type="date" placeholder="Date" class="form-control" name="date" id="date"
                                        value="{{ old('date', $intervention->date) }}">
                                    <span class="text-danger" id="error_date"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Intervenant: <span class="obligatoire">*</span></label>
                                    <select class="form-control select2" name="intervenant_id" id="intervenant_id">
                                        <option value="">Sélectionner un intervenant</option>
                                        @foreach ($intervenants as $intervenant)
                                            <option value="{{ $intervenant->id }}"
                                                {{ $intervenant->id == old('intervenant_id', $intervention->intervenant_id) ? 'selected' : '' }}>
                                                {{ $intervenant->name }} 
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="error_intervenant_id"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                         


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Adresse:</label>
                                    <input type="text" placeholder="Adresse" class="form-control" name="address" id="address"
                                        value="{{ old('address', $intervention->address) }}" >
                                </div>
                            </div>
							 <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Client: <span class="obligatoire">*</span></label>
            <select class="form-control select2" name="client_id" id="client_id">
                <option value="">Sélectionner un client</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}"
                        {{ $client->id == old('client_id', $intervention->client_id) ? 'selected' : '' }}>
                        {{ $client->nom }} 
                    </option>
                @endforeach
            </select>
            <span class="text-danger" id="error_client_id"></span>
        </div>
    </div>
                        </div>

                        <!-- Add Client and Entreprise Information -->
                       <div class="row">
   
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Entreprise: <span class="obligatoire">*</span></label>
            <select class="form-control select2" name="entreprise_id" id="entreprise_id">
                <option value="">Sélectionner une entreprise</option>
                @foreach ($entreprises as $entreprise)
                    <option value="{{ $entreprise->id }}"
                        {{ $entreprise->id == old('entreprise_id', $intervention->entreprise_id) ? 'selected' : '' }}>
                        {{ $entreprise->nom }} 
                    </option>
                @endforeach
            </select>
            <span class="text-danger" id="error_entreprise_id"></span>
        </div>
    </div>
						   <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description:</label>
                                    <textarea placeholder="Description" class="form-control" name="description" id="description">{{ old('description', $intervention->description) }}</textarea>
                                    <span class="text-danger" id="error_description"></span>
                                </div>
                            </div>
</div>



                        <div class="row">
                            
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
    <script>
        $(document).ready(function() {
            // Enhanced Select2 initialization
            $('.select2').select2({
                theme: "classic",
                placeholder: 'Sélectionner une option',
                width: '100%',
                allowClear: true,
                minimumResultsForSearch: 5,
                dropdownParent: $('.form-wrap')
            });

            // Elegant focus effects
            $('.form-control, .select2').on('focus', function() {
                $(this).closest('.form-group').addClass('focused');
            }).on('blur', function() {
                $(this).closest('.form-group').removeClass('focused');
            });

            // Smooth label animation
            $('.form-control').each(function() {
                if ($(this).val()) $(this).closest('.form-group').addClass('has-value');
            }).on('input', function() {
                $(this).closest('.form-group')[$(this).val() ? 'addClass' : 'removeClass']('has-value');
            });
        });

        function updateIntervention() {
            $('.text-danger').empty();
            $('.form-control').removeClass('is-invalid');
            
            // Add loading state
            const form = $('#updateInterventionForm');
            form.addClass('loading');

            var formData = form.serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('interventions.update', $intervention->id) }}",
                method: 'PUT',
                data: formData,
                success: function(response) {
                    form.removeClass('loading');
                    if (response.success) {
                        Swal.fire({
                            title: 'Succès!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-info',
                                popup: 'animated fadeInDown faster'
                            }
                        }).then(() => {
                            window.location.href = "{{ route('interventions.index') }}";
                        });
                    }
                },
                error: function(xhr) {
                    form.removeClass('loading');
                    var errors = xhr.responseJSON.error || xhr.responseJSON.errors;
                    if (errors) {
                        Object.keys(errors).forEach(field => {
                            $(`#${field}`).addClass('is-invalid');
                            $(`#error_${field}`).text(errors[field][0])
                                .fadeIn(200);
                        });
                    }
                }
            });
        }
    </script>
@endsection
