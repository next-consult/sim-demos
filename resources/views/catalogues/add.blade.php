@extends('layouts.app')

@section('content')
<meta name="_token" content="{{ csrf_token() }}">
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="seipkon-breadcromb-left">
                            <h3>Ajouter un produit</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <ul>
                                <a href="{{ url()->previous() }} "> <button class="btn btn-warning"><i
                                            class="fa-solid fa-backward"></i>Retour</button></a>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcromb Row -->
<style>.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
    height: 40px !important;
}</style>

    <!-- Form Layout Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-box">
                <div class="form-example">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Categorie du produit</label>
                                <select class="form-control"style="width: 100% height: 40px !important;" id="type_produit" onchange="test_type()">
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}" style="float:left">
                                            {{ $categorie->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="oem_div">
                            <div class="col-md-4">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Le fichier des clés<span
                                            class="obligatoire">*</span></label>
                                    <input type="file" class="form-control" id="file_cles">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Date <span class="obligatoire">*</span></label>
                                    <input type="date" class="form-control" id="date_cles">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Fournisseur:<span class="obligatoire">*</span> </label>


                                    <select class="form-control"style="width: 100%" id="fournisseur_id_oem" required>
                                        @foreach ($fournisseurs as $fournisseur)
                                            <option value="{{ $fournisseur->id }}" style="float:left">
                                                {{ $fournisseur->nom }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <button type="button" class="btn btn-success " onclick="save_oem()"><i
                                        class="fa fa-check"></i>
                                    Enregistrer le
                                    produit</button>
                            </div>
                        </div>
                    </div>

                    <div class="form-wrap top-label-exapmple form-layout-page" id="normal_div" style="display:none">
                        <div class="row" id="info_div">
                            <div class="col-md-3">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Produit<span class="obligatoire">*</span></label>
                                    <input type="text" placeholder="Produit" class="form-control " id="nom_produit">

                                </div>
                            </div>
                            <div class="col-md-3" id="prix_achat_div">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Prix achat<span class="obligatoire">*</span></label>
                                    <input type="number" placeholder="Prix achat" class="form-control " id="prix_achat">

                                </div>
                            </div>
                            <div class="col-md-3 date-fields" style="display:none">
                                <br>
                                <div class="form-group">
                                    <label class="control-label">Date début: </label>
                                    <input type="date" class="form-control" id="date_debut">
                                </div>
                            </div>

                            <div class="col-md-3 date-fields" style="display:none">
                                <br>
                                <div class="form-group">
                                    <label class="control-label">Date fin: </label>
                                    <input type="date" class="form-control" id="date_fin">
                                </div>
                            </div>

                        </div>

                        <div class="row">


                            <div class="col-md-3">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Prix vente HT: <span class="obligatoire">*</span></label>
                                    <input type="number" placeholder="Prix HT" class="form-control " id="prix_ht">

                                </div>
                            </div>

                            <div class="col-md-2">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Remise:</label>
                                    <input type="number" placeholder="Remise:"
                                        class="form-control  @error('mobile') is-invalid @enderror" id="remise">


                                </div>
                            </div>
                            <div class="col-md-3">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Fournisseur:<span class="obligatoire">*</span> </label>


                                    <select class="form-control"style="width: 100%" id="fournisseur_id" required>
                                        @foreach ($fournisseurs as $fournisseur)
                                            <option value="{{ $fournisseur->id }}" style="float:left">
                                                {{ $fournisseur->nom }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>

                            <div class="col-md-2">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Tva: </label>


                                    <select class="none form-control"style="width: 100%" id="tva" required>
                                        @foreach ($taxes as $taxe)
                                            <option value="{{ $taxe->pourcentage }}" style="float:left">
                                                {{ $taxe->nom }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>

                            <div class="col-md-2">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Type remise:</label>
                                    <select class="form-select none form-control" id="type_remise">
                                        <option value="pourcentage">
                                            <span style="font-size:10px">%
                                            </span>
                                        </option>
                                        <option value="montant">
                                            <span style="font-size:10px">TND
                                            </span>
                                        </option>
                                    </select>


                                </div>

                            </div>
                            <div class="col-md-3">
                                <br>

                                <div class="form-group">
                                    <label class="control-label"> Déscription: </label>
                                    <textarea placeholder="Déscription" class="form-control " id="description"></textarea>

                                </div>
                            </div>







                        </div>


                        <div class="col-md-2 text-center">
                            <button type='submit' class='btn btn-success' onclick='save()'>Enregistrer le produit
                            </button>
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-layout-submit">
                                                <button class="btn btn-info" onclick="calculer()">Effectuer Le
                                                    calcule</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-12" id="after_calcul">
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Form Layout Row -->
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<script>
    function test_type() {
    var type_produit = $("#type_produit").val();

    // Gestion de l'affichage OEM vs Normal
    const isOEM = type_produit == 4;
    $('#oem_div').toggle(isOEM);
    $('#normal_div').toggle(!isOEM);

    if (!isOEM) {
        // Gestion des champs de date (type 1)
        $('.date-fields').toggle(type_produit == 1);

        // Gestion du prix d'achat (masqué uniquement pour type 2)
        $('#prix_achat_div').toggle(type_produit != 2);

        // Gestion du champ fournisseur (affiché uniquement pour materiel)
        const isMateriel = type_produit == 3; // Assumant que 3 est l'ID pour materiel
        $('#fournisseur_id').closest('.col-md-3').toggle(isMateriel);
    }
}
    $(document).ready(function() {
        test_type()

        // Définir la date minimum à aujourd'hui pour date_debut
        var today = new Date().toISOString().split('T')[0];
        $('#date_debut').attr('min', today);

        // Validation des dates
        $('#date_debut').on('change', function() {
            $('.date-error').remove();
            var dateDebut = $(this).val();
            $('#date_fin').attr('min', dateDebut);

            var dateFin = $('#date_fin').val();
            if(dateFin && dateDebut > dateFin) {
                $('#date_fin').val('');
                $("<span class='text-danger date-error' style='font-size:12px'>La date de fin doit être supérieure à la date de début</span>")
                    .insertAfter('#date_fin');
            }
        });

        $('#date_fin').on('change', function() {
            $('.date-error').remove();
            var dateFin = $(this).val();
            var dateDebut = $('#date_debut').val();

            if(dateDebut && dateDebut > dateFin) {
                $(this).val('');
                $("<span class='text-danger date-error' style='font-size:12px'>La date de fin doit être supérieure à la date de début</span>")
                    .insertAfter(this);
            }
        });
    });

    function save_oem() {
        $('.erreur').empty();
        var file_cles = $("#file_cles")[0].files
        var file_result = file_cles.length > 0 ? file_cles[0] : ''
        var type_produit = $("#type_produit").val()
        var date_cles = $("#date_cles").val()
        var fournisseur_id = $('#fournisseur_id').val()

        var form = new FormData();

        form.append('file_cles', file_result);
        form.append('type_produit', type_produit);
        form.append('date_cles', date_cles);
        form.append('fournisseur_id', fournisseur_id);


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },

            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            data: form,
            success: function(result) {
                console.log(result)
                if (result.error) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'Un erreur est survenu',
                        showConfirmButton: true,
                        timer: 3000
                    })
                    if (result.error.file_cles) {
                        error_message(result.error.file_cles[0], "#file_cles")
                    }
                    if (result.error.type_produit) {
                        error_message(result.error.type_produit[0], "#type_produit")
                    }
                    if (result.error.date_cles) {
                        error_message(result.error.date_cles[0], "#date_cles")
                    }

                } else if (result.erreur_existe) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: result.erreur_existe,
                        showConfirmButton: true,
                    })
                    return false
                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Produit ajouté avec succès',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(function() {
                        window.location.href = "{{ route('catalogues.index') }}";
                    }, 1000);
                    console.log(result.success_id)



                }
            }
        });


    }

    function test_number(number, test) {

        if (!isNaN(number) && parseFloat(number) >= parseFloat(test)) {
            return true
        } else {
            return false
        }


    }

    function total(prix_ht, quantites, tva, remise_valeur, type_remise) {

        if (!test_number(prix_ht, 0) || !test_number(quantites, 0)) {
            return false

        }
        if (!prix_ht || !quantites) {
            return false

        }
        var totale_ht = parseFloat(prix_ht) * quantites

        if (type_remise == 'pourcentage') {
            var total_remise = parseFloat(totale_ht) * (parseFloat(remise_valeur) / 100)
        } else if (type_remise == 'montant') {
            var total_remise = parseFloat(remise_valeur)
        }

        var new_total = totale_ht - total_remise

        var total_tva = parseFloat(new_total) * (parseFloat(tva) / 100)

        var total_ttc = (parseFloat(new_total) + parseFloat(total_tva))

        return {

            'total_ht': totale_ht,
            'total_tva': total_tva,
            'total_remise': total_remise,
            'type_remise': type_remise,
            'total_ttc': total_ttc,
        }


    }

    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    {{-- function enlevement() {
        $('#adresse_livraison').empty()
        var enlev = $('#adresse_enlev').val()

        var data = {!! str_replace("'", "\'", json_encode($destinations)) !!};
        data.forEach(element => {
            if (element.id != enlev) {
                $('#adresse_livraison').append($('<option>', {
                    value: element.id,
                    text: element.nom
                }));

            }
        });
    } --}}


    function save() {
        $('.erreur, .date-error').empty();
        
        var type_produit = $("#type_produit").val();
        var isService = type_produit == 2;

        // Validation des champs obligatoires
        if (!$('#nom_produit').val()) {
            error_message("Le nom du produit est requis", "#nom_produit");
            return false;
        }

        if (!$('#prix_ht').val()) {
            error_message("Le prix HT est requis", "#prix_ht");
            return false;
        }

        // Prix d'achat obligatoire seulement pour les non-services
        if (!isService && !$('#prix_achat').val()) {
            error_message("Le prix d'achat est requis", "#prix_achat");
            return false;
        }

        var data = {
            type_produit: type_produit,
            fournisseur_id: $('#fournisseur_id').val(),
            prix_ht: $('#prix_ht').val(),
            prix_achat: isService ? 0 : $('#prix_achat').val(), // 0 pour les services
            tva: $('#tva').val() || 0,
            remise: $('#remise').val() || 0,
            type_remise: $('#type_remise').val(),
            produit: $('#nom_produit').val(),
            description: $('#description').val() || '',
            _token: "{{ csrf_token() }}"
        };

        // Dates uniquement pour type 1
        if (type_produit == 1) {
            data.date_debut = $('#date_debut').val();
            data.date_fin = $('#date_fin').val();
        }

        console.log('Données envoyées:', data); // Pour le debug

        $.ajax({
            url: "{{ url('/storecatalogue') }}",
            method: 'POST',
            data: data,
            success: function(result) {
                console.log('Réponse:', result); // Pour le debug
                if (result.error) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'Une erreur est survenue',
                        text: result.error,
                        showConfirmButton: true
                    });
                } else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Produit ajouté avec succès',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    setTimeout(function() {
                        window.location.href = "{{ route('catalogues.index') }}";
                    }, 1000);
                }
            },
            error: function(xhr, status, error) {
                console.log('Erreur:', {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'Une erreur est survenue',
                    text: 'Impossible d\'enregistrer le produit. Veuillez réessayer.',
                    showConfirmButton: true
                });
            }
        });
    }
</script>
