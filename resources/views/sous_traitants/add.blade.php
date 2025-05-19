@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-7">
                        <div class="seipkon-breadcromb-left">
                            <h3>Ajouter un sous traitant</h3>
                        </div>
                    </div>
                    <div class="col-md-5">

                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">

                            <button type="button" class="btn btn-info " onclick="savechauffeur()"><i
                                    class="fa fa-check"></i>
                                Enregistrer le
                                sous traitant</button>

                            <a onclick="history.back();"><button type="button" class="btn btn-warning btn_retour"
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
                                        <label class="control-label">Prénom: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer prénom"
                                            class="form-control  @error('nom') is-invalid @enderror" name="prenom">


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
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Cin: <span class="obligatoire">*</span></label>
                                        <input type="number" placeholder="Entrer Cin" class="form-control" name="cin">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Date cin: <span class="obligatoire">*</span></label>
                                        <input type="date" class="form-control  @error('mf') is-invalid @enderror"
                                            name="date_cin">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" id="categorie_label">Type pérmis : <span
                                                class="obligatoire">*</span></label>

                                        <select class="form-control none" id="type_permis" placeholder="Type de permis">
                                            <option>B</option>
                                            <option>B1</option>
                                            <option>BE</option>
                                            <option>C</option>
                                            <option>C1E</option>
                                            <option>C1</option>
                                            <option>D</option>
                                            <option>D1</option>
                                            <option>C1E</option>
                                            <option>D1E</option>
                                            <option>DE</option>
                                        </select>

                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Date permis: <span class="obligatoire">*</span></label>
                                        <input type="date" class="form-control  @error('mf') is-invalid @enderror"
                                            name="date_permis">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Date naissance: <span
                                                class="obligatoire">*</span></label>
                                        <input type="date"
                                            class="form-control  @error('code_postal') is-invalid @enderror"
                                            name="date_naissance">
                                        @error('code_postal')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>






                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Entreprise: <span
                                                class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entreprise"
                                            class="form-control  @error('entreprise') is-invalid @enderror"
                                            name="entreprise">
                                     
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">MF externe <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Matricule fiscale"
                                            class="form-control  @error('mf_externe') is-invalid @enderror"
                                            name="mf_externe">
                                        @error('mf_externe')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-12" style="  border: 1px solid grey;">
                                    <br>
                                    <div class="form-group">
                                        <label for="first">Choisir la photo du sous traitant
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
                                <div class="col-md-8">
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label"> Addresse: <span class="obligatoire">*</span></label>
                                        <textarea placeholder="L'adresse du sous traitant" class="form-control " name="adresse"></textarea>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <br>

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

    function change_color() {
        var color = $('#categorie option:selected').data('color')
        $('#categorie').css('border-color', color)
        $('#categorie').css('color', color)
        $('#categorie_label').css('color', color)

    }
    $(document).ready(function() {
        change_color()
    });


    function savechauffeur() {
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
                contacts.push({
                    'nom': nom_contact[j],
                    'telephone': telephone[j],
                    'email': email[j]
                })
            }
            var nom = $("input[name='nom']").val();
            var prenom = $("input[name='prenom']").val();
            var email = $("input[name='email']").val();
            var telephone = $("input[name='telephone']").val();
            var cin = $("input[name='cin']").val();
            var date_cin = $("input[name='date_cin']").val();
            var date_naissance = $("input[name='date_naissance']").val();
            var date_permis = $("input[name='date_permis']").val();
            var type_permis = $("#type_permis").val();
            var code_postal = $("input[name='code_postal']").val();
            var adresse = $("textarea[name='adresse']").val();
            var photo = $("input[name='photo']")[0].files[0]

            var mf_externe = $("input[name='mf_externe']").val();
            var entreprise = $("input[name='entreprise']").val();

            var form = new FormData();

            form.append('nom', nom);
            form.append('prenom', prenom);
            form.append('email', email);
            form.append('telephone', telephone);
            form.append('cin', cin);
            form.append('date_cin', date_cin);
            form.append('date_naissance', date_naissance);
            form.append('date_permis', date_permis);
            form.append('type_permis', type_permis);
            form.append('code_postal', code_postal);
            form.append('photo', photo);
            form.append('adresse', adresse);
            form.append('mf_externe', mf_externe);
            form.append('entreprise', entreprise);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                url: "{{ url('/storesoustraitants') }}",
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
                        if (result.error.prenom) {
                            error_message(result.error.prenom[0], "input[name='prenom']")
                        }
                        if (result.error.email) {
                            error_message(result.error.email[0], "input[name='email']")
                        }
                        if (result.error.telephone) {
                            error_message(result.error.telephone[0], "input[name='telephone']")
                        }
                        if (result.error.cin) {
                            error_message(result.error.cin[0], "input[name='cin']")
                        }
                        if (result.error.date_cin) {
                            error_message(result.error.date_cin[0], "input[name='date_cin']")
                        }
                        if (result.error.date_naissance) {
                            error_message(result.error.date_naissance[0], "input[name='date_naissance']")
                        }
                        if (result.error.date_permis) {
                            error_message(result.error.date_permis[0], "input[name='date_permis']")
                        }

                        if (result.error.type_permis) {
                            error_message(result.error.type_permis[0], "#type_permis")
                        }
                        if (result.error.code_postal) {
                            error_message(result.error.code_postal[0], "input[name='code_postal']")
                        }

                        if (result.error.entreprise) {
                            error_message(result.error.entreprise[0], "input[name='entreprise']")
                        }
                        if (result.error.mf_externe) {
                            error_message(result.error.mf_externe[0], "input[name='mf_externe']")
                        }


                        if (result.error.adresse) {
                            error_message(result.error.adresse[0], "textarea[name='adresse']")
                        }

                    } else if (result.success_id) {

                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Sous traitant ajouté avecc succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })

                        setTimeout(function() {

                            window.location.href =
                                `updatesoustraitants/${result.success_id}`;

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
            "<input type='number' class='form-control' name='telephone_contact[]' placeholder='Telephone'" +
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
