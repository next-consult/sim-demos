@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="seipkon-breadcromb-left">
                            <h3>Bon de commande</h3>
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
                                Nouveau bon de commande
                            </button>


                        </div>
                    </div>
                    {{-- boncommandemodal --}}
                    <div class="modal fade" id="add" aria-hidden="true" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="float:left" id="exampleModalLongTitle">Créer
                                        un
                                        bon de commande </h5>


                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="addboncommande">

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
                                                le fournisseur<span
                                                    style="font-size:12px;color:green;cursor:pointer;font-weight:500"
                                                    onclick="add_contact()">(Nouveau)</span></label>
                                            <div class="col-md-8">
                                                <input type="hidden" id="fournisseur_boncommande_id" value="" />
                                                <select
                                                    class="js-example-basic-single js-states form-control"style="width: 100%"
                                                    id="fournisseur_id" required>
                                                    @foreach ($fournisseurs as $fournisseur)
                                                        <option value="{{ $fournisseur->id }}" style="float:left">
                                                            {{ $fournisseur->nom }}</option>
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
                                                <button type="submit" class="btn btn-primary"
                                                    id="submit_boncommande">Valider le
                                                    bon de commande</button>
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
                                    <th>bon de commande </th>
                                    <th>fournisseur</th>
                                    <th>Entreprise</th>
                                    <th>Total ttc</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($boncommande_array as $boncommande)
                                    <tr>
                                        <td><a href="{{ route('boncommande.update', ['id' => $boncommande->id]) }}"
                                                style="text-decoration: underline;"
                                                class="text-success"><b>{{ $boncommande->numero }}</b> </a> </td>
									@if(!$boncommande->fournisseur)
                                        <td>
											
                                            -

                                        </td>
										@else
										 <td>
										{{ $boncommande->fournisseur->nom }}
                                         </td>
										@endif
                                        <td>{{ $boncommande->entreprise->nom }}</td>
                                        <td>{{ str_replace('.', ',', sprintf('%.3f', $boncommande->boncommande_ttc)) }}</td>
                                        <td>{{ $boncommande->date }}</td>
                                        <td>
                                            @if ($boncommande->status == 'en cours')
                                                <span class="badge badge-secondary">En cours</span>
                                            @elseif($boncommande->status == 'valide')
                                                <span class="badge badge-info"> Valide</span>
                                            @elseif($boncommande->status == 'annuler')
                                                <span class="badge badge-error">Annulé</span>
                                            @elseif($boncommande->status == 'converti_facture' && isset($boncommande->facture))
                                                <a href="{{ route('factures.update', ['id' => $boncommande->facture->id]) }}"
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
                                                        <a
                                                            href="{{ route('boncommande.print', ['id' => $boncommande->id]) }}">
                                                            <li class="list-group-item"><i class="fa fa-file"
                                                                    style="margin-right:5px"></i> PDF </li>
                                                        </a>
                                                        <a
                                                            href="{{ route('boncommande.update', ['id' => $boncommande->id]) }}">
                                                            <li class="list-group-item"><i class="fa fa-pen"
                                                                    style="margin-right:5px"></i> Modifier </li>
                                                        </a>
                                                        <a href="#"
                                                            onclick="deleteboncommande({{ $boncommande->id }})">
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


            $('#addboncommande').submit(function(e) {
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


                $('#submit_boncommande').attr('disabled', 'disabled');
                $('.erreur').empty()
                var entreprise_id = jQuery('#entreprise_id').val()
                var fournisseur_id = jQuery('#fournisseur_id').val()

                var fournisseurs = []

                for (let j = 0; j < nom.length; j++) {

                    fournisseurs.push({
                        'nom': nom[j],
                        'email': email[j],
                        'telephone': telephone[j],
                        'adresse': adresse[j],
                    })

                }

                var fournisseursJson = null;
                if (fournisseurs.length > 0) {
                    var fournisseursJson = JSON.stringify(fournisseurs);
                }


                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/addboncommande') }}",
                    method: 'post',
                    data: {
                        entreprise_id: entreprise_id,
                        fournisseur_id: fournisseur_id,
                        new_fournisseur: fournisseursJson,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(result) {
                        if (result.error) {

                            $('#submit_boncommande').removeAttr('disabled');

                            if (result.error.dossier_id) {
                                error_message(result.error.dossier_id[0], "#dossier_id")
                            }

                            if (result.error.date) {
                                error_message(result.error.date[0], "#date_boncommande")
                            }

                        } else if (result.error_existe) {
                            error_message(result.error_existe, "#erreurr_existe")
                        } else if (result.success_id) {

                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'boncommande ajouté avecc succéss',
                                showConfirmButton: false,
                                timer: 1000
                            })

                            setTimeout(function() {

                                window.location.href =
                                    `editboncommande/${result.success_id}`;

                            }, 1000);



                        }

                    }
                });



            });
        });

        //contacts
        function add_contact() {
            if ($('#contact_table tr').length == 0) {
                $('#contact_table tbody').append("<tr> " +
                    "<td style='width:90%'><br>" +
                    "<input type='hidden' class='form-control' name='id_fournisseur[]' value='new'><input type='text' class='form-control' placeholder='Nom fournisseur' name='nom[]'>" +

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
