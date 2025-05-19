@extends('layouts.app')
@section('content')
    <?php
    $date_debut = Date('Y') . '-01-01';
    $date_fin = Date('Y') . '-12-31';
    
    ?>
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <form action="{{ route('chiffreaffaire.index') }}" method="GET">
                    <div class="row align-items-center">
                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label text-primary">
                                    <i class="fa fa-calendar"></i> Date début
                                </label>
                                <input type="date" name="date_debut" 
                                    class="form-control form-control-lg shadow-sm @error('nom') is-invalid @enderror" 
                                    value="{{ request('date_debut', $date_debut) }}"
                                    style="border-radius: 8px;">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label text-primary">
                                    <i class="fa fa-calendar"></i> Date fin
                                </label>
                                <input type="date" name="date_fin" 
                                    class="form-control form-control-lg shadow-sm @error('nom') is-invalid @enderror" 
                                    value="{{ request('date_fin', $date_fin) }}"
                                    style="border-radius: 8px;">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label text-primary">
                                    <i class="fa fa-users"></i> Clients
                                </label>
                                <select class="js-example-basic-single js-states form-control form-control-lg shadow-sm" 
                                    name="client_id" 
                                    style="width: 100%; border-radius: 8px;">
                                    <option value="">Tous les clients</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                                            {{ $client->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label text-primary">
                                    <i class="fa fa-percent"></i> Type Taxe
                                </label>
                                <select class="form-control form-control-lg shadow-sm" 
                                    name="tax_type" 
                                    style="border-radius: 8px;">
                                    <option value="">Tous les types</option>
                                    <option value="with_tva" {{ request('tax_type') == 'with_tva' ? 'selected' : '' }}>
                                        Avec TVA
                                    </option>
                                    <option value="without_tva" {{ request('tax_type') == 'without_tva' ? 'selected' : '' }}>
                                        Sans TVA
                                    </option>
                                    <option value="with_timbre" {{ request('tax_type') == 'with_timbre' ? 'selected' : '' }}>
                                        Avec Timbre
                                    </option>
                                    <option value="without_timbre" {{ request('tax_type') == 'without_timbre' ? 'selected' : '' }}>
                                        Sans Timbre
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label text-primary">
                                    <i class="fa fa-money-bill"></i> Statut
                                </label>
                                <select class="form-control form-control-lg shadow-sm" 
                                    name="payment_status" 
                                    style="border-radius: 8px;">
                                    <option value="">Tous les statuts</option>
                                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>
                                        Factures payées
                                    </option>
                                    <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>
                                        Factures non payées
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group mt-4">
                                <div class="btn-group-vertical shadow" style="margin-top: 27px;">
                                    <button type="submit" class="btn btn-primary" style="border-radius: 8px 8px 0 0;">
                                        <i class="fa fa-filter"></i>
                                    </button>
                                    <a href="{{ route('chiffreaffaire.index') }}" 
                                        class="btn btn-danger" 
                                        style="border-radius: 0 0 8px 8px;">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div id="clock" class="widget_card alert">
                <div class="widget_card_header">
                </div>
                <div class="widget_card_body">
                    <div class="widget_icon">
                        <i class="fa fa-dollar"></i>
                    </div>
                    <div class="widget_text">
                        <h3 id="count_ht">{{ $total_ht }}</h3>
                        <p>Total HT</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="widget_visitor" class="widget_card alert">
                <div class="widget_card_header">
                </div>
                <div class="widget_card_body">
                    <div class="widget_icon">
                        <i class="fa-solid fa-file-circle-check"></i>

                    </div>
                    <div class="widget_text">
                        <h3 id="count_tva">{{ $total_tva }}</h3>
                        <p>Total TVA (Sans timbre)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="widget_profits" class="widget_card alert">
                <div class="widget_card_header">
                </div>
                <div class="widget_card_body">
                    <div class="widget_icon">
                        <i class="fa fa-dollar"></i>
                    </div>
                    <div class="widget_text">
                        <h3 id="count_ttc">{{ $total_ttc }}</h3>
                        <p>Total ttc</p>
                    </div>
                </div>
            </div>
        </div>
		</div>
		<div class="row">
        <div class="col-md-6">
            <div id="widget_user" class="widget_card alert">
                <div class="widget_card_header">
                </div>
                <div class="widget_card_body">
                    <div class="widget_icon">
                        <i class="fa fa-dollar"></i>
                    </div>
                    <div class="widget_text">
                        <h3 id="count_paiements_total">{{ number_format($paiements, 3, '.', ' ') }}</h3>
                        <p>Total des factures payées</p>
                    </div>
                </div>
            </div>
        </div>
		<div class="col-md-6">
            <div id="widget_user" class="widget_card alert">
                <div class="widget_card_header">
                </div>
                <div class="widget_card_body">
                    <div class="widget_icon">
                        <i class="fa fa-dollar"></i>
                    </div>
                    <div class="widget_text">
                        <h3 id="count_paiements_nonpaye">{{ $paiementsnonpaye }}</h3>
                        <p>Total des factures non payées</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="page-box">
                <div class="datatables-example-heading">

                </div>
                <div class="table-responsive">
                    <table class="table display nowrap table-bordered facture_table_index" id="table_facture">
                        <thead>
                            <tr>
                                <th>Facture </th>
                                <th>Client</th>
                                <th>Entreprise</th>
                                <th>Total TTC</th>
                                <th>Payé</th>
                                <th>Reste</th>
                                <th>Date</th>
                                {{-- <th>Status</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($factures as $facture)
                                <tr>
                                    <td>{{ $facture->numero }}</td>
                                    <td>
                                        {{ $facture->client->nom }}
                                    </td>
                                    <td>{{ $facture->entreprise->nom }}</td>
                                    <td>{{ $facture->facture_ttc }}</td>
                                    <td>{{ $facture->facture_paye }}</td>
                                    <td>{{ $facture->facture_solde }}</td>
                                    <td>{{ $facture->date }}</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .form-control {
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    .btn-group .btn {
        transition: all 0.3s ease;
    }
    
    .btn-group .btn:hover {
        transform: translateY(-1px);
    }
    
    .control-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .breadcromb-area {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        margin-bottom: 1.5rem;
    }
    
    .select2-container--default .select2-selection--single {
        height: 48px !important;
        padding: 10px !important;
        border-radius: 8px !important;
        border: 1px solid #d1d3e2 !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 46px !important;
    }
</style>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<script scr="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
