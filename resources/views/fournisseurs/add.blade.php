@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-7">
                        <div class="seipkon-breadcromb-left">
                            <h3>Ajouter un fournisseur</h3>
                        </div>
                    </div>
                    <div class="col-md-5">

                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">

                            <button type="button" class="btn btn-info " onclick="savefournisseur()"><i
                                    class="fa fa-check"></i>
                                Enregistrer le
                                fournisseur</button>

                            <a href="{{ route('fournisseur.index') }}"><button type="button"
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
                        <form>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Nom: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer Nom"
                                            class="form-control  @error('nom') is-invalid @enderror" name="nom">


                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Email: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer Email" class="form-control "
                                            name="email">


                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Telephone <span class="obligatoire">*</span> </label>
                                        <input type="number" placeholder="Entrer Telephone" class="form-control"
                                            name="telephone">


                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">MF: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer MF" class="form-control" name="mf">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <br>

                                <div class="col-md-3">
                                    <br>

                                    <div class="form-group">
                                        <label class="control-label">Code postal <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer Code postal" class="form-control"
                                            name="code_postal">

                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="control-label"> Addresse: <span class="obligatoire">*</span></label>
                                        <textarea placeholder="Entrer votre adresse" class="form-control " name="adresse"></textarea>

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

    function savefournisseur() {
        $('.erreur').empty();
        var obligatoire =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"

        var number =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ doit etre un telephone</p>"

        var nom = $("input[name='nom']").val();
        var email = $("input[name='email']").val();
        var telephone = $("input[name='telephone']").val();
        var mf = $("input[name='mf']").val();

        var adresse = $("textarea[name='adresse']").val();
        var code_postal = $("input[name='code_postal']").val();
        var form = new FormData();

        form.append('nom', nom);
        form.append('email', email);
        form.append('telephone', telephone);
        form.append('mf', mf);
        form.append('adresse', adresse);
        form.append('code_postal', code_postal);

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
            url: "{{ url('/storefournisseur') }}",
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
                        error_message(result.error.nom[0], "input[name='nom']")
                    }
                    if (result.error.email) {
                        error_message(result.error.email[0], "input[name='email']")
                    }
                    if (result.error.telephone) {
                        error_message(result.error.telephone[0], "input[name='telephone']")
                    }
                    if (result.error.mf) {
                        error_message(result.error.mf[0], "input[name='mf']")
                    }
                    if (result.error.adresse) {
                        error_message(result.error.adresse[0], "textarea[name='adresse']")
                    }
                    if (result.error.code_postal) {
                        error_message(result.error.code_postal[0], "input[name='code_postal']")
                    }
                } else if (result.error_existe) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: result.error_existe,
                        showConfirmButton: true,
                        timer: 3000
                    })
                    return false
                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'fournisseur ajouté avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(function() {


                        window.location.href =
                            "{{ url('/fournisseurs') }}";

                    }, 1000);
                    console.log(result.success_id)



                }
            }
        });


    }
</script>
