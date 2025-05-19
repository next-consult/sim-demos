@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Bon de livraisons</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                                Nouveau Bon de livraison
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Créer un
                                                bon de livraison</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="addbonlivraisons">

                                            <div class="modal-body">

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Choisir
                                                        l'ordre</label>
                                                    <div class="col-md-8">
                                                        <select
                                                            class="js-example-basic-single js-states form-control"style="width: 100%"
                                                            id="ordre_id" required>
                                                            @foreach ($ordres as $ordre)
                                                                <option value="{{ $ordre->id }}" style="float:left">
                                                                    {{ $ordre->numero }} ({{ $ordre->client->nom }}
                                                                    {{ $ordre->client->prenom }})</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Master
                                                        BL</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="master_bl">
                                                        <span class="text-danger" id="master_erreur"
                                                            style="float:left"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">House
                                                        BL</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="house_bl">
                                                        <span class="text-danger" id="house_erreur"
                                                            style="float:left"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Choisir la
                                                        Date</label>
                                                    <div class="col-md-8">
                                                        <input type="date" class="form-control" id="date_livraison">
                                                        <span class="text-danger" id="date_erreur"
                                                            style="float:left"></span>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning"
                                                    data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary" id="submit_devis">Valider le
                                                    bon de livraison</button>
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
                <div class="table-responsive">
                    <table class="table display nowrap table-bordered livraisons_index">
                        <thead>
                            <tr>
                                <th>Bon de livraison</th>
                                <th>Entreprise</th>
                                <th>Client</th>
                                <th>Orde de travail</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($livraisons as $livraison)
                                <tr>
                                    <td><a href="{{ route('bonlivraisons.update', ['id' => $livraison->id]) }}"
                                            target="_blank" style="text-decoration: underline;"
                                            class="text-success"><b>{{ $livraison->numero }}</b> </a> </td>

                                    <td>{{ $livraison->ordre->entreprise->nom }}</td>



                                    <td>
                                        <a href="{{ route('clients.show', ['id' => $livraison->ordre->client->id]) }}"
                                            target="_blank" style="text-decoration: underline;"
                                            class="text-primary"><b>{{ $livraison->ordre->client->nom }}
                                                {{ $livraison->ordre->client->prenom }}</b> </a>


                                    </td>


                                    <td>


                                        <a href="{{ route('ordres.update', ['id' => $livraison->ordre->id]) }}"
                                            target="_blank" style="text-decoration: underline;"
                                            class="text-warning"><b>{{ $livraison->ordre->numero }}</b> </a>

                                    </td>
                                    <td>{{ $livraison->date }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">
                                                    <a href="{{ route('bonlivraisons.print', ['id' => $livraison->id]) }}">
                                                        <li class="list-group-item"><i class="fa fa-file"
                                                                style="margin-right:5px"></i> PDF </li>
                                                    </a>
                                                    <a href="{{ route('bonlivraisons.update', ['id' => $livraison->id]) }}">
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



        $('#addbonlivraisons').submit(function(e) {
            $('#submit_livraison').attr('disabled', 'disabled');
            $('.erreur').empty()
            var date_livraison = jQuery('#date_livraison').val()
            var ordre_id = jQuery('#ordre_id').val()
            var house_bl = jQuery('#house_bl').val()
            var master_bl = jQuery('#master_bl').val()

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/addbonlivraisons') }}",
                method: 'post',
                data: {
                    date_livraison: date_livraison,
                    ordre_id: ordre_id,
                    house_bl: house_bl,
                    master_bl: master_bl,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {


                    if (result.error) {


                        if (result.error.date_livraison) {
                            error_message(result.error.date_livraison[0], "#date_livraison")
                        }
                        if (result.error.ordre_id) {
                            error_message(result.error.ordre_id[0], "#ordre_id")
                        }
                        if (result.error.house_bl) {
                            error_message(result.error.house_bl[0], "#house_bl")
                        }
                        if (result.error.master_bl) {
                            error_message(result.error.master_bl[0], "#master_bl")
                        }


                    } else if (result.success_id) {


                        window.location.href = `updatebonlivraisons/${result.success_id}`;



                    }

                }
            });



        });
    });
</script>
