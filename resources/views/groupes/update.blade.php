@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-7">
                        <div class="seipkon-breadcromb-left">
                            <h3>Modifier le groupe</h3>
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
                                        <label class="control-label">Module:<span class="obligatoire">*</span>
                                        </label>
                                        <select class='form-control' id="nom">

                                            <option value="facture" {{ $groupe->nom == 'facture' ? 'selected' : '' }}>
                                                Facture
                                            </option>
                                            <option value="devis" {{ $groupe->nom === 'devis' ? 'selected' : '' }}>
                                                Devis
                                            </option>
                                            <option value="bonlivraison "
                                                {{ $groupe->nom === 'bonlivraison' ? 'selected' : '' }}>
                                                Bonlivraisons
                                            </option>
                                            <option value="intervention"
                                                {{ $groupe->nom == 'intervention' ? 'selected' : '' }}>
                                                Intervention
                                            </option>
                                            <option value="client" {{ $groupe->nom == 'client' ? 'selected' : '' }}>
                                                Client
                                            </option>
                                            <option value="depense" {{ $groupe->nom == 'depense' ? 'selected' : '' }}>
                                                Depense
                                            </option>
                                            <option value="produit" {{ $groupe->nom == 'produit' ? 'selected' : '' }}>
                                                Produit
                                            </option>
                                            <option value="fournisseur"
                                                {{ $groupe->nom == 'fournisseur' ? 'selected' : '' }}>
                                                Fournisseur
                                            </option>
                                            <option value="contact-crm"
                                                {{ $groupe->nom == 'contact-crm' ? 'selected' : '' }}>
                                                Contact-crm
                                            </option>
                                            <option value="contrat" {{ $groupe->nom == 'contrat' ? 'selected' : '' }}>
                                                Contrat
                                            </option>
                                            <option value="boncommande"
                                                {{ $groupe->nom == 'boncommande' ? 'selected' : '' }}>
                                                Boncommande
                                            </option>
                                            <option value="opportunite"
                                                {{ $groupe->nom == 'opportunite' ? 'selected' : '' }}>
                                                opportunite
                                            </option>


                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label">Caractéres: <span class="obligatoire">*</span></label>

                                        <input type="text" class="form-control " name="format"
                                            value="{{ $groupe->format }}">
                                        {{-- <span>Fichiers Disponibles: {NUMBER} {YEAR} {MONTH}</span> --}}
                                    </div>
                                </div>
                                <div class="col-md-12">

                                    <label class="control-label">Format (aprés caractéres): <span
                                            class="obligatoire">*</span></label>

                                    <input type="hidden" value="0" id="increment_test" />
                                    <select multiple="multiple"
                                        class="js-example-basic-single js-states form-control"style="width: 100%"
                                        id="elements">
                                        {{-- {{$ordre->id == 3 ||  $ordre->id == 2 ? 'selected' : ''}}  --}}



                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Nombre prochain <span class="obligatoire">*</span>
                                        </label>
                                        <input type="number" placeholder="Nombre prochain" class="form-control"
                                            name="nb_prochain" value="{{ $groupe->nb_prochain }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Le pavé gauche: <span
                                                class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Le pavé gauche" class="form-control"
                                            name="nb_left" value="{{ $groupe->nb_left }}">

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Numéro réinitialisé: <span class="obligatoire">*</span>
                                        </label>
                                        <select class='form-control' id="renist">

                                            <option value="jamais" {{ $groupe->renist == 'jamais' ? 'selected' : '' }}>
                                                Jamais
                                            </option>
                                            <option value="year" {{ $groupe->renist == 'year' ? 'selected' : '' }}>
                                                Chaque année
                                            </option>
                                            <option value="month" {{ $groupe->renist == 'month' ? 'selected' : '' }}>
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
    //error_message

    $(document).ready(function() {
        test_select()

    })

    function test_select() {
        var items = {{ Js::from($groupe->elements) }};
        var all = ['YEAR', 'YY', 'MONTH', 'NUMBER']
        var test = []
        for (var i = 0; i < items.length; i++) {
            $('#elements').append("<option selected value=" + items[i].nom +
                "><span style='text-transform: uppercase;'>" + items[i].nom + "</span></option>");
            test.push(items[i].nom)
        }

        jQuery.grep(all, function(el) {
            if (jQuery.inArray(el, test) == -1) {
                $('#elements').append("<option  value=" + el +
                    "><span style='text-transform: uppercase;'>" + el + "</span></option>");
            };
        });


        $("#elements").change()

    }

    function reset_select() {
        var increment = $('#increment_test').val()
        if (increment == 0) {
            $('#elements').empty()
            $('#elements').append(
                "<option value='year'>year </option><option value='month'>month</option><option value='number'>number</option>"
            )
        }
    }

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
            url: "{{ url('/updatestoregroupe') }}/" + '{{ $groupe->id }}',
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
                        error_message(result.error.nom[0], "#nom")
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


                } else if (result.error_existe) {
                    error_message(result.error_existe, "input[name='nb_prochain']")
                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'groupe modifié avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(function() {

                        window.location.href =
                            "{{ url('/groupe') }}";

                    }, 1000);
                    console.log(result.success_id)



                }
            }
        });


    }
</script>
