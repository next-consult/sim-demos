@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-7">
                        <div class="seipkon-breadcromb-left">
                            <h3>Ajouter un groupe</h3>
                        </div>
                    </div>
                    <div class="col-md-5">

                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">

                            <button type="button" class="btn btn-info " onclick="savegroupe()"><i class="fa fa-check"></i>
                                Enregistrer le
                                groupe</button>

                            <a href="{{ route('groupe.index') }}"><button type="button" class="btn btn-warning btn_retour"
                                    style=" margin-left: 120px;
"><i class="fa-solid fa-backward"></i>Retour</button></a>

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
                        <form>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Module: <span class="obligatoire">*</span>
                                        </label>
                                        <select class='form-control' id="nom">

                                            <option value="facture">
                                                Facture
                                            </option>
                                            <option value="devis">
                                                Devis
                                            </option>
                                            <option value="bonlivraison">
                                                Bonlivraisons
                                            </option>
                                            <option value="intervention">
                                                Intervention
                                            </option>
                                            <option value="client">
                                                Client
                                            </option>
                                            <option value="produit">
                                                Produit
                                            </option>
                                            <option value="fournisseur">
                                                Fournisseur
                                            </option>
                                            <option value="contact-crm">
                                                Contact-crm
                                            </option>
                                            <option value="contrat">
                                                Contrat
                                            </option>
                                            <option value="boncommande">
                                                Boncommande
                                            </option>
                                            <option value="opportunite">
                                                opportunite
                                            </option>
                                        </select>
                                        <div id="erreur_unique"></div>


                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label">Caractéres: <span class="obligatoire">*</span></label>

                                        <input type="text" class="form-control " name="format">
                                        {{-- <span>Fichiers Disponibles: {NUMBER} {YEAR} {MONTH}</span> --}}
                                    </div>
                                </div>
                                <div class="col-md-12">

                                    <label class="control-label">Format (aprés caractéres): <span
                                            class="obligatoire">*</span></label>

                                    <select multiple="multiple"
                                        class="js-example-basic-single js-states form-control chosen-select"style="width: 100%"
                                        id="elements">
                                        {{-- {{$ordre->id == 3 ||  $ordre->id == 2 ? 'selected' : ''}}  --}}

                                        <option value="YEAR">
                                            YEAR
                                        </option>
                                        <option value="YY">
                                            YY
                                        </option>
                                        <option value="MONTH">
                                            MONTH
                                        </option>
                                        <option value="NUMBER">
                                            NUMBER
                                        </option>
                                    </select>
                                    <div id="erreur_format"></div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Nombre prochain <span class="obligatoire">*</span>
                                        </label>
                                        <input type="number" placeholder="Nombre prochain" class="form-control"
                                            name="nb_prochain">


                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Le pavé gauche: <span
                                                class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Le pavé gauche" class="form-control"
                                            name="nb_left">

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Numéro réinitialisé: <span class="obligatoire">*</span>
                                        </label>
                                        <select class='form-control' id="renist">

                                            <option value="jamais">
                                                Jamais
                                            </option>
                                            <option value="year">
                                                Chaque année
                                            </option>
                                            <option value="month">
                                                Chaque mois
                                            </option>


                                        </select>

                                    </div>
                                </div>

                            </div>
                        </form>

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
    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }



    function savegroupe() {
        $('.erreur').empty();
        var obligatoire =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"

        var number =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ doit etre un telephone</p>"

        var nom = $("#nom").val();
        var format = $("input[name='format']").val();
        var nb_prochain = $("input[name='nb_prochain']").val();
        var nb_left = $("input[name='nb_left']").val();


        var renist = $("#renist").val();
        if ($("#elements").val().length == 0) {
            error_message("Ce champ est obligatoire", "#erreur_format")
            return false
        }
        if (jQuery.inArray("NUMBER", $("#elements").val()) == -1) {
            error_message("number est obligatoire <br>", "#erreur_format")
            return false
        }


        var elements = JSON.stringify($("#elements").val());
        var form = new FormData();

        form.append('nom', nom);
        form.append('format', format);
        form.append('nb_prochain', nb_prochain);
        form.append('nb_left', nb_left);
        form.append('renist', renist);
        form.append('elements', elements);

        {{-- var files = $("input[name='files']")[0].files
        var photo = $("input[name='photo']")[0].files[0]
        var form = new FormData();
        for (var i = files.length - 1; i >= 0; i--) {
            form.append('files[]', files[i]);
        } --}}
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            url: "{{ url('/storegroupe') }}",
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

                    if (result.error.nom) {
                        error_message(result.error.nom[0], "#erreur_unique")
                    }
                    if (result.error.format) {
                        error_message(result.error.format[0], "input[name='format']")
                    }
                    if (result.error.nb_prochain) {
                        error_message(result.error.nb_prochain[0], "input[name='nb_prochain']")
                    }
                    if (result.error.nb_left) {
                        error_message(result.error.nb_left[0], "input[name='nb_left']")
                    }
                    if (result.error.renist) {
                        error_message(result.error.renist[0], "#renist")
                    }

                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'groupe ajouté avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    {{-- setTimeout(function() {


                        window.location.href =
                            "{{ url('/groupe') }}";

                    }, 1000); --}}
                    console.log(result.success_id)



                }
            },
            error: function(result) {

            }
        });


    }
</script>
