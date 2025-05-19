@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des Produits Clients</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <a href="{{ route('catalogues.client-products') }}?type=devis" class="btn btn-primary {{ request('type') == 'devis' ? 'active' : '' }} mr-2">
                                <i class="fas fa-file-invoice"></i> Devis
                            </a>
                            <a href="{{ route('catalogues.client-products') }}?type=factures" class="btn btn-success {{ request('type') == 'factures' ? 'active' : '' }}">
                                <i class="fas fa-file-invoice-dollar"></i> Factures
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcromb Row -->

    <!-- Advance Table Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-box">
                <div class="datatables-example-heading">
                </div>
                <div class="table-responsive">
                    <table class="table display table-bordered client_table_index">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Total HT</th>
                                <th>Total TTC</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(request('type') == 'devis')
                                @forelse($devis_array ?? [] as $devis)
                                    <tr>
                                        <td><b>{{ $devis->numero }}</b></td>
                                        <td>{{ $devis->date ? date('d/m/Y', strtotime($devis->date)) : '' }}</td>
                                        <td>
                                            <a href="/showclient/{{ $devis->client?->id }}" style="text-decoration: underline;" class="text-success">
                                                <b>{{ $devis->client?->nom }}</b>
                                            </a>
                                        </td>
                                        <td>{{ number_format($devis->devis_ht, 2) }} TND</td>
                                        <td>{{ number_format($devis->devis_ttc, 2) }} TND</td>
                                           <td>
                                        @if ($devis->status == 'en cours')
                                                <span class="badge badge-secondary">En cours</span>
                                            @elseif($devis->status == 'valide')
                                                <span class="badge badge-info"> Valide</span>
                                            @elseif($devis->status == 'annuler')
                                                <span class="badge badge-error">Annulé</span>
                                            @elseif($devis->status == 'converti_facture' && isset($devis->facture))
                                                <a href="{{ route('factures.update', ['id' => $devis->facture->id]) }}"
                                                    target="_blank" style="text-decoration: underline;"
                                                    class="text-success"><b>Converti en facture</b> </a>
                                            @endif
                                        </td>                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Aucun devis trouvé</td>
                                    </tr>
                                @endforelse
                            @elseif(request('type') == 'factures')
                                @forelse($factures ?? [] as $facture)
                                    <tr>
                                        <td>
                                            <a href="/factures/show/{{ $facture->id }}" style="text-decoration: underline;" class="text-success">
                                                <b>{{ $facture->numero }}</b>
                                            </a>
                                        </td>
                                        <td>{{ $facture->date ? date('d/m/Y', strtotime($facture->date)) : '' }}</td>
                                        <td>
                                            <a href="/showclient/{{ $facture->client?->id }}" class="text-primary">
                                                {{ $facture->client?->nom }}
                                            </a>
                                        </td>
                                        <td>{{ number_format($facture->facture_ht, 2) }} TND</td>
                                        <td>{{ number_format($facture->facture_ttc, 2) }} TND</td>
                                        <td>
                                        @if ($facture->status == 'paye')
                                            <span class="badge badge-success">payée en totalité</span>
                                        @elseif($facture->status == 'valide')
                                            <span class="badge badge-info">valide</span>
                                        @elseif($facture->status == 'en cours')
                                            <span class="badge">en cours</span>
                                        @elseif($facture->status == 'paye_partielle')
                                            <span class="badge badge-warning"> partiellement payé</span>
                                        @endif
                                    </td>                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Aucune facture trouvée</td>
                                    </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Veuillez sélectionner "Devis" ou "Factures" pour afficher la liste correspondante.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialisation de DataTable
    let table = $('.client_table_index').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json'
        }
    });
    

});
</script>
@endsection 