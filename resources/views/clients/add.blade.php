@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-7 ">
                        <div class="seipkon-breadcromb-left">
                            <h3>Ajouter un client</h3>
                        </div>
                    </div>

                    <div class="col-md-5">

                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">

                            <button type="button" class="btn btn-info " onclick="saveclient()"><i class="fa fa-check"></i>
                                Enregistrer le
                                client</button>

                            <a href="{{ route('clients.index') }}"><button type="button" class="btn btn-warning btn_retour"
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
        <div class="col-md-9">
            <div class="page-box">
                <div class="form-example">
                    <div class="form-wrap top-label-exapmple form-layout-page">
                        <form>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Nom: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer nom"
                                            class="form-control  @error('nom') is-invalid @enderror" name="nom">
                                        @error('nom')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Email: <span class="obligatoire">*</span> </label>
                                        <input type="email" placeholder="Enter L'email"
                                            class="form-control  @error('email') is-invalid @enderror" name="email">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Telephone: <span class="obligatoire">*</span></label>
                                        <input type="number" placeholder="Entrer telephone"
                                            class="form-control  @error('telephone') is-invalid @enderror" name="telephone">
                                        @error('telephone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Mobile: </label>
                                        <input type="text" placeholder="Entrer mobile" class="form-control "
                                            name="mobile">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">RNE: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer RNE"
                                            class="form-control  @error('rne') is-invalid @enderror" name="rne">
                                        @error('rne')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">MF: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer matricule fiscal"
                                            class="form-control  @error('mf') is-invalid @enderror" name="mf">
                                        @error('mf')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Raison social:</label>
                                        <input type="text" placeholder="Raison social:"
                                            class="form-control  @error('code_postal') is-invalid @enderror"
                                            name="raison_social">
                                        @error('code_postal')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" id="categorie_label">Catégorie : <span
                                                class="obligatoire">*</span></label>

                                        <select class='form-control none ' id="categorie" onchange="change_color()">
                                            @foreach ($categories as $categorie)
                                                <option data-color="{{ $categorie->couleur }}" value='{{ $categorie->id }}'
                                                    style='float:left;color:{{ $categorie->couleur }}'>
                                                    {{ $categorie->nom }} ({{ $categorie->montant }} TND)
                                                    ({{ $categorie->nb_jours }} jours)
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-3 ">
                                    <br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="avec_taxe" name="type_client"
                                            class="custom-control-input" style="margin-left: 10px;" value="avec_taxe "
                                            checked>
                                        <label class="custom-control-label" for="avec_taxe" style='font-size:14px'>
                                            Assujetti</label>

                                        <input type="radio" id="sans_taxe" name="type_client"
                                            class="custom-control-input" value="sans_taxe" style="margin-left:15px">
                                        <label class="custom-control-label" for="sans_taxe" style='font-size:14px'>
                                            Exonoré</label>

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Fax: </label>
                                        <input type="text" placeholder="Entrer fax" class="form-control "
                                            name="fax">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Web: </label>
                                        <input type="text" placeholder="Web" class="form-control  " name="web">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Code postal: <span
                                                class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Code postal"
                                            class="form-control  @error('code_postal') is-invalid @enderror"
                                            name="code_postal">
                                        @error('code_postal')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
								
								       <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" id="categorie_label">Commerciale : <span
                                                class="obligatoire">*</span></label>

                                        <select class='form-control none ' id="user" name="user_id">
                                            @foreach ($users as $user)
                                                <option  value='{{ $user->id }}'
                                                    style='float:left'>
                                                    {{ $user->name }} 
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12" style="  border: 1px solid grey;">
                                    <br>
                                    <div class="form-group">
                                        <label for="first">Choisir le logo
                                        </label>
                                        <input type='file' class="form-control" id="file-input" name="photo" />
                                        @error('photo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                        <div id='img_contain'>
                                            <img id="image-preview"
                                                align='middle'src="http://www.clker.com/cliparts/c/W/h/n/P/W/generic-image-file-icon-hi.png"
                                                alt="your image" title='' />
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <div class="form-group">
                                        <label for="first">Choisir des fichiers juridiques
                                        </label>
                                        <input type='file' class="form-control" name="files" multiple="multiple" />

                                        {{-- <div id='img_contain'>
                                            <img id="image-preview"
                                                align='middle'src="http://www.clker.com/cliparts/c/W/h/n/P/W/generic-image-file-icon-hi.png"
                                                alt="your image" title='' />
                                        </div> --}}

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <br>
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
        <div class="col-md-3">
            <div class="page-box">
                <h3 style="font-size: 18px;color: black;border-bottom:1px black solid;padding-bottom:8px">
                    Autre contacts <span style="font-size:14px;color:green;cursor:pointer;font-weight:500"
                        onclick="add_contact()">(Ajouter)</span><a>

                </h3>
                <table style="margin-top:15px" id="contact_table">
                    <tbody>
                    </tbody>
                </table>
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


    function saveclient() {
        $('.erreur').empty();
        var obligatoire =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"

        var number =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ doit etre un telephone</p>"

        var test = true

        var nom_contact = $("input[name='nom_contact[]']")
            .map(function() {

                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);

                }
                return $(this).val();
            }).get();


        var telephone = $("input[name='telephone_contact[]']")
            .map(function() {

                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);

                } else if (!test_number($(this).val())) {
                    test = false
                    $(number).insertAfter(this);


                }
                return $(this).val();
            }).get();

        var autre_telephone_contact = $("input[name='autre_telephone_contact[]']")
            .map(function() {

                if ($(this).val() && !test_number($(this).val(), 0)) {
                    test = false
                    $(remise).insertAfter(this);
                }
                return $(this).val();
            }).get();

        var poste_contact = $("input[name='poste_contact[]']")
            .map(function() {

                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);

                }
                return $(this).val();
            }).get();



        var email = $("input[name='email_contact[]']")
            .map(function() {

                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);

                }
                return $(this).val();
            }).get();

        if (test == false) {
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Un erreur est survenu',
                showConfirmButton: true,
                timer: 3000
            })

        } else if (test == true) {
            var contacts = []
            for (let j = 0; j < nom_contact.length; j++) {

                var autre_telef = 0
                if (autre_telephone_contact[j]) {
                    autre_telef = autre_telephone_contact[j]

                }

                contacts.push({
                    'autre_telephone': autre_telef,
                    'nom': nom_contact[j],
                    'poste': poste_contact[j],
                    'telephone': telephone[j],
                    'email': email[j]
                })

            }

            var contactsJson = JSON.stringify(contacts);

            var nom = $("input[name='nom']").val();
            var email = $("input[name='email']").val();
            var telephone = $("input[name='telephone']").val();
            var rne = $("input[name='rne']").val();
            var mf = $("input[name='mf']").val();
            var raison_social = $("input[name='raison_social']").val();
            var fax = $("input[name='fax']").val();
            var web = $("input[name='web']").val();
            var mobile = $("input[name='mobile']").val();
            var categorie = $("#categorie").val();
            var user_id = $("#user").val();

            var adresse = $("textarea[name='adresse']").val();
            var code_postal = $("input[name='code_postal']").val();

            var files = $("input[name='files']")[0].files
            var photo = $("input[name='photo']")[0].files[0]
            console.log(photo)
            var type_client = $('input[name = "type_client"]:checked').val()

            var form = new FormData();
            for (var i = files.length - 1; i >= 0; i--) {
                form.append('files[]', files[i]);
            }

            form.append('user_id', user_id);

            form.append('contacts', contactsJson);
            form.append('photo', photo);
            form.append('mobile', mobile);
            form.append('nom', nom);
            form.append('email', email);
            form.append('telephone', telephone);
            form.append('rne', rne);
            form.append('mf', mf);
            form.append('raison_social', raison_social);
            form.append('fax', fax);
            form.append('web', web);
            form.append('adresse', adresse);
            form.append('code_postal', code_postal);
            form.append('type_client', type_client);
            form.append('categorie', categorie);



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                url: "{{ url('/storeclient') }}",
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
                        if (result.error.rne) {
                            error_message(result.error.rne[0], "input[name='rne']")
                        }
                        if (result.error.mf) {
                            error_message(result.error.mf[0], "input[name='mf']")
                        }
                        if (result.error.raison_social) {
                            error_message(result.error.raison_social[0], "input[name='raison_social']")
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
                    } else if (result.success_id) {









                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Client ajouté avecc succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })

                        setTimeout(function() {

                            window.location.href =
                                `updateclient/${result.success_id}`;

                        }, 1000);



                    }
                }
            });



        }


    }



    //contacts
    function add_contact() {
        $('#contact_table tbody').append("<tr> " +
            "<td style='width:90%'><br>" +
            "<input type='hidden' class='form-control' name='id_frais[]' value='new'><input type='text' class='form-control' placeholder='Nom' name='nom_contact[]'>" +
            "<input type='text' class='form-control' name='poste_contact[]' placeholder='Poste'" +
            " style='margin-top:5px'>" +
            "<input type='number' class='form-control' name='telephone_contact[]' placeholder='Telephone'" +
            " style='margin-top:5px'>" +
            "<input type='number' class='form-control' name='autre_telephone_contact[]' placeholder='Autre telephone'" +
            " style='margin-top:5px'>" +
            "<input type='text' class='form-control' name='email_contact[]' placeholder='Email'" +
            " style='margin-top:5px'>" +
            " </td>" +
            "<td>" +
            "<a class='btn btn-danger ' style='float:right;margin-left:5px;margin-top:20px' onclick=delete_contact($(this))><span style='font-size:12px'>Annuler</span></a>" +
            "</td>" +
            " </tr>")
    }

    function delete_contact(row) {
        row.closest('tr').remove();
    }
</script>
