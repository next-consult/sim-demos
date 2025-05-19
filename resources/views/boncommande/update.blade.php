<?php
function replace($montant)
{
    $montant = str_replace('.', ',', $montant);
    return $montant;
}
?>


@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row ">
                    <div class="col-md-4">
                        <h3><span>{{ $boncommande->fournisseur->nom }} </span>
                        </h3>
                    </div>
                    <div class="col-md-8">
                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">



                            @if ($boncommande->status != 'converti_facture' && $boncommande->status != 'valide')
                                <button type="button" class="btn btn-info  " onclick="saveboncommande()"
                                    id="save_boncommande"><i class="fa fa-check"></i>
                                    Enregistrer le
                                    boncommande</button>
                            @endif



                        </div>
                        <div class="dropdown">
                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left:20px">
                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                <ul class="list-group">
                                    <a href="{{ route('boncommande.print', ['id' => $boncommande->id]) }}">
                                        <li class="list-group-item"><i class="fa fa-file" style="margin-right:5px"></i>
                                            PDF </li>
                                    </a>
                                </ul>
                            </div>
                        </div>


                        <a href="{{ route('boncommande.index') }} "><button type="button"
                                class="btn btn-warning btn_retour" style=" margin-left: 120px;
"><i
                                    class="fa-solid fa-backward"></i>Retour</button></a>

                    </div>


                </div>

            </div>
        </div>
    </div>
    <!-- End Breadcromb Row -->

    <!-- Invoice Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-box">
                <div class="invoice-box">
                    <h4 class="invoice-status">{{ $boncommande->status }}</h4>
                    <div class="invoice-head">
                        <h2>#{{ $boncommande->numero }}
                        </h2>

                    </div>
                    <div class="invoice-address">
                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="invoice-company-address">
                                    <h3>Entreprise</h3>
                                    <p class="name-invoice"><b>{{ $boncommande->entreprise->nom }}</b></p>
                                    <p>{{ $boncommande->entreprise->adresse }}</p>
                                    <p>Tel No: {{ $boncommande->entreprise->telephone }}</p>
                                    <p>Email: {{ $boncommande->entreprise->email }}</p>
                                    <p>Web: {{ $boncommande->entreprise->web }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="billed-to-address">
                                    <h3>fournisseur</h3>
                                    <p class="name-invoice"><b>{{ $boncommande->fournisseur->nom }}
                                        </b>
                                    </p>
                                    <p>{{ $boncommande->fournisseur->adresse }}</p>
                                    <p>Tel No: {{ $boncommande->fournisseur->telephone }}</p>
                                    <p>Email: {{ $boncommande->fournisseur->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="billed-to-address">
                                    <h3>Options</h3>
                                    <div class="form-group row">
                                        <p class="name-invoice col-md-4 col-form-label" style="margin-top:10px">
                                            <b>Fournisseur</b>
                                        </p>
                                        <div class="col-md-8">

                                            @if ($boncommande->status == 'en cours')
                                                <select class="form-control none" id="fournisseur_id">
                                                    @foreach ($fournisseurs as $fournisseur)
                                                        <option value="{{ $fournisseur->id }}"
                                                            {{ $boncommande->fournisseur->id == $fournisseur->id ? 'selected' : '' }}>
                                                            {{ $fournisseur->nom }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            @else
                                                <span
                                                    class="form-control disabled">{{ $boncommande->fournisseur->nom }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <p class="name-invoice col-md-4 col-form-label" style="margin-top:10px"><b>Numéro
                                                bon de commande</b></p>
                                        <div class="col-md-8">
                                            {{-- @if ($boncommande->status != 'converti_facture')
                                            <input type="text" class="form-control" id="numero_boncommande"
                                                value="{{ $boncommande->numero }}">
                                            @else
                                            <span class="form-control disabled">{{ $boncommande->numero }}</span>
                                             @endif --}}
                                            <span class="form-control disabled">{{ $boncommande->numero }}</span>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <p class="name-invoice col-md-4 col-form-label" style="margin-top:10px"><b>Date
                                                bon de commande</b></p>
                                        <div class="col-md-8">

                                            @if ($boncommande->status != 'converti_facture')
                                                <input type="date" class="form-control" id="date_boncommande"
                                                    value="{{ $boncommande->date }}">
                                            @else
                                                <span class="form-control disabled">{{ $boncommande->date }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <p class="name-invoice col-md-4 col-form-label" style="margin-top:10px">
                                            <b>Status</b>
                                        </p>
                                        <div class="col-md-8">

                                            @if ($boncommande->status == 'en cours')
                                                <select class="form-control none" id="status">
                                                    <option value="en cours"
                                                        {{ $boncommande->status == 'en cours' ? 'selected' : '' }}>En cours
                                                    </option>
                                                    <option value="valide"
                                                        {{ $boncommande->status == 'valide' ? 'selected' : '' }}>
                                                        Valide</option>
                                                </select>
                                            @elseif($boncommande->status == 'valide')
                                                <span class="form-control disabled">Valide</span>
                                            @elseif($boncommande->status == 'converti_facture' || $boncommande->status == 'valide')
                                                <span class="form-control disabled">Converti en facture</span>
                                            @endif



                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <p class="name-invoice col-md-4 col-form-label" style="margin-top:10px">
                                            <b>Devise</b>
                                        </p>
                                        <div class="col-md-8">

                                            @if ($boncommande->status == 'en cours')
                                                <select class="form-control none" id="devise">
                                                    @foreach ($devises as $devv)
                                                        <option value="{{ $devv->symbole }}"
                                                            {{ $devv->symbole == $boncommande->devise ? 'selected' : '' }}>
                                                            {{ $devv->code }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            @else
                                                <span class="form-control disabled">{{ $devv->code }}</span>
                                            @endif
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:30px">
                        <div class="col-md-6 col-sm-6">
                            <div class="seipkon-breadcromb-left" style="margin-top:15px">
                                <h3>Liste des opérations</h3>
                            </div>
                        </div>
                        @if ($boncommande->status != 'converti_facture' && $boncommande->status != 'valide')
                            <div class="col-md-6 col-sm-6">
                                <div class="seipkon-breadcromb-right">
                                    <button class="btn btn-success btn_mobile" data-toggle="modal"
                                        data-target="#produit_catalogue">Ajouter produit éxistant</button>
                                    <button class="btn btn-success btn_mobile" onclick="addoperation('new')">Ajouter
                                        nouveau
                                        produit</button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="invoice-table">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="boncommande_table">
                                <tr id=0 style="background:#DEE2E6 ">
                                    <th>Produit</th>
                                    <th>Déscription</th>
                                    <th style="width:10%">Quantités:</th>
                                    <th style="width:12%">Prix unitaire HT</th>
                                    <th style="width:12%"><span style="font-size:14px">TVA : </span>
                                    </th>
                                    <th style="width:12%"><span style="font-size:14px">Remise : </span>

                                    </th>
                                    <th>Total HT</th>

                                    <th>Total remise</th>

                                    <th>Total TVA</th>
                                    <th>Total TTC</th>
                                    @if ($boncommande->status != 'converti_facture' && $boncommande->status != 'valide')
                                        <th>#</th>
                                    @endif
                                </tr>
                                @if (count($boncommande->items) > 0)
                                    @foreach ($boncommande->items as $key => $item)
                                        <tr id="{{ $key + 1 }}">

                                            <td>
                                                <input type='hidden' class='form-control' value={{ $item->id }}
                                                    name='id[]'>

                                                @if ($boncommande->status != 'converti_facture' && $boncommande->status != 'valide')
                                                    <input type="text" class="form-control"
                                                        value="{{ $item->produit }}"name="produits[]"
                                                        id="{{ $key + 1 }}_produit">
                                                @else
                                                    <span class="form-control disabled"> {{ $item->produit }}</span>
                                                @endif



                                            </td>
                                            <td>
                                                <textarea class='form-control' id='description_id[]-{{ $key + 1 }}' name='description[]'
                                                    @if ($boncommande->status == 'converti_facture' || $boncommande->status == 'valide') disabled @endif>{{ $item->description }}</textarea>
                                            </td>
                                            <td>
                                                @if ($boncommande->status != 'converti_facture' && $boncommande->status != 'valide')
                                                    <input type="number" class="form-control"
                                                        value="{{ $item->quantites }}" name="quantites[]" min="1"
                                                        required onchange=calcule($(this))
                                                        id="quantites_id-{{ $key + 1 }}">
                                                @else
                                                    <span class="form-control disabled">{{ $item->quantites }}</span>
                                                @endif
                                            </td>
                                            <td>

                                                @if ($boncommande->status != 'converti_facture' && $boncommande->status != 'valide')
                                                    <input type="number" class="form-control"
                                                        value="{{ $item->prix_ht }}"name="prix_ht[]"
                                                        onchange=calcule($(this));test_prix($(this))
                                                        old-value="{{ $item->prix_ht }}"
                                                        id="prix_id-{{ $key + 1 }}">
                                                @else
                                                    <span class="form-control disabled">{{ $item->prix_ht }}</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($boncommande->status != 'converti_facture' && $boncommande->status != 'valide')
                                                    <select onchange=calcule($(this))
                                                        name='tva[]'class='form-control none'
                                                        style='margin-top:5px'id="tva_id-{{ $key + 1 }}">
                                                        @foreach ($taxes as $taxe)
                                                            <option value='{{ $taxe->pourcentage }}' style='float:left'
                                                                {{ $taxe->pourcentage == $item->tva ? 'selected' : '' }}>
                                                                {{ $taxe->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <span class="form-control disabled">{{ $item->tva }}</span>
                                                @endif

                                            </td>
                                            <td>



                                                <div class="row justify-content-start">


                                                    <div class="col-md-6">







                                                        @if ($boncommande->status != 'converti_facture' && $boncommande->status != 'valide')
                                                            <input type="number" class="form-control"
                                                                value="{{ $item->remise }}" name="remise[]" required
                                                                style="width:70px" onchange=calcule($(this))
                                                                id="remise_id-{{ $key + 1 }}">
                                                        @else
                                                            <span class="form-control disabled">

                                                                {{ $item->remise }}

                                                            </span>
                                                        @endif


                                                    </div>
                                                    <div class="col-md-6">



                                                        @if ($boncommande->status != 'converti_facture' && $boncommande->status != 'valide')
                                                            <select class="form-select none" style="margin-top:5px"
                                                                id="type_remise-{{ $key + 1 }}"
                                                                onchange=calcule($(this))>
                                                                <option value="pourcentage"
                                                                    {{ $item->type_remise == 'pourcentage' ? 'selected' : '' }}>
                                                                    <span style="font-size:10px">%
                                                                    </span>
                                                                </option>
                                                                <option value="montant"
                                                                    {{ $item->type_remise == 'montant' ? 'selected' : '' }}>
                                                                    <span style="font-size:10px">TND
                                                                    </span>
                                                                </option>
                                                            </select>
                                                        @else
                                                            <span class="form-control disabled">

                                                                {{ $item->type_remise == 'montant' ? 'TND' : '' }}
                                                                {{ $item->type_remise == 'pourcentage' ? '%' : '' }}

                                                            </span>
                                                        @endif



                                                    </div>
                                                </div>


                                            </td>

                                            <td><span
                                                    id='total_ht_id-{{ $key + 1 }}'>{{ replace(sprintf('%.3f', $item->total_ht)) }}</span>
                                            </td>

                                            <td><span
                                                    id='total_remise_id-{{ $key + 1 }}'>{{ replace(sprintf('%.3f', $item->total_remise)) }}</span>
                                            </td>


                                            <td><span
                                                    id='total_tva_id-{{ $key + 1 }}'>{{ replace(sprintf('%.3f', $item->total_tva)) }}</span>
                                            </td>
                                            <td><span
                                                    id='total_ttc_id-{{ $key + 1 }}'>{{ replace(sprintf('%.3f', $item->total_ttc)) }}</span>
                                            </td>
                                            @if ($boncommande->status != 'converti_facture' && $boncommande->status != 'valide')
                                                <td>
                                                    <a class="btn btn_mobile" onclick="delete_operation($(this))">X
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                    <div class="invoice-footer-note">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <div class="invoice-note">
                                    <h4>Conditions de ventes :</h4>
                                    {{-- <input style="height:94px" class="form-control" name="condition"
                                        value="@if ($boncommande->condition) {{ $boncommande->condition }}@else {{ $boncommande->entreprise->condition }}@endif" />  --}}


                                    <textarea
                                        class="form-control  @error('condition') is-invalid @enderror @if ($boncommande->status == 'converti_facture' || $boncommande->status == 'valide') disabled @endif"
                                        @if ($boncommande->status == 'converti_facture' || $boncommande->status == 'valide') disabled @endif name="condition">
                                    @if ($boncommande->condition)
{{ $boncommande->condition }}@else{{ $boncommande->entreprise->condition }}
@endif
                                    </textarea>


                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="invoice-subtotal">
                                    <p><span>Total HT:</span> <span
                                            id='total_boncommande_ht'>{{ replace(sprintf('%.3f', $boncommande->commande_ht)) }}</span>
                                        {{ $boncommande->devise }}</p>
                                    <p><span>Total Remise:</span> <span
                                            id='total_boncommande_remise'>-{{ replace(sprintf('%.3f', $boncommande->commande_remise)) }}</span>
                                        {{ $boncommande->devise }}
                                    </p>

                                    <p><span>Total TVA:</span> <span
                                            id='total_boncommande_tva'>{{ replace(sprintf('%.3f', $boncommande->commande_tva)) }}</span>
                                        {{ $boncommande->devise }}</p>
                                    <h3 style="font-size:18px">Total TTC:<span
                                            id='total_boncommande_ttc'>{{ replace(sprintf('%.3f', $boncommande->commande_ttc)) }}</span>
                                        {{ $boncommande->devise }} </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-action">
                        <div class="row">
                            <div class="col-md-12">

                                <h4 style="color:#333;float:left">Pied de la page :</h4>
                                <br>


                                <textarea class="form-control  @if ($boncommande->status == 'converti_facture') disabled @endif" name="footer"
                                    @if ($boncommande->status == 'converti_facture' || $boncommande->status == 'valide') disabled @endif>
@if ($boncommande->footer)
{{ $boncommande->footer }}@else{{ $boncommande->entreprise->footer }}
@endif
</textarea>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Invoice Row -->
    <div class="modal fade" id="produit_catalogue" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Ajouter un produit
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Choisir
                            le produit</label>
                        <div class="col-md-8">
                            <input type="hidden" id="fournisseur_id" />
                            <select class="js-example-basic-single js-states form-control"style="width: 100%"
                                id="cataloge_id" required>
                                @foreach ($catalogues as $catalogue)
                                    <option value="{{ $catalogue->id }}" style="float:left">
                                        {{ $catalogue->produit }} ( {{ $catalogue->numero }})</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Retour</button>
                    <button type="submit" class="btn btn-primary" onclick="add_catalogue()">Ajouter</button>
                </div>

            </div>
        </div>
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        //status boncommande
        var status_facture = '{{ $boncommande->status }}'

        if (status_facture == 'annuler') {
            $('.invoice-status').css('background', 'red')
            $('.invoice-status').toggleClass('annuler');
            $('.invoice-status').html('Annulé')

        } else if (status_facture == 'en cours') {
            $('.invoice-status').css('background', '#A6ACAF')
            $('.invoice-status').toggleClass('etablir');
            $('.invoice-status').html('En cours')

        } else if (status_facture == 'valide') {
            $('.invoice-status').css('background', '#21618C')
            $('.invoice-status').toggleClass('envoye');
            $('.invoice-status').html('boncommande valide')

        } else if (status_facture == 'paye') {
            $('.invoice-status').html('Payé')

        } else if (status_facture == 'converti_facture') {
            $('.invoice-status').css('background', '#0B5345')
            $('.invoice-status').toggleClass('paye_total');
            $('.invoice-status').html('boncommande converti')

        }


        $('#boncommande_table tr').each(function() {
            if (this.id > 0) {
                var tva_id = "#tva_id-" + this.id

                var type_fournisseur = '{{ $boncommande->fournisseur->type }}'
                if (type_fournisseur == 'sans_taxe') {
                    $(tva_id + "> option").each(function() {
                        if (this.value != 0) {
                            this.remove()
                        }
                    });

                } else {
                    $(tva_id + " option[value=" + result.tva + "]").prop('selected', true);
                }
            }

        });


    });

    function add_catalogue() {
        var cataloge = $('#cataloge_id').val();

        if (cataloge) {
            var page_data = {{ Js::from($boncommande->items) }};
            var rowCount = $('#boncommande_table  tr').length;
            var id = 0;
            if (rowCount > 1) {
                var id = $('#boncommande_table tr').last().attr('id');
            }

            var id_1 = parseInt(id) + 1
            var name_remise = "type_remise-" + id_1
            var catalogue_id = "catalogue_id_" + id_1
            var quantites_id = "quantites_id-" + id_1
            var prix_id = "prix_id-" + id_1
            var tva_id = "tva_id-" + id_1
            var remise_id = "remise_id-" + id_1

            var total_ht_id = "total_ht_id-" + id_1
            var total_remise_id = "total_remise_id-" + id_1
            var total_tva_id = "total_tva_id-" + id_1
            var total_ttc_id = "total_ttc_id-" + id_1
            var description = "description_id-" + id_1



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/onecatalogue') }}/" + cataloge,
                method: 'get',
                data: {

                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    console.log(result)
                    $('#boncommande_table tr:last').after(
                        "<tr id=" + id_1 +
                        "><td><input type='hidden' class='form-control' value='new' name='id[]'> <input type='text' class='form-control' name='produits[]' value='" +
                        result.produit + "' id=" + catalogue_id + "_produit>" +
                        "</td>" +
                        "<td><textarea class='form-control' id=" + description +
                        " name='description[]'  @if ($boncommande->status == 'converti_facture' && $boncommande->status == 'valide') disabled @endif >" +
                        "" + result.description + "</textarea></td>" +
                        "<td><input type='number' class='form-control'  value='" + result.quantites +
                        "' name='quantites[]' onchange=calcule($(this)) required id=" + quantites_id +
                        "></td><td> <input type='text' onchange=calcule($(this));test_prix($(this))  class='form-control'  name='prix_ht[]' value='" +
                        result.prix_ht + "' old- required id=" + prix_id + "></td>" +
                        "<td> <select onchange=calcule($(this))  name='tva[]'class='form-control none' style='margin-top:5px' id=" +
                        tva_id +
                        ">" +
                        "@foreach ($taxes as $taxe)" +
                        "<option value='{{ $taxe->pourcentage }}' style='float:left' " + (result.tva ==
                            '{{ $taxe->pourcentage }}' ? 'selected' : '') + ">" +
                        "{{ $taxe->nom }}</option>" +
                        "@endforeach" +
                        "</td><td> <div class='row justify-content-start'> <div class='col-md-6'><input type='number' class='form-control' value='" +
                        result.remise + "' name='remise[]'  onchange=calcule($(this))  id=" +
                        remise_id +
                        " required style='width:70px'></div><div class='col-md-6'><select onchange=calcule($(this))  name='type_remise'class='form-select none' style='margin-top:5px' id=" +
                        name_remise +
                        "><option value='pourcentage' " + (result.type_remise == 'pourcentage' ?
                            'selected' : '') + " >" +
                        "<span style='font-size:10px'>%</span></option><option value='montant' " + (
                            result.type_remise == 'montant' ? 'selected' : '') +
                        "><span style='font-size:10px'>TND </span></option></select></div></div></td><td id=" +
                        total_ht_id + ">" + result.total_ht + "</td><td id=" + total_remise_id + ">" +
                        result.total_remise + "</td><td id=" + total_tva_id + ">" + result.total_tva +
                        "</td><td id=" + total_ttc_id + ">" + result.total_ttc +
                        "</td><td><a class='btn btn_mobile' onclick ='delete_operation($(this))'>X</a></td></tr>"
                    );

                    $("#produit_catalogue .close").click()
                    total_final()
                }
            });
        }


    }

    //error_message
    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }
    //test_number
    function test_number(number, test) {
        if (!isNaN(number) && parseFloat(number) >= parseFloat(test)) {
            return true
        } else {
            return false
        }
    }
    //save
    function saveboncommande(type_save) {
        $('.erreur').empty();
        var test = true
        var title_var = ""
        var obligatoire =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"
        var number =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est doit etre supérieur ou égale a 0,001</p>"

        var quantites =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est doit etre supérieur ou égale a 1</p>"

        var remise =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est doit etre un entier</p>"



        if ($('#boncommande_table tr').length <= 1) {
            test = false
            title_var = "Le boncommande est vide"

        } else {
            title_var = "Il faut remplir tous les champs correctement"

        }




        var rowCount = $('#boncommande_table tr').length;
        var all_remises = []
        var tva = []

        $('#boncommande_table tr').each(function() {
            if (this.id > 0) {
                var remises = $("#type_remise-" + this.id + " option:selected").val()
                var item_tva = $("#tva_id-" + this.id + " option:selected").val()
                all_remises.push(remises)
                tva.push(item_tva)
            }

        });




        var catalogues = []
        var produits = []

        {{-- $('#boncommande_table tr').each(function() {
            if (this.id > 0) {
               var  catalogue = $("#catalogue_id_" + this.id + " option:selected").val()
               var  produit = $("#catalogue_id_" + this.id + "_produit").val()

               if(typeof catalogue != "undefined"){
                if(!catalogue){
                test = false
                $(obligatoire).insertAfter($("#catalogue_id_" + this.id + " option:selected"));
                  }
                catalogues.push(catalogue)
               }
                if(typeof produit != "undefined"){
                  if(!produit){
                  test = false
                $(obligatoire).insertAfter($("#catalogue_id_" + this.id + "_produit"));
                  }
                catalogues.push(produit)
               }

            }

        }); --}}
        console.log(catalogues)


        var ids = $("input[name='id[]']")
            .map(function() {
                return $(this).val();
            }).get();



        var quantites = $("input[name='quantites[]']")
            .map(function() {


                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);

                } else if (!test_number($(this).val(), 0.001)) {
                    test = false
                    $(quantites).insertAfter(this);


                }

                return $(this).val();
            }).get();

        var description = $("textarea[name='description[]']")
            .map(function() {


                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);




                }

                return $(this).val() + '\n';
            }).get();

        var produits = $("input[name='produits[]']")
            .map(function() {


                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);

                }

                return $(this).val();
            }).get();



        var prix_ht = $("input[name='prix_ht[]']")
            .map(function() {

                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);

                } else if (!test_number($(this).val(), 0.001)) {
                    test = false
                    $(number).insertAfter(this);


                }
                return $(this).val();
            }).get();



        var remise = $("input[name='remise[]']")
            .map(function() {
                if ($(this).val() && !test_number($(this).val(), 0)) {
                    test = false
                    $(remise).insertAfter(this);
                }
                return $(this).val();
            }).get();


        if (test == false) {
            swal.fire({
                title: title_var,

                timer: 1000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {}
            })


        }

        if (test == true) {
            var items = []


            for (let i = 0; i < quantites.length; i++) {

                if (!remise[i]) {
                    remise[i] = 0
                }
                object = total(prix_ht[i], quantites[i], tva[i], remise[i], all_remises[i])

                items.push({
                    'id': ids[i],
                    'produit': produits[i],
                    'description': description[i],
                    'quantites': quantites[i],
                    'prix_ht': prix_ht[i],
                    'tva': tva[i],
                    'remise': remise[i],
                    'total_remise': object['total_remise'],
                    'type_remise': all_remises[i],
                    'total_ht': object['total_ht'],
                    'total_tva': object['total_tva'],
                    'total_ttc': object['total_ttc'],
                })


            }
            var itemsJson = JSON.stringify(items);
            var condition = $("textarea[name='condition']").val();
            var footer = $("textarea[name='footer']").val();
            var status = $('#status').val();
            var type = $('#type').val();
            var devise = $('#devise').val()
            var date_boncommande = $('#date_boncommande').val()
            var fournisseur_id = $('#fournisseur_id').val()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });




            if (status == "valide") {



                swal.fire({
                    title: "Valider le boncommande?",
                    icon: 'question',
                    text: "Etes-vous sûrs,vous voulez valider le boncommande ??  Vous ne pouvez pas changer le boncommande ultérieurement !!",
                    type: "warning",
                    showCancelButton: !0,
                    customClass: 'swal-wide',
                    confirmButtonText: "Oui, Confirmer!",
                    cancelButtonText: "Non, Annuler!",
                    reverseButtons: !0
                }).then(function(e) {

                    if (e.value === true) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        jQuery.ajax({
                            url: "{{ url('/update_store_boncommande') }}/" + '{{ $boncommande->id }}',
                            method: 'post',
                            data: {
                                items: itemsJson,
                                condition: condition,
                                footer: footer,
                                status: status,
                                type: type,
                                devise: devise,
                                date_boncommande: date_boncommande,
                                fournisseur_id: fournisseur_id,
                                _token: "{{ csrf_token() }}",
                            },
                            success: function(result) {

                                if (result.error) {
                                    Swal.fire({
                                        position: 'top-center',
                                        icon: 'error',
                                        title: 'Un erreur est survenu',
                                        showConfirmButton: true,
                                        timer: 3000
                                    })
                                    if (result.error.numero_boncommande) {
                                        error_message(result.error.numero_boncommande[0],
                                            "#numero_boncommande")
                                    }
                                    if (result.error.date_boncommande) {
                                        error_message(result.error.date_boncommande[0],
                                            "#date_boncommande")
                                    }

                                } else if (result == 200) {
                                    console.log(type)

                                    Swal.fire({
                                        position: 'top-center',
                                        icon: 'success',
                                        title: 'boncommande configuré avecc succéss',
                                        showConfirmButton: false,
                                        timer: 1000
                                    })

                                    setTimeout(function() {

                                        location.reload(true);
                                    }, 1000);





                                }

                            }
                        });

                    } else {
                        e.dismiss;
                    }

                }, function(dismiss) {
                    return false;
                })



            } else if (status == "en cours") {


                jQuery.ajax({
                    url: "{{ url('/update_store_boncommande') }}/" + '{{ $boncommande->id }}',
                    method: 'post',
                    data: {
                        items: itemsJson,
                        condition: condition,
                        footer: footer,
                        status: status,
                        type: type,
                        devise: devise,
                        date_boncommande: date_boncommande,
                        fournisseur_id: fournisseur_id,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(result) {

                        if (result.error) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'Un erreur est survenu',
                                showConfirmButton: true,
                                timer: 3000
                            })
                            if (result.error.numero_boncommande) {
                                error_message(result.error.numero_boncommande[0], "#numero_boncommande")
                            }
                            if (result.error.date_boncommande) {
                                error_message(result.error.date_boncommande[0], "#date_boncommande")
                            }

                        } else if (result == 200) {

                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'boncommande configuré avecc succéss',
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
        }
    }

    //add row
    function addoperation(test) {

        var page_data = {{ Js::from($boncommande->items) }};
        var rowCount = $('#boncommande_table  tr').length;
        var id = 0;
        if (rowCount > 1) {
            var id = $('#boncommande_table tr').last().attr('id');
        }

        var id_1 = parseInt(id) + 1
        var name_remise = "type_remise-" + id_1
        var catalogue_id = "catalogue_id_" + id_1
        var quantites_id = "quantites_id-" + id_1
        var prix_id = "prix_id-" + id_1
        var tva_id = "tva_id-" + id_1
        var remise_id = "remise_id-" + id_1

        var total_ht_id = "total_ht_id-" + id_1
        var total_remise_id = "total_remise_id-" + id_1
        var total_tva_id = "total_tva_id-" + id_1
        var total_ttc_id = "total_ttc_id-" + id_1
        var description = "description_id-" + id_1

        var object = {
            'id': catalogue_id
        }
        $('#boncommande_table tr:last').after(
            "<tr id=" + id_1 +
            "><td><input type='hidden' class='form-control' value='new' name='id[]'> <input type='text' class='form-control' name='produits[]' id=" +
            catalogue_id + "_produit>" +
            "</td>" +
            "<td><textarea class='form-control' id=" + description +
            " name='description[]' @if ($boncommande->status == 'converti_facture' && $boncommande->status == 'valide') disabled @endif >" +
            "</textarea></td>" +
            "<td><input type='number' class='form-control'  name='quantites[]' onchange=calcule($(this)) required id=" +
            quantites_id +
            "></td><td> <input type='text' onchange=calcule($(this));test_prix($(this))  class='form-control'  name='prix_ht[]' old- required id=" +
            prix_id + "></td>" +
            "<td> <select onchange=calcule($(this))  name='tva[]'class='form-control none' style='margin-top:5px' id=" +
            tva_id +
            ">" +
            "@foreach ($taxes as $taxe)" +
            "<option value='{{ $taxe->pourcentage }}' style='float:left'>" +
            "{{ $taxe->nom }}</option>" +
            "@endforeach" +
            "</td><td> <div class='row justify-content-start'> <div class='col-md-6'><input type='number' class='form-control'  name='remise[]' onchange=calcule($(this))  id=" +
            remise_id +
            " required style='width:70px'></div><div class='col-md-6'><select onchange=calcule($(this))  name='type_remise'class='form-select none' style='margin-top:5px' id=" +
            name_remise +
            "><option value='pourcentage'> <span style='font-size:10px'>%</span></option><option value='montant'><span style='font-size:10px'>TND </span></option></select></div></div></td><td id=" +
            total_ht_id + "></td><td id=" + total_remise_id + "></td><td id=" + total_tva_id + "></td><td id=" +
            total_ttc_id +
            "></td><td><a class='btn btn_mobile' onclick ='delete_operation($(this))'>X</a></td></tr>"
        );


        total_final()

    }
    //delete row
    function delete_operation(row) {
        row.closest('tr').remove();
        total_final()
    }

    //get destination from select
    function catalogue_info(select_val, select_id) {
        select_id = select_id.id.replace('catalogue_id_', '');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/onecatalogue') }}/" + select_val,
            method: 'get',
            data: {

                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                var name_remise = "#type_remise-" + select_id
                var catalogue_id = "#catalogue_id_" + select_id
                var quantites_id = "#quantites_id-" + select_id
                var prix_id = "#prix_id-" + select_id
                var tva_id = "#tva_id-" + select_id
                var remise_id = "#remise_id-" + select_id
                var total_ht_id = "#total_ht_id-" + select_id
                var total_remise_id = "#total_remise_id-" + select_id
                var total_tva_id = "#total_tva_id-" + select_id
                var total_ttc_id = "#total_ttc_id-" + select_id
                var name_remise = "#type_remise-" + select_id
                var description = "#description_id-" + select_id

                $(total_ht_id).empty()
                $(total_remise_id).empty()
                $(total_tva_id).empty()
                $(total_ttc_id).empty()
                $(quantites_id).val(result.quantites)
                $(prix_id).val(result.prix_ht)

                var type_fournisseur = '{{ $boncommande->fournisseur->type }}'
                if (type_fournisseur == 'sans_taxe') {
                    $(tva_id + "> option").each(function() {
                        if (this.value != 0) {
                            this.remove()
                        }
                    });

                } else {
                    $(tva_id + " option[value=" + result.tva + "]").prop('selected', true);

                }


                $(remise_id).val(result.remise)

                if (result.type_remise == 'pourcentage') {
                    $(name_remise + " option[value='pourcentage']").prop('selected', true);
                    $(name_remise).change()
                } else if (result.type_remise == 'montant') {
                    $(name_remise + " option[value='montant']").prop('selected', true);
                    $(name_remise).change()
                }
                var total_tva = 0.000;
                if (type_fournisseur == 'avec_taxe') {
                    $(total_tva_id).html(total_tva)
                    total_tva = result.total_tva

                }
                total_ttc = parseFloat(result.total_ht - result.total_remise) + parseFloat(total_tva)
                $(total_tva_id).html(total_tva)
                $(total_ht_id).html(result.total_ht)
                $(total_remise_id).html(result.total_remise)
                $(total_ttc_id).html(parseFloat(total_ttc).toFixed(3))
                $("textarea#description_id-" + select_id).text(result.description)

                total_final()
            }
        });

    }
    //when input change calcule
    function calcule(ligne) {
        select_id = ligne.attr('id').match(/\d+/)[0]

        var name_remise = $("#type_remise-" + select_id).val()
        var quantites_id = $("#quantites_id-" + select_id).val()
        var prix_id = $("#prix_id-" + select_id).val()
        var tva_id = $("#tva_id-" + select_id).val()
        var remise_id = $("#remise_id-" + select_id).val()

        if (!quantites_id) {
            quantites_id = 1

        }
        if (!prix_id) {
            prix_id = 0


        }
        if (!tva_id) {
            tva_id = 0


        }
        if (!remise_id) {
            remise_id = 0


        }



        object = total(prix_id, quantites_id, tva_id, remise_id, name_remise)
        var total_ht_id = "#total_ht_id-" + select_id
        var total_remise_id = "#total_remise_id-" + select_id
        var total_tva_id = "#total_tva_id-" + select_id
        var total_ttc_id = "#total_ttc_id-" + select_id

        $(total_ht_id).empty()
        $(total_remise_id).empty()
        $(total_tva_id).empty()
        $(total_ttc_id).empty()

        $(total_ht_id).html(object['total_ht'].replace('.', ','))
        $(total_remise_id).html(object['total_remise'].replace('.', ','))
        $(total_tva_id).html(object['total_tva'].replace('.', ','))
        $(total_ttc_id).html(object['total_ttc'].replace('.', ','))
        total_final()

    }

    //calcule total in array
    function total(prix_ht, quantites, tva, remise_valeur, type_remise) {

        if (!test_number(prix_ht, 0) || !test_number(quantites, 0)) {
            return false

        }
        if (!prix_ht || !quantites) {
            return false

        }



        var totale_ht = parseFloat(prix_ht) * parseFloat(quantites)


        if (type_remise == 'pourcentage') {
            var total_remise = parseFloat(totale_ht) * (parseFloat(remise_valeur) / 100)
        } else if (type_remise == 'montant') {
            var total_remise = parseFloat(remise_valeur)

        }
        var new_total_ht = parseFloat(totale_ht) - parseFloat(total_remise)
        var total_tva = parseFloat(new_total_ht) * (parseFloat(tva) / 100)

        var total_ttc = parseFloat(new_total_ht) + parseFloat(total_tva)

        return {
            'total_ht': parseFloat(totale_ht).toFixed(3),
            'total_tva': parseFloat(total_tva).toFixed(3),
            'total_remise': parseFloat(total_remise).toFixed(3),
            'type_remise': parseFloat(type_remise).toFixed(3),
            'total_ttc': parseFloat(total_ttc).toFixed(3),
        }

    }

    //function final

    function total_final() {
        var total_ht = 0
        var total_remise = 0
        var total_tva = 0
        var total_ttc = 0
        $('#boncommande_table tr').each(function() {

            var currentRow = $(this).closest("tr");

            if (this.id > 0) {

                var col_ht = currentRow.find("td:eq(6)").text().replace(',', '.');
                var col_remise = currentRow.find("td:eq(7)").text().replace(',', '.');
                var col_tva = currentRow.find("td:eq(8)").text().replace(',', '.');
                var col_ttc = currentRow.find("td:eq(9)").text().replace(',', '.');


                total_ht += parseFloat(col_ht)
                total_remise += parseFloat(col_remise)
                total_tva += parseFloat(col_tva)

                total_ttc = (total_ht - total_remise) + total_tva


            }
        });
        $("#total_boncommande_ht").empty()
        $("#total_boncommande_remise").empty()
        $("#total_boncommande_tva").empty()
        $("#total_boncommande_ttc").empty()
        $("#total_boncommande_ht").html(total_ht.toFixed(3).replace('.', ','))
        $("#total_boncommande_remise").html('-' + total_remise.toFixed(3).replace('.', ','))
        $("#total_boncommande_tva").html(total_tva.toFixed(3).replace('.', ','))
        $("#total_boncommande_ttc").html(total_ttc.toFixed(3).replace('.', ','))
    }

    function test_prix(input) {
        $('#save_boncommande').attr('disabled', true)
        var prev = input.attr('old-value');

        var select_id = input.attr('id').match(/\d+/)[0]
        var catalogue_id = $("#catalogue_id_" + select_id + " option:selected").val()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/onecatalogue') }}/" + catalogue_id,
            method: 'get',
            data: {

                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (parseFloat(result.prix_ht) > parseFloat(input.val())) {
                    error_message('Le prix introduit est inférieur au prix dans le catalogue (minimum:' +
                        result.prix_ht + ' Dt)', input)
                    setTimeout("$('.erreur').hide();", 3000);

                    if (!prev) {
                        input.val(result.prix_ht)

                    } else {
                        input.val(prev)

                    }

                    input.change()
                }
                $('#save_boncommande').attr('disabled', false)

            }
        });

    }

    function generate_facture() {
        $('.erreur').empty()
        var boncommande_id = '{{ $boncommande->id }}'
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });


        swal.fire({
            title: "Générer une facture?",
            icon: 'question',
            text: "Etes-vous sûrs,vous voulez générer une facture ??  Vous ne pouvez pas changer le boncommande ultérieurement !!",
            type: "warning",
            showCancelButton: !0,
            customClass: 'swal-wide',
            confirmButtonText: "Oui, Confirmer!",
            cancelButtonText: "Non, Annuler!",
            reverseButtons: !0
        }).then(function(e) {

            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                jQuery.ajax({
                    url: "{{ url('/generatefacture') }}/" + "{{ $boncommande->id }}",
                    method: 'get',
                    data: {
                        _token: CSRF_TOKEN
                    },
                    success: function(result) {
                        if (result.error) {
                            if (result.error.boncommande_id) {
                                error_message(result.error.boncommande_id[0], "#boncommande_id")
                            }
                        } else if (result.success_id) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Facture généré avec succéss',
                                showConfirmButton: false,
                                timer: 1000
                            })

                            setTimeout(function() {

                                window.location.href = "{{ url('/updatefacture') }}/" +
                                    result.success_id


                            }, 1000);
                        }
                    }
                });

            } else {
                e.dismiss;
            }

        }, function(dismiss) {
            return false;
        })
    }

    function generate_bonlivraison() {
        jQuery.ajax({
            url: "{{ url('/boncommandebonlivraison') }}/" + "{{ $boncommande->id }}",
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.success_id) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Bonne livraison  généré avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(function() {
                        window.location.href =
                            "{{ url('bonlivraisonsupdate') }}/" + result.success_id

                    }, 1000);
                }
            },
            error: function(result) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'Vérifier la base de donnés',
                    showConfirmButton: false,
                    timer: 1000
                })

            },

        });
    }
</script>
