@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="seipkon-breadcromb-left">
                            <h3>Ajouter un client</h3>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-info" onclick="saveuser()"><i class="fa fa-check"></i>
                            Enregistrer l'utilisateur
                        </button>
                    </div>

                    <div class="col-md-2">

                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">

                            <a href="{{ route('users.index') }}"><button type="button" class="btn btn-warning btn_retour"
                                    style=" margin-left: 120px;
"><i class="fa-solid fa-backward"></i>Retour</button></a>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                        <input type="text" placeholder="Entrer nom"
                                            class="form-control  @error('nom') is-invalid @enderror" name="name"
                                            value="{{ $user->name }}">
                                        @error('nom')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Email: <span class="obligatoire">*</span> </label>
                                        <input type="email" placeholder="Enter L'email"
                                            class="form-control  @error('email') is-invalid @enderror" name="email"
                                            value="{{ $user->email }}">
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
                                            value="{{ $user->telephone }}">
                                        @error('telephone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Solde Congés: <span
                                                class="obligatoire">*</span></label>
                                        <input type="number" placeholder="Entrer solde congé" class="form-control"
                                            name="solde" value="{{ $user->solde_conge }}">

                                        @error('solde')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Solde Maladie: <span
                                                class="obligatoire">*</span></label>
                                        <input type="number" placeholder="Entrer solde maladie" class="form-control"
                                            name="solde_maladie" value="{{ $user->solde_maladie }}">

                                        @error('solde_maladie')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="margin-top:15px">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Choisir le role<span
                                                class="obligatoire">*</span></label>
                                        <select class="form-control " id="roles">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $role->id == $user->role_id ? 'selected' : '' }}>
                                                    {{ $role->nom }}
                                                </option>
                                            @endforeach



                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Mot de passe: <span
                                                class="obligatoire">*</span></label>
                                        <input type="password" placeholder="password" class="form-control" name="password">

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Confirmer mot de passe: <span
                                                class="obligatoire">*</span></label>
                                        <input type="password" placeholder="password" class="form-control"
                                            name="password_confirmation">

                                    </div>
                                </div>


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

    function saveuser() {
        $('.erreur').empty();
        var obligatoire =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>";

        var number =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ doit etre un telephone</p>";

        var name = $("input[name='name']").val();
        var email = $("input[name='email']").val();
        var telephone = $("input[name='telephone']").val();
        var password = $("input[name='password']").val();
        var roles = $("#roles").val();
        var solde = $("input[name='solde']").val(); // Get solde_conge value
        var solde_maladie = $("input[name='solde_maladie']").val(); // Get solde_maladie value
        var password_confirmation = $("input[name='password_confirmation']").val();
        var form = new FormData();

        form.append('name', name);
        form.append('roles', roles);
        form.append('email', email);
        form.append('telephone', telephone);
        form.append('password', password);
        form.append('solde_conge', solde); // Append solde_conge
        form.append('solde_maladie', solde_maladie); // Append solde_maladie
        form.append('password_confirmation', password_confirmation);
        form.append('_token', '{{ csrf_token() }}');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        jQuery.ajax({
            url: "{{ url('/storeupdateuser') }}/" + '{{ $user->id }}',
            method: 'post',
            cache: false,
            contentType: false,
            processData: false,
            data: form,
            success: function(result) {
                if (result.error) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'Un erreur est survenu',
                        showConfirmButton: true,
                        timer: 3000
                    });
                    if (result.error.name) {
                        error_message(result.error.name[0], "input[name='name']");
                    }
                    if (result.error.email) {
                        error_message(result.error.email[0], "input[name='email']");
                    }
                    if (result.error.telephone) {
                        error_message(result.error.telephone[0], "input[name='telephone']");
                    }
                    if (result.error.password) {
                        error_message(result.error.password[0], "input[name='password']");
                    }
                    if (result.error.solde_conge) {
                        error_message(result.error.solde_conge[0], "input[name='solde']");
                    }
                    if (result.error.solde_maladie) {
                        error_message(result.error.solde_maladie[0], "input[name='solde_maladie']");
                    }
                } else if (result.success_id) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Utilisateur modifié avec succès',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    setTimeout(function() {
                        window.location.href = "{{ route('users.index') }}";
                    }, 1000);
                }
            }
        });
    }
</script>
