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
                        <h3><span>{{ $bonlivraison->client->nom }} </span></h3>
                    </div>
                    <div class="col-md-8">
                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">



                            <button type="button" class="btn btn-info  " onclick="savebonlivraison()"
                                id="save_bonlivraison"><i class="fa fa-check"></i>
                                Enregistrer</button>



                        </div>
                        <div class="dropdown">
                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left:20px">
                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                <ul class="list-group">
                                    <a href="{{ route('bonlivraisons.print', ['id' => $bonlivraison->id]) }}">
                                        <li class="list-group-item"><i class="fa fa-file" style="margin-right:5px"></i>
                                            PDF </li>
                                    </a>



                                    {{-- <a href="#">
                                            <li class="list-group-item" style="cursor:pointer"><i class="fa-solid fa-trash"
                                                    style="margin-right:5px;"></i>Supprimer</li>
                                        </a> --}}
                                </ul>
                            </div>
                        </div>


                        <a href="{{ route('bonlivraisons.index') }} "><button type="button"
                                class="btn btn-warning btn_retour" style=" margin-left: 120px;
"><i
                                    class="fa-solid fa-backward"></i>Retour</button></a>

                    </div>


                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="page-box">
                <div class="invoice-box">
                    <h4 class="invoice-status">{{ $bonlivraison->status }}</h4>
                    <div class="invoice-head">
                        <h2>#{{ $bonlivraison->numero }} @if ($bonlivraison->client->type == 'sans_taxe')
                                <span style="font-size: 18px; color: #A93226;text-transform: initial;">(Client exonéré de
                                    tva)</span>
                            @elseif($bonlivraison->client->type == 'avec_taxe')
                                <span style="font-size: 18px; color: #145A32;text-transform: initial;">(Client avec
                                    taxe)</span>
                            @endif
                            </span></h2>

                    </div>
                    <div class="invoice-address">
                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="invoice-company-address">
                                    <h3>Entreprise</h3>
                                    <p class="name-invoice"><b>{{ $bonlivraison->entreprise->nom }}</b></p>
                                    <p>{{ $bonlivraison->entreprise->adresse }}</p>
                                    <p>Tel No: {{ $bonlivraison->entreprise->telephone }}</p>
                                    <p>Email: {{ $bonlivraison->entreprise->email }}</p>
                                    <p>Web: {{ $bonlivraison->entreprise->web }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="billed-to-address">
                                    <h3>Client</h3>
                                    <p class="name-invoice"><b>{{ $bonlivraison->client->nom }}
                                        </b>
                                    </p>
                                    <p>{{ $bonlivraison->client->adresse }}</p>
                                    <p>Tel No: {{ $bonlivraison->client->telephone }}</p>
                                    <p>Email: {{ $bonlivraison->client->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="billed-to-address">
                                    <h3>Options</h3>
                                    <div class="form-group row">
                                        <p class="name-invoice col-md-4 col-form-label" style="margin-top:10px">
                                            <b>Client</b>
                                        </p>
                                        <div class="col-md-8">

                                            @if ($bonlivraison->status == 'en cours')
                                                <select class="form-control none" id="client_id">
                                                    @foreach ($clients as $client)
                                                        <option value="{{ $client->id }}"
                                                            {{ $bonlivraison->client->id == $client->id ? 'selected' : '' }}>
                                                            {{ $client->nom }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            @else
                                                <span class="form-control disabled">{{ $bonlivraison->client->nom }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <p class="name-invoice col-md-4 col-form-label" style="margin-top:10px"><b>Numéro de
                                                bon de livraison</b></p>
                                        <div class="col-md-8">
                                            {{-- @if ($bonlivraison->status != 'converti_facture')
                                            <input type="text" class="form-control" id="numero_bonlivraison"
                                                value="{{ $bonlivraison->numero }}">
                                            @else
                                            <span class="form-control disabled">{{ $bonlivraison->numero }}</span>
                                             @endif --}}
                                            <span class="form-control disabled">{{ $bonlivraison->numero }}</span>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <p class="name-invoice col-md-4 col-form-label" style="margin-top:10px"><b>Date
                                                de bon de livraison</b></p>
                                        <div class="col-md-8">

                                            @if ($bonlivraison->status != 'converti_facture')
                                                <input type="date" class="form-control" id="date_bonlivraison"
                                                    value="{{ $bonlivraison->date }}">
                                            @else
                                                <span class="form-control disabled">{{ $bonlivraison->date }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <p class="name-invoice col-md-4 col-form-label" style="margin-top:10px">
                                            <b>Status</b>
                                        </p>
                                        <div class="col-md-8">

                                            @if ($bonlivraison->status == 'en cours')
                                                <select class="form-control none" id="status">
                                                    <option value="en cours"
                                                        {{ $bonlivraison->status == 'en cours' ? 'selected' : '' }}>En
                                                        cours
                                                    </option>
                                                    <option value="valide"
                                                        {{ $bonlivraison->status == 'valide' ? 'selected' : '' }}>
                                                        Valide</option>
                                                </select>
                                            @elseif($bonlivraison->status == 'valide')
                                                <span class="form-control disabled">Valide</span>
                                            @elseif($bonlivraison->status == 'converti_facture' || $bonlivraison->status == 'valide')
                                                <span class="form-control disabled">Converti en facture</span>
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
                        @if ($bonlivraison->status != 'converti_facture' && $bonlivraison->status != 'valide')
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
                            <table class="table table-bordered" id="bonlivraison_table">
                                <tr id=0 style="background:#DEE2E6 ">
                                    <th>Produit</th>
                                    <th>Déscription</th>
                                    <th style="width:10%">Quantités:</th>
                                    <th>Quantité en Stock</th>
                                    @if ($bonlivraison->status != 'converti_facture' && $bonlivraison->status != 'valide')
                                        <th>#</th>
                                    @endif
                                </tr>
                                @if (count($bonlivraison->items) > 0)
                                    @foreach ($bonlivraison->items as $key => $item)
                                        <tr id="{{ $key + 1 }}">

                                            <td>
                                                <input type='hidden' class='form-control' value={{ $item->id }}
                                                    name='id[]'>

                                                @if ($bonlivraison->status != 'converti_facture' && $bonlivraison->status != 'valide')
                                                    <input type="text" class="form-control"
                                                        value="{{ $item->produit }}"name="produits[]"
                                                        id="{{ $key + 1 }}_produit">
                                                @else
                                                    <span class="form-control disabled"> {{ $item->produit }}</span>
                                                @endif



                                            </td>
                                            <td>
                                                <textarea class='form-control' id='description_id[]-{{ $key + 1 }}' name='description[]'
                                                    @if ($bonlivraison->status == 'converti_facture' || $bonlivraison->status == 'valide') disabled @endif>{{ $item->description }}</textarea>
                                            </td>
                                            <td>
                                                @if ($bonlivraison->status != 'converti_facture' && $bonlivraison->status != 'valide')
                                                    <input type="number" class="form-control"
                                                        value="{{ $item->quantites }}" name="quantites[]" min="1"
                                                        required onchange=calcule($(this))
                                                        id="quantites_id-{{ $key + 1 }}">
                                                @else
                                                    <span class="form-control disabled">{{ $item->quantites }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->stock)
                                                    <span class="form-control disabled">{{ $item->stock->qte }}</span>
                                                @else
                                                    <span class="form-control disabled">N/A</span>
                                                @endif
                                            </td>
                                            @if ($bonlivraison->status != 'converti_facture' && $bonlivraison->status != 'valide')
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
                                        value="@if ($bonlivraison->condition) {{ $bonlivraison->condition }}@else {{ $bonlivraison->entreprise->condition }}@endif" />  --}}


                                    <textarea
                                        class="form-control  @error('condition') is-invalid @enderror @if ($bonlivraison->status == 'converti_facture' || $bonlivraison->status == 'valide') disabled @endif"
                                        @if ($bonlivraison->status == 'converti_facture' || $bonlivraison->status == 'valide') disabled @endif name="condition">
                                    @if ($bonlivraison->condition)
{{ $bonlivraison->condition }}@else{{ $bonlivraison->entreprise->condition }}
@endif
                                    </textarea>


                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="invoice-action">
                        <div class="row">
                            <div class="col-md-12">

                                <h4 style="color:#333;float:left">Pied de la page :</h4>
                                <br>


                                <textarea class="form-control  @if ($bonlivraison->status == 'converti_facture') disabled @endif" name="footer"
                                    @if ($bonlivraison->status == 'converti_facture' || $bonlivraison->status == 'valide') disabled @endif>
@if ($bonlivraison->footer)
{{ $bonlivraison->footer }}@else{{ $bonlivraison->entreprise->footer }}
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
                            <input type="hidden" id="client_id" />
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
        //status bonlivraison
        var status_bon = '{{ $bonlivraison->status }}'

        if (status_bon == 'annuler') {
            $('.invoice-status').css('background', 'red')
            $('.invoice-status').toggleClass('annuler');
            $('.invoice-status').html('Annulé')

        } else if (status_bon == 'en cours') {
            $('.invoice-status').css('background', '#A6ACAF')
            $('.invoice-status').toggleClass('etablir');
            $('.invoice-status').html('En cours')

        } else if (status_bon == 'valide') {
            $('.invoice-status').css('background', '#21618C')
            $('.invoice-status').toggleClass('envoye');
            $('.invoice-status').html('bonlivraison valide')

        } else if (status_bon == 'paye') {
            $('.invoice-status').html('Payé')

        } else if (status_bon == 'converti_facture') {
            $('.invoice-status').css('background', '#0B5345')
            $('.invoice-status').toggleClass('paye_total');
            $('.invoice-status').html('bonlivraison converti')

        }


        $('#bonlivraison_table tr').each(function() {
            if (this.id > 0) {
                var tva_id = "#tva_id-" + this.id

                var type_client = '{{ $bonlivraison->client->type }}'
                if (type_client == 'sans_taxe') {
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
            var page_data = {{ Js::from($bonlivraison->items) }};
            var rowCount = $('#bonlivraison_table  tr').length;
            var id = 0;
            if (rowCount > 1) {
                var id = $('#bonlivraison_table tr').last().attr('id');
            }

            var id_1 = parseInt(id) + 1;
            var name_remise = "type_remise-" + id_1;
            var catalogue_id = "catalogue_id_" + id_1;
            var quantites_id = "quantites_id-" + id_1;
            var prix_id = "prix_id-" + id_1;
            var tva_id = "tva_id-" + id_1;
            var remise_id = "remise_id-" + id_1;

            var total_ht_id = "total_ht_id-" + id_1;
            var total_remise_id = "total_remise_id-" + id_1;
            var total_tva_id = "total_tva_id-" + id_1;
            var total_ttc_id = "total_ttc_id-" + id_1;
            var description = "description_id-" + id_1;

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
                    console.log(result);
                    $('#bonlivraison_table tr:last').after(
                        "<tr id=" + id_1 +
                        "><td><input type='hidden' class='form-control' value='" + result.id +
                        "' name='id[]'> <input type='text' class='form-control' name='produits[]' value='" +
                        result.produit + "' id=" + catalogue_id + "_produit>" +
                        "</td>" +
                        "<td><textarea class='form-control' id=" + description +
                        " name='description[]'   >" +
                        "" + result.description + "</textarea></td>" +
                        "<td><input type='number' class='form-control'  value='" + result.quantites +
                        "' name='quantites[]' onchange=calcule($(this)) required id=" + quantites_id +
                        "></td><td><span class='form-control disabled'>" + result.stocks.qte + "</span></td>" +
                        "<td><a class='btn btn_mobile' onclick ='delete_operation($(this))'>X</a></td></tr>"
                    );

                    $("#produit_catalogue .close").click();
                    total_final();
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

    function addoperation(test) {
        var page_data = {{ Js::from($bonlivraison->items) }};
        var rowCount = $('#bonlivraison_table tr').length;
        var id = rowCount > 1 ? $('#bonlivraison_table tr').last().attr('id') : 0;
        var id_1 = parseInt(id) + 1;
        var name_remise = "type_remise-" + id_1;
        var catalogue_id = "catalogue_id_" + id_1;
        var quantites_id = "quantites_id-" + id_1;
        var prix_id = "prix_id-" + id_1;
        var tva_id = "tva_id-" + id_1;
        var remise_id = "remise_id-" + id_1;

        var total_ht_id = "total_ht_id-" + id_1;
        var total_remise_id = "total_remise_id-" + id_1;
        var total_tva_id = "total_tva_id-" + id_1;
        var total_ttc_id = "total_ttc_id-" + id_1;
        var description = "description_id-" + id_1;

        var object = {
            'id': catalogue_id
        };

        $('#bonlivraison_table tr:last').after(
            `<tr id="${id_1}">
            <td>
                <input type='hidden' class='form-control' value='new' name='id[]'>
                <input type='text' class='form-control' name='produits[]' id='${catalogue_id}_produit'>
                <input type='hidden' name='catalogue_ids[]' value='${catalogue_id}'>
            </td>
            <td>
                <textarea class='form-control' id='${description}' name='description[]'></textarea>
            </td>
            <td>
                <input type='number' class='form-control' name='quantites[]' onchange='calcule($(this))' required id='${quantites_id}'>
            </td>
            <td>
                <a class='btn btn_mobile' onclick='delete_operation($(this))'>X</a>
            </td>
        </tr>`
        );
    }

    //delete row
    function delete_operation(row) {
        row.closest('tr').remove();
        total_final()
    }

    function savebonlivraison(type_save) {
        $('.erreur').empty();
        let test = true;
        let title_var = "";
        const obligatoire =
            "<p class='text-danger erreur' style='float:left;font-size:13px'>Ce champ est obligatoire</p>";
        const quantiteError =
            "<p class='text-danger erreur' style='float:left;font-size:13px'>Ce champ doit être supérieur ou égal à 1</p>";
        const numberError =
            "<p class='text-danger erreur' style='float:left;font-size:13px'>Ce champ doit être supérieur ou égal à 0,001</p>";

        if ($('#bonlivraison_table tr').length <= 1) {
            test = false;
            title_var = "Le bonlivraison est vide";
        } else {
            title_var = "Il faut remplir tous les champs correctement";
        }

        const ids = $("input[name='id[]']").map(function() {
            return $(this).val();
        }).get();

        const productIds = $("input[name='catalogue_ids[]']").map(function() {
            return $(this).val();
        }).get();

        const quantites = $("input[name='quantites[]']").map(function() {
            if (!$(this).val()) {
                test = false;
                $(obligatoire).insertAfter(this);
            } else if (!test_number($(this).val(), 0.001)) {
                test = false;
                $(quantiteError).insertAfter(this);
            }
            return $(this).val();
        }).get();

        const descriptions = $("textarea[name='description[]']").map(function() {
            if (!$(this).val()) {
                test = false;
                $(obligatoire).insertAfter(this);
            }
            return $(this).val() + '\n';
        }).get();

        const produits = $("input[name='produits[]']").map(function() {
            if (!$(this).val()) {
                test = false;
                $(obligatoire).insertAfter(this);
            }
            return $(this).val();
        }).get();

        if (!test) {
            Swal.fire({
                title: title_var,
                timer: 1000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            });
            return;
        }

        const items = quantites.map((quantite, i) => ({
            id: ids[i],
            produit: produits[i],
            productId: productIds[i], // Include productId here
            description: descriptions[i],
            quantites: quantite
        }));

        const data = {
            items: JSON.stringify(items),
            condition: $("textarea[name='condition']").val(),
            footer: $("textarea[name='footer']").val(),
            status: $('#status').val(),
            type: $('#type').val(),
            date_bonlivraison: $('#date_bonlivraison').val(),
            client_id: $('#client_id').val(),
            _token: "{{ csrf_token() }}"
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url('/storebonlivraisonsupdate') }}/{{ $bonlivraison->id }}",
            method: 'POST',
            data: data,
            success: function(result) {
                if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Bon de livraison configuré avec succès',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    setTimeout(() => {
                        location.reload(true);
                    }, 1000);
                }
				 window.location.href = "{{ url('/bonlivraisons') }}";
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    if (xhr.responseJSON.error.stock_insuffisant) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: xhr.responseJSON.error.stock_insuffisant,
                            showConfirmButton: true,
                            timer: 3000
                        });
                    } else {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'Une erreur est survenue',
                            showConfirmButton: true,
                            timer: 3000
                        });
                    }
                }
            }
        });


    }
</script>
