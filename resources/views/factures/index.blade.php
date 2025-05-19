@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="seipkon-breadcromb-left">
                            <h3>Factures</h3>
                        </div>
                    </div>
                    <div class="col-md-2 ">

                        <select class="form-control status-dropdown">
                            <option value="">Tous</option>
                            <option value="en cours">en cours</option>
                            <option value="valide">valide</option>
                            <option value="partiellement payé">partiellement payé</option>
                            <option value="payée en totalité">payée en totalité </option>

                        </select>
                    </div>

                    <div class="col-md-4 ">
                        <div class="seipkon-breadcromb-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                                Nouvelle facture
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Choisir le
                                                        client</label>
                                                    <div class="col-md-8">
                                                        <select
                                                            class="js-example-basic-single js-states form-control"style="width: 100%"
                                                            id="client_id">
                                                            @foreach ($clients as $client)
                                                                <option value="{{ $client->id }}" style="float:left">
                                                                    {{ $client->nom }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="form-group row" id="ordres_div">
                                                    <label for='inputPassword' class='col-md-4 col-form-label'>Choisir
                                                        l'entreprise</label>
                                                    <div class='col-md-8'>
                                                        <select
                                                            class="js-example-basic-single js-states form-control"style="width: 100%"
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
                                                <button type="button" class="btn btn-warning"
                                                    data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary" id="submit_factures">Valider
                                                    la
                                                    facture</button>
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
    </div>
    <!-- End Breadcromb Row -->

    <!-- Advance Table Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-box">
                <div class="datatables-example-heading">

                </div>
                <div class="table-responsive ">
                    <table class="table display nowrap table-bordered facture_table_index">
                        <thead>
                            <tr>
                                <th>Facture </th>
                                <th>Client</th>
                                <th>Entreprise</th>
                                <th>Total ttc</th>
                                <th>Payé</th>
                                <th>Reste</th>
                                <th>Date</th>
                                <th>Statut </th>
                                {{-- <th>Status</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($factures as $facture)
                                <tr>

                                    <td><a href="{{ route('factures.update', ['id' => $facture->id]) }}"
                                            style="text-decoration: underline;"
                                            class="text-success"><b>{{ $facture->numero }}</b> </a> </td>
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
                                            <span class="badge badge-success">payée en totalité</span>
                                        @elseif($facture->status == 'valide')
                                            <span class="badge badge-info">valide</span>
                                        @elseif($facture->status == 'en cours')
                                            <span class="badge">en cours</span>
                                        @elseif($facture->status == 'paye_partielle')
                                            <span class="badge badge-warning"> partiellement payé</span>
                                        @endif

                                    </td>
                                    {{-- <td><span class="badge badge-warning">{{$devis->status}}</span></td> --}}
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">
                                                    <a href="{{ route('factures.print', ['id' => $facture->id]) }}">
                                                        <li class="list-group-item"><i class="fa fa-file"
                                                                style="margin-right:5px"></i> PDF </li>
                                                    </a>
                                                    <a href="{{ route('factures.update', ['id' => $facture->id]) }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    <a href="#" class="addpaiement_button" data-toggle="modal"
                                                        data-target="#payement" data-id="{{ $facture->id }}">
                                                        <li class="list-group-item">
                                                            <i class="fa-solid fa-credit-card"></i>
                                                            Saisir le paiement
                                                        </li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="list-group-item" style="cursor:pointer"
                                                            onclick="deletefacture({{ $facture->id }})"><i
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
    <div class="modal fade" id="payement" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">
                        Saisir le paiement:<span style="font-size:13px;">Solde
                            réstant(<span id="new_solde"></span> TND)</span>

                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="paiement_form">

                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">
                                Montant</label>
                            <div class="col-md-8">
                                <input type="hidden" id="facture_id" value="" />
                                <input type="number" class="form-control" id="montant" value="">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Date du
                                paiement</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" id="date" value="{{ date('Y-m-d') }}">

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
                                    <option value="traite">Traite</option>

                                </select>

                            </div>
                        </div>
                        {{-- <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">
                                                        Retenu a la source</label>
                                                    <div class="col-md-8">
                                                        <i class="fa-solid fa-toggle-on text-success"
                                                            style="font-size:24px;cursor:pointer" id="active"
                                                            value="active" status="1"
                                                            onclick="change_togle($(this))"></i>
                                                        <i class="fa-solid fa-toggle-off text-dark"
                                                            style="font-size:24px;cursor:pointer;display:none"
                                                            id="desactive" value="desactive" status="0"
                                                           onclick="change_togle($(this))" ></i>
                                                    </div>
                                                </div> --}}
                        <div class="form-floating mb-3  ">
                            <label for="floatingTextarea2">Note</label>

                            <textarea class="form-control" id="note" id="floatingTextarea2" style="height: 100px"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="submit_paiement" onclick="paiement()">Valider
                            le paiement</button>
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
    $(document).ready(function() {

        //devis

        $('.addpaiement_button').click(function() {
            var id = $(this).data('id');
            $('#facture_id').val(id)
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
        });

    });
</script>
<script>
    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }
    //Testapi


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

        $('#addfacture').submit(function(e) {
            $('#submit_factures').attr('disabled', 'disabled');
            $('.erreur').empty()

            var client_id = jQuery('#client_id').val()
            var entreprise_id = jQuery('#entreprise_id').val()


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
                    type: "client",
                    client_id: client_id,
                    entreprise_id: entreprise_id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    if (result.error) {
                        $('#submit_factures').removeAttr('disabled');
                        if (result.error.date) {
                            $('#submit_factures').removeAttr('disabled');
                            error_message(result.error.date[0], "#date_facture")
                        }


                    } else if (result.error_ordres) {
                        $('#submit_factures').removeAttr('disabled');
                        error_message(result.error_ordres, "#ordres_id")
                    } else if (result.error_mf) {
                        $('#submit_factures').removeAttr('disabled');
                        error_message(result.error_mf, "#client_id")
                    } else if (result.error_existe) {
                        $('#submit_factures').removeAttr('disabled');

                        error_message(result.error_existe, "#erreurr_existe")
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
                                result.success_id
                        }, 1000);

                    }

                }
            });


        });
    });
</script>
