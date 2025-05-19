<?php
function replace($montant)
{
    $montant = str_replace('.', ',', $montant);
    return $montant;
}
$count = count($facture->paiements);
if ($count > 0) {
    $paye = true;
} else {
    $paye = false;
}
?>


@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row ">
                    <div class="col-md-4 seipkon-breadcromb-left">

                        <h3>Facture

                        </h3>
                    </div>
                    @if ($facture->status != 'paye')
                        <div class="col-md-2">

                            <select class="form-control none" id="status">
                                <option value="en cours" {{ $facture->status == 'en cours' ? 'selected' : '' }}>En cours
                                </option>
                                <option value="envoye" {{ $facture->status == 'envoye' ? 'selected' : '' }}>Envoyé</option>
                                <option value="annuler" {{ $facture->status == 'annuler' ? 'selected' : '' }}>Annulé
                                </option>
                            </select>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">




                            <div class="dropdown">
                                @if ($facture->status != 'paye')
                                    <button type="button" class="btn btn-info  " onclick="save()"><i
                                            class="fa fa-check"></i>
                                        Enregistrer la
                                        facture</button>
                                @endif
                                <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="margin-left:20px">
                                    Options <i class="fa-solid fa-circle-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                    <ul class="list-group">
                                        @if ($facture->facture_solde > 0 && $facture->status!="annuler" && $facture->status!="paye")
                                            <a data-toggle="modal" data-target="#payement" style="cursor:pointer">
                                                <li class="list-group-item">

                                                    <i class="fa-solid fa-credit-card" style="margin-right:5px;"></i>
                                                    Saisir le paiement
                                                </li>
                                            </a>
                                        @endif
                                        <a href="{{ route('factures.print', ['id' => $facture->id]) }}">
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

                            <div class="modal fade" id="payement" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">
                                                Saisir le paiement:<span style="font-size:13px;">Solde
                                                    réstant({{ $facture->facture_solde }} TND)</span>

                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="paiement_form">

                                            <div class="modal-body">

                                                <div class="form-group row">
                                                    <label for="inputPassword"
                                                        class="col-md-4 col-form-label">Montant</label>
                                                    <div class="col-md-8">
                                                        <input type="number" class="form-control" id="montant"
                                                            value="{{ $facture->facture_solde }}">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Date du
                                                        paiement</label>
                                                    <div class="col-md-8">
                                                        <input type="date" class="form-control" id="date"
                                                            value="{{ date('Y-m-d') }}">

                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Methode de
                                                        paiement</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control none" id="method">
                                                            <option value="cheque">Chèque</option>
                                                            <option value="especes">Especes</option>
                                                            <option value="virement">Virement</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="form-floating mb-3  ">
                                                    <label for="floatingTextarea2">Note</label>

                                                    <textarea class="form-control" id="note" id="floatingTextarea2" style="height: 100px"></textarea>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning"
                                                    data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary" id="submit_paiement"
                                                    onclick="paiement()">Valider
                                                    le paiement</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <a href="{{ url()->previous() }} "><button type="button" class="btn btn-warning btn_retour"
                                    style=" margin-left:60px;"><i class="fa-solid fa-backward"></i>Retour</button></a>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcromb Row -->
    <div class="row">
        <div class="col-md-9">
            <div class="page-box">
                <div class="invoice-box">
                    <h4 class="invoice-status"></h4>
                    <div class="invoice-head">
                        <h2>{{ $facture->numero }}
                        </h2>
                    </div>
                    <div class="invoice-address">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="invoice-company-address">
                                    <h3>Entreprise</h3>
                                    <p class="name-invoice"><b>{{ $facture->entreprise->nom }}</b></p>

                                    <p>{{ $facture->entreprise->adresse }}</p>
                                    <p>Tel No: {{ $facture->entreprise->telephone }}</p>
                                    <p>Email: {{ $facture->entreprise->email }}</p>
                                    <p>Web: {{ $facture->entreprise->web }}</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="billed-to-address">
                                    <h3>Client</h3>
                                    <p class="name-invoice"><b>{{ $facture->client->nom }}
                                            {{ $facture->client->prenom }}</b>
                                    </p>
                                    <p>{{ $facture->client->adresse }}</p>
                                    <p>Tel No: {{ $facture->client->telephone }}</p>
                                    <p>Email: {{ $facture->client->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="invoice-table" style="margin-top:30px">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="ordre_table">
                                <thead>
                                    <tr>
                                        <th class="th-livraison">No ordre</th>
                                        <th class="th-livraison">Description</th>
                                        <th class="th-livraison" style="width:12%">Prix unitaire HT</th>
                                        <th class="th-livraison" style="width:12%">TVA</th>
                                        <th class="th-livraison" style="width:17%">Remise</th>
                                        <th class="th-livraison">Total remise</th>
                                        <th class="th-livraison">Total TVA</th>
                                        <th class="th-livraison">Total TTC</th>
                                    </tr>
                                </thead>
                                @foreach ($facture->ordres as $key => $ordre)
                                    <tr>
                                        <td class="livraison">{{ $ordre->numero }}</td>
                                        <td class="livraison">
                                            {{ $ordre->pivot->description }}
                                        </td>
                                        <td class="livraison"> {{ replace(sprintf('%.3f', $ordre->pivot->prix_ht)) }}</td>
                                        <td class="livraison">{{ replace(sprintf('%.3f', $ordre->pivot->tva)) }}</td>
                                        <td class="livraison">

                                            {{ replace(sprintf('%.3f', $ordre->pivot->remise)) }}
                                            @if ($ordre->pivot->type_remise == 'pourcentage')
                                                %
                                            @elseif($ordre->pivot->type_remise == 'montant')
                                                TND
                                            @endif


                                        </td>

                                        <td class="livraison">{{ replace(sprintf('%.3f', $ordre->pivot->total_remise)) }}
                                        </td>
                                        <td class="livraison">{{ replace(sprintf('%.3f', $ordre->pivot->total_tva)) }}
                                        </td>
                                        <td class="livraison">{{ replace(sprintf('%.3f', $ordre->pivot->total_ttc)) }}
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                    <div class="invoice-address" style="margin-top:35px">
                        <div class="row justify-content-between">
                            <div class="col-md-8">
                                @if (count($facture->paiements) > 0)
                                    <div class="invoice-company-address">
                                        <h3>Les paiements effectués</h3>


                                    </div>
                                    <table class="table table-bordered" style="width:80%;margin-top:10px">
                                        <thead>
                                            <tr>
                                                <th class="th-livraison">
                                                    Montant
                                                </th>
                                                <th class="th-livraison">
                                                    Date de paiement
                                                </th>
                                                <th class="th-livraison">
                                                    Méthodes
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($facture->paiements as $paiement)
                                                <tr>
                                                    <td class="livraison">
                                                        {{ replace(sprintf('%.3f', $paiement->montant)) }}
                                                    </td>
                                                    <td class="livraison">{{ date('Y-m-d', strtotime($paiement->date)) }}
                                                    </td>
                                                    <td class="livraison">{{ $paiement->method }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>


                                    </table>
                                @endif

                                <div class="invoice-subtotal" style="text-align:left">
                                    <p class="paiement-facture"><span>Total Payé:</span>-
                                        {{ replace(sprintf('%.3f', $facture->facture_paye)) }}
                                        TND</p>


                                    <p class="paiement-facture"><span>Solde restant:</span> <span
                                            class="total-style-solde">{{ replace(sprintf('%.3f', $facture->facture_solde)) }}
                                            TND</span>
                                    </p>


                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="invoice-subtotal" style="text-align:left">
                                    <p><span>Total HT:</span> {{ replace(sprintf('%.3f', $facture->facture_ht)) }} TND</p>


                                    <p><span>Total TVA:</span> {{ replace(sprintf('%.3f', $facture->facture_tva)) }} TND
                                    </p>
                                    <p><span>Total Frais:</span> {{ replace(sprintf('%.3f', $facture->facture_debour)) }}
                                        TND
                                    </p>
                                    <p><span>Timbre:</span> {{ replace(sprintf('%.3f', $facture->timbre)) }}
                                        TND
                                    </p>
                                    <p><span>Total Remise:</span>
                                        -{{ replace(sprintf('%.3f', $facture->facture_remise)) }}TND
                                    </p>
                                    <p><span>Total
                                            TTC:</span> <span
                                            class="total-style-ttc">{{ replace(sprintf('%.3f', $facture->facture_ttc)) }}
                                            TND</span>
                                    </p>

                                    {{-- <h3 style="font-size:18px">Total
                                        TTC:{{ replace(sprintf('%.3f', $facture->facture_ttc)) }}
                                        TND </h3> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-action">
                        <div class="row">
                            <div class="col-md-12">

                                <h4 style="color:#333;float:left">Pied de la page :</h4>
                                <br>


                                <p style="text-align:left;color:black">{{ $facture->footer }}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="page-box">
                <div class="invoice-box" style="margin-top:5px">
                    <h3 style="font-size: 18px;color: black;border-bottom:1px black solid;padding-bottom:8px">
                        Liste des frais
                    </h3>

                    @foreach ($facture->frais as $frais)
                        <p class="detail-facture"><b>Nom :</b> {{ $frais->nom }}</p>

                        <p class="detail-facture"><b>Montant :</b> {{ $frais->montant }} TND</p>
                    @endforeach


                </div>
            </div>
            <div class="page-box">
                <div class="invoice-box">
                    <h3 style="font-size: 18px;color: black;border-bottom:1px black solid;padding-bottom:8px">
                        Options:
                    </h3>


                    <p class="detail-facture"><b>#Numéro :</b> {{ $facture->numero }}</p>

                    <p class="detail-facture"><b>Date :</b> {{ $facture->date }} </p>

                    <p class="detail-facture"><b>Date paiement :</b>
                        {{ date('Y-m-d', strtotime($facture->date_paiement)) }}
                    </p>

                    
                </div>
            </div>
        </div>



    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<script>
    function save() {

        var status = jQuery('#status').val()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/changestatus') }}/" + '{{ $facture->id }}',
            method: 'post',
            data: {
                status: status,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Facture configuré avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })

                    setTimeout(function() {

                        location.reload(true);
                    }, 1000);

                } else {
                    setTimeout(function() {

                        location.reload(true);
                    }, 1000);

                }

            }
        });











    }







    $(document).ready(function() {

        var status_facture = '{{ $facture->status }}'

        if (status_facture == 'annuler') {
            $('.invoice-status').css('background', 'red')
            $('.invoice-status').toggleClass('annuler');
            $('.invoice-status').html('Annulé')

        } else if (status_facture == 'en cours') {
            $('.invoice-status').css('background', '#A6ACAF')
            $('.invoice-status').toggleClass('etablir');
            $('.invoice-status').html('En cours')

        } else if (status_facture == 'envoye') {
            $('.invoice-status').css('background', '#21618C')
            $('.invoice-status').toggleClass('envoye');
            $('.invoice-status').html('Envoyé')

        } else if (status_facture == 'paye') {
            $('.invoice-status').html('Payé')

        }


        var ids = $("input[name='id[]']")
            .map(function() {

                if (!$(this).val()) {
                    test = false

                }

                return $(this).val();
            }).get();


        for (id of ids) {

            $("#ordre_select option[value=" + parseInt(id) + "]").prop('selected', true);

        }

    });

    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    function paiement() {
        $('#submit_paiement').attr('disabled', 'disabled');
        $('.erreur').empty()

        var date = jQuery('#date').val()
        var montant = jQuery('#montant').val()
        var method = jQuery('#method').val()
        var note = jQuery('#note').val()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/savepaiement') }}/" + '{{ $facture->id }}',
            method: 'post',
            data: {
                date: date,
                montant: montant,
                method: method,
                note: note,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                console.log(result.error_montant);
                if (result.error_montant != null) {
                    $('#submit_paiement').removeAttr('disabled');

                    error_message(result.error_montant, "#montant")
                }
                if (result.error) {

                    $('#submit_paiement').removeAttr('disabled');

                    if (result.error.date) {
                        error_message(result.error.date[0], "#date")
                    }
                    if (result.error.montant) {
                        error_message(result.error.montant[0], "#montant")
                    }
                    if (result.error.method) {
                        error_message(result.error.method[0], "#method")
                    }


                } else if (result == 200) {


                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Paiement effectué avecc succéss',
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
