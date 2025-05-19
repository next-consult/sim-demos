@extends('layouts.app')

@section('content')
    <?php
    $moy_step1 = \App\Models\Oportunity::where('step', 'step1')->sum('expected_revenue');
    $moy_step2 = \App\Models\Oportunity::where('step', 'step2')->sum('expected_revenue');
    $moy_step3 = \App\Models\Oportunity::where('step', 'step3')->sum('expected_revenue');
    $moy_step4 = \App\Models\Oportunity::where('step', 'step4')->sum('expected_revenue');
    
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="seipkon-breadcromb-left">
                            <h3> CRM </h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 step">
                <div class="breadcromb-area" style="  background: #641E16;">
                    <div class="seipkon-breadcromb-left">
                        <h3 style="color:#ECF0F1;font-size: 16px;">En attente<span
                                style="font-size:14px;margin-left:10px">({{ $moy_step1 }} DT )</span><span
                                data-toggle="modal" style="float:right;cursor:pointer" data-target="#new_opportunite"
                                onclick="add_opportunite('step1')"> +</span></h3>
                    </div>
                </div>
                @foreach ($oportunitys as $opp)
                    @if ($opp->step == 'step1')
                        <div class="breadcromb-area step-black">
                            <div class="seipkon-breadcromb-left div-opp">
                                <span class="options dropdown">
                                    <a class="dropdown-toggle profile-toggle" href="#" data-toggle="dropdown">
                                        <div class="profile-avatar-txt">
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </a>
                                    <div class="profile-box dropdown-menu animated bounceIn">
                                        <ul>
                                            <li><a href="#" data-toggle="modal" data-target="#update_opportunite"
                                                    class="update-click" data-id="{{ $opp->id }}"><i
                                                        class="fa fa-pencil-square"></i>
                                                    Modifier</a>
                                            </li>
                                            <li><a href="#" onclick="deleteopportunite({{ $opp->id }})"><i
                                                        class="fa fa-trash"></i> Supprimer</a></li>
                                            <li><a href="#" class="plan-button" data-id="{{ $opp->id }}"
                                                    data-toggle="modal" data-target="#add_event"><i class="fa fa-phone"></i>
                                                    Plannifier une
                                                    réunion</a>
                                            </li>

                                        </ul>
                                    </div>
                                </span>
                                <p class="titre-oppor"> <b>{{ $opp->titre }} </b></p>
                                <p class="nom-client-oppor">{{ $opp->nom }} </p>
                                <p>{{ $opp->email }} </p>
                                <p>{{ $opp->telephone }} </p>
                                <p class="price">{{ $opp->expected_revenue }} DT</p>
                                <a href="#"><img class="right-arrow" src='assets/img/right_arrow.png'
                                        data-id="{{ $opp->id }}" data-step="1" /></a>
                                @if (count($opp->reunions) > 0)
                                    <a href="#" class="text-primary detail-reunion" data-id="{{ $opp->id }}"
                                        data-toggle="modal" data-target="#show_reuinons"> <i class="fa fa-phone"
                                            style="font-size:20px"></i> </a>
                                    <a href="#" class="file-opp" data-id="{{ $opp->id }}"
                                        style="margin-left:5px" data-toggle="modal" data-target="#files-opp"> <i
                                            class="fa fa-file" style="font-size:20px"></i> </a>
                                @else
                                    <p class="text-danger">Il n'y a pas des réunions <a href="#" class="file-opp"
                                            data-id="{{ $opp->id }}" style="margin-left:5px" data-toggle="modal"
                                            data-target="#files-opp">
                                            <i class="fa fa-file" style="font-size:20px;color:#627077"></i> </a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="col-md-4 step">
                <div class="breadcromb-area" style="background: #566573;">
                    <div class="seipkon-breadcromb-left">
                        <h3 style="color:#ECF0F1;font-size: 16px;"> Opportunité <span
                                style="margin-left:10px;font-size:14px">({{ $moy_step2 }} DT)</span><span
                                data-toggle="modal" data-target="#new_opportunite" style="float:right;cursor:pointer;"
                                onclick="add_opportunite('step2')">+</span></h3>

                    </div>
                </div>
                <ul class="sortable">

                    @foreach ($oportunitys as $opp)
                        @if ($opp->step == 'step2')
                            <li class="ui-state-default">
                                <div class="breadcromb-area step-black">
                                    <div class="seipkon-breadcromb-left div-opp">
                                        <span class="options dropdown">
                                            <a class="dropdown-toggle profile-toggle" href="#" data-toggle="dropdown">
                                                <div class="profile-avatar-txt">
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </a>
                                            <div class="profile-box dropdown-menu animated bounceIn">
                                                <ul>
                                                    <li><a href="#" data-toggle="modal"
                                                            data-target="#update_opportunite" class="update-click"
                                                            data-id="{{ $opp->id }}"><i
                                                                class="fa fa-pencil-square"></i>
                                                            Modifier</a>
                                                    </li>
                                                    <li><a href="#"
                                                            onclick="deleteopportunite({{ $opp->id }})"><i
                                                                class="fa fa-trash"></i> Supprimer</a></li>
													    <li><a href="#" onclick="create_devis({{ $opp->id }})"><i
                                                                class="fa fa-file"></i>
                                                            Créer un devis</a>
                                                    </li>
                                                    <li><a href="#" class="plan-button"
                                                            data-id="{{ $opp->id }}" data-toggle="modal"
                                                            data-target="#add_event" data-id="{{ $opp->id }}"><i
                                                                class="fa fa-phone"></i>
                                                            Plannifier une
                                                            réunion</a>
                                                    </li>
													
                                                    <li><a href="#" class="disable-button"
                                                            data-id="{{ $opp->id }}"><i
                                                                class="fa-solid fa-xmark"></i>
                                                            Mettre en attente</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </span>
                                        <p class="titre-oppor"> <b>{{ $opp->titre }} </b> </p>
                                        <p class="nom-client-oppor">{{ $opp->nom }} </p>
                                        <p>{{ $opp->email }} </p>
                                        <p>{{ $opp->telephone }} </p>
                                        <p class="price">{{ $opp->expected_revenue }} DT</p>

                                        <a href="#"><img class="right-arrow" src='assets/img/right_arrow.png'
                                                data-id="{{ $opp->id }}" data-step="2" /></a>

   									@if (count($opp->reunions) > 0)
                                            <a href="#" class="text-primary detail-reunion"
                                                data-id="{{ $opp->id }}" data-toggle="modal"
                                                data-target="#show_reuinons"> <i class="fa fa-phone"
                                                    style="font-size:20px"></i> </a>
                                            <a href="#" class="file-opp" data-id="{{ $opp->id }}"
                                                style="margin-left:5px" data-toggle="modal" data-target="#files-opp"> <i
                                                    class="fa fa-file" style="font-size:20px"></i> </a>
                                        @else
                                            <p class="text-danger">Il n'y a pas des réunions <a href="#"
                                                    class="file-opp" data-id="{{ $opp->id }}"
                                                    style="margin-left:5px" data-toggle="modal" data-target="#files-opp">
                                                    <i class="fa fa-file" style="font-size:20px;color:#627077"></i> </a>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>

            </div>
            <div class="col-md-4 step">
                <div class="breadcromb-area" style="  background: #2874A6;">
                    <div class="seipkon-breadcromb-left">
                        <h3 style="color:#ECF0F1;font-size: 16px;">Qualifié <span
                                style="margin-left:10px;font-size:14px">({{ $moy_step3 }} DT)</span><span
                                data-toggle="modal" style="float:right;cursor:pointer" data-target="#new_opportunite"
                                onclick="add_opportunite('step3')">+</span></h3>
                    </div>
                </div>
                <ul class="sortable">
                    @foreach ($oportunitys as $opp)
                        @if ($opp->step == 'step3')
                            <li class="ui-state-default">

                                <div class="breadcromb-area step-black">
                                    <div class="seipkon-breadcromb-left div-opp">
                                        <span class="options dropdown">
                                            <a class="dropdown-toggle profile-toggle" href="#"
                                                data-toggle="dropdown">
                                                <div class="profile-avatar-txt">
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </a>
                                            <div class="profile-box dropdown-menu animated bounceIn">
                                                <ul>
                                                    <li><a href="#" data-toggle="modal"
                                                            data-target="#update_opportunite" class="update-click"
                                                            data-id="{{ $opp->id }}"><i
                                                                class="fa fa-pencil-square"></i>
                                                            Modifier</a>
                                                    </li>
                                                    <li><a href="#"
                                                            onclick="deleteopportunite({{ $opp->id }})"><i
                                                                class="fa fa-trash"></i> Supprimer</a></li>
                                                    <li><a href="#" class="plan-button" data-toggle="modal"
                                                            data-target="#add_event" data-id="{{ $opp->id }}"><i
                                                                class="fa fa-phone"></i>
                                                            Plannifier une
                                                            réunion</a>
                                                    </li>
                                                

                                                </ul>
                                            </div>
                                        </span>
                                        <p class="titre-oppor"> <b>{{ $opp->titre }} </b></p>
                                        <p class="nom-client-oppor">{{ $opp->nom }} </p>
                                        <p>{{ $opp->email }} </p>
                                        <p>{{ $opp->telephone }} </p>
                                        <p class="price">{{ $opp->expected_revenue }} DT</p>
                                   

                                        @if (count($opp->reunions) > 0)
                                            <a href="#" class="text-primary detail-reunion"
                                                data-id="{{ $opp->id }}" data-toggle="modal"
                                                data-target="#show_reuinons"> <i class="fa fa-phone"
                                                    style="font-size:20px"></i> </a>
                                            <a href="#" class="file-opp" data-id="{{ $opp->id }}"
                                                style="margin-left:5px" data-toggle="modal" data-target="#files-opp"> <i
                                                    class="fa fa-file" style="font-size:20px"></i> </a>
                                        @else
                                            <p class="text-danger">Il n'y a pas des réunions <a href="#"
                                                    class="file-opp" data-id="{{ $opp->id }}"
                                                    style="margin-left:5px" data-toggle="modal" data-target="#files-opp">
                                                    <i class="fa fa-file" style="font-size:20px;color:#627077"></i> </a>
                                            </p>
                                        @endif



                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            {{-- <div class="col-md-3 step">
                <div class="breadcromb-area" style="  background: #186A3B;">
                    <div class="seipkon-breadcromb-left">
                        <h3 style="color:#ECF0F1;font-size: 16px;">Vente <span
                                style="margin-left:10px;font-size:14px">({{ $moy_step4 }} DT)</span><span
                                data-toggle="modal" style="float:right;cursor:pointer" data-target="#new_opportunite"
                                onclick="add_opportunite('step4')">+</span></h3>
                    </div>
                </div>
                @foreach ($oportunitys as $opp)
                    @if ($opp->step == 'step4')
                        <div class="breadcromb-area step-black">
                            <div class="seipkon-breadcromb-left div-opp">
                                <span class="options dropdown">
                                    <a class="dropdown-toggle profile-toggle" href="#" data-toggle="dropdown">
                                        <div class="profile-avatar-txt">
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </a>
                                    <div class="profile-box dropdown-menu animated bounceIn">
                                        <ul>
                                            <li><a href="#" data-toggle="modal" data-target="#update_opportunite"
                                                    class="update-click" data-id="{{ $opp->id }}"><i
                                                        class="fa fa-pencil-square"></i>
                                                    Modifier</a>
                                            </li>
                                            <li><a href="#" onclick="deleteopportunite({{ $opp->id }})"><i
                                                        class="fa fa-trash"></i> Supprimer</a></li>
                                            <li><a href="#" class="plan-button" data-id="{{ $opp->id }}"
                                                    data-toggle="modal" data-target="#add_event"><i
                                                        class="fa fa-phone"></i>
                                                    Plannifier une
                                                    réunion</a>
                                            </li>
                                            <li><a href="#" onclick="create_facture({{ $opp->id }})"><i
                                                        class="fa fa-file"></i>
                                                    Créer une facture</a>
                                            </li>

                                        </ul>
                                    </div>
                                </span>
                                <p class="titre-oppor"> <b>{{ $opp->titre }} </b></p>
                                <p class="nom-client-oppor">{{ $opp->nom }} </p>
                                <p>{{ $opp->email }} </p>
                                <p>{{ $opp->telephone }} </p>
                                <p class="price">{{ $opp->expected_revenue }} DT</p>

                                @if (count($opp->reunions) > 0)
                                    <a href="#" class="text-primary detail-reunion" data-id="{{ $opp->id }}"
                                        data-toggle="modal" data-target="#show_reuinons"> <i class="fa fa-phone"
                                            style="font-size:20px"></i> </a>
                                    <a href="#" class="file-opp" data-id="{{ $opp->id }}"
                                        style="margin-left:5px" data-toggle="modal" data-target="#files-opp"> <i
                                            class="fa fa-file" style="font-size:20px"></i> </a>
                                @else
                                    <p class="text-danger">Il n'y a pas des réunions <a href="#" class="file-opp"
                                            data-id="{{ $opp->id }}" style="margin-left:5px" data-toggle="modal"
                                            data-target="#files-opp">
                                            <i class="fa fa-file" style="font-size:20px;color:#627077"></i> </a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div> --}}

        </div>
    </div>
    {{-- add opportunite --}}
    <div class="modal fade" id="new_opportunite" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Ajouter une opportunité</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Client / Contact<span
                                class="obligatoire">*</span> </label>
                        <div class="col-md-8">
                            <select class="js-example-basic-single js-states form-control calend "style="width: 100%"
                                id="client_id" onchange=change_client('add')>
                                @foreach ($contacts as $contact)
                                    <option value="{{ $contact->id }}" style="float:left">
                                        {{ $contact->nom }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Opportunité <span
                                class="obligatoire">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="opportunite" value="Opportunité">
                            <input type="hidden" class="form-control" id="etape-opportunie">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Email <span
                                class="obligatoire">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Telephone <span
                                class="obligatoire">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="telephone">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Revenu espéré <span
                                class="obligatoire">*</span></label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="revenu" value="0,000">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" id="add_opp" onclick="store()">Ajouter</button>
                </div>

            </div>
        </div>
    </div>



    {{-- update opportunite --}}
    <div class="modal fade" id="update_opportunite" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Modifier l'opportunité</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Client / Contact<span
                                class="obligatoire">*</span> </label>
                        <div class="col-md-8">
                            <select class="js-example-basic-single js-states form-control calend"style="width: 100%"
                                id="client_id_update" onchange=change_client('update')>
                                @foreach ($contacts as $contact)
                                    <option value="{{ $contact->id }}" style="float:left">
                                        {{ $contact->nom }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Opportunité <span
                                class="obligatoire">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="opportunite_update" value="Opportunité">
                            <input type="hidden" class="form-control" id="id-opportunie_update">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Email <span
                                class="obligatoire">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="email_update">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Telephone <span
                                class="obligatoire">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="telephone_update">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Revenu espéré <span
                                class="obligatoire">*</span></label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="revenu_update">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary" id="add_opp_update" onclick="store_update()">Modifier</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Add event -->
    <div class="modal fade" id="add_event" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            <input type="hidden" class="form-control" id="event-id">
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
                    <button class="btn btn-primary" id="add_event_button" onclick="add_event()">Ajouter</button>
                </div>


            </div>
        </div>
    </div>




    <!-- Sow event -->
    <div class="modal fade" id="show_reuinons" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Les détails du réunion</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id-opp" />
                    <table class="table" id="table-show">
                        <thead>
                            <tr>
                                <th scope="col">Date début</th>
                                <th scope="col">Date fin</th>
                                <th scope="col">Type</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Retour</button>
                </div>


            </div>
        </div>
    </div>



    <!-- Sow files -->
    <div class="modal fade" id="files-opp" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Les fichiers de l'opportunité
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id-opp" />
                    <table class="table" id="table-facture-show">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center">Numéro</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Retour</button>
                </div>


            </div>
        </div>
    </div>


    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/draggable/1.0.0-beta.12/draggable.min.js"
    integrity="sha512-VTqyB/kLQGaTnF5kYAgeEFo8fwqdlAGNUQeoQi4EOmmBYTEQ/XrYC7lnzCvBBp1PR+1ODEQiT075oeUdPeFHwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
{{-- <script>
    $(function() {
        $(".step-black").draggable({
            cursor: "move",
            revert: "invalid",
            helper: "clone"
        });
        $(".step-black").droppable({
            accept: ".breadcromb-area",
            drop: function(event, ui) {
                var draggable = ui.draggable;
                var droppable = $(this);

                console.log(droppable)
                console.log(draggable)

                var dragParent = draggable.parent();
                var dropParent = droppable.parent();
                var dropIndex = droppable.index();
                var dragIndex = draggable.index();
                if (dragIndex < dropIndex) {
                    droppable.after(draggable);
                } else {

                    droppable.before(draggable);
                }
            },
            
        });
    });
</script> --}}

<script>
    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    $(document).ready(function() {
        $('.disable-button').click(function() {
            var id_op = $(this).data('id')
            console.log(id_op)
            $('#id-opp').val(id_op)
            jQuery.ajax({
                url: "{{ url('/enattentestep') }}/" + id_op,
                method: 'get',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    if (result == 200) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Oportunité en attente',
                            showConfirmButton: false,
                            timer: 1000
                        })
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }

                }
            });

        })

        $('.detail-reunion').click(function() {
            var id_op = $(this).data('id')
            console.log(id_op)
            $('#id-opp').val(id_op)
            jQuery.ajax({
                url: "{{ url('/oneopportunite') }}/" + id_op,
                method: 'get',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    $("#table-show tbody").empty()
                    console.log(result.reunions)
                    var tableBody = $("#table-show tbody");
                    for (var i = 0; i < result.reunions.length; i++) {
                        var row = $("<tr>");
                        var start = $("<td>").text(moment(result.reunions[i].start).format(
                            'YYYY-MM-DD HH:mm'));
                        var end = $("<td>").text(moment(result.reunions[i].end).format(
                            'YYYY-MM-DD HH:mm'));
                        var type = $("<td>").text(result.reunions[i].type);
                        var action = $("<td>").append(
                            "<button class='btn btn-danger' onclick=(delete_event(" +
                            result.reunions[i].id + "))>Supprimer</button>");
                        row.append(start, end, type, action);
                        tableBody.append(row);
                    }

                }
            });

        })

        $('.file-opp').click(function() {
            var id_op = $(this).data('id')
            console.log(id_op)
            $('#id-opp').val(id_op)
            jQuery.ajax({
                url: "{{ url('/oneopportunite') }}/" + id_op,
                method: 'get',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    $("#table-facture-show tbody").empty()
                    console.log(result.facture)
                    var tableBody = $("#table-facture-show tbody");
                    for (var i = 0; i < result.devis.length; i++) {
                        var row = $("<tr>");
                        var numero = $("<td style='text-align:center'>").append(
                            "<a class='dev-num'><b >" +
                            result.devis[i].numero +
                            "</b></a>");
                        row.append(numero);
                        tableBody.append(row);
                        var myUrl = `editdevis/${result.devis[i].id}`;
                        $('.dev-num').attr('href', myUrl);
                    }
                    for (var i = 0; i < result.facture.length; i++) {
                        var row = $("<tr>");
                        var numero = $("<td style='text-align:center'>").append(
                            "<a class='dev-num'><b >" +
                            result.facture[i].numero +
                            "</b></a>");
                        row.append(numero);
                        tableBody.append(row);
                        var myUrl = `updatefacture/${result.facture[i].id}`;
                        $('.dev-num').attr('href', myUrl);
                    }

                }
            });

        })

        $('.update-click').click(function() {
            var id_op = $(this).data('id')
            $('#id-opportunie_update').val(id_op)
            jQuery.ajax({
                url: "{{ url('/oneopportunite') }}/" + id_op,
                method: 'get',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    console.log(result)
                    $('#opportunite_update').val(result.titre)
                    $('#email_update').val(result.email)
                    $('#telephone_update').val(result.telephone)
                    $('#revenu_update').val(parseFloat(result.expected_revenue))
                    $("#client_id_update option[value=" + result.contactcrm_id + "]").prop(
                        'selected', true)
                }
            });

        })

        $('.plan-button').click(function() {
            var id_op = $(this).data('id')

            var now = new Date();
            var date_now = moment(now).format('YYYY-MM-DDTHH:mm')
            var date_end = moment(now).add(30, 'minutes').format('YYYY-MM-DDTHH:mm')
            $('#date-event').val(date_now);
            $('#date_fin').val(date_end);
            $('#event-id').val(id_op)
        })
        change_client('add')
        $('.right-arrow').click(function() {
            var id = $(this).data('id');
            var step = $(this).data('step');
            jQuery.ajax({
                url: "{{ url('/rightchange') }}",
                method: 'post',
                data: {
                    id: id,
                    step: step,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    if (result == 200) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Oportunité Changé avecc succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }

                }
            });
        })
    });

    function store() {
        $('#add_opp').attr('disabled', 'disabled');
        $('.erreur').empty()
        var client_id = $('#client_id').val()
        var opportunite = $('#opportunite').val()
        var email = $('#email').val()
        var telephone = $('#telephone').val()
        var revenu = $('#revenu').val()
        var etape = $('#etape-opportunie').val()
        jQuery.ajax({
            url: "{{ url('/storecrm') }}",
            method: 'post',
            data: {
                etape: etape,
                client_id: client_id,
                opportunite: opportunite,
                email: email,
                telephone: telephone,
                revenu: revenu,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {

                    $('#add_opp').removeAttr('disabled');

                    if (result.error.client_id) {
                        error_message(result.error.client_id[0], "#client_id")
                    }
                    if (result.error.etape) {
                        error_message(result.error.etape[0], "#etape")
                    }
                    if (result.error.opportunite) {
                        error_message(result.error.opportunite[0], "#opportunite")
                    }
                    if (result.error.email) {
                        error_message(result.error.email[0], "#email")
                    }
                    if (result.error.revenu) {
                        error_message(result.error.revenu[0], "#revenu")
                    }
                    if (result.error.telephone) {
                        error_message(result.error.telephone[0], "#telephone")
                    }


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
            }
        });
    }

    function store_update() {

        $('#add_opp_update').attr('disabled', 'disabled');
        $('.erreur').empty()
        var client_id = $('#client_id_update').val()
        var opportunite = $('#opportunite_update').val()
        var email = $('#email_update').val()
        var telephone = $('#telephone_update').val()
        var revenu = $('#revenu_update').val()
        var etape = $('#etape-opportunie_update').val()
        var id = $("#id-opportunie_update").val()
        jQuery.ajax({
            url: "{{ url('/storeupdatecrm') }}/" + id,
            method: 'post',
            data: {
                etape: etape,
                client_id: client_id,
                opportunite: opportunite,
                email: email,
                telephone: telephone,
                revenu: revenu,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {

                    $('#add_opp').removeAttr('disabled');

                    if (result.error.client_id) {
                        error_message(result.error.client_id[0], "#client_id_update")
                    }
                    if (result.error.etape) {
                        error_message(result.error.etape[0], "#etape_update")
                    }
                    if (result.error.opportunite) {
                        error_message(result.error.opportunite[0], "#opportunite_update")
                    }
                    if (result.error.email) {
                        error_message(result.error.email[0], "#email_update")
                    }
                    if (result.error.revenu) {
                        error_message(result.error.revenu[0], "#revenu_update")
                    }
                    if (result.error.telephone) {
                        error_message(result.error.telephone[0], "#telephone_update")
                    }


                } else if (result == 200) {
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
            }
        });
    }

    function change_client(type) {
        $('.erreur').empty()

        if (type == "add") {
            var client_id = $('#client_id').val()

        } else {
            var client_id = $('#client_id_update').val()

        }
        var clients = {{ Js::from($contacts) }};
        var filteredArray = $.grep(clients, function(obj) {
            return obj.id == client_id;
        });
        if (type == "add") {
            $('#email').val(filteredArray[0].email)
            $('#telephone').val(filteredArray[0].telephone)

        } else {
            $('#email_update').val(filteredArray[0].email)
            $('#telephone_update').val(filteredArray[0].telephone)

        }

    }

    function add_opportunite(type) {
        $('.erreur').empty()

        $('#etape-opportunie').val(type)
        console.log($('#etape-opportunie').val())
    }

    function create_devis(opp_id) {
        jQuery.ajax({
            url: "{{ url('/createdevisopportunite') }}",
            method: 'post',
            data: {
                opp_id: opp_id,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                console.log(result)
                if (result.success_id) {

                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Devis ajouté avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })

                    setTimeout(function() {

                        window.location.href =
                            `editdevis/${result.success_id}`;

                    }, 1000);
                }
            }
        });

    }

    function create_facture(opp_id) {
        jQuery.ajax({
            url: "{{ url('/createfactureopportunite') }}",
            method: 'post',
            data: {
                opp_id: opp_id,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                console.log(result)
                if (result.success_id) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Facture ajouté avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })

                    setTimeout(function() {

                        window.location.href =
                            `updatefacture/${result.success_id}`;

                    }, 1000);

                }

            }
        });

    }

    function add_event() {
        $('.erreur').empty()
        $('#add_event_button').attr('disabled', 'disabled');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var opportunie_id = $('#event-id').val()
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
                    $('#add_event_button').removeAttr('disabled');
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
                    $('#add_event_button').removeAttr('disabled');
                    error_message("La date début doit etre supérieur ou égale a la date fin ", "#date_fin")
                } else if (result == 200) {

                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Réunion ajouté avecc succéss',
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
