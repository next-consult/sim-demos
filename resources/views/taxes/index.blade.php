@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des taxes</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">

                            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#add">Ajouter un
                                taxe</button>

                            <!-- Modal -->
                            <div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Créer un
                                                taxe</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="addtaxe">

                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Nom
                                                        taxe</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="nom">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword"
                                                        class="col-md-4 col-form-label">Pourcentage</label>
                                                    <div class="col-md-8">
                                                        <input type="number" class="form-control" id="pourcentage">

                                                    </div>
                                                </div>



                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning"
                                                    data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary" id="submit_taxe"
                                                    onclick="add_taxe()">Ajouter le taxe</button>
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
                    <table class="table display table-bordered devis_table_index">
                        <thead>
                            <tr>
                                <th style="width:35%">Nom</th>
                                <th style="width:35%">Pourcentage</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($taxes as $taxe)
                                <tr>

                                    <td>{{ $taxe->nom }}</td>
                                    <td>{{ sprintf('%.3f', $taxe->pourcentage) }}%</td>
                                    <td style="text-align:left">
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">

                                                    <a href="#" data-toggle="modal" data-target="#update_taxe"
                                                        class="update_button" data-id="{{ $taxe->id }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="list-group-item" style="cursor:pointer"
                                                            onclick="deletetaxe({{ $taxe->id }})"><i
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

    <!-- UpdateModal -->
    <div class="modal fade" id="update_taxe" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Modifier la déstination</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>

                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Nom
                                taxe</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="nom_update">
                                <input type="hidden" class="form-control" id="destination_id">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Pourcentage</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="pourcentage_update">
                                <input type="hidden" class="form-control" id="taxe_id">

                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="submit_update"
                            onclick="update_taxe()">Modifier le taxe</button>
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

        $('.update_button').click(function() {
            var id = $(this).data('id');
            $('#taxe_id').val(id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/onetaxen') }}/" + id,
                method: 'get',
                success: function(result) {
                    console.log(result.gouvernerat)
                    $('#nom_update').val(result.nom)
                    $('#pourcentage_update').val(result.pourcentage)

                }
            });

        });
    });


    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    function add_taxe() {
        $('#submit_taxe').attr('disabled', 'disabled');
        $('.erreur').empty()
        var nom = jQuery('#nom').val()
        var pourcentage = jQuery('#pourcentage').val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/addtaxe') }}",
            method: 'post',
            data: {
                nom: nom,
                pourcentage: pourcentage,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {
                    $('#submit_taxe').removeAttr('disabled');
                    if (result.error.nom) {
                        error_message(result.error.nom[0], "#nom")
                    }
                    if (result.error.pourcentage) {
                        error_message(result.error.pourcentage[0], "#pourcentage")
                    }

                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Taxe ajouté avecc succéss',
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











    function update_taxe() {
        $('#submit_update').attr('disabled', 'disabled');
        $('.erreur').empty()
        var nom = jQuery('#nom_update').val()
        var pourcentage = jQuery('#pourcentage_update').val()
        var taxe_id = jQuery('#taxe_id').val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/updatetaxe') }}/" + taxe_id,
            method: 'post',
            data: {
                nom: nom,
                pourcentage: pourcentage,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {

                    $('#submit_update').removeAttr('disabled');

                    if (result.error.nom) {
                        error_message(result.error.nom[0], "#nom_update")
                    }
                    if (result.error.pourcentage) {
                        error_message(result.error.pourcentage[0], "#pourcentage_update")
                    }


                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Taxe modifié avecc succéss',
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
