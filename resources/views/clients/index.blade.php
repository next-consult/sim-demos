@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des clients</h3>
                        </div>
                    </div>

                    <div class="col-md-4 ">
                        <div class="seipkon-breadcromb-right">
                            <a href="{{ route('clients.add') }}">
                                <button class="btn btn-primary float-right">Ajouter un client</button>
                            </a>
							<a href="{{ route('clients.export') }}"> <button class="btn btn-info"> <i
                                class="fas fa-download"></i> Export client
                        </button></a>
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
                <div class="table-responsive ">
                    <table class="table display table-bordered client_table_index">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Nom & Prénom</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Total_ttc</th>
                                <th>Total payé</th>
                                <th>Solde a payé</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td><a href="{{ route('clients.show', ['id' => $client->id]) }}" target="_blank"
                                            style="text-decoration: underline;" class="text-success"><b>{{ $client->numero }}
                                               </b> </a> </td>
                                    <td><b>{{ $client->nom }}</b></td>
                                    <td>{{ $client->email }}</td>

                                    <td>{{ $client->telephone }}</td>
                                    <td>{{ $client->total }}</td>
                                    <td>{{ $client->paye_total }}</td>
                                    <td>{{ $client->solde }}</td>
                                    <td style="text-align:left">
                                        <div class="dropdown">
                                            <button class="btn btn-options  btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">
                                                    <a href="{{ route('clients.show', ['id' => $client->id]) }}">
                                                        <li class="list-group-item"> <i class="fa-solid fa-magnifying-glass"
                                                                style="margin-right:5px"></i> Voir détails</li>
                                                    </a>
                                                    <a href="{{ route('clients.update', ['id' => $client->id]) }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    <a href="#" data-toggle="modal" data-target="#add_devis"
                                                        class="adddevis_button" data-id="{{ $client->id }}">

                                                        <li class="list-group-item">


                                                            <i class="fa-solid fa-file-export" style="margin-right:5px">

                                                            </i>Créer un devis

                                                        </li>
                                                    </a>
                                                    <a href="#" data-toggle="modal" data-target="#add_facture"
                                                        class="addfacture_button" data-id="{{ $client->id }}">

                                                        <li class="list-group-item">


                                                            <i class="fa-solid fa-file-circle-check"
                                                                style="margin-right:5px">

                                                            </i>Créer une facture

                                                        </li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="list-group-item" style="cursor:pointer"
                                                            onclick="deleteclient({{ $client->id }})"><i
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
                {{-- devismodal --}}
                <div class="modal fade" id="add_devis" role="dialog" aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Créer un devis
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="adddevis">

                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-md-4 col-form-label">Choisir
                                            l'entreprise</label>
                                        <div class="col-md-8">
                                            <input type="hidden" id="client_id" />
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
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary" id="submit_devis">Créer Le
                                        devis</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                {{-- facturemodal --}}
                <div class="modal fade" id="add_facture" role="dialog" aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Créer une
                                    Facture</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="addfacture">

                                <div class="modal-body">

                                    <div class="form-group row">
                                        <label for='inputPassword' class='col-md-4 col-form-label'>Choisir
                                            l'entreprise</label>
                                        <div class='col-md-8'>
                                            <input type="hidden" id="client_id_facture" />
                                            <select
                                                class="js-example-basic-single js-states form-control"style="width: 100%"
                                                id="entreprise_id_facture">
                                                @foreach ($entreprises as $entreprise)
                                                    <option value="{{ $entreprise->id }}" style="float:left">
                                                        {{ $entreprise->nom }}
                                                    </option>
                                                @endforeach
                                            </select>


                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary" id="submit_factures">Valider
                                        la
                                        facture</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {

        //devis

        $('.adddevis_button').click(function() {
            var id = $(this).data('id');
            $('#client_id').val(id)
        });
        $('.addfacture_button').click(function() {
            var id = $(this).data('id');
            $('#client_id_facture').val(id)
        });
    });
</script>
<script>
    $(document).ready(function() {


        //devis

        $('.adddevis_button').click(function() {
            var id = $(this).data('id');
            $('#client_dossier_id').val(id)
        });
        //facture
        $('.addfacture_button').click(function() {
            var id = $(this).data('id');
            $('#client_facture_id').val(id)
        });
        //paiementfacture

        $('.addpaiement_button').click(function() {
            $("#facture_id").empty();

            var id = $(this).data('id');
            $('#client_paiement_id').val(id)
            console.log(id)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/paiementfacture') }}/" + id,
                method: 'get',
                success: function(result) {
                    console.log(result)
                    if (result) {
                        for (facture of result) {
                            var o = new Option(facture.numero, facture.id);
                            $(o).html(facture.numero + ' (Total a payer :' + facture
                                .facture_solde + ' dt)');
                            $("#facture_id").append(o);

                        }

                    }
                }
            });
        });

        //livraison

        $('.addlivraison_button').click(function() {
            $("#ordre_id").empty();

            var id = $(this).data('id');
            $('#client_livraison_id').val(id)
            console.log(id)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/ordreclient') }}/" + id,
                method: 'get',
                success: function(result) {
                    console.log(result)
                    if (result) {
                        for (ordre of result) {
                            var o = new Option(ordre.numero, ordre.id);
                            $(o).html(ordre.numero);
                            $("#ordre_id").append(o);

                        }

                    }
                }
            });
        });

        //ordre
        $('input[name="type_devis"]').on('change', function(e) {

            var type = e.target.value;

            if (type == 'sans_devis') {
                $('#div_avec_devis').hide()
                $('#div_sans_devis').show()
            } else if (type == 'avec_devis') {
                $('#div_avec_devis').show()
                $('#div_sans_devis').hide()

            }
        });
        $('.addordre_button').click(function() {
            $("#devis_id").empty();

            var id = $(this).data('id');
            $('#client_ordre_id').val(id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/devisclient') }}/" + id,
                method: 'get',
                success: function(result) {
                    console.log(result)
                    if (result) {
                        for (devis of result) {
                            var o = new Option(devis.numero, devis.id);
                            $(o).html(devis.numero);
                            $("#devis_id").append(o);

                        }

                    }
                    /// jquerify the DOM object 'o' so we can use the html method
                }
            });
        });
    });
</script>
<script>
    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    function paiement() {
        $('#submit_paiement').attr('disabled', 'disabled');
        $('.erreur').empty()

        var facture_id = jQuery('#facture_id').val()
        var date = jQuery('#date').val()
        var montant = jQuery('#montant').val()
        var method = jQuery('#method').val()
        var note = jQuery('#note').val()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        if (!facture_id) {
            swal.fire({
                title: "Il n'y a pas des factures a payé",

                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {}
            })
            setTimeout(function() {

                location.reload(true);
            }, 2000);
        } else {
            jQuery.ajax({
                url: "{{ url('/savepaiement') }}/" + facture_id,
                method: 'post',
                data: {
                    date: date,
                    montant: montant,
                    method: method,
                    note: note,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    console.log(result.error_montant);
                    if (result.error_montant != null) {
                        $('#submit_paiement').removeAttr('disabled');

                        error_message(result.error_montant, "#montant")
                    }
                    if (result.error) {

                        $('#submit_paiement').removeAttr('disabled');

                        if (result.error.date) {
                            error_message(result.error.date[0], "#date")
                        }
                        if (result.error.montant) {
                            error_message(result.error.montant[0], "#montant")
                        }
                        if (result.error.method) {
                            error_message(result.error.method[0], "#method")
                        }


                    } else if (result.error == -1) {
                        swal.fire({
                            title: "Erreur calcule",

                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer()
                                    .querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal
                                        .getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {}
                        })
                    } else if (result == 200) {


                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Paiement effectué avecc succéss',
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




        $('#adddevis').submit(function(e) {
            $('#submit_devis').attr('disabled', 'disabled');
            $('.erreur').empty()
            var client_id = jQuery('#client_id').val()
            var type = jQuery('#type').val()
            var entreprise_id = jQuery('#entreprise_id').val()

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/adddevis') }}",
                method: 'post',
                data: {
                    entreprise_id: entreprise_id,
                    client_id: client_id,
                    type: type,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    if (result.error) {

                        $('#submit_devis').removeAttr('disabled');

                        if (result.error.entreprise_id) {
                            error_message(result.error.entreprise_id[0], "#entreprise_id")
                        }
                        if (result.error.date) {
                            error_message(result.error.date[0], "#date_devis")
                        }


                    } else if (result.success_id) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Devis crée avec succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })

                        setTimeout(function() {

                            window.location.href = "{{ url('/editdevis') }}/" +
                                result
                                .success_id;

                        }, 1000);
                    }

                }
            });
        });

        $('#addfacture').submit(function(e) {
            $('#submit_factures').attr('disabled', 'disabled');
            $('.erreur').empty()

            var client_id = jQuery('#client_id_facture').val()
            var type = "client"
            var entreprise_id = jQuery('#entreprise_id_facture').val()

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/addfactures') }}",
                method: 'post',
                data: {
                    type:type,
                    entreprise_id: entreprise_id,
                    client_id: client_id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    if (result.error) {

                        $('#submit_factures').removeAttr('disabled');

                        if (result.error.entreprise_id) {
                            error_message(result.error.entreprise_id[0],
                                "#entreprise_id_facture")
                        }







                    } 
                    
                      else if (result.error_mf) {
                        $('#submit_factures').removeAttr('disabled');
                        error_message(result.error_mf, "#entreprise_id_facture")
                    }
                    
                    else if (result.success_id) {

                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Facture crée avec succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })

                        setTimeout(function() {

                            window.location.href = "{{ url('/updatefacture') }}/" +
                                result
                                .success_id;

                        }, 1000);

                    }

                }
            });


        });
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
