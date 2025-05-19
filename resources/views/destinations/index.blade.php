@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des trajéctoires</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">

                            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#add">Ajouter une
                                trajéctoire</button>

                            <!-- Modal -->
                            <div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Créer une
                                                trajéctoire</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="adddossier">

                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Adresse Enlevement</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="enlevement">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Adresse Livraison</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="livraison">

                                                    </div>
                                                </div>
                                                {{-- <div class="form-group row">
                                                    <label for="inputPassword"
                                                        class="col-md-4 col-form-label">Gouvernerat</label>
                                                    <div class="col-md-8">
                                                        <select
                                                            class="js-example-basic-single js-states form-control"style="width: 100%"
                                                            id="gouvernerat">
                                                            <option value="ariana" style="float:left">
                                                                Ariana</option>
                                                            <option value="beja" style="float:left">
                                                                Béja</option>
                                                            <option value="ben_arous" style="float:left">
                                                                Ben Arous</option>
                                                            <option value="bizerte" style="float:left">
                                                                Bizerte</option>
                                                            <option value="gabes" style="float:left">
                                                                Gabes</option>
                                                            <option value="gafsa" style="float:left">
                                                                Gafsa</option>
                                                            <option value="jendouba" style="float:left">
                                                                Jendouba</option>

                                                            <option value="kairaoun" style="float:left">
                                                                Kairaoun</option>
                                                            <option value="kasserine" style="float:left">
                                                                Kasserine</option>
                                                            <option value="kebili" style="float:left">
                                                                kebili</option>

                                                            <option value="kef" style="float:left">
                                                                Le kef</option>
                                                            <option value="mahdia" style="float:left">
                                                                Mahdia</option>

                                                            <option value="manouba" style="float:left">
                                                                La Manouba</option>

                                                            <option value="medenine" style="float:left">
                                                                Medenine</option>
                                                            <option value="monastir" style="float:left">
                                                                Monastir</option>
                                                            <option value="nabeul" style="float:left">
                                                                Nabeul</option>


                                                            <option value="sfax" style="float:left">
                                                                Sfax</option>
                                                            <option value="sidi_bouzid" style="float:left">
                                                                Sidi bouzid</option>
                                                            <option value="siliana" style="float:left">
                                                                Siliana</option>

                                                            <option value="sousse" style="float:left">
                                                                Sousse</option>

                                                            <option value="tataouine" style="float:left">
                                                                Tataouine</option>

                                                            <option value="tozeur" style="float:left">
                                                                Tozeur</option>

                                                            <option value="tunis" style="float:left">
                                                                Tunis</option>
                                                            <option value="zaghouane" style="float:left">
                                                                Zaghouane</option>



                                                        </select>

                                                    </div>
                                                </div> --}}

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning"
                                                    data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary" id="submit_destination"
                                                    onclick="add_destination()">Ajouter la trajéctoire</button>
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
                                <th style="width:35%">Enlevement</th>
                                <th style="width:35%">Livraison</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($destinations as $destination)
                                <tr>

                                    <td>{{ $destination->enlevement }}</td>
                                    <td>{{ $destination->livraison }}</td>
                                    <td style="text-align:left">
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">

                                                    <a href="#" data-toggle="modal" data-target="#update_destin"
                                                        class="update_button" data-id="{{ $destination->id }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="list-group-item" style="cursor:pointer"
                                                            onclick="#"><i class="fa-solid fa-trash"
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
    <div class="modal fade" id="update_destin" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Modifier la trajéctoire</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>

                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Adresse Enlevement</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="enlevement_update">
                                <input type="hidden" class="form-control" id="destination_id">

                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Adresse Livraison</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="livraison_update">
                                <input type="hidden" class="form-control" id="destination_id">

                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="submit_update"
                            onclick="update_destination()">Modifier la trajéctoire</button>
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
            $('#destination_id').val(id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/onedestination') }}/" + id,
                method: 'get',
                success: function(result) {
                    $('#enlevement_update').val(result.enlevement)
                    $('#livraison_update').val(result.livraison)

                }
            });

        });
    });


    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    function add_destination() {
        $('#submit_destination').attr('disabled', 'disabled');
        $('.erreur').empty()
        var enlevement = jQuery('#enlevement').val()
        var livraison = jQuery('#livraison').val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/adddestination') }}",
            method: 'post',
            data: {
                enlevement: enlevement,
                livraison: livraison,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {

                    $('#submit_destination').removeAttr('disabled');

                    if (result.error.enlevement) {
                        error_message(result.error.enlevement[0], "#enlevement")
                    }
                    if (result.error.livraison) {
                        error_message(result.error.livraison[0], "#livraison")
                    }


                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Trajéctoire ajouté avecc succéss',
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











    function update_destination() {
        $('#submit_update').attr('disabled', 'disabled');
        $('.erreur').empty()
        var enlevement = jQuery('#enlevement_update').val()
        var livraison = jQuery('#livraison_update').val()
        var destination_id = jQuery('#destination_id').val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/updatedestination') }}/" + destination_id,
            method: 'post',
            data: {
                enlevement: enlevement,
                livraison: livraison,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {

                    $('#submit_update').removeAttr('disabled');

                    if (result.error.enlevement) {
                        error_message(result.error.enlevement[0], "#enlevement_update")
                    }
                    if (result.error.livraison) {
                        error_message(result.error.livraison[0], "#livraison_update")
                    }


                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Trajéctoire modifié avecc succéss',
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
