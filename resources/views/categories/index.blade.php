@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des categories</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">

                            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#add">
                                Ajouter une catégorie
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Ajouter
                                                une catégorie</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="addcategorie">

                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Nom
                                                        catégorie</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="nom">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword"
                                                        class="col-md-4 col-form-label">montant</label>
                                                    <div class="col-md-8">
                                                        <input type="number" class="form-control" id="montant">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Nombre jours
                                                        paiement</label>
                                                    <div class="col-md-8">

                                                        <select class="form-control none" id="nb_jours">
                                                            <option value="0">0 jours
                                                            </option>
                                                            <option value="7">7 jours
                                                            </option>
                                                            <option value="15">15 jours
                                                            </option>
                                                            <option value="30">30 jours
                                                            </option>
                                                            <option value="45">45 jours
                                                            </option>
                                                            <option value="90">90 jours
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Choisir un
                                                        couleur </label>
                                                    <div class="col-md-5">
                                                        <input type="color" id="couleur">

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning"
                                                    data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary" id="submit_categorie"
                                                    onclick="add_categorie()">Ajouter la categorie</button>
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
                                <th style="width:1%">Couleur</th>
                                <th style="text-align:center">Nom</th>
                                <th style="text-align:center">montant</th>
                                <th style="text-align:center">Nombre de jours</th>
                                <th style="text-align:center;width:15%"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $categorie)
                                <tr>
                                    <td style="background:{{ $categorie->couleur }};text-align:center"></td>
                                    <td style="text-align:center">{{ $categorie->nom }}</td>
                                    <td style="text-align:center">{{ sprintf('%.3f', $categorie->montant) }} TND</td>
                                    <td style="text-align:center">{{ $categorie->nb_jours }} jours</td>
                                    <td style="text-align:center">
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">

                                                    <a href="#" data-toggle="modal" data-target="#update_categorie"
                                                        class="update_button" data-id="{{ $categorie->id }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    <a href="#" onclick="deletecategorie({{ $categorie->id }})">
                                                        <li class="list-group-item" style="cursor:pointer"
                                                            ><i class="fa-solid fa-trash"
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
    <div class="modal fade" id="update_categorie" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
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
                                categorie</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="nom_update">
                                <input type="hidden" class="form-control" id="destination_id">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">montant</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="montant_update">
                                <input type="hidden" class="form-control" id="categorie_id">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Nombre jours paiement</label>
                            <div class="col-md-8">
                                <select class="form-control none" id="nb_jours_update">
                                    <option value="0">0 jours
                                    </option>
                                    <option value="7">7 jours
                                    </option>
                                    <option value="15">15 jours
                                    </option>
                                    <option value="30">30 jours
                                    </option>
                                    <option value="45">45 jours
                                    </option>
                                    <option value="90">90 jours
                                    </option>

                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Choisir un couleur </label>
                            <div class="col-md-1">
                                <input type="color" id="couleur_update">

                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="submit_update"
                            onclick="update_categorie()">Modifier la categorie</button>
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
            $('#categorie_id').val(id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/onecategorie') }}/" + id,
                method: 'get',
                success: function(result) {
                    console.log(result.gouvernerat)
                    $('#nom_update').val(result.nom)
                    $('#montant_update').val(result.montant)
                    $('#couleur_update').val(result.couleur)
                    $("#nb_jours_update option[value=" + parseInt(result.nb_jours) + "]").prop('selected', true);

                }
            });

        });
    });

    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    function add_categorie() {
        $('#submit_categorie').attr('disabled', 'disabled');
        $('.erreur').empty()
        var nom = jQuery('#nom').val()
        var montant = jQuery('#montant').val()
        var couleur = jQuery('#couleur').val()
        var nb_jours = jQuery('#nb_jours').val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/addcategorie') }}",
            method: 'post',
            data: {
                nom: nom,
                montant: montant,
                couleur: couleur,
                nb_jours: nb_jours,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {

                    $('#submit_categorie').removeAttr('disabled');

                    if (result.error.nom) {
                        error_message(result.error.nom[0], "#nom")
                    }
                    if (result.error.montant) {
                        error_message(result.error.montant[0], "#montant")
                    }
                    if (result.error.couleur) {
                        error_message(result.error.couleur[0], "#couleur")
                    }
                    if (result.error.nb_jours) {
                        error_message(result.error.nb_jours[0], "#nb_jours_update")
                    }


                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'categorie ajouté avecc succéss',
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











    function update_categorie() {
        $('#submit_update').attr('disabled', 'disabled');
        $('.erreur').empty()
        var nom = jQuery('#nom_update').val()
        var montant = jQuery('#montant_update').val()
        var categorie_id = jQuery('#categorie_id').val()
        var couleur = jQuery('#couleur_update').val()
        var nb_jours = jQuery('#nb_jours_update').val()


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/updatecategorie') }}/" + categorie_id,
            method: 'post',
            data: {
                nom: nom,
                montant: montant,
                couleur: couleur,
                nb_jours: nb_jours,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {

                    $('#submit_update').removeAttr('disabled');

                    if (result.error.nom) {
                        error_message(result.error.nom[0], "#nom_update")
                    }
                    if (result.error.montant) {
                        error_message(result.error.montant[0], "#montant_update")
                    }

                    if (result.error.nb_jours) {
                        error_message(result.error.nb_jours[0], "#nb_jours")
                    }


                    if (result.error.couleur) {
                        error_message(result.error.couleur[0], "#couleur_update")
                    }


                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'categorie modifié avecc succéss',
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
