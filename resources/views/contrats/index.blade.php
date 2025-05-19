@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des contrats</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <a href="{{ route('contrats.create') }}">
                                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#add">Ajouter un
                                    contrat</button>
                            </a>
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
                <div class="table-responsive advance-table">
                    <table class="table display table-bordered devis_table_index">
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Client</th>
                                <th>Entreprise</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contrats as $contrat)
                                <tr>

                                    <td>{{ $contrat->numero }}</td>
                                    <td>{{ $contrat->client->nom }}</td>
                                    <td>{{ $contrat->entreprise->nom }}</td>
                                    <td>{{ \Carbon\Carbon::parse($contrat->date_debut)->format('Y-m-d')}}</td>
                                    <td>{{ \Carbon\Carbon::parse($contrat->date_fin)->format('Y-m-d') }}</td>
                                    <td style="text-align:left">
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">
                                                    <a href="#" data-toggle="modal" data-target="#files-opp"
                                                        class="contrat_button" data-id="{{ $contrat->id }}">
                                                        <li class="list-group-item" style="cursor:pointer">

                                                            <i class="fa-solid fa-eye" style="margin-right:5px;"></i>Voir
                                                            factures
                                                        </li>
                                                    </a>

                                                    <a href="{{ route('contrats.update', ['id' => $contrat->id]) }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="list-group-item" style="cursor:pointer"
                                                            onclick="deletecontrat({{ $contrat->id }})"><i
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
    <div class="modal fade" id="files-opp" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Les factures du contrat
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
                                <th scope="col" style="text-align:center">Date Facture</th>
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
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {

        $('.contrat_button').click(function() {
            var id_op = $(this).data('id')
            $('#id-opp').val(id_op)
            jQuery.ajax({
                url: "{{ url('/onecontrat') }}/" + id_op,
                method: 'get',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    $("#table-facture-show tbody").empty()
                    var tableBody = $("#table-facture-show tbody");
                    for (var i = 0; i < result.facture_month.length; i++) {
						console.log(result.facture_month[i].id);
                        var row = $("<tr>");
                        var numero = $("<td style='text-align:center'>").append(
                            `<a id='dev-num${result.facture_month[i].id}'><b >
                            ${result.facture_month[i].numero} 
                            </b></a>`);
                        var date = $("<td style='text-align:center'>").append(
                            `<a id='dev-num${result.facture_month[i].id}'><b >
                            ${result.facture_month[i].date} 
                            </b></a>`);
                        row.append(numero);
                        row.append(date);
                        tableBody.append(row);
                        var myUrl = `updatefacture/${result.facture_month[i].id}`;
                        $(`#dev-num${result.facture_month[i].id}`).attr('href', myUrl);
                    }

                }
            });

        })
    });
</script>
