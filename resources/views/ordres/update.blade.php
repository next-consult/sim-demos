@extends('layouts.app')

@section('content')
    <?php
    $camions_interne = \app\Models\Camion::where('type_camion', 'interne')->get();
    
    ?>
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-10">
                        <div class="seipkon-breadcromb-left">
                            <h3>Configurer les ordres de travail

                            </h3>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('ordres.index') }} "><button type="button" class="btn btn-warning btn_retour"
                                style=" margin-left: 120px;"><i class="fa-solid fa-backward"></i>Retour</button></a>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="breadcromb-area">
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="seipkon-breadcromb-left">
                                            <h3>
                                                <a href="{{ route('devis.update', ['id' => $devis->id]) }}" target="_blank"
                                                    style="text-decoration: underline;"
                                                    class="text-success"><b>{{ $devis->numero }}</b> </a>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-success " data-toggle="modal"
                                            data-target="#add">
                                            <i class="fa-solid fa-rotate"></i> Créer une facture
                                        </button>

                                        <div class="modal fade" id="add" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" style="float:left"
                                                            id="exampleModalLongTitle">Créer une
                                                            Facture</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form id="addfacture">

                                                        <div class="modal-body">

                                                            <div class="form-group row">
                                                                <label for="inputPassword"
                                                                    class="col-md-4 col-form-label">Choisir les
                                                                    ordres</label>
                                                                <div class="col-md-8">
                                                                    <select id="ordre_select" multiple="multiple"
                                                                        class="js-example-basic-single js-states form-control"style="width: 100%"
                                                                        required>
                                                                        {{-- {{$ordre->id == 3 ||  $ordre->id == 2 ? 'selected' : ''}}  --}}
                                                                        @foreach ($ordres as $ordre)
                                                                            <option value="{{ $ordre->id }}">
                                                                                {{ $ordre->items->adress_enlev }} ->
                                                                                {{ $ordre->items->adress_livraison }}({{ $ordre->numero }})
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            {{-- 
                                                            <div class="form-group row">
                                                                <label for="inputPassword"
                                                                    class="col-md-4 col-form-label">Choisir la
                                                                    Date</label>
                                                                <div class="col-md-8">
                                                                    <input type="date" class="form-control"
                                                                        id="date_facture">
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning"
                                                                data-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                id="submit_factures">Valider la facture</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tabs-box-example horizontal-tab-example">
                        <ul class="nav nav-tabs" id="service_pro" role="tablist">

                            @foreach ($devis->ordres as $key => $ordre)
                                <li role="ordres"
                                    @if ($previous == 'all') @if ($key == 0) class="active" @endif
                                @else @if ($ordre->id == $previous) class="active" @endif @endif> <a href="#ordre-{{ $ordre->id }}" role="tab"
                                        data-toggle="tab">{{ $ordre->numero }}</a>
                                </li>
                            @endforeach

                        </ul>
                        <div id="seipkkon_tab_content" class="tab-content">
                            @foreach ($devis->ordres as $key => $ordre)
                                <div id="ordre-{{ $ordre->id }}"
                                    class="tab-pane fade in @if ($previous == 'all') @if ($key == 0) active @endif
@else
@if ($ordre->id == $previous) active @endif @endif">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="breadcromb-area">
                                                <div class="row ">
                                                    <div class="col-md-8">
                                                        <div class="seipkon-breadcromb-left" style="margin-top: 10px;">
                                                            @if (count($ordre->factures) > 0)
                                                                <h4>
                                                                    <a href="{{ route('factures.update', ['id' => $ordre->factures[0]->id, 'devis_id' => $devis->id]) }}"
                                                                        target="_blank" style="text-decoration: underline;"
                                                                        class="text-info"><b>{{ $ordre->factures[0]->numero }}</b>
                                                                    </a>
                                                                </h4>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="btn-group" role="group" aria-label="Basic example"
                                                            id="btn_group">

                                                            @if (count($ordre->factures) == 0) <button
                                                                    type="button" class="btn btn-info "
                                                                    onclick="saveordre({{ $ordre->id }})">
                                                                    <i class="fa-solid fa-check"></i> Enregistrer l'ordre
                                                                </button>
                                                            @endif
                                                            <a href="{{ route('ordres.print', ['id' => $ordre->id]) }}"><button
                                                                    type="button" class="btn btn-success btn_mobile"
                                                                    style="margin-left:8px"><i
                                                                        class="fa-solid fa-download"></i>PDF</button></a>


                                                        </div>

                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="page-box">
                                                <div class="form-example">
                                                    <h3>Enlèvement</h3>
                                                    <div class="form-wrap label-left form-layout-page">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label">Adresse</label>
                                                                </div>
                                                                <div class="col-md-8">

                                                                    <span
                                                                        class="form-control disabled">{{ $ordre->items->adress_enlev }}</span>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label">Nom du contact</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <input type="text"
                                                                        @if (count($ordre->factures) > 0) disabled @endif
                                                                        placeholder="Enrer le nom du contact"
                                                                        class="form-control"
                                                                        name="nom_enlev_{{ $ordre->id }}"
                                                                        value="{{ $ordre->items->nom_enlev }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label">Tranche horaire</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <input type="date" class="form-control"
                                                                        @if (count($ordre->factures) > 0) disabled @endif
                                                                        name="date_enlev_{{ $ordre->id }}"
                                                                        value="{{ $ordre->items->date_enlev }}">

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="page-box">
                                                <div class="form-example">
                                                    <h3>Livraison</h3>
                                                    <div class="form-wrap label-left form-layout-page">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label">Adresse</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <span class="form-control disabled">{{ $ordre->items->adress_livraison }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label">Nom du contact</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <input type="text"
                                                                        @if (count($ordre->factures) > 0) disabled @endif
                                                                        placeholder="Enrer le nom du contact"
                                                                        class="form-control"
                                                                        value="{{ $ordre->items->nom_livraison }}"
                                                                        name="nom_livraison_{{ $ordre->id }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label">Horaire objectif</label>
                                                                </div>
                                                                <div class="col-md-8">

                                                                    <input type="date" class="form-control"
                                                                        @if (count($ordre->factures) > 0) disabled @endif
                                                                        name="date_livraison_{{ $ordre->id }}"
                                                                        value="{{ $ordre->items->date_livraison }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="page-box">
                                                <div class="form-example">
                                                    <h3>Marchandises a transporter</h3>
                                                    <div class="form-wrap label-left form-layout-page">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label">Nature</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <input type="text" placeholder="Nature"
                                                                        @if (count($ordre->factures) > 0) disabled @endif
                                                                        class="form-control"
                                                                        name="nature_{{ $ordre->id }}"
                                                                        value="{{ $ordre->items->nature }}">


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label">Poids</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <input type="text" placeholder="Poids"
                                                                        @if (count($ordre->factures) > 0) disabled @endif
                                                                        class="form-control"
                                                                        name="poids_{{ $ordre->id }}"
                                                                        value="{{ $ordre->items->poids }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label">Nombre de colis</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <input type="text" placeholder="Nombre de colis"
                                                                        class="form-control"
                                                                        @if (count($ordre->factures) > 0) disabled @endif
                                                                        name="nb_coliss_{{ $ordre->id }}"
                                                                        value="{{ $ordre->items->nb_coliss }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label">Volume</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <input type="text" placeholder="Volume"
                                                                        class="form-control"
                                                                        @if (count($ordre->factures) > 0) disabled @endif
                                                                        name="volume_{{ $ordre->id }}"
                                                                        value="{{ $ordre->items->volume }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="page-box">
                                                <div class="form-example">
                                                    <h3>informations complémentaires</h3>
                                                    <div class="form-wrap label-left form-layout-page">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label">Spécificités</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="form-gender">
                                                                        <div class="form-group form-radio">
                                                                            <input id="inflam_{{ $ordre->id }}"
                                                                                name="specif_{{ $ordre->id }}"
                                                                                @if (count($ordre->factures) > 0) disabled @endif
                                                                                type="radio" value="inflam"
                                                                                {{ $ordre->items->specif == 'inflam' ? 'checked' : '' }}>
                                                                            <label for="inflam_{{ $ordre->id }}"
                                                                                class="inline control-label">Inflamable</label>
                                                                        </div>
                                                                        <div class="form-group form-radio">
                                                                            <input name="specif_{{ $ordre->id }}"
                                                                                @if (count($ordre->factures) > 0) disabled @endif
                                                                                type="radio"
                                                                                id="fragile_{{ $ordre->id }}"
                                                                                value="fragile"
                                                                                {{ $ordre->items->specif == 'fragile' ? 'checked' : '' }}>
                                                                            <label for="fragile_{{ $ordre->id }}"
                                                                                class="inline control-label">Fragile</label>
                                                                        </div>
                                                                        <div class="form-group form-radio">
                                                                            <input id="autre_{{ $ordre->id }}"
                                                                                @if (count($ordre->factures) > 0) disabled @endif
                                                                                name="specif_{{ $ordre->id }}"
                                                                                type="radio" value="autre"
                                                                                {{ $ordre->items->specif != 'fragile' && $ordre->items->specif != 'inflam' ? 'checked' : '' }}>
                                                                            <label for="autre_{{ $ordre->id }}"
                                                                                class="inline control-label">Autre</label>
                                                                            <input type="text" placeholder="Autre:"
                                                                                class="form-control" id="autre_specif"
                                                                                @if (count($ordre->factures) > 0) disabled @endif
                                                                                style="display:none"
                                                                                name="autre_specif_{{ $ordre->id }}"
                                                                                value="@if ($ordre->items->specif != 'fragile' && $ordre->items->specif != 'inflam') {{ $ordre->items->specif }} @endif">


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label">N° dossier</label>
                                                                </div>
                                                                <div class="col-md-8">

                                                                    <span
                                                                        class="form-control disabled">{{ $ordre->items->no_dossier }}</span>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label">Remarques
                                                                        additionnelles</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <textarea placeholder="Remarques Additionnelles" class="form-control" style="height:97px"
                                                                        @if (count($ordre->factures) > 0) disabled @endif name="remarques_{{ $ordre->id }}">{{ $ordre->items->remarques }}</textarea>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="page-box">
                                                <div class="form-example">
                                                    <h3>Conditions transport
                                                    </h3>
                                                    <div class="form-wrap top-label-exapmple form-layout-page">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="control-label">Type chauffeur</label>
                                                                <div class="form-gender">
                                                                    <div class="form-group form-radio">
                                                                        <input id="interne_{{ $ordre->id }}"
                                                                            @if (count($ordre->factures) > 0) disabled @endif
                                                                            name="type_chauffeur_{{ $ordre->id }}"
                                                                            type="radio" value="interne"
                                                                            onchange="test_type($(this))"
                                                                            @if (($ordre->items->chauffeur && $ordre->items->chauffeur->type_chauffeur == 'interne') ||
                                                                                $ordre->items->chauffeur_id == null) checked @endif>
                                                                        <label for="interne_{{ $ordre->id }}"
                                                                            class="inline control-label">Interne</label>
                                                                    </div>
                                                                    <div class="form-group form-radio">
                                                                        <input name="type_chauffeur_{{ $ordre->id }}"
                                                                            @if (count($ordre->factures) > 0) disabled @endif
                                                                            type="radio"
                                                                            id="externe_{{ $ordre->id }}"
                                                                            value="externe" onchange="test_type($(this))"
                                                                            @if ($ordre->items->chauffeur && $ordre->items->chauffeur->type_chauffeur == 'externe') checked @endif>
                                                                        <label for="externe_{{ $ordre->id }}"
                                                                            class="inline control-label">Sou
                                                                            traitant</label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3" style="margin-top:5px">


                                                                <div class="form-group">
                                                                    <label class="control-label">Choisir le
                                                                        chauffeur</label>
                                                                    <select
                                                                        class="js-example-basic-single js-states form-control"style="width: 100%"
                                                                        id="chauffeur_id_{{ $ordre->id }}"
                                                                        name="chauffeur_id_{{ $ordre->id }}"
                                                                        onchange="change_camion({{ $ordre->id }})"
                                                                        @if (count($ordre->factures) > 0) disabled @endif>
                                                                        @foreach ($chauffeurs as $chauffeur)
                                                                            <option value="{{ $chauffeur->id }}"
                                                                                style="float:left"
                                                                                {{ $chauffeur->id == $ordre->items->chauffeur_id ? 'selected' : '' }}>
                                                                                {{ $chauffeur->nom }}
                                                                                {{ $chauffeur->prenom }}</option>
                                                                        @endforeach

                                                                    </select>


                                                                </div>
                                                            </div>
                                                            <div class="col-md-3" id="prix_achat_div_{{ $ordre->id }}"
                                                                @if ($ordre->items->chauffeur && $ordre->items->chauffeur->type_chauffeur == 'interne') style="display:none" @endif>
                                                                <div class="form-group">
                                                                    <label class="control-label">Prix achat</label>
                                                                    <input type="number" placeholder="Prix achat"
                                                                        @if (count($ordre->factures) > 0) disabled @endif
                                                                        class="form-control"
                                                                        name="prix_achat_{{ $ordre->id }}"
                                                                        value="{{ $ordre->items->prix_achat }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3" id="prix_vente_div_{{ $ordre->id }}"
                                                                @if ($ordre->items->chauffeur && $ordre->items->chauffeur->type_chauffeur == 'interne') style="display:none" @endif>
                                                                <div class="form-group">
                                                                    <label class="control-label">Prix vente</label>
                                                                    <input type="number" placeholder="Prix vente"
                                                                        @if (count($ordre->factures) > 0) disabled @endif
                                                                        class="form-control"
                                                                        name="prix_vente_{{ $ordre->id }}"
                                                                        value="{{ $ordre->items->prix_vente }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3" style="margin-top:5px">
                                                                <div class="form-group">
                                                                    <label class="control-label">Choisir la camion</label>
                                                                    <select
                                                                        class="js-example-basic-single js-states form-control"style="width: 100%"
                                                                        @if (count($ordre->factures) > 0) disabled @endif
                                                                        id="camion_id_{{ $ordre->id }}"
                                                                        name="camion_id_{{ $ordre->id }}">
                                                                        @foreach ($camions as $camion)
                                                                            <option value="{{ $camion->id }}"
                                                                                data-type="{{ $camion->type_camion }}"
                                                                                style="float:left"
                                                                                {{ $camion->id == $ordre->items->camion_id ? 'selected' : '' }}>
                                                                                {{ $camion->matricule }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Evaluation transporteur
                                                                        :</label>
                                                                    <textarea @if (count($ordre->factures) > 0) disabled @endif placeholder="Evaluation transporteur :"
                                                                        class="form-control" name="evaluation_{{ $ordre->id }}">{{ $ordre->items->evaluation }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function() {

        var ordres_all = {{ Js::from($devis->ordres) }};
        var chauffeurs_all = {{ Js::from($chauffeurs) }};

        if (chauffeurs_all.length > 0) {

            for (ordre of ordres_all) {
                var select_id = ordre.id
                var chauffeur_id = $('#chauffeur_id_' + ordre.id)
                var camion_id = $('#camion_id_' + ordre.id)
                var select_val = $("input[name=type_chauffeur_" + ordre.id + "]:checked").val()
                var chauffeur_all = {{ Js::from($chauffeurs) }};
                var camions_interne = {{ Js::from($camions_interne) }};

                chauffeur_id.empty()
                if (select_val == "interne") {
                    $('#prix_achat_div_' + select_id).hide()
                    $('#prix_vente_div_' + select_id).hide()

                    for (chauffeur of chauffeur_all) {
                        if (chauffeur.type_chauffeur == "interne") {
                            camion_id.empty()

                            $(chauffeur_id).append($('<option>', {
                                value: chauffeur.id,
                                text: chauffeur.nom + " " + chauffeur.prenom
                            }));
                            for (camion of camions_interne) {

                                $(camion_id).append($('<option>', {
                                    value: camion.id,
                                    text: camion.matricule
                                }));

                            }

                        }
                    }

                } else if (select_val == "externe") {
                    $('#prix_achat_div_' + select_id).show()
                    $('#prix_vente_div_' + select_id).show()
                    for (chauffeur of chauffeur_all) {
                        if (chauffeur.type_chauffeur == "externe") {

                            $(chauffeur_id).append($('<option>', {
                                value: chauffeur.id,
                                text: chauffeur.nom + " " + chauffeur.prenom
                            }));

                            for (camion of chauffeur.camions) {

                                $(camion_id).append($('<option>', {
                                    value: camion.id,
                                    text: camion.matricule
                                }));
                            }


                        }
                    }

                }
                $('#chauffeur_id_' + select_id + " option[value=" + ordre.items.chauffeur_id + "]").prop(
                    'selected',
                    true);
                $(chauffeur_id).change()

                $('#camion_id_' + select_id + " option[value=" + ordre.items.camion_id + "]").prop('selected',
                    true);
                $(camion_id).change()

            }



        }


        $('#addfacture').submit(function(e) {
            $('#submit_factures').attr('disabled', 'disabled');
            $('.erreur').empty()


            var selected = $('#ordre_select').val()
            var selectedJson = JSON.stringify(selected);
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
                    ordres: selectedJson,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    console.log(result)
                    if (result.error) {
                        $('#submit_factures').removeAttr('disabled');
                        if (result.error.date) {
                            error_message(result.error.date[0], "#date_facture")
                        }



                    } else if (result.success_id) {

                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Facture créer avec succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })

                        setTimeout(function() {

                            window.location.href = "{{ url('/updatefacture') }}/" +
                                result.success_id + "/" + "{{ $devis->id }}";
                        }, 1000);

                    }
                }
            });

        });
        $(camion_id).each(function() {
            console.log(this.value)
        });
    });

    function test_type(select) {


        var select_id = select.attr('id').match(/\d+/)[0]

        var select_val = select.val()
        var chauffeur_id = $('#chauffeur_id_' + select_id)
        var chauffeur_all = {{ Js::from($chauffeurs) }};
        var camions_interne = {{ Js::from($camions_interne) }};
        var camion_id = $('#camion_id_' + select_id)
        chauffeur_id.empty()
        camion_id.empty()


        if (select_val == "interne") {
            $('#prix_achat_div_' + select_id).hide()
            $('#prix_vente_div_' + select_id).hide()

            for (chauffeur of chauffeur_all) {
                if (chauffeur.type_chauffeur == "interne") {
                    camion_id.empty()

                    $(chauffeur_id).append($('<option>', {
                        value: chauffeur.id,
                        text: chauffeur.nom + " " + chauffeur.prenom
                    }));


                    for (camion of camions_interne) {
                        $(camion_id).append($('<option>', {
                            value: camion.id,
                            text: camion.matricule
                        }));
                    }



                }
            }


        } else if (select_val == "externe") {
            $('#prix_achat_div_' + select_id).show()
            $('#prix_vente_div_' + select_id).show()
            for (chauffeur of chauffeur_all) {
                if (chauffeur.type_chauffeur == "externe") {
                    $(chauffeur_id).append($('<option>', {
                        value: chauffeur.id,
                        text: chauffeur.nom + " " + chauffeur.prenom
                    }));

                    if (chauffeur_id.val() == chauffeur.id) {
                        for (camion of chauffeur.camions) {
                            $(camion_id).append($('<option>', {
                                value: camion.id,
                                text: camion.matricule
                            }));
                        }
                    }
                }
            }
        }
    }

    function change_camion(ordre_id) {

        var camion_id = $('#camion_id_' + ordre_id)
        var chauffeur_id = $('#chauffeur_id_' + ordre_id)
        var chauffeur_all = {{ Js::from($chauffeurs) }};
        console.log(chauffeur_id.val())
        var result = chauffeur_all.filter(chauffeur => chauffeur.id == chauffeur_id.val());
        console.log(result)
        if (result[0].type_chauffeur == "externe") {
            camion_id.empty()
            for (camion of result[0].camions) {
                $(camion_id).append($('<option>', {
                    value: camion.id,
                    text: camion.matricule
                }));
            }
        }
        $(camion_id).change()

    }


    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    function saveordre(ordre_id) {
        $('.erreur').empty()

        var date_enlev = $("input[name='date_enlev_" + ordre_id + "']").val();
        var nom_enlev = $("input[name='nom_enlev_" + ordre_id + "']").val();

        var date_livraison = $("input[name='date_livraison_" + ordre_id + "']").val();
        var nom_livraison = $("input[name='nom_livraison_" + ordre_id + "']").val();

        var poids = $("input[name='poids_" + ordre_id + "']").val();
        var nb_coliss = $("input[name='nb_coliss_" + ordre_id + "']").val();
        var volume = $("input[name='volume_" + ordre_id + "']").val();
        var nature = $("input[name='nature_" + ordre_id + "']").val();

        var specif = $("input[name='specif_" + ordre_id + "']:checked").val();
        var no_dossier = $("input[name='no_dossier_" + ordre_id + "']").val();
        var remarques = $("textarea[name='remarques_" + ordre_id + "']").val();


        var select_val = $("input[name=type_chauffeur_" + ordre_id + "]:checked").val()
        var prix_achat = " "
        var prix_vente = " "
        if (select_val == "externe") {
            prix_achat = $("input[name='prix_achat_" + ordre_id + "']").val();
            prix_vente = $("input[name='prix_vente_" + ordre_id + "']").val();

        }


        var chauffeur_id = $("select[name='chauffeur_id_" + ordre_id + "']").val();
        var camion_id = $("select[name='camion_id_" + ordre_id + "']").val();
        var evaluation = $("textarea[name='evaluation_" + ordre_id + "']").val();


        if (specif == "autre") {
            specif = $("input[name='autre_specif_" + ordre_id + "']").val();
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/configordre') }}/" + ordre_id,
            method: 'post',
            data: {
                date_enlev: date_enlev,
                nom_enlev: nom_enlev,
                date_livraison: date_livraison,
                nom_livraison: nom_livraison,
                nb_coliss: nb_coliss,
                volume: volume,
                nature: nature,
                poids: poids,
                specif: specif,
                remarques: remarques,
                prix_achat: prix_achat,
                prix_vente: prix_vente,
                chauffeur_id: chauffeur_id,
                camion_id: camion_id,
                evaluation: evaluation,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {

                if (result.error) {


                    if (result.error.adress_enlev) {
                        error_message(result.error.adress_enlev[0], "input[name='adress_enlev_" + ordre_id +
                            "']")
                    }
                    if (result.error.date_enlev) {
                        error_message(result.error.date_enlev[0], "input[name='date_enlev_" + ordre_id +
                            "']")
                    }
                    if (result.error.nom_enlev) {
                        error_message(result.error.nom_enlev[0], "input[name='nom_enlev_" + ordre_id + "']")
                    }


                    if (result.error.adress_livraison) {
                        error_message(result.error.adress_livraison[0], "input[name='adress_livraison_" +
                            ordre_id + "']")
                    }
                    if (result.error.date_livraison) {
                        error_message(result.error.date_livraison[0], "input[name='date_livraison_" +
                            ordre_id + "']")
                    }
                    if (result.error.nom_livraison) {
                        error_message(result.error.nom_livraison[0], "input[name='nom_livraison_" +
                            ordre_id + "']")
                    }


                    if (result.error.poids) {
                        error_message(result.error.poids[0], "input[name='poids_" + ordre_id + "']")
                    }
                    if (result.error.nb_coliss) {
                        error_message(result.error.nb_coliss[0], "input[name='nb_coliss_" + ordre_id + "']")
                    }
                    if (result.error.nature) {
                        error_message(result.error.nature[0], "input[name='nature_" + ordre_id + "']")
                    }
                    if (result.error.volume) {
                        error_message(result.error.volume[0], "input[name='volume_" + ordre_id + "']")
                    }

                    if (result.error.no_dossier) {
                        error_message(result.error.no_dossier[0], "input[name='no_dossier_" + ordre_id +
                            "']")
                    }


                    if (result.error.specif) {
                        error_message(result.error.specif[0], "input[name='autre_specif_" + ordre_id + "']")
                    }

                    if (result.error.prix_achat) {
                        error_message(result.error.prix_achat[0], "input[name='prix_achat_" + ordre_id +
                            "']")
                    }
                    if (result.error.prix_vente) {
                        error_message(result.error.prix_vente[0], "input[name='prix_vente']_" + ordre_id +
                            "")
                    }

                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Ordre de travail configuré avecc succéss',
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
</script>
