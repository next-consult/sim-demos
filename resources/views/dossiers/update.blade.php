@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row ">
                    <div class="col-md-8">
                        <h3>{{ $dossier->numero }}</h3>
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">
                            <div class="dropdown">
                                <button class="btn btn-options  btn-success dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="margin-left:20px">
                                    Options <i class="fa-solid fa-circle-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                    <ul class="list-group">
                                        {{-- <a data-toggle="modal" data-target="#update_folder" style="cursor:pointer">
                                            <li class="list-group-item"><i class="fa fa-pen" style="margin-right:5px"></i>
                                                Modifier </li>
                                        </a> --}}


                                        <a href="#" data-toggle="modal" data-target="#add_devis"
                                            class="adddevis_button" data-id="{{ $dossier->id }}">

                                            <li class="list-group-item">


                                                <i class="fa-solid fa-file-export" style="margin-right:5px">

                                                </i>Créer un devis

                                            </li>
                                        </a>

                                    </ul>
                                </div>
                            </div>
                            <a href="{{ route('dossiers.index') }} "><button type="button"
                                    class="btn btn-warning btn_retour" style=" margin-left: 120px;
"><i
                                        class="fa-solid fa-backward"></i>Retour</button></a>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="page-box">
                <div class="tabs-example">
                    <h3><a href="{{ route('clients.show', ['id' => $dossier->client->id]) }}" target="_blank"
                            style="text-decoration: underline;" class="text-info"><b>Détails client
                            </b> </a> </h3>
                    <div class="tabs-box-example horizontal-tab-example">
                        <ul class="nav nav-tabs" id="service_pro" role="tablist">
                            <li role="presentation" class="active"><a href="#devis" role="tab"
                                    data-toggle="tab">Devis</a></li>
                            <li role="ordres"><a href="#ordres" role="tab" data-toggle="tab">Ordres de travail</a>
                            </li>
                            <li role="factures"><a href="#factures" role="tab" data-toggle="tab">Factures</a>
                            </li>
                            <li role="paiements"><a href="#paiements" role="tab" data-toggle="tab">Paiements</a>
                            </li>
                        </ul>
                        <div id="seipkkon_tab_content" class="tab-content">
                            <div id="devis" class="tab-pane fade in active">
                                <div class="row">


                                    <div class="col-md-12">
                                        <div class="page-box">

                                            <div class="datatables-example-heading">

                                            </div>
                                            <div class="table-responsive">
                                                <div class="filter-select" style="width:200px">
                                                    <select class="form-control status-dropdown">
                                                        <option value="">Tous </option>
                                                        <option value="En cours">en cours</option>
                                                        <option value="Valide">Valide</option>
                                                        <option value="Converti en ordres">Converti en ordres</option>

                                                    </select>
                                                </div>
                                                <table class="table display nowrap table-bordered devis_table_index">
                                                    <thead>
                                                        <tr>
                                                            <th>Devis </th>
                                                            <th>Client</th>
                                                            <th>Entreprise</th>
                                                            <th>Total ttc</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($dossier->devis as $devis)
                                                            <tr>
                                                                <td><a href="{{ route('devis.update', ['id' => $devis->id]) }}"
                                                                        target="_blank" style="text-decoration: underline;"
                                                                        class="text-success"><b>{{ $devis->numero }}</b>
                                                                    </a> </td>

                                                                <td>
                                                                    <a href="{{ route('clients.show', ['id' => $devis->dossier->client->id]) }}"
                                                                        target="_blank" style="text-decoration: underline;"
                                                                        class="text-primary"><b>{{ $devis->dossier->client->nom }}
                                                                            {{ $devis->dossier->client->prenom }}</b> </a>

                                                                </td>

                                                                <td>{{ $devis->entreprise->nom }}</td>
                                                                <td>{{ str_replace('.', ',', sprintf('%.3f', $devis->devis_ttc)) }}
                                                                </td>
                                                                <td>{{ $devis->date }}</td>
                                                                <td>
                                                                    @if ($devis->status == 'en cours')
                                                                        <span class="badge badge-secondary">En cours</span>
                                                                    @elseif($devis->status == 'valide')
                                                                        <span class="badge badge-info"> Valide</span>
                                                                    @elseif($devis->status == 'annuler')
                                                                        <span class="badge badge-error">Annulé</span>
                                                                    @elseif($devis->status == 'converti_ordres')
                                                                        <span class="badge badge-success">Converti en
                                                                            ordres</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn btn-options btn-success dropdown-toggle"
                                                                            type="button" data-toggle="dropdown"
                                                                            aria-haspopup="true" aria-expanded="false"
                                                                            style="margin-left:20px">
                                                                            Options <i
                                                                                class="fa-solid fa-circle-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu pull-right"
                                                                            aria-labelledby="dropdownMenuButton">
                                                                            <ul class="list-group">
                                                                                <a
                                                                                    href="{{ route('devis.print', ['id' => $devis->id]) }}">
                                                                                    <li class="list-group-item"><i
                                                                                            class="fa fa-file"
                                                                                            style="margin-right:5px"></i>
                                                                                        PDF </li>
                                                                                </a>
                                                                                <a
                                                                                    href="{{ route('devis.update', ['id' => $devis->id]) }}">
                                                                                    <li class="list-group-item"><i
                                                                                            class="fa fa-pen"
                                                                                            style="margin-right:5px"></i>
                                                                                        Modifier </li>
                                                                                </a>
                                                                                <a href="#">
                                                                                    <li class="list-group-item"
                                                                                        style="cursor:pointer"><i
                                                                                            class="fa-solid fa-trash"
                                                                                            style="margin-right:5px;"></i>Supprimer
                                                                                    </li>
                                                                                </a>

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach



                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="ordres" class="tab-pane fade in ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="page-box">
                                            <div class="datatables-example-heading">

                                            </div>
                                            <div class="table-responsive advance-table">
                                                <table class="table display table-bordered ordres_table_index">
                                                    <thead>
                                                        <tr>
                                                            <th>Numéro</th>
                                                            <th>Devis</th>

                                                            <th>Chauffeur</th>
                                                            <th>Camion</th>
                                                            <th>Date de livraison</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($dossier->devis) > 0)
                                                            @foreach ($dossier->devis as $devis)
                                                                @foreach ($devis->ordres as $ordre)
                                                                    <tr>
                                                                        <td><a href="{{ route('ordres.update', ['id' => $ordre->devis->id, 'all' => $ordre->id]) }}"
                                                                                target="_blank"
                                                                                style="text-decoration: underline;"
                                                                                class="text-success"><b>{{ $ordre->numero }}</b>
                                                                            </a> </td>

                                                                        <td>


                                                                            <a href="{{ route('devis.update', ['id' => $ordre->devis->id]) }}"
                                                                                target="_blank"
                                                                                style="text-decoration: underline;"
                                                                                class="text-primary"><b>{{ $ordre->devis->numero }}</b>
                                                                            </a>
                                                                        </td>



                                                                        <td>
                                                                            @if ($ordre->items->chauffeur)
                                                                                {{ $ordre->items->chauffeur->nom }}
                                                                                {{ $ordre->items->chauffeur->prenom }}
                                                                            @else
                                                                                <span
                                                                                    class="badge badge-pill badge-danger">
                                                                                    #Non affecté </span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if ($ordre->items->camion)
                                                                                {{ $ordre->items->camion->matricule }}
                                                                            @else
                                                                                <span
                                                                                    class="badge badge-pill badge-danger">
                                                                                    #Non affecté </span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $ordre->items->date_livraison }}</td>
                                                                        <td style="text-align:left">
                                                                            <div class="dropdown">
                                                                                <button
                                                                                    class="btn btn-options btn-success dropdown-toggle"
                                                                                    type="button" data-toggle="dropdown"
                                                                                    aria-haspopup="true"
                                                                                    aria-expanded="false"
                                                                                    style="margin-left:20px">
                                                                                    Options <i
                                                                                        class="fa-solid fa-circle-chevron-down"></i>
                                                                                </button>
                                                                                <div class="dropdown-menu pull-right"
                                                                                    aria-labelledby="dropdownMenuButton">
                                                                                    <ul class="list-group">
                                                                                        <a
                                                                                            href="{{ route('ordres.print', ['id' => $ordre->id]) }}">
                                                                                            <li class="list-group-item"><i
                                                                                                    class="fa fa-file"
                                                                                                    style="margin-right:5px"></i>
                                                                                                PDF </li>
                                                                                        </a>
                                                                                        <a
                                                                                            href="{{ route('ordres.update', ['id' => $ordre->devis->id, 'all' => $ordre->id]) }}">
                                                                                            <li class="list-group-item"><i
                                                                                                    class="fa fa-pen"
                                                                                                    style="margin-right:5px"></i>
                                                                                                Modifier </li>
                                                                                        </a>
                                                                                        <a href="#">
                                                                                            <li class="list-group-item"
                                                                                                style="cursor:pointer"><i
                                                                                                    class="fa-solid fa-trash"
                                                                                                    style="margin-right:5px;"></i>Supprimer
                                                                                            </li>
                                                                                        </a>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $all_factures = [];
                            foreach ($dossier->devis as $devis) {
                                foreach ($devis->ordres as $ordre) {
                                    foreach ($ordre->factures as $facture) {
                                        array_push($all_factures, $facture->id);
                                    }
                                }
                            }
                            $all_factures = array_unique($all_factures);
                            $factures = \App\Models\Facture::whereIn('id', $all_factures)->get();
                            $paiements = \App\Models\Paiement::whereIn('facture_id', $all_factures)->get();
                            
                            ?>
                            <div id="factures" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="page-box">
                                            <div class="datatables-example-heading">
                                            </div>
                                            <div class="table-responsive">
                                                <div class="filter-select">
                                                    <select class="form-control status-dropdown-facture"
                                                        style="width:200px">
                                                        <option value="">Tous</option>
                                                        <option value="en cours">en cours</option>
                                                        <option value="valide">valide</option>
                                                        <option value="partiellement payé">partiellement payé</option>
                                                        <option value="payée en totalité">payée en totalité </option>

                                                    </select>
                                                </div>
                                                <table class="table display nowrap table-bordered facture_table_index">
                                                    <thead>
                                                        <th>Facture </th>
                                                        <th>Client</th>
                                                        <th>Entreprise</th>
                                                        <th>Total ttc</th>
                                                        <th>Payé</th>
                                                        <th>Réste</th>
                                                        <th>Date</th>
                                                        <th>Status </th>
                                                        {{-- <th>Status</th> --}}
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($factures as $facture)
                                                            <tr>

                                                                <td><a href="{{ route('factures.update', ['id' => $facture->id, 'devis_id' => $facture->ordres[0]->devis->id]) }}"
                                                                        target="_blank"
                                                                        style="text-decoration: underline;"
                                                                        class="text-success"><b>{{ $facture->numero }}</b>
                                                                    </a> </td>
                                                                <td>
                                                                    {{ $facture->ordres[0]->devis->dossier->client->nom }}
                                                                </td>

                                                                <td>{{ $facture->ordres[0]->devis->entreprise->nom }}</td>
                                                                <td>{{ $facture->facture_ttc }}</td>
                                                                <td>{{ $facture->facture_paye }}</td>
                                                                <td>{{ $facture->facture_solde }}</td>

                                                                <td>{{ $facture->date }}</td>
                                                                <td>
                                                                    @if ($facture->status == 'paye')
                                                                        <span class="badge badge-success">payée en
                                                                            totalité</span>
                                                                    @elseif($facture->status == 'valide')
                                                                        <span class="badge badge-info">valide</span>
                                                                    @elseif($facture->status == 'en cours')
                                                                        <span class="badge">en cours</span>
                                                                    @elseif($facture->status == 'paye_partielle')
                                                                        <span class="badge badge-warning"> partiellement
                                                                            payé</span>
                                                                    @endif

                                                                </td>
                                                                {{-- <td><span class="badge badge-warning">{{$devis->status}}</span></td> --}}
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn btn-options btn-success dropdown-toggle"
                                                                            type="button" data-toggle="dropdown"
                                                                            aria-haspopup="true" aria-expanded="false">
                                                                            Options <i
                                                                                class="fa-solid fa-circle-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu pull-right"
                                                                            aria-labelledby="dropdownMenuButton">
                                                                            <ul class="list-group">
                                                                                <a
                                                                                    href="{{ route('factures.print', ['id' => $facture->id]) }}">
                                                                                    <li class="list-group-item"><i
                                                                                            class="fa fa-file"
                                                                                            style="margin-right:5px"></i>
                                                                                        PDF </li>
                                                                                </a>
                                                                                <a
                                                                                    href="{{ route('factures.update', ['id' => $facture->id, 'devis_id' => $facture->ordres[0]->devis->id]) }}">
                                                                                    <li class="list-group-item"><i
                                                                                            class="fa fa-pen"
                                                                                            style="margin-right:5px"></i>
                                                                                        Modifier </li>
                                                                                </a>
                                                                                <a href="#">
                                                                                    <li class="list-group-item"
                                                                                        style="cursor:pointer"><i
                                                                                            class="fa-solid fa-trash"
                                                                                            style="margin-right:5px;"></i>Supprimer
                                                                                    </li>
                                                                                </a>


                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach




                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="paiements" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="page-box">
                                            <div class="datatables-example-heading">
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table display nowrap table-bordered paiement_table_index">
                                                    <thead>
                                                        <tr>
                                                            <th>Date de paiement</th>
                                                            <th>Facture</th>
                                                            <th>Client</th>
                                                            <th>Montant Payé</th>
                                                            <th>Réste a payé</th>
                                                            <th>Methode</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($paiements as $paiement)
                                                            <tr>

                                                                <td>{{ $paiement->date }}</td>

                                                                <td>

                                                                    <a href="{{ route('factures.update', ['id' => $paiement->facture->id, 'devis_id' => $paiement->facture->ordres[0]->devis->id]) }}"
                                                                        target="_blank"
                                                                        style="text-decoration: underline;"
                                                                        class="text-primary"><b>{{ $paiement->facture->numero }}</b>
                                                                    </a>

                                                                </td>
                                                                <td>
                                                                    {{ $paiement->facture->ordres[0]->devis->dossier->client->nom }}
                                                                </td>
                                                                <td>
                                                                    {{ $paiement->montant }}
                                                                </td>
                                                                <td>{{ $paiement->facture->facture_solde }}</td>
                                                                <td> {{ $paiement->method }}</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn btn-options btn-success dropdown-toggle"
                                                                            type="button" data-toggle="dropdown"
                                                                            aria-haspopup="true" aria-expanded="false"
                                                                            style="margin-left:20px">
                                                                            Options <i
                                                                                class="fa-solid fa-circle-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu pull-right"
                                                                            aria-labelledby="dropdownMenuButton">
                                                                            <ul class="list-group">
                                                                                <a
                                                                                    href="{{ route('factures.update', ['id' => $paiement->facture->id, 'devis_id' => $paiement->facture->ordres[0]->devis->id]) }}">
                                                                                    <li class="list-group-item"><i
                                                                                            class="fa fa-file"
                                                                                            style="margin-right:5px"></i>
                                                                                        Facture </li>
                                                                                </a>
                                                                                <a href="#" data-toggle="modal"
                                                                                    @if ($paiement->facture->status == 'etablir' || $paiement->facture->status == 'envoye') data-target="#update"
                                                    @elseif($paiement->facture->status == 'paye' || $paiement->facture->status == 'annuler')
                                                    data-target="#paye" @endif
                                                                                    class="update_button"
                                                                                    data-id="{{ $paiement->id }}">
                                                                                    <li class="list-group-item"><i
                                                                                            class="fa fa-pen"
                                                                                            style="margin-right:5px"></i>
                                                                                        Modifier </li>
                                                                                </a>
                                                                                <a href="#">
                                                                                    <li class="list-group-item"
                                                                                        style="cursor:pointer"><i
                                                                                            class="fa-solid fa-trash"
                                                                                            style="margin-right:5px;"></i>Supprimer
                                                                                    </li>
                                                                                </a>


                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="update_folder" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Modifier le
                        dossier</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update_dossier">

                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Choisir
                                l'entreprise</label>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="submit_dossier"
                            onclick="update_dossier()">Modifier le
                            dossier</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="add_devis" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Créer un devis
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>

                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Choisir
                                l'entreprise</label>
                            <div class="col-md-8">
                                <select class="js-example-basic-single js-states form-control"style="width: 100%"
                                    id="entreprise_id" required>
                                    @foreach ($entreprises as $entreprise)
                                        <option value="{{ $entreprise->id }}" style="float:left">
                                            {{ $entreprise->nom }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">
                                Type devis
                            </label>
                            <div class="col-md-8">
                                <select class="js-example-basic-single js-states form-control"style="width: 100%"
                                    id="type" required>
                                    <option value="import" style="float:left">
                                        Import</option>
                                    <option value="export" style="float:left">
                                        Export</option>
                                    <option value="import_export" style="float:left">
                                        Import/Export</option>
                                </select>
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Choisir la
                                Date</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" id="date_devis">

                            </div>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="submit_devis" onclick="add_devis()">Créer Le
                            devis</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<script scr="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
<script>
    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    function update_dossier() {
        $('#submit_dossier').attr('disabled', 'disabled');
        $('.erreur').empty()
        var entreprise_id = jQuery('#entreprise_id').val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/updatestoredossiers') }}/" + '{{ $dossier->id }}',
            method: 'post',
            data: {
                entreprise_id: entreprise_id,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {

                    $('#submit_dossier').removeAttr('disabled');

                    if (result.error.entreprise_id) {
                        error_message(result.error.entreprise_id[0], "#entreprise_id")
                    }

                } else if (result == 200) {

                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Dossier modifié avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })

                    setTimeout(function() {

                        location.reload(true);
                    }, 1000);

                }


            }
        });

    }

    function add_devis() {
        $('#submit_devis').attr('disabled', 'disabled');
        $('.erreur').empty()
        var entreprise_id = jQuery('#entreprise_id').val()
        var type = jQuery('#type').val()


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/storedevis') }}/" + '{{ $dossier->id }}',
            method: 'post',
            data: {
                entreprise_id: entreprise_id,
                type: type,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {

                    $('#submit_devis').removeAttr('disabled');

                    if (result.error.date) {
                        error_message(result.error.date[0], "#date_devis")
                    }

                } else if (result.success_id) {


                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Devis ajouté avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })

                    setTimeout(function() {

                        window.location.href = "{{ url('/editdevis') }}/" + result.success_id

                    }, 1000);


                }


            }
        });



    }
</script>
