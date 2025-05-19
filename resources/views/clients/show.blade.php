@extends('layouts.app')

@section('content')
    <?php
    function replace($montant)
    {
        $montant = str_replace('.', ',', $montant);
        return $montant;
    }
    ?>
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row ">
                    <div class="col-md-8">
                        <h3>Détail client</h3>
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
                                            class="adddevis_button" data-id="{{ $client->id }}">

                                            <li class="list-group-item">


                                                <i class="fa-solid fa-file-export" style="margin-right:5px">

                                                </i>Créer un devis

                                            </li>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#add_facture"
                                            class="addfacture_button" data-id="{{ $client->id }}">

                                            <li class="list-group-item">


                                                <i class="fa-solid fa-file-circle-check" style="margin-right:5px">

                                                </i>Créer une facture

                                            </li>
                                        </a>
                                    </ul>
                                </div>
                            </div>







                            {{-- <div class="dropdown">
                                <button class="btn btn-options  btn-success dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="margin-left:20px">
                                    Options <i class="fa-solid fa-circle-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                    <ul class="list-group">
                                        <a href="{{ route('clients.update', ['id' => $client->id]) }}">
                                            <li class="list-group-item"><i class="fa fa-pen" style="margin-right:5px"></i>
                                                Modifier </li>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#devis_modal"
                                            class="adddevis_button" data-id="{{ $client->id }}">

                                            <li class="list-group-item">


                                                <i class="fa-solid fa-file-export" style="margin-right:5px">

                                                </i>Créer un devis

                                            </li>
                                        </a>

                                        <a href="#" data-toggle="modal" data-target="#devis_ordre"
                                            class="addordre_button" data-id="{{ $client->id }}">

                                            <li class="list-group-item">


                                                <i class="fa-solid fa-truck-fast" style="margin-right:5px"></i>

                                                Créer un ordre de travail

                                            </li>
                                        </a>

                                        <a href="#" data-toggle="modal" data-target="#facture"
                                            class="addfacture_button" data-id="{{ $client->id }}">
                                            <li class="list-group-item"><i class="fa-solid fa-file-circle-check"
                                                    style="margin-right:5px"></i>Créer une facture</li>
                                        </a>

                                        <a href="#" data-toggle="modal" data-target="#addpaiement"
                                            class="addpaiement_button" data-id="{{ $client->id }}">
                                            <li class="list-group-item"><i class="fa-solid fa-credit-card"
                                                    style="margin-right:5px"></i>Payer une facture</li>
                                        </a>


                                    </ul>
                                </div>
                            </div> --}}

                            <a href="#" data-toggle="modal" data-target="#fichiers">
                                <button type="button" class="btn btn-info "><i
                                        class="fa-solid fa-file"></i>Fichiers</button></a>
                            <a href="{{ url()->previous() }} "><button type="button" class="btn btn-warning btn_retour"
                                    style=" margin-left: 120px;
"><i class="fa-solid fa-backward"></i>Retour</button></a>




                        </div>


                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- End Breadcromb Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-box">
                <div class="tabs-example">

                    <div class="tabs-box-example horizontal-tab-example">
                        <ul class="nav nav-tabs" id="service_pro" role="tablist">

                            <li role="presentation" class="active"><a href="#details" role="tab"
                                    data-toggle="tab">Détails</a></li>

                            <li role="devis"><a href="#devis" role="tab" data-toggle="tab">Devis</a></li>
                            <li role="interventions"><a href="#interventions" role="tab"
                                    data-toggle="tab">Interventions</a>
                            </li>
                            <li role="factures"><a href="#factures" role="tab" data-toggle="tab">Factures</a>
                            </li>
                            <li role="paiements"><a href="#paiements" role="tab" data-toggle="tab">Paiements</a>
                            </li>
                        </ul>

                        <!-- Profile Row Start -->
                        <div id="seipkkon_tab_content" class="tab-content">

                            <div id="details" class="tab-pane fade in active">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="profile-left">
                                            <div class="widget_card_page profile-box header_bg_blue">
                                                <div class="profile-widget-img">
                                                    @if ($client->photo != null)
                                                        <img src="{{ asset('assets/img/' . $client->photo) }}"
                                                            alt="profile" style="width: 135px;height: 120px;" />
                                                    @else
                                                        <img src="{{ asset('assets/img/user.png') }}" alt="profile"
                                                            style="width: 135px;height: 120px;" />
                                                    @endif

                                                </div>
                                                <div class="profile-widget-info">
                                                    <h3>{{ $client->nom }}@if ($client->type == 'sans_taxe')
                                                            <span
                                                                style="font-size: 14px; color: #A93226;text-transform: initial;">(
                                                                exonéré)</span>
                                                        @elseif($client->type == 'avec_taxe')
                                                            <span
                                                                style="font-size: 14px; color: #145A32;text-transform: initial;">(surtaxé)</span>
                                                        @endif
                                                    </h3>


                                                    <p>
                                                        <span class="livraison-label">Total ttc :</span>
                                                        {{ replace(sprintf('%.3f', $client->total)) }}DT
                                                    </p>
                                                    <p>
                                                        <span class="livraison-label">Total payé :
                                                        </span>{{ replace(sprintf('%.3f', $client->paye_total)) }}DT
                                                    </p>
                                                    <p>
                                                        <span class="livraison-label">Solde réstant
                                                            :</span>{{ replace(sprintf('%.3f', $client->solde)) }} DT
                                                    </p>
                                                    <p>
                                                        <span
                                                            style="color:{{ $client->categorie->couleur }};font-size:14px"><b>{{ $client->categorie->nom }}({{ $client->categorie->montant }}
                                                                TND)</b></span>
                                                    </p>

                                                </div>

                                                <div class="text-center profile-widget-social">
                                                    <a href="{{ route('clients.update', ['id' => $client->id]) }}">
                                                        Modifier
                                                        le
                                                        client <i class="fa fa-pencil"></i></a>
                                                </div>
                                            </div>
                                            <!-- End Widget Card -->
                                            <div class="profile-bio">


                                                <div class="single-profile-bio">
                                                    <h3>Info générales</h3>

                                                    <ul class="work_history">
                                                        <li>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table_info"
                                                                    style="text-align:center">
                                                                    <tr>

                                                                        <th>Téléphone :</th>
                                                                        <td class="data">{{ $client->telephone }}</td>
                                                                        <th>Email :</th>
                                                                        <td class="data">{{ $client->email }}</td>
                                                                        <th>Raison Social :</th>
                                                                        <td class="data">{{ $client->raison_social }}
                                                                        </td>

                                                                    </tr>
                                                                    <tr>

                                                                        <th>Mf :</th>
                                                                        <td class="data">{{ $client->mf }}</td>
                                                                        <th>Rne :</th>
                                                                        <td class="data">{{ $client->rne }}</td>
                                                                        <th>Date d'ajout :</th>
                                                                        <td class="data">{{ $client->created_at }}</td>

                                                                    </tr>

                                                                    <tr>

                                                                        <th>Code postal :</th>
                                                                        <td class="data">{{ $client->code_postal }}</td>
                                                                        <th>Fax :</th>
                                                                        <td class="data">{{ $client->fax }}</td>
                                                                        <th>Site Web :</th>
                                                                        <td class="data">{{ $client->web }}</td>

                                                                    </tr>



                                                                </table>
                                                                {{-- <h4>Adresse</h4>
                                                            <p>{{$client->adresse}}</p> --}}
                                                            </div>
                                                        </li>

                                                    </ul>
                                                    {{-- @if (count($client->files) > 0)
                                                <table class="table table-bordered" style="width:50%;margin-top:10px">
                                                    <thead>
                                                        <tr>
                                                            <th class="th-livraison">
                                                                Fichier
                                                            </th>
                                                            <th class="th-livraison">
                                                                Action
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($client->files as $file)
                                                            <tr>
                                                                <td class="livraison">
                                                                    <input type="hidden" name="files_ids[]"
                                                                        value="{{ $file->id }}" />
                                                                    {{ $file->file }}
                                                                </td>
                                                                <td class="livraison">
                                                                    <a
                                                                        href="{{ route('clients.downloadfile', ['id' => $file->file]) }}">
                                                                        <i class="fa-solid fa-download text-success"
                                                                            style="font-size:15px"></i>
                                                                    </a>

                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>


                                                </table>
                                            @endif --}}
                                                    <div class="single-profile-bio">
                                                        <h3>Autre contact</h3>
                                                        <table class="table table-bordered table_info"
                                                            style="text-align:center">
                                                            <tr>
                                                                <th>Nom :</th>
                                                                <th>Poste :</th>
                                                                <th>Téléphone :</th>
                                                                <th>Autre telephone :</th>
                                                                <th>Email :</th>
                                                                </td>

                                                            </tr>
                                                            @foreach ($client->contacts as $contact)
                                                                <tr>

                                                                    <td class="data">{{ $contact->nom }}</td>
                                                                    <td class="data">{{ $contact->poste }}</td>
                                                                    <td class="data">{{ $contact->telephone }}</td>
                                                                    <td class="data">{{ $contact->fixe }}</td>
                                                                    <td class="data">{{ $contact->email }}</td>

                                                                </tr>
                                                            @endforeach




                                                        </table>
                                                    </div>
                                                    <div class="single-profile-bio">
                                                        <h3>Adresse du client</h3>
                                                        <p>
                                                            {{ $client->adresse }}
                                                        </p>
                                                        <p>
                                                            {{-- <b>Code postal </b> ({{$client->code_postal}}) --}}
                                                        </p>
                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                            <div id="devis" class="tab-pane fade in ">
                                <div class="row">


                                    <div class="col-md-12">
                                        <div class="page-box">
                                            <div class="datatables-example-heading">
                                            </div>
                                            <div class="table-responsive">
                                                <div class="filter-select">
                                                    <select class="form-control status-dropdown" style="width:200px">
                                                        <option value="">Tous </option>
                                                        <option value="En cours">en cours</option>
                                                        <option value="Valide">Valide</option>
                                                        <option value="Converti en facture">Converti en facture</option>

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
                                                        @foreach ($client->devis as $devis)
                                                            <tr>
                                                                <td><a href="{{ route('devis.update', ['id' => $devis->id]) }}"
                                                                        target="_blank"
                                                                        style="text-decoration: underline;"
                                                                        class="text-success"><b>{{ $devis->numero }}</b>
                                                                    </a> </td>

                                                                <td>
                                                                    <a href="{{ route('clients.show', ['id' => $devis->client->id]) }}"
                                                                        target="_blank"
                                                                        style="text-decoration: underline;"
                                                                        class="text-primary"><b>{{ $devis->client->nom }}
                                                                            {{ $devis->client->prenom }}</b> </a>

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
                                                                   @elseif($devis->status == 'converti_facture' && $devis->facture)
                                                                        <a href="{{ route('factures.update', ['id' => $devis->facture->id]) }}"
                                                                            target="_blank"
                                                                            style="text-decoration: underline;"
                                                                            class="text-success"><b>Converti en facture</b>
                                                                        </a>
                                                                    @elseif($devis->status == 'converti_facture')
                                                                        <span class="badge badge-success">Converti en facture</span>
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

                                                        @foreach ($client->factures as $facture)
                                                            <tr>

                                                                <td><a href="{{ route('factures.update', ['id' => $facture->id]) }}"
                                                                        target="_blank"
                                                                        style="text-decoration: underline;"
                                                                        class="text-success"><b>{{ $facture->numero }}</b>
                                                                    </a> </td>
                                                                <td>
                                                                    {{ $facture->client->nom }}
                                                                </td>

                                                                <td>{{ $facture->entreprise->nom }}</td>
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
                                                                                    href="{{ route('factures.update', ['id' => $facture->id]) }}">
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
                            <div id="interventions" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="page-box">
                                            <div class="datatables-example-heading">
                                            </div>
                                            <div class="table-responsive advance-table">
                                                <table id="responsive_datatables_example"
                                                    class="table display table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Numero </th>
                                                            <th>Date</th>
                                                            <th>Client</th>
                                                            <th>intervention</th>
                                                            <th>Intervenant</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($client->interventions as $intervention)
                                                            <tr>

                                                                <td><a href="#" target="_blank"
                                                                        style="text-decoration: underline;"
                                                                        class="text-success"><b>{{ $intervention->numero }}</b>
                                                                    </a> </td>
                                                                <td>{{ $intervention->date }}</td>
                                                                <td>
                                                                    <a href="{{ route('clients.show', ['id' => $intervention->client->id]) }}"
                                                                        target="_blank"
                                                                        style="text-decoration: underline;"
                                                                        class="text-primary"><b>{{ $intervention->client->nom }}
                                                                        </b> </a>

                                                                </td>
                                                                <td>{{ $intervention->entreprise->nom }}</td>
                                                                <td>{{ $intervention->intervenant }}</td>

                                                                <td style="text-align:left">
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
                                                                                    href="{{ route('interventions.print', ['id' => $intervention->id]) }}">
                                                                                    <li class="list-group-item"><i
                                                                                            class="fa fa-file"
                                                                                            style="margin-right:5px"></i>
                                                                                        PDF </li>
                                                                                </a>
                                                                                <a
                                                                                    href="{{ route('interventions.update', ['id' => $intervention->id]) }}">
                                                                                    <li class="list-group-item"><i
                                                                                            class="fa fa-pen"
                                                                                            style="margin-right:5px"></i>
                                                                                        Modifier </li>
                                                                                </a>
                                                                                <a href="#"
                                                                                    onclick="deleteintervention({{ $intervention->id }})">
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
                                                            {{-- <th>Status_Facture</th> --}}
                                                            <th>Client</th>
                                                            <th>Montant Payé</th>
                                                            {{-- <th>Réste a payé</th> --}}
                                                            <th>Methode</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($client->factures as $facture)
                                                            @foreach ($facture->paiements as $paiement)
                                                                <tr>

                                                                    <td>{{ $paiement->date }}</td>
                                                                    <td>
                                                                        <a href="{{ route('factures.update', ['id' => $paiement->facture->id]) }}"
                                                                            target="_blank"
                                                                            style="text-decoration: underline;"
                                                                            class="text-primary"><b>{{ $paiement->facture->numero }}</b>
                                                                        </a>

                                                                    </td>
                                                                    {{-- <td>

                                        @if ($paiement->facture->status == 'paye')
                                            <span class="badge badge-success">Facture payé</span>
                                        @elseif($paiement->facture->status == 'annuler')
                                            <span class="badge badge-error">Facture annulé</span>
                                        @elseif($paiement->facture->status == 'envoye')
                                            <span class="badge badge-info">Facture envoyé</span>
                                        @elseif($paiement->facture->status == 'etablir')
                                            <span class="badge">Facture en cours</span>
                                        @elseif($paiement->facture->status == 'paye_partielle')
                                            <span class="badge badge-warning">Facture payé partiellement</span>
                                        @endif

                                    </td> --}}
                                                                    <td>
                                                                        {{ $paiement->facture->client->nom }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $paiement->montant }}
                                                                    </td>
                                                                    {{-- <td>{{ $paiement->facture->facture_solde }}</td> --}}
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
                                                                                    <a href="#">
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
                                                                                    <a href="#"
                                                                                        onclick="deletepaiement({{ $paiement->id }})">
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
    </div>
    {{-- devismodal --}}
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
                <form id="adddevis">

                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Choisir
                                l'entreprise</label>
                            <div class="col-md-8">
                                <input type="hidden" id="client_id" />
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
                        <button type="submit" class="btn btn-primary" id="submit_devis">Créer Le
                            devis</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- facturemodal --}}
    <div class="modal fade" id="add_facture" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Créer une
                        Facture</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addfacture">

                    <div class="modal-body">

                        <div class="form-group row">
                            <label for='inputPassword' class='col-md-4 col-form-label'>Choisir l'entreprise</label>
                            <div class='col-md-8'>
                                <input type="hidden" id="client_id_facture" />
                                <select class="js-example-basic-single js-states form-control"style="width: 100%"
                                    id="entreprise_id">
                                    @foreach ($entreprises as $entreprise)
                                        <option value="{{ $entreprise->id }}" style="float:left">
                                            {{ $entreprise->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="erreurr_existe">

                                </div>


                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="submit_factures">Valider
                            la
                            facture</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal fade" id="fichiers" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Les fichiers du client
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>

                    <div class="modal-body">
                        @if (count($client->files) > 0)
                            <table class="table table-bordered" style="margin-top:10px">
                                <thead>
                                    <tr>
                                        <th class="th-livraison">
                                            Fichier
                                        </th>
                                        <th class="th-livraison">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($client->files as $file)
                                        <tr>
                                            <td class="livraison">
                                                <input type="hidden" name="files_ids[]" value="{{ $file->id }}" />
                                                {{ $file->file }}
                                            </td>
                                            <td class="livraison">
                                                <a href="{{ route('clients.downloadfile', ['id' => $file->file]) }}">
                                                    <i class="fa-solid fa-download text-success"
                                                        style="font-size:15px"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>


                            </table>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {

        //devis

        $('.adddevis_button').click(function() {
            var id = $(this).data('id');
            $('#client_id').val(id)
        });
        $('.addfacture_button').click(function() {
            var id = $(this).data('id');
            $('#client_id_facture').val(id)
        });
    });
</script>
<script>
    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }


    $(document).ready(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        })

        $('#adddevis').submit(function(e) {
            $('#submit_devis').attr('disabled', 'disabled');
            $('.erreur').empty()
            var client_id = jQuery('#client_id').val()
            var type = jQuery('#type').val()
            var entreprise_id = jQuery('#entreprise_id').val()

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/adddevis') }}",
                method: 'post',
                data: {
                    entreprise_id: entreprise_id,
                    client_id: client_id,
                    type: type,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    if (result.error) {

                        $('#submit_devis').removeAttr('disabled');

                        if (result.error.entreprise_id) {
                            error_message(result.error.entreprise_id[0], "#entreprise_id")
                        }
                        if (result.error.date) {
                            error_message(result.error.date[0], "#date_devis")
                        }


                    } else if (result.success_id) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Devis crée avec succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })

                        setTimeout(function() {

                            window.location.href = "{{ url('/editdevis') }}/" +
                                result
                                .success_id;

                        }, 1000);
                    }

                }
            });
        });

        $('#addfacture').submit(function(e) {
            $('#submit_factures').attr('disabled', 'disabled');
            $('.erreur').empty()

            var client_id = jQuery('#client_id_facture').val()
            var entreprise_id = jQuery('#entreprise_id').val()
            var type = "client"

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/addfactures') }}",
                method: 'post',
                data: {
                    entreprise_id: entreprise_id,
                    type: type,
                    client_id: client_id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    if (result.error) {

                        $('#submit_factures').removeAttr('disabled');

                        if (result.error.entreprise_id) {
                            error_message(result.error.entreprise_id[0], "#entreprise_id")
                        }


                    } else if (result.error_mf) {
                        $('#submit_factures').removeAttr('disabled');
                        error_message(result.error_mf, "#erreurr_existe")

                    } else if (result.success_id) {

                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Facture crée avec succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })

                        setTimeout(function() {

                            window.location.href = "{{ url('/updatefacture') }}/" +
                                result
                                .success_id;

                        }, 1000);

                    }

                }
            });


        });
        $('#addbonlivraisons').submit(function(e) {
            $('#submit_livraison').attr('disabled', 'disabled');
            $('.erreur').empty()
            var date_livraison = jQuery('#date_livraison').val()
            var ordre_id = jQuery('#ordre_id').val()
            var house_bl = jQuery('#house_bl').val()
            var master_bl = jQuery('#master_bl').val()

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/addbonlivraisons') }}",
                method: 'post',
                data: {
                    date_livraison: date_livraison,
                    ordre_id: ordre_id,
                    house_bl: house_bl,
                    master_bl: master_bl,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {


                    if (result.error) {


                        if (result.error.date_livraison) {
                            error_message(result.error.date_livraison[0], "#date_livraison")
                        }
                        if (result.error.ordre_id) {
                            error_message(result.error.ordre_id[0], "#ordre_id")
                        }
                        if (result.error.house_bl) {
                            error_message(result.error.house_bl[0], "#house_bl")
                        }
                        if (result.error.master_bl) {
                            error_message(result.error.master_bl[0], "#master_bl")
                        }


                    } else if (result.success_id) {


                        window.location.href = "{{ url('/updatebonlivraisons') }}/" +
                            result.success_id;



                    }

                }
            });



        });


    });
</script>
