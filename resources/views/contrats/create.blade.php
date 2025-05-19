@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-7">
                        <div class="seipkon-breadcromb-left">
                            <h3>Ajouter un contrat</h3>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">

                            <button type="button" class="btn btn-info " onclick="savecontrat()"><i class="fa fa-check"></i>
                                Enregistrer le contrat</button>

                            <a href="{{ route('contrats.index') }}"><button type="button"
                                    class="btn btn-warning btn_retour" style=" margin-left: 120px;
"><i
                                        class="fa-solid fa-backward"></i>Retour</button></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcromb Row -->


    <!-- Form Layout Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-box">
                <div class="form-example">
                    <div class="form-wrap top-label-exapmple form-layout-page">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Choisir un client: <span
                                            class="obligatoire">*</span></label>
                                    <select class="js-example-basic-single js-states form-control"style="width: 100%"
                                        id="client_id">
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}" style="float:left">
                                                {{ $client->nom }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Choisir l'entreprise: <span
                                            class="obligatoire">*</span></label>
                                    <select class="js-example-basic-single js-states form-control"style="width: 100%"
                                        id="entreprise_id">
                                        @foreach ($entreprises as $entreprise)
                                            <option value="{{ $entreprise->id }}" style="float:left">
                                                {{ $entreprise->nom }}
                                            </option>
                                        @endforeach
                                    </select>


                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Date début <span class="obligatoire">*</span> </label>
                                    <input type="date" class="form-control  @error('date_debut') is-invalid @enderror"
                                        name="date_debut">

                                </div>
                            </div>
							
							
							     <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Date Fin <span class="obligatoire">*</span> </label>
                                    <input type="date" class="form-control  @error('date_fin') is-invalid @enderror"
                                        name="date_fin">

                                </div>
                            </div>
							
							
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Nombre de mois<span class="obligatoire">*</span></label>
                                    <input type="number" placeholder="Nombre de mois" class="form-control" name="num_mois">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Devise<span class="obligatoire">*</span></label>
                                </div>

                                <select class="form-control none" id="devise">
                                    @foreach ($devises as $devv)
                                        <option value="{{ $devv->symbole }}">
                                            {{ $devv->code }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Timbre<span class="obligatoire">*</span></label>
                                    <input type="number" class="form-control" id="timbre_value" value="1"
                                        onchange="total_final()">
                                </div>
                            </div>



                            <div class="col-md-12">
                                <br>
                                <br>
                                <div class="seipkon-breadcromb-right">

                                    <button class="btn btn-success btn_mobile" onclick="addoperation('new')">Ajouter
                                        nouveau produit</button>
                                </div>
                                <div class="invoice-table">

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="facture_table">
                                            <tr id=0 style="background:#DEE2E6 ">
                                                <th>Produit</th>
                                                <th>Déscription</th>
                                                <th style="width:10%">Quantités:</th>
                                                <th style="width:12%">Prix unitaire HT</th>
                                                <th style="width:12%"><span style="font-size:14px">TVA : </span>
                                                </th>
                                                <th style="width:12%"><span style="font-size:14px">Remise : </span>
                                                </th>
                                                <th>Total HT</th>
                                                <th>Total remise</th>
                                                <th>Total TVA</th>
                                                <th>Total TTC</th>
                                                <th>#</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="invoice-footer-note">
                                    <div class="row">

                                        <div class="col-md-11 ">
                                            <div class="invoice-subtotal">
                                                <p><span>Total HT:</span><span id='total_facture_ht'>
                                                    </span> TND
                                                </p>
                                                <p><span>Total Remise:</span>
                                                    <span id='total_facture_remise'></span>TND
                                                </p>


                                                <p><span>Total TVA:</span><span id='total_facture_tva'>
                                                    </span> TND
                                                </p>

                                                <p><span>Timbre:</span><span id='timbre'>
                                                    </span>
                                                    TND
                                                </p>
                                                <p><span>Total
                                                        TTC:</span> <span class="total-style-ttc" id='total_facture_ttc'>
                                                    </span>TND
                                                </p>
                                            </div>
                                        </div>

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
            //error_message
            function error_message(messages, input) {
                return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
                    .insertAfter(input);
            }
            //test_number
            function test_number(number) {

                if (!isNaN(number)) {
                    return true
                } else {
                    return false
                }


            }

            function change_color() {
                var color = $('#categorie option:selected').data('color')
                $('#categorie').css('border-color', color)
                $('#categorie').css('color', color)
                $('#categorie_label').css('color', color)

            }
            $(document).ready(function() {
                change_color()
            });

            function test_input(input) {
                console.log(input.val())
                if (!input.val()) {
                    error_message("Ce champ est obligatoire", input)
                    return false

                }
            }


            function savecontrat() {
                $('.erreur').empty();
                var obligatoire =
                    "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"

                var number =
                    "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ doit etre un telephone</p>"

                var client_id = $("#client_id").val();
                var entreprise_id = $("#entreprise_id").val();
                var timbre_value = $("#timbre_value").val();

                var date_debut = $("input[name='date_debut']").val();
				var date_fin = $("input[name='date_fin']").val();

                var nb_mois = $("input[name='num_mois']").val();
                var devise = $("#devise").val()

                var test = true
                var title_var = ""
                var obligatoire =
                    "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"
                var number =
                    "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est doit etre supérieur ou égale a 0,001</p>"

                var quantites =
                    "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est doit etre supérieur ou égale a 1</p>"

                var remise =
                    "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est doit etre un entier</p>"

                if ($('#facture_table tr').length <= 1) {
                    test = false
                    title_var = "La facture est vide"

                } else {
                    title_var = "Il faut remplir tous les champs correctement"

                }

                if (test_input($("#client_id")) == false) {
                    test = false
                }
                if (test_input($("#entreprise_id")) == false) {
                    test = false

                }
                if (test_input($("#timbre_value")) == false) {
                    test = false

                }
                if (test_input($("input[name='date_debut']")) == false) {
                    test = false

                }
                if (test_input($("input[name='num_mois']")) == false) {
                    test = false

                }
                var rowCount = $('#facture_table tr').length;
                var all_remises = []
                var tva = []

                $('#facture_table tr').each(function() {
                    if (this.id > 0) {
                        var remises = $("#type_remise-" + this.id + " option:selected").val()
                        var item_tva = $("#tva_id-" + this.id + " option:selected").val()
                        all_remises.push(remises)
                        tva.push(item_tva)
                    }

                });
                var catalogues = []
                var produits = []
                var ids = $("input[name='id[]']")
                    .map(function() {
                        return $(this).val();
                    }).get();

                var nom_frais = $("input[name='titre[]']")
                    .map(function() {
                        if (!$(this).val()) {
                            test = false
                            $(obligatoire).insertAfter(this);
                        }


                        return $(this).val();
                    }).get();


                var montant_frais = $("input[name='montant[]']")
                    .map(function() {
                        if (!$(this).val()) {
                            test = false
                            $(obligatoire).insertAfter(this);

                        } else if (!test_number($(this).val(), 0)) {
                            test = false
                            $(number).insertAfter(this);


                        }
                        return $(this).val();
                    }).get();


                var id_frais = $("input[name='id_frais[]']")
                    .map(function() {

                        if (!$(this).val()) {
                            test = false

                        }

                        return $(this).val();
                    }).get();


                var quantites = $("input[name='quantites[]']")
                    .map(function() {


                        if (!$(this).val()) {
                            test = false
                            $(obligatoire).insertAfter(this);

                        } else if (!test_number($(this).val(), 0.001)) {
                            test = false
                            $(quantites).insertAfter(this);


                        }

                        return $(this).val();
                    }).get();

                var description = $("textarea[name='description[]']")
                    .map(function() {


                        if (!$(this).val()) {
                            test = false
                            $(obligatoire).insertAfter(this);

                        }

                        return $(this).val();
                    }).get();

                var produits = $("input[name='produits[]']")
                    .map(function() {


                        if (!$(this).val()) {
                            test = false
                            $(obligatoire).insertAfter(this);

                        }

                        return $(this).val();
                    }).get();



                var prix_ht = $("input[name='prix_ht[]']")
                    .map(function() {

                        if (!$(this).val()) {
                            test = false
                            $(obligatoire).insertAfter(this);

                        } else if (!test_number($(this).val(), 0.001)) {
                            test = false
                            $(number).insertAfter(this);


                        }
                        return $(this).val();
                    }).get();



                var remise = $("input[name='remise[]']")
                    .map(function() {
                        if ($(this).val() && !test_number($(this).val(), 0)) {
                            test = false
                            $(remise).insertAfter(this);
                        }
                        return $(this).val();
                    }).get();
                if (test == false) {
                    swal.fire({
                        title: title_var,

                        timer: 1000,
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


                }
                if (test == true) {
                    var frais = []
                    var items = []
                    for (let i = 0; i < quantites.length; i++) {

                        if (!remise[i]) {
                            remise[i] = 0
                        }
                        object = total(prix_ht[i], quantites[i], tva[i], remise[i], all_remises[i])

                        items.push({
                            'id': ids[i],
                            'produit': produits[i],
                            'description': description[i],
                            'quantites': quantites[i],
                            'prix_ht': prix_ht[i],
                            'tva': tva[i],
                            'remise': remise[i],
                            'total_remise': object['total_remise'],
                            'type_remise': all_remises[i],
                            'total_ht': object['total_ht'],
                            'total_tva': object['total_tva'],
                            'total_ttc': object['total_ttc'],
                        })
                    }
                    var itemsJson = JSON.stringify(items);
                    var form = new FormData();
                    form.append('client_id', client_id);
                    form.append('entreprise_id', entreprise_id);
                    form.append('timbre_value', timbre_value);
                    form.append('date_debut', date_debut);
					form.append('date_fin', date_fin);
                    form.append('nb_mois', parseInt(nb_mois));
                    form.append('items', itemsJson);
                    form.append('devise', devise)
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        },
                        url: "{{ url('/storecontrat') }}",
                        method: 'post',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form,
                        success: function(result) {

                            if (result == 200) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: 'Contrat ajouté avecc succéss',
                                    showConfirmButton: false,
                                    timer: 1000
                                })

                                setTimeout(function() {

                                    window.location.href =
                                        "{{ url('/contrats') }}";

                                }, 1000);
                            }
                        },
                        error: function(result) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'Vérifier la base de donnés',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }

                    });
                }




            }

            function addoperation(test) {

                var rowCount = $('#facture_table  tr').length;
                var id = 0;
                if (rowCount > 1) {
                    var id = $('#facture_table tr').last().attr('id');
                }

                var id_1 = parseInt(id) + 1
                var name_remise = "type_remise-" + id_1
                var catalogue_id = "catalogue_id_" + id_1
                var quantites_id = "quantites_id-" + id_1
                var prix_id = "prix_id-" + id_1
                var tva_id = "tva_id-" + id_1
                var remise_id = "remise_id-" + id_1

                var total_ht_id = "total_ht_id-" + id_1
                var total_remise_id = "total_remise_id-" + id_1
                var total_tva_id = "total_tva_id-" + id_1
                var total_ttc_id = "total_ttc_id-" + id_1
                var description = "description_id-" + id_1
                var object = {
                    'id': catalogue_id
                }
                $('#facture_table tr:last').after(
                    "<tr id=" + id_1 +
                    "><td><input type='hidden' class='form-control' value='new' name='id[]'> <input type='text' class='form-control' name='produits[]' id=" +
                    catalogue_id + "_produit>" +
                    "</td>" +
                    "<td>+Mois courant<textarea class='form-control' id=" + description +
                    " name='description[]'>" +
                    "</textarea> </td>" +
                    "<td><input type='number' class='form-control' value='' name='quantites[]' onchange=calcule($(this)) required id=" +
                    quantites_id +
                    "></td><td> <input type='text' onchange=calcule($(this))  class='form-control' value='' name='prix_ht[]' old-value='' required id=" +
                    prix_id + "></td>" +
                    "<td> <select onchange=calcule($(this))  name='tva[]'class='form-control none' style='margin-top:5px' id=" +
                    tva_id +
                    ">" +
                    "@foreach ($taxes as $taxe)" +
                    "<option value='{{ $taxe->pourcentage }}' style='float:left'>" +
                    "{{ $taxe->nom }}</option>" +
                    "@endforeach" +
                    "</td><td> <div class='row justify-content-start'> <div class='col-md-6'><input type='number' class='form-control' value='' name='remise[]' onchange=calcule($(this))  id=" +
                    remise_id +
                    " required style='width:70px'></div><div class='col-md-6'><select onchange=calcule($(this))  name='type_remise'class='form-select none' style='margin-top:5px' id=" +
                    name_remise +
                    "><option value='pourcentage'> <span style='font-size:10px'>%</span></option><option value='montant'><span style='font-size:10px'>TND </span></option></select></div></div></td><td id=" +
                    total_ht_id + "></td><td id=" + total_remise_id + "></td><td id=" + total_tva_id + "></td><td id=" +
                    total_ttc_id +
                    "></td><td><a class='btn btn_mobile' onclick ='delete_operation($(this))'>X</a></td></tr>"
                );


                total_final()

            }
            //delete row
            function delete_operation(row) {
                row.closest('tr').remove();
                total_final()
            }
            //when input change calcule
            function calcule(ligne) {
                select_id = ligne.attr('id').match(/\d+/)[0]

                var name_remise = $("#type_remise-" + select_id).val()
                var quantites_id = $("#quantites_id-" + select_id).val()
                var prix_id = $("#prix_id-" + select_id).val()
                var tva_id = $("#tva_id-" + select_id).val()
                var remise_id = $("#remise_id-" + select_id).val()

                if (!quantites_id) {
                    quantites_id = 1

                }
                if (!prix_id) {
                    prix_id = 0


                }
                if (!tva_id) {
                    tva_id = 0


                }
                if (!remise_id) {
                    remise_id = 0


                }



                object = total(prix_id, quantites_id, tva_id, remise_id, name_remise)
                var total_ht_id = "#total_ht_id-" + select_id
                var total_remise_id = "#total_remise_id-" + select_id
                var total_tva_id = "#total_tva_id-" + select_id
                var total_ttc_id = "#total_ttc_id-" + select_id

                $(total_ht_id).empty()
                $(total_remise_id).empty()
                $(total_tva_id).empty()
                $(total_ttc_id).empty()

                $(total_ht_id).html(object['total_ht'].replace('.', ','))
                $(total_remise_id).html(object['total_remise'].replace('.', ','))
                $(total_tva_id).html(object['total_tva'].replace('.', ','))
                $(total_ttc_id).html(object['total_ttc'].replace('.', ','))
                total_final()

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
                    'total_ht': parseFloat(totale_ht).toFixed(3),
                    'total_tva': parseFloat(total_tva).toFixed(3),
                    'total_remise': parseFloat(total_remise).toFixed(3),
                    'type_remise': parseFloat(type_remise).toFixed(3),
                    'total_ttc': parseFloat(total_ttc).toFixed(3),
                }

            }

            //function final

            function total_final() {
                var total_ht = 0
                var total_remise = 0
                var total_tva = 0
                var total_ttc = 0
                var total_debours = 0
                var timbre = 0
                if ($("#timbre_value").val()) {
                    timbre = $("#timbre_value").val()

                }

                $('#facture_table tr').each(function() {

                    var currentRow = $(this).closest("tr");
                    if (this.id > 0) {

                        var col_ht = currentRow.find("td:eq(6)").text().replace(',', '.');

                        var col_remise = currentRow.find("td:eq(7)").text().replace(',', '.');
                        var col_tva = currentRow.find("td:eq(8)").text().replace(',', '.');
                        var col_ttc = currentRow.find("td:eq(9)").text().replace(',', '.');
                        total_ht += parseFloat(col_ht)
                        total_remise += parseFloat(col_remise)
                        total_tva += parseFloat(col_tva)
                        total_ttc += parseFloat(col_ttc)
                    }
                });

                var montant_frais = $("input[name='montant[]']")
                    .map(function() {
                        if (!$(this).val()) {
                            return 0;

                        } else {
                            return $(this).val()
                        }
                    }).get();


                for (montant of montant_frais) {
                    total_debours += parseFloat(montant)

                }

                $("#total_facture_ht").empty()
                $("#total_retenu_ht").empty()
                $("#total_facture_remise").empty()
                $("#total_facture_tva").empty()
                $("#total_facture_ttc").empty()
                $("#total_retenu_ht").empty()
                $('.total-style-solde').empty()



                var montant_retenu = 0
                var retenu = 0
                {{-- var items_factures = {{ Js::from($facture->items) }}; --}}


                var montant_retenu = 0
                var retenu = 0


                total_ttc = parseFloat(total_ttc) + parseFloat(total_debours) + parseFloat(timbre)

                $("#total_facture_ht").html(total_ht.toFixed(3).replace('.', ','))
                $("#total_facture_frais").html(total_debours.toFixed(3).replace('.', ','))
                $("#total_facture_remise").html('-' + total_remise.toFixed(3).replace('.', ','))
                $("#total_facture_tva").html(total_tva.toFixed(3).replace('.', ','))
                $("#timbre").html(parseFloat(timbre).toFixed(3).replace('.', ','))
                $("#total_facture_ttc").html(total_ttc.toFixed(3).replace('.', ','))
                $(".total-style-solde").html(total_ttc.toFixed(3).replace('.', ','))


            }
        </script>
