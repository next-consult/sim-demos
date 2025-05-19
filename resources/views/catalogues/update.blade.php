@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="seipkon-breadcromb-left">
                            <h3>Modifier le produit <span
                                    style='font-size:14px;font-weight:400'>({{ $catalogue->numero }})</span></h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <ul>
                                <a href="{{ route('catalogues.index') }} "> <button class="btn btn-warning"><i
                                            class="fa-solid fa-backward"></i>Retour</button></a>

                            </ul>
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
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="control-label">Categorie du produit</label>
                                <select class="form-control"style="width: 100%" id="type_produit" onchange="test_type()">
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
                                    <label class="control-label">Numéro clé <span class="obligatoire">*</span></label>
                                    <input type="text" class="form-control" id="num_cle"
                                        value="{{ $catalogue->numero_cle }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Date <span class="obligatoire">*</span></label>
                                    <input type="date" class="form-control" id="date_cles"
                                        value="{{ $catalogue->date_cle }}">

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
                                    <input type="text" placeholder="Produit" class="form-control " id="nom_produit"
                                        value="{{ $catalogue->produit }}">

                                </div>
                            </div>
                            <div class="col-md-3 date-fields" style="display:none">
                                <br>
                           
                                <div class="form-group">
                                    <label class="control-label">Date début: </label>

                                    <input type="date" class="form-control" id="date_debut" value="{{ old('date_debut', $catalogue->date_debut) }}">
                                </div>
                            </div>
                            <div class="col-md-3 date-fields" style="display:none">
                                <br>
                                <div class="form-group">
                                    <label class="control-label">Date fin: </label>
                                    <input type="date" class="form-control" id="date_fin" value="{{ old('date_fin', $catalogue->date_fin) }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Prix achat<span class="obligatoire">*</span></label>
                                    <input type="number" placeholder="Prix achat" class="form-control " id="prix_achat"
                                        value="{{ $catalogue->prix_achat }}">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Fournisseur:<span class="obligatoire">*</span> </label>


                                    <select class="form-control"style="width: 100%" id="fournisseur_id" required>
                                        @foreach ($fournisseurs as $fournisseur)
                                            <option value="{{ $fournisseur->id }}" style="float:left"
                                                {{ $fournisseur->id == $catalogue->fournisseur_id ? 'selected' : '' }}>
                                                {{ $fournisseur->nom }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <br>

                                <div class="form-group">
                                    <label class="control-label"> Déscription: <span class="obligatoire">*</span></label>
                                    <textarea placeholder="Déscription" class="form-control " id="description">{{ $catalogue->description }}</textarea>

                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Prix HT: <span class="obligatoire">*</span></label>
                                    <input type="number" placeholder="Prix HT" class="form-control " id="prix_ht"
                                        value="{{ $catalogue->prix_ht }}">

                                </div>
                            </div>

                            <div class="col-md-2">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Tva: </label>


                                    <select class="none form-control"style="width: 100%" id="tva" required>
                                        @foreach ($taxes as $taxe)
                                            <option value="{{ $taxe->pourcentage }}" style="float:left"
                                                {{ $catalogue->tva == $taxe->pourcentage ? 'selected' : '' }}>
                                                {{ $taxe->nom }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Remise:</label>
                                    <input type="number" placeholder="Remise:"
                                        class="form-control  @error('mobile') is-invalid @enderror" id="remise"
                                        value="{{ $catalogue->remise }}">
                                    @error('mobile')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <br>

                                <div class="form-group">
                                    <label class="control-label">Type remise:</label>
                                    <select class="form-select none form-control" id="type_remise">
                                        <option value="pourcentage"
                                            {{ $catalogue->type_remise == 'pourcentage' ? 'selected' : '' }}>
                                            <span style="font-size:10px">%
                                            </span>
                                        </option>
                                        <option value="montant"
                                            {{ $catalogue->type_remise == 'montant' ? 'selected' : '' }}>
                                            <span style="font-size:10px">TND
                                            </span>
                                        </option>
                                    </select>


                                </div>
                            </div>
                            <div class='text-center'><button type='submit' class='btn btn-success'
                                    onclick='save()'>Modifier le produit </button></div>

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
        var type_produit = $("#type_produit").val()
        if (type_produit == 4) {
            $('#oem_div').show()
            $('#normal_div').hide()
        } else {
            $('#oem_div').hide()
            $('#normal_div').show()

            if (type_produit == 1) {
                $('.date-fields').show()
            } else {
                $('.date-fields').hide()
            }
        }
    }
    $(document).ready(function() {
        $("#type_produit").val('{{ $catalogue->categorie }}')
        test_type()
        {{-- $('#info_div').append("<div class='col-md-4'>"+
                                "<div class='form-group'>"+
                                    "<label class='control-label'>Choisir le trajéctoire <span"+
                                            "class='obligatoire'>*</span></label>"+

                                    "<select class='js-example-basic-single js-states form-control'style='width: 100%'"+
                                        "id='trajectoire' required >"+

                                        "@foreach ($destinations as $destination)"+
                                            "<option value='{{ $destination->id }}' {{ $destination->id == $catalogue->destination_id ? 'selected' : '' }}>"+
                                                "{{ $destination->enlevement }}-> {{$destination->livraison}}</option>"+
                                        "@endforeach"+

                                    "</select>"+

                                "</div>"+
                            "</div>"+

                            "<div class='col-md-4'>"+
                                "<div class='form-group'>"+
                                    "<label class='control-label'>Déscription:</label>"+
                                    "<input value='{{$catalogue->description}}' type='text' placeholder='Déscription'"+
                                        "class='form-control' id='description'>"+
                                "</div>"+
                            "</div>"+

                            "<div class='col-md-4'>"+
                                "<div class='form-group'>"+
                                    "<label class='control-label'>Unité:</label>"+
                                    "<input type='text' placeholder='Unité' class='form-control ' id='unite' value='{{$catalogue->unite}}'>"+

                                "</div>"+
                            "</div>")
     --}}

        calculer()

    });

    function test_number(number, test) {

        if (!isNaN(number) && parseFloat(number) >= parseFloat(test)) {
            return true
        } else {
            return false
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

        $("#adresse_livraison option[value=" + '{{$catalogue->destination_id}}' + "]").prop('selected', true);
    } --}}




    function save_oem() {
        $('.erreur').empty();
        var type_produit = $("#type_produit").val()
        var date_cles = $("#date_cles").val()
        var fournisseur_id = $('#fournisseur_id').val()
        var num_cle = $('#num_cle').val()

        var form = new FormData();

        form.append('num_cle', num_cle);
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
            url: "{{ url('/storeupdatecatalogueoem') }}/" + "{{ $catalogue->id }}",
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
                    if (result.error.num_cle) {
                        error_message(result.error.num_cle[0], "#num_cle")
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
                        title: 'Produit modifié avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(function() {
                        location.reload()

                    }, 1000);
                    console.log(result.success_id)



                }
            }
        });


    }










    function save() {
        $('.erreur').empty();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var tva = 0
        var remise_valeur = 0
        var prix_ht = $('#prix_ht').val()
        var prix_achat = $('#prix_achat').val()

        if ($('#tva').val()) {
            tva = $('#tva').val()

        }
        if ($('#remise').val()) {
            remise_valeur = $('#remise').val()


        }
        var type_remise = $('#type_remise').val()

        var description = $('#description').val()
        var produit = $('#nom_produit').val()

        var fournisseur_id = $('#fournisseur_id').val()
        var type_produit = $("#type_produit").val()

        var data = {
            fournisseur_id: fournisseur_id,
            prix_achat: prix_achat,
            prix_ht: prix_ht,
            tva: tva,
            remise: remise_valeur,
            type_remise: type_remise,
            produit: produit,
            description: description,
            type_produit: type_produit,
            date_debut: $('#date_debut').val(),
            date_fin: $('#date_fin').val(),
            _token: "{{ csrf_token() }}"
        };

        jQuery.ajax({
            url: "{{ url('/storeupdatecatalogue') }}/" + '{{ $catalogue->id }}',
            method: 'post',
            data: data,
            success: function(result) {
                if (result.error) {
                    if (result.error.prix_achat) {
                        error_message(result.error.prix_achat[0], "#prix_achat")
                    }
                    if (result.error.produit) {
                        error_message(result.error.produit[0], "#nom_produit")
                    }

                    if (result.error.description) {
                        error_message(result.error.description[0], "#description")
                    }
                    if (result.error.unite) {
                        error_message(result.error.unite[0], "#unite")
                    }
                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Produit modifié avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })

                    setTimeout(function() {

                        window.location.href = "{{ url('/catalogues') }}";

                    }, 1000);

                }


            }




        });








    }
</script>
