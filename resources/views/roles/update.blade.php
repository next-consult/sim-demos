@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-5 ">
                        <div class="seipkon-breadcromb-left">
                            <h3>Ajouter un role</h3>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <button type="button" class="btn btn-info" onclick="saverole()"><i class="fa fa-check"></i>
                            Enregistrer le role
                        </button>
                    </div>

                    <div class="col-md-2">

                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">

                            <a href="{{ route('roles.index') }}"><button type="button" class="btn btn-warning btn_retour"
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nom: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer nom" class="form-control" name="nom"
                                            value="{{ $role->nom }}">


                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label" id="module_test">Liste des modules<span
                                                class="obligatoire">*</span></label>
                                        <ul class="list-group">
                                            @foreach ($permissions as $permission)
                                                <li class="list-group-item">
                                                    <input class="form-check-input me-1" type="checkbox"
                                                        value="{{ $permission->id }}" name="module"
                                                        id="module-{{ $permission->id }}">
                                                    <span
                                                        style="font-size:14px;font-weight:600;margin-left:10px;text-transform: capitalize">
                                                        {{ $permission->nom }} </span>
                                                </li>
                                            @endforeach

                                        </ul>
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
    $(document).ready(function() {
        test_checked()

        // Read selected option

    });
</script>

<script>
    function test_checked() {

        var permissions = {{ Js::from($role->permissions) }}
        console.log(permissions)

        for (permission of permissions) {
            $('input[name=module][value=' + permission.id + ']').prop("checked", true);

        }

    }

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

    function saverole() {
        $('.erreur').empty();
        var obligatoire =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"

        var number =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ doit etre un telephone</p>"

        var modules = $("input[name='module']")
            .map(function() {
                if ($(this).prop('checked') == true) {
                    return $(this).val();

                }
            }).get();

        var modulesJson = JSON.stringify(modules);
        var nom = $("input[name='nom']").val();
        var test = true
        if ("{{ $role->nom }}" == "Administrateur") {
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: "Vous ne pouvez pas changer les permissions de l'admin",
                showConfirmButton: true,
                timer: 2000
            })
             setTimeout(function() {
              location.reload()
            }, 2000);
            return false
           
        }
        if (!nom) {
            error_message("Ce champ est obligatoire", "input[name='nom']")
            test = false
        }
        if (modules.length == 0) {
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Il faut choisir un role',
                showConfirmButton: true,
                timer: 3000
            })
            test = false


        }
        if (test == false) {
            return false
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            url: "{{ url('/updatestorerole') }}/" + '{{ $role->id }}',
            method: 'post',
            data: {
                modules: modulesJson,
                nom: nom,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                console.log(result)
                if (result == 200) {

                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Role modifié avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(function() {
                        window.location.href =
                            "{{ route('roles.index') }}"
                    }, 1000);


                }
            }
        });


    }
</script>
