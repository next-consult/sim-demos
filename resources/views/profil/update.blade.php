@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-7 ">
                        <div class="seipkon-breadcromb-left">
                            <h3>Modifier votre profil</h3>
                        </div>
                    </div>

                    <div class="col-md-5">

                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">

                            <button type="button" class="btn btn-info " onclick="saveprofil()"><i class="fa fa-check"></i>
                                Enregistrer</button>

                            <a href="{{ route('home') }}"><button type="button" class="btn btn-warning btn_retour"
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">name: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer name" class="form-control" name="name"
                                            value="{{ auth()->user()->name }}">


                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Email: <span class="obligatoire">*</span> </label>
                                        <input type="email" placeholder="Enter L'email"
                                            class="form-control  @error('email') is-invalid @enderror" name="email"
                                            value="{{ auth()->user()->email }}">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Telephone: <span class="obligatoire">*</span></label>
                                        <input type="number" placeholder="Entrer telephone"
                                            class="form-control  @error('telephone') is-invalid @enderror" name="telephone"
                                            value="{{ auth()->user()->telephone }}">
                                        @error('telephone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Ancien mot de passe: </label>
                                        <input type="password" class="form-control " name="old_password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Nouveau mot de passe </label>
                                        <input type="password" class="form-control " name="password">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Confirmer mot de passe: </label>
                                        <input type="password" class="form-control " name="password_confirmation">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12" style="  border: 1px solid grey;">
                                    <br>
                                    <div class="form-group">
                                        <label for="first" id="erreur-photo ">Votre photo
                                        </label><br>

                                        <input type='file' class="form-control" id="file-input" name="photo" />



                                        <div id='img_contain'>
                                            <img id="image-preview"
                                                align='middle'src="{{ asset('assets/img/' . auth()->user()->photo) }}"
                                                alt="your image" title='' />
                                        </div>

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

    function saveprofil() {
        $('.erreur').empty();
        var obligatoire =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"

        var number =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ doit etre un telephone</p>"

        var name = $("input[name='name']").val();
        var email = $("input[name='email']").val();
        var telephone = $("input[name='telephone']").val();
        var old_password = $("input[name='old_password']").val();
        var password = $("input[name='password']").val();
        var password_confirmation = $("input[name='password_confirmation']").val();
        var photo = $("input[name='photo']")[0].files[0]
        if (photo === undefined) {
            photo = ""
        }
        console.log(photo)

        var form = new FormData();
        form.append('name', name);
        form.append('email', email);
        form.append('telephone', telephone);
        form.append('password', password);
        form.append('password_confirmation', password_confirmation);
        form.append('old_password', old_password);
        form.append('photo', photo);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            url: "{{ url('/editprofilstore') }}",
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
                    if (result.error.name) {
                        error_message(result.error.name[0], "input[name='name']")
                    }
                    if (result.error.email) {
                        error_message(result.error.email[0], "input[name='email']")
                    }
                    if (result.error.telephone) {
                        error_message(result.error.telephone[0], "input[name='telephone']")
                    }
                    if (result.error.password) {
                        error_message(result.error.password[0], "input[name='password']")
                    }
                    if (result.error.old_password) {
                        error_message(result.error.old_password[0], "input[name='old_password']")
                    }
                    if (result.error.photo) {
                        error_message(result.error.photo[0], "input[name='photo']")
                    }

                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Profil modifié avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(function() {
                        location.reload()
                    }, 1000);
                }
            },
            error: function() {
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'Un erreur est survenu',
                    showConfirmButton: true,
                    timer: 3000
                })

            }
        });



    }
</script>
