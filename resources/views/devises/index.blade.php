@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des devises</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">

                            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#add">Ajouter un
                                devise</button>

                            <!-- Modal -->
                            <div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">ajouter
                                                une
                                                devise</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="adddevise">

                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Nom
                                                    </label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="nom">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">code</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="code">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword"
                                                        class="col-md-4 col-form-label">Symbole</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="symbole">

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Grande
                                                        unite</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="grande_unite">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Petite
                                                        unite</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="petite_unite">

                                                    </div>
                                                </div>



                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning"
                                                    data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary" id="submit_devise"
                                                    onclick="add_devise()">Ajouter le devise</button>
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
                                <th>Nom</th>
                                <th>code</th>
                                <th>symbole</th>
                                <th>Grande unite</th>
                                <th>Petite unite</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($devises as $devise)
                                <tr>

                                    <td>{{ $devise->nom }}</td>
                                    <td>{{ $devise->code }}</td>
                                    <td>{{ $devise->symbole }}</td>
                                    <td>{{ $devise->grande_unite }}</td>
                                    <td>{{ $devise->petite_unite }}</td>
                                    <td style="text-align:left">
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">

                                                    <a href="#" data-toggle="modal" data-target="#update_devise"
                                                        class="update_button" data-id="{{ $devise->id }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="list-group-item" style="cursor:pointer"
                                                            onclick="deletedevise({{ $devise->id }})"><i
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
    <div class="modal fade" id="update_devise" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Modifier devise</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>

                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Nom
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="nom_update">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">code</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="code_update">
                                <input type="hidden" class="form-control" id="devise_id">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Symbole</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="symbole_update">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Grande unite</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="grande_unite_update">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Petite unite</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="petite_unite_update">

                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="submit_update"
                            onclick="update_devise()">Modifier le devise</button>
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
            $('#devise_id').val(id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/onedevise') }}/" + id,
                method: 'get',
                success: function(result) {
                    $('#nom_update').val(result.nom)
                    $('#code_update').val(result.code)
                    $('#symbole_update').val(result.symbole)
                    $('#grande_unite_update').val(result.grande_unite)
                    $('#petite_unite_update').val(result.petite_unite)

                }
            });

        });
    });


    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    function add_devise() {
        $('#submit_devise').attr('disabled', 'disabled');
        $('.erreur').empty()
        var nom = jQuery('#nom').val()
        var code = jQuery('#code').val()
        var symbole = jQuery('#symbole').val()
        var grande_unite = jQuery('#grande_unite').val()
        var petite_unite = jQuery('#petite_unite').val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/adddevise') }}",
            method: 'post',
            data: {
                nom: nom,
                code: code,
                symbole: symbole,
                grande_unite: grande_unite,
                petite_unite: petite_unite,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {
                    $('#submit_devise').removeAttr('disabled');
                    if (result.error.nom) {
                        error_message(result.error.nom[0], "#nom")
                    }
                    if (result.error.code) {
                        error_message(result.error.code[0], "#code")
                    }
                    if (result.error.symbole) {
                        error_message(result.error.symbole[0], "#symbole")
                    }
                    if (result.error.grande_unite) {
                        error_message(result.error.grande_unite[0], "#grande_unite")
                    }
                    if (result.error.petite_unite) {
                        error_message(result.error.petite_unite[0], "#petite_unite")
                    }

                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'devise ajouté avecc succéss',
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











    function update_devise() {
        $('#submit_update').attr('disabled', 'disabled');
        $('.erreur').empty()
        var nom = jQuery('#nom_update').val()
        var code = jQuery('#code_update').val()
        var devise_id = jQuery('#devise_id').val()
        var symbole = jQuery('#symbole_update').val()
        var grande_unite = jQuery('#grande_unite_update').val()
        var petite_unite = jQuery('#petite_unite_update').val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/updatedevise') }}/" + devise_id,
            method: 'post',
            data: {
                nom: nom,
                code: code,
                symbole: symbole,
                grande_unite: grande_unite,
                petite_unite: petite_unite,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {

                    $('#submit_update').removeAttr('disabled');

                    if (result.error.nom) {
                        error_message(result.error.nom[0], "#nom_update")
                    }
                    if (result.error.code) {
                        error_message(result.error.code[0], "#code_update")
                    }
                    if (result.error.symbole) {
                        error_message(result.error.symbole[0], "#symbole_update")
                    }
                    if (result.error.grande_unite) {
                        error_message(result.error.grande_unite[0], "#grande_unite_update")
                    }
                    if (result.error.petite_unite) {
                        error_message(result.error.petite_unite[0], "#petite_unite_update")
                    }


                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'devise modifié avecc succéss',
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
