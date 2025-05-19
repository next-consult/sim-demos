@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des dossiers</h3>
                        </div>
                    </div>
                    <div class="col-md-2 ">

                        <select class="form-control status-dropdown">
                            <option value="">Tous les types</option>
                            <option value="Client avec taxe">Client avec taxe</option>
                            <option value="Client Exonéré">Client Exonéré</option>

                        </select>
                    </div>
                    {{-- <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">

                            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#add">Ajouter un
                                dossier</button>

                            <!-- Modal -->
                            <div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Créer un
                                                dossier</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="adddossier">

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
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Choisir le
                                                        client</label>
                                                    <div class="col-md-8">
                                                        <select
                                                            class="js-example-basic-single js-states form-control"style="width: 100%"
                                                            id="client_id">
                                                            @foreach ($clients as $client)
                                                                <option value="{{ $client->id }}" style="float:left">
                                                                    {{ $client->nom }} {{ $client->prenom }}</option>
                                                            @endforeach

                                                        </select>

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning"
                                                    data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary" id="submit_dossier"
                                                    onclick="add_dossier()">Valider le
                                                    dossier</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> --}}
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
                <div class="table-responsive advance-table">
                    <table  class="table display table-bordered dossier_table_index">
                        <thead>
                            <tr>
                                <th>Dossier</th>
                                <th>Client</th>
                                <th>Total_ttc</th>
                                <th>Total payé</th>
                                <th>Solde a payé</th>
                                <th>Catégorie</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dossiers as $dossier)
                                <tr>
                                    <td><a href="{{ route('dossiers.update', ['id' => $dossier->id]) }}" target="_blank"
                                            style="text-decoration: underline;"
                                            class="text-success"><b>{{ $dossier->numero }}</b> </a> </td>
                                    <td><a href="{{ route('clients.show', ['id' => $dossier->client->id]) }}"
                                            target="_blank" style="text-decoration: underline;"
                                            class="text-info"><b>{{ $dossier->client->nom }}
                                            </b> </a> </td>
                                    <td>{{ $dossier->client->total }}</td>
                                    <td>{{ $dossier->client->paye_total }}</td>
                                    <td>{{ $dossier->client->solde }}</td>
                                    <td style="color:{{ $dossier->client->categorie->couleur }};">
                                        <b>{{ $dossier->client->categorie->nom }}({{ $dossier->client->categorie->montant }}
                                            TND)
                                            ({{ $dossier->client->categorie->nb_jours }} Jours)
                                        </b>
                                    </td>
                                    <td>
                                        @if ($dossier->client->type == 'sans_taxe')
                                            <span class="badge badge-error">Client Exonéré</span>
                                        @elseif($dossier->client->type == 'avec_taxe')
                                            <span class="badge badge-success">Client avec taxe</span>
                                        @endif
                                    </td>
                                    <td style="text-align:left">
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">

                                                    <a href="#">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="list-group-item" style="cursor:pointer" onclick="#"><i
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

    function add_dossier() {
        $('#submit_dossier').attr('disabled', 'disabled');
        $('.erreur').empty()
        var entreprise_id = jQuery('#entreprise_id').val()
        var client_id = jQuery('#client_id').val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/adddossiers') }}",
            method: 'post',
            data: {
                entreprise_id: entreprise_id,
                client_id: client_id,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {

                    $('#submit_dossier').removeAttr('disabled');

                    if (result.error.entreprise_id) {
                        error_message(result.error.entreprise_id[0], "#entreprise_id")
                    }
                    if (result.error.client_id) {
                        error_message(result.error.client_id[0], "#client_id")
                    }

                } else if (result.success_id) {

                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Dossier ajouté avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })

                    setTimeout(function() {

                        window.location.href = `updatedossiers/${result.success_id}`;

                    }, 1000);


                }


            }
        });



    }
</script>
