@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des ordre de transports </h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                                Nouveau ordre de travail
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Générer
                                                les
                                                ordres de travail a travers un devis</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                        </div>
                                        <form id="addordre">

                                            <div class="modal-body" style="text-align:left">
                                                <div id="div_avec_devis">
                                                    <div class="form-group row">
                                                        <label for="inputPassword" class="col-md-4 col-form-label">Choisir
                                                            le devis </label>
                                                        <div class="col-md-8">
                                                            <select
                                                                class="js-example-basic-single js-states form-control"style="width: 100%"
                                                                id="devis_id">
                                                                @foreach ($devis as $devi)
                                                                    <option value="{{ $devi->id }}" style="float:left">
                                                                        {{ $devi->numero }}
                                                                        ({{ $devi->dossier->client->nom }})
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>





                                                {{-- //avec devis// --}}
                                                {{-- sans devis --}}
                                                {{-- <div id="div_sans_devis" style="display:none">
                                                    <div class="form-group row">
                                                        <label for="inputPassword" class="col-md-4 col-form-label">Choisir
                                                            l'entreprise</label>
                                                        <div class="col-md-8">
                                                            <select class="js-example-basic-single js-states form-control"
                                                                style="width: 100%" id="entreprise_id" required>
                                                                @foreach ($entreprises as $entreprise)
                                                                    <option value="{{ $entreprise->id }}"
                                                                        style="float:left">
                                                                        {{ $entreprise->nom }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputPassword" class="col-md-4 col-form-label">Choisir
                                                            le
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


                                                </div> --}}
                                                {{-- //sans devis// --}}


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning"
                                                    data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary" id="submit_ordre">Valider
                                                </button>
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
                <div class="table-responsive advance-table">
                    <table class="table display table-bordered ordres_table_index">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Devis</th>
                                <th>Facture</th>
                                <th>Dossier</th>
                                <th>Chauffeur</th>
                                <th>Camion</th>
                                <th>Date de livraison</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ordres as $ordre)
                                <tr>
                                    <td><a href="{{ route('ordres.update', ['id' => $ordre->devis->id, 'all' => $ordre->id]) }}"
                                            target="_blank" style="text-decoration: underline;"
                                            class="text-success"><b>{{ $ordre->numero }}</b> </a> </td>

                                    <td>

                                        <a href="{{ route('devis.update', ['id' => $ordre->devis->id]) }}" target="_blank"
                                            style="text-decoration: underline;"
                                            class="text-primary"><b>{{ $ordre->devis->numero }}</b> </a>
                                    </td>

                                    <td>
                                        @if (count($ordre->factures) > 0)
                                            <h4>
                                                <a href="{{ route('factures.update', ['id' => $ordre->factures[0]->id, 'devis_id' => $ordre->devis->id]) }}"
                                                    target="_blank" style="text-decoration: underline;"
                                                    class="text-info"><b>{{ $ordre->factures[0]->numero }}</b>
                                                </a>
                                            </h4>
                                        @else
                                        <span class="badge badge-pill badge-danger"> Sans facture </span>
                                        @endif
                                    </td>



                                    <td>
                                        <a href="{{ route('dossiers.update', ['id' => $ordre->devis->dossier->id]) }}"
                                            target="_blank" style="text-decoration: underline;"
                                            class="text-warning"><b>{{ $ordre->devis->dossier->numero }}</b> </a>



                                    </td>

                                    <td>
                                        @if ($ordre->items->chauffeur)
                                            {{ $ordre->items->chauffeur->nom }} {{ $ordre->items->chauffeur->prenom }}
                                        @else
                                            <span class="badge badge-pill badge-danger"> #Non affecté </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($ordre->items->camion)
                                            {{ $ordre->items->camion->matricule }}
                                        @else
                                            <span class="badge badge-pill badge-danger"> #Non affecté </span>
                                        @endif
                                    </td>
                                    <td>{{ $ordre->items->date_livraison }}</td>
                                    <td style="text-align:left">
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">
                                                    <a href="{{ route('ordres.print', ['id' => $ordre->id]) }}">
                                                        <li class="list-group-item"><i class="fa fa-file"
                                                                style="margin-right:5px"></i> PDF </li>
                                                    </a>
                                                    <a
                                                        href="{{ route('ordres.update', ['id' => $ordre->devis->id, 'all' => $ordre->id]) }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="list-group-item" style="cursor:pointer"><i
                                                                class="fa-solid fa-trash"
                                                                style="margin-right:5px;"></i>Supprimer</li>
                                                    </a>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>

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
    //Testapi
    $(document).ready(function() {

        $('#addordre').submit(function(e) {
            $('#submit_ordre').attr('disabled', 'disabled');
            $('.erreur').empty()

            var devis_id = jQuery('#devis_id').val()

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/addordre') }}",
                method: 'post',
                data: {
                    devis_id: devis_id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    if (result.error) {
                        $('#submit_ordre').removeAttr('disabled');

                        if (result.error.devis_id) {
                            error_message(result.error.devis_id[0], "#devis_id")
                        }
                    }
                    if (result.error_vide != null) {
                        $('#submit_ordre').removeAttr('disabled');

                        error_message(result.error_vide, "#devis_id")
                    } else if (result.success_id) {

                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Ordres générés avec succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })

                        setTimeout(function() {
                            window.location.href = "{{ url('/updateordre') }}/" +
                                result.success_id + "/all"

                        }, 1000);




                    }


                }
            });



        });
    });
</script>
