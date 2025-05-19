@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des parametres</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">

                            {{-- <button class="btn btn-primary float-right" data-toggle="modal" data-target="#add">Ajouter un
                                parametre</button> --}}

                            <!-- Modal -->
                            <div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Créer un
                                                parametre</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="addparametre">

                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="inputPassword"
                                                        class="col-md-4 col-form-label">nb_conges</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="nb_conges">

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning"
                                                    data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary" id="submit_parametre"
                                                    onclick="add_parametre()">Ajouter le parametre</button>
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
                                <th style="width:35%">Nombre de congés</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parametres as $parametre)
                                <tr>

                                    <td>{{ $parametre->nb_conges }}</td>
                                    <td style="text-align:left">
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">

                                                    <a href="#" data-toggle="modal" data-target="#update_parametre"
                                                        class="update_button" data-id="{{ $parametre->id }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
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
    <div class="modal fade" id="update_parametre" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Modifier </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">nb_conges</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="nb_conges_update">
                                <input type="hidden" class="form-control" id="parametre_id">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="submit_update"
                            onclick="update_parametre()">Modifier le parametre</button>
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
            $('#parametre_id').val(id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/oneparametren') }}/" + id,
                method: 'get',
                success: function(result) {
                    console.log(result.gouvernerat)
                    $('#nb_conges_update').val(result.nb_conges)

                }
            });

        });
    });


    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    function add_parametre() {
        $('#submit_parametre').attr('disabled', 'disabled');
        $('.erreur').empty()
        var nb_conges = jQuery('#nb_conges').val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/addparametre') }}",
            method: 'post',
            data: {
                nb_conges: nb_conges,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {
                    $('#submit_parametre').removeAttr('disabled');
                    if (result.error.nb_conges) {
                        error_message(result.error.nb_conges[0], "#nb_conges")
                    }

                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'parametre ajouté avecc succéss',
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





    function update_parametre() {
        $('#submit_update').attr('disabled', 'disabled');
        $('.erreur').empty()
        var nb_conges = jQuery('#nb_conges_update').val()
        var parametre_id = jQuery('#parametre_id').val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/updateparametre') }}/" + parametre_id,
            method: 'post',
            data: {
                nb_conges: nb_conges,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {

                    $('#submit_update').removeAttr('disabled');

                    if (result.error.nb_conges) {
                        error_message(result.error.nb_conges[0], "#nb_conges_update")
                    }

                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'parametre modifié avecc succéss',
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
