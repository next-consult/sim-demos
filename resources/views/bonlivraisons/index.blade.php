@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="seipkon-breadcromb-left">
                            <h3>livraison</h3>
                        </div>
                    </div>
                    <div class="col-md-2 ">

                        <select class="form-control status-dropdown">
                            <option value="">Tous </option>
                            <option value="En cours">en cours</option>
                            <option value="Valide">Valide</option>
                            <option value="Converti en facture">Converti en facture</option>

                        </select>
                    </div>
                    <div class="col-md-4 ">
                        <div class="seipkon-breadcromb-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                                Nouveau livraison
                            </button>


                        </div>
                    </div>
                    {{-- livraisonmodal --}}
                    <div class="modal fade" id="add" aria-hidden="true" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="float:left" id="exampleModalLongTitle">Créer
                                        un
                                        bonlivraison </h5>


                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="addlivraison">

                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-md-4 col-form-label">Choisir
                                                l'entreprise</label>
                                            <div class="col-md-8">
                                                <select
                                                    class="js-example-basic-single js-states form-control"style="width: 100%"
                                                    id="entreprise_id" required>
                                                    @foreach ($entreprises as $entreprise)
                                                        <option value="{{ $entreprise->id }}" style="float:left">
                                                            {{ $entreprise->nom }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-md-4 col-form-label">Choisir
                                                le client <span
                                                    style="font-size:12px;color:green;cursor:pointer;font-weight:500"
                                                    onclick="add_contact()">(Nouveau)</span></label>
                                            <div class="col-md-8">
                                                <input type="hidden" id="client_livraison_id" value="" />
                                                <select
                                                    class="js-example-basic-single js-states form-control"style="width: 100%"
                                                    id="client_id" required>
                                                    @foreach ($clients as $client)
                                                        <option value="{{ $client->id }}" style="float:left">
                                                            {{ $client->nom }}</option>
                                                    @endforeach
                                                </select>
                                                <div id="erreurr_existe">

                                                </div>

                                                <table style="margin-top:15px" id="contact_table">
                                                    <tbody>
                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning"
                                                    data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary" id="submit_livraison">Valider
                                                    le bonlivraison</button>
                                            </div>
                                </form>

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
                        <table class="table display nowrap table-bordered devis_table_index">
                            <thead>
                                <tr>
                                    <th>Devis </th>
                                    <th>Client</th>
                                    <th>Entreprise</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($livraison_array as $bonlivraison)
                                    <tr>
                                        <td><a href="{{ route('bonlivraisons.update', ['id' => $bonlivraison->id]) }}"
                                                style="text-decoration: underline;"
                                                class="text-success"><b>{{ $bonlivraison->numero }}</b> </a> </td>

                                        <td>
                                            <a href="{{ route('clients.show', ['id' => $bonlivraison->client->id]) }}"
                                                style="text-decoration: underline;"
                                                class="text-primary"><b>{{ $bonlivraison->client->nom }}
                                                </b> </a>

                                        </td>

                                        <td>{{ $bonlivraison->entreprise->nom }}</td>
                                        <td>{{ $bonlivraison->date }}</td>
                                        <td>
                                            @if ($bonlivraison->status == 'en cours')
                                                <span class="badge badge-secondary">En cours</span>
                                            @elseif($bonlivraison->status == 'valide')
                                                <span class="badge badge-info"> Valide</span>
                                            @elseif($bonlivraison->status == 'annuler')
                                                <span class="badge badge-error">Annulé</span>
                                            @elseif($bonlivraison->status == 'converti_facture' && isset($devis->facture))
                                                <a href="{{ route('factures.update', ['id' => $devis->facture->id]) }}"
                                                    target="_blank" style="text-decoration: underline;"
                                                    class="text-success"><b>Converti en facture</b> </a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    style="margin-left:20px">
                                                    Options <i class="fa-solid fa-circle-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                    <ul class="list-group">
                                                        <a href="{{ route('bonlivraisons.print', ['id' => $bonlivraison->id]) }}">
                                                            <li class="list-group-item"><i class="fa fa-file"
                                                                    style="margin-right:5px"></i> PDF </li>
                                                        </a>
                                                        <a
                                                            href="{{ route('bonlivraisons.update', ['id' => $bonlivraison->id]) }}">
                                                            <li class="list-group-item"><i class="fa fa-pen"
                                                                    style="margin-right:5px"></i> Modifier </li>
                                                        </a>
                                                        <a href="#" onclick="deletebonlivraison({{ $bonlivraison->id }})">
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
    @endsection
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
    <script scr="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
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


            $('#addlivraison').submit(function(e) {
                $('.erreur').empty();
                var test = true

                var obligatoire =
                    "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"

                var nom = $("input[name='nom[]']")
                    .map(function() {

                        if (!$(this).val()) {
                            test = false
                            $(obligatoire).insertAfter(this);

                        }
                        return $(this).val();
                    }).get();

                var email = $("input[name='email[]']")
                    .map(function() {

                        if (!$(this).val()) {
                            test = false
                            $(obligatoire).insertAfter(this);

                        }
                        return $(this).val();
                    }).get();

                var telephone = $("input[name='telephone[]']")
                    .map(function() {

                        if (!$(this).val()) {
                            test = false
                            $(obligatoire).insertAfter(this);

                        }
                        return $(this).val();
                    }).get();
                var adresse = $("textarea[name='adresse[]']")
                    .map(function() {

                        if (!$(this).val()) {
                            test = false
                            $(obligatoire).insertAfter(this);

                        }
                        return $(this).val();
                    }).get();

                if (test == false) {
                    return false
                }


                $('#submit_livraison').attr('disabled', 'disabled');
                $('.erreur').empty()
                var entreprise_id = jQuery('#entreprise_id').val()
                var client_id = jQuery('#client_id').val()

                var clients = []

                for (let j = 0; j < nom.length; j++) {

                    clients.push({
                        'nom': nom[j],
                        'email': email[j],
                        'telephone': telephone[j],
                        'adresse': adresse[j],
                    })

                }

                var clientsJson = null;
                if (clients.length > 0) {
                    var clientsJson = JSON.stringify(clients);
                }


                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/storebonlivraisons') }}",
                    method: 'post',
                    data: {
                        entreprise_id: entreprise_id,
                        client_id: client_id,
                        new_client: clientsJson,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(result) {
                        if (result.error) {

                            $('#submit_livraison').removeAttr('disabled');

                            if (result.error.dossier_id) {
                                error_message(result.error.dossier_id[0], "#dossier_id")
                            }

                            if (result.error.date) {
                                error_message(result.error.date[0], "#date_livraison")
                            }

                        } else if (result.error_existe) {
                            error_message(result.error_existe, "#erreurr_existe")
                        } else if (result.success_id) {

                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'bonslivraison ajouté avecc succéss',
                                showConfirmButton: false,
                                timer: 1000
                            })

                            setTimeout(function() {

                                window.location.href =
                                    `bonlivraisonsupdate/${result.success_id}`;

                            }, 1000);



                        }

                    },
                    error: function(result) {
                        $('#submit_livraison').removeAttr('disabled');
                    }
                });



            });
        });

        //contacts
        function add_contact() {
            if ($('#contact_table tr').length == 0) {
                $('#contact_table tbody').append("<tr> " +
                    "<td style='width:90%'><br>" +
                    "<input type='hidden' class='form-control' name='id_client[]' value='new'><input type='text' class='form-control' placeholder='Nom client' name='nom[]'>" +

                    "<input type='text' class='form-control' name='email[]' placeholder='Email'" +
                    " style='margin-top:5px'>" +


                    "<input type='text' class='form-control' name='telephone[]' placeholder='Telephone'" +
                    " style='margin-top:5px'>" +

                    "<textarea type='text' class='form-control' name='adresse[]' placeholder='Adresse'" +
                    " style='margin-top:5px'></textarea>" +

                    "<td>" +
                    "<a class='btn btn-danger ' style='float:right;margin-left:5px;margin-top:20px' onclick=delete_contact($(this))><span style='font-size:12px'>Annuler</span></a>" +
                    "</td>" +
                    " </tr>")
            }
        }

        function delete_contact(row) {
            row.closest('tr').remove();
        }
    </script>
