@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Paiements</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#payement">
                                Saisir un paiement
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="payement" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Créer un
                                                paiement</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-md-4 col-form-label">Choisir
                                                    la facture</label>
                                                <div class="col-md-8">
                                                    <select
                                                        class="js-example-basic-single js-states form-control"style="width: 100%"
                                                        id="facture_id" required onchange="change_select()">
                                                        @foreach ($factures as $facture)
                                                            <option value="{{ $facture->id }}" style="float:left">
                                                                {{ $facture->numero }}
                                                                (Solde
                                                                réstant:{{ $facture->facture_solde }})
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-md-4 col-form-label">Montant</label>
                                                <div class="col-md-8">
                                                    <input type="number" class="form-control" id="montant">

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
                                                <div class="col-md-8" style="float:none">
                                                    <select class="form-control none" id="method">
                                                        <option value="cheque">Chèque</option>
                                                        <option value="especes">Especes</option>
                                                        <option value="virement">Virement</option>
                                                        <option value="traite">Traite</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-md-4 col-form-label">Note</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" id="note" id="floatingTextarea2" style="height: 100px;width:450px"></textarea>


                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning"
                                                data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary" id="submit_paiement"
                                                onclick="paiement()">Valider
                                                le paiement</button>
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
    <!-- End Breadcromb Row -->

    <!-- Advance Table Row Start -->
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
                            @foreach ($paiements as $paiement)
                                <tr>

                                    <td>{{ $paiement->date }}</td>
                                    <td>
                                        <a href="{{ route('factures.update', ['id' => $paiement->facture->id]) }}"
                                            target="_blank" style="text-decoration: underline;"
                                            class="text-primary"><b>{{ $paiement->facture->numero }}</b> </a>

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
                                        {{ $paiement->facture->client ? $paiement->facture->client->nom : '#' }}
                                    </td>
                                    <td>
                                        {{ $paiement->montant }}
                                    </td>
                                    {{-- <td>{{ $paiement->facture->facture_solde }}</td> --}}
                                    <td> {{ $paiement->method }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">
                                                    <a href="#">
                                                        <li class="list-group-item"><i class="fa fa-file"
                                                                style="margin-right:5px"></i> Facture </li>
                                                    </a>
                                                    <a href="#" data-toggle="modal"
                                                        @if ($paiement->facture->status == 'etablir' || $paiement->facture->status == 'envoye') data-target="#update"
                                                    @elseif($paiement->facture->status == 'paye' || $paiement->facture->status == 'annuler')
                                                    data-target="#paye" @endif
                                                        class="update_button" data-id="{{ $paiement->id }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i>                                         <button class="btn btn-warning update_button" data-id="{{ $paiement->id }}" data-toggle="modal" data-target="#updateModal">Modifier</button>
 </li>
                                                    </a>
                                                    <a href="#" onclick="deletepaiement({{ $paiement->id }})">
                                                        <li class="list-group-item" style="cursor:pointer"><i
                                                                class="fa-solid fa-trash"
                                                                style="margin-right:5px;"></i>Supprimer</li>
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

<div class="modal fade" id="updateModal" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="updateModalLabel">Modifier le paiement</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="paiement_id">
                    <div class="form-group row">
                        <label for="date_update" class="col-md-4 col-form-label">Date de paiement</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" id="date_update">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="montant_update" class="col-md-4 col-form-label">Montant</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="montant_update">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="method_update" class="col-md-4 col-form-label">Méthode de paiement</label>
                        <div class="col-md-8">
                            <select class="form-control" id="method_update">
                                <option value="cheque">Chèque</option>
                                <option value="especes">Espèces</option>
                                <option value="virement">Virement</option>
                                <option value="traite">Traite</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note_update" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="note_update" style="height: 100px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="submit_paiement_update" onclick="paiement_update()">Valider les modifications</button>
                </div>
            </div>
        </div>

    <!-- Update-Modal -->

    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<script scr="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
<script>
    function change_select() {
        var id = $('#facture_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/onefacture') }}/" + id,
            method: 'get',
            success: function(result) {
                $('#montant').val(result.facture_solde)
                $('#new_solde').text(result.facture_solde)
            }
        });
    }

    $(document).ready(function() {
        change_select()
        $('.update_button').click(function() {
            var id = $(this).data('id');
            $('#paiement_id').val(id)
            console.log(id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/paiementsbyid') }}/" + id,
                method: 'get',
                success: function(result) {
                    console.log(result)
                    jQuery('#date_update').val(result.date)
                    jQuery('#montant_update').val(result.montant)
                    jQuery('#note_update').val(result.note)
                    jQuery('#solde_restant').html(parseFloat(result.montant) + parseFloat(
                        result.facture.facture_solde) + " Dt")

                    if (result.method == 'especes') {
                        $("#method_update option[value=especes]").prop('selected', true);
                    } else if (result.method == 'virement') {
                        $("#method_update option[value=virement]").prop('selected', true);

                    } else {
                        $("#method_update option[value=cheque]").prop('selected', true);

                    }
                }
            });

        });
    });

    function get_facture() {
        var facture_id = $('#facture_id').val()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/onefacture') }}/" + facture_id,
            method: 'post',
            data: {
                ordres: ordresJson,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {

                console.log(result)
                return result
            }
        });

    }





    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    function paiement() {
        $('#submit_paiement').attr('disabled', 'disabled');
        $('.erreur').empty()

        var facture_id = jQuery('#facture_id').val()
        var date = jQuery('#date').val()
        var montant = jQuery('#montant').val()
        var method = jQuery('#method').val()
        var note = jQuery('#note').val()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        if (!facture_id) {
            swal.fire({
                title: "Tous les factures sont payés",

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
            setTimeout(function() {

                location.reload(true);
            }, 1000);
        } else {
            jQuery.ajax({
                url: "{{ url('/savepaiement') }}/" + facture_id,
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


                    } else if (result.error == -1) {
                        swal.fire({
                            title: "Erreur calcule",

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


    }

    function paiement_update() {

        $('.erreur').empty()

        var paiement_id = $('#paiement_id').val()
        var date = $('#date_update').val()
        var montant = $('#montant_update').val()
        var method = $('#method_update').val()
        var note = $('#note_update').val()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        jQuery.ajax({
            url: "{{ url('/updatepaiement') }}/" + paiement_id,
            method: 'post',
            data: {
                date: date,
                montant: montant,
                method: method,
                note: note,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {

                if (result.error_montant != null) {
                    $('#submit_paiement_update').removeAttr('disabled');

                    error_message(result.error_montant, "#montant_update")
                }
                if (result.error) {

                    $('#submit_paiement_update').removeAttr('disabled');

                    if (result.error.date) {
                        error_message(result.error.date[0], "#date_update")
                    }
                    if (result.error.montant) {
                        error_message(result.error.montant[0], "#montant_update")
                    }
                    if (result.error.method) {
                        error_message(result.error.method[0], "#method_update")
                    }


                } else if (result == 200) {


                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Paiement modifié avecc succéss',
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
