@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-7">
                        <div class="seipkon-breadcromb-left">
                            <h3>Ajouter un contact</h3>
                        </div>
                    </div>
                    <div class="col-md-5">

                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">

                            <button type="button" class="btn btn-info " onclick="savecontact()"><i class="fa fa-check"></i>
                                Enregistrer le
                                contact</button>

                            <a href="{{ route('crm.contact.index') }}"><button type="button"
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
        <div class="col-md-9">
            <div class="page-box">
                <div class="form-example">
                    <div class="form-wrap top-label-exapmple form-layout-page">
                        <form>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Raison social: </label>
                                        <input type="text" placeholder="Entrer Raison" class="form-control  "
                                            name="raison">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Nom: </label>
                                        <input type="text" placeholder="Entrer Nom" class="form-control  "
                                            name="nom">


                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Prenom: </label>
                                        <input type="text" placeholder="Entrer prenom" class="form-control  "
                                            name="prenom">


                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Poste</label>
                                        <input type="text" placeholder="Entrer Poste" class="form-control"
                                            name="poste">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Telephone fixe</label>
                                        <input type="number" placeholder="Entrer Telephone" class="form-control"
                                            name="telephone">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Telephone mobile</label>
                                        <input type="number" placeholder="Entrer mobile" class="form-control"
                                            name="mobile">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">MF: </label>
                                        <input type="text" placeholder="Entrer MF" class="form-control" name="mf">

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Email: </label>
                                        <input type="text" placeholder="Entrer Email" class="form-control "
                                            name="email">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Secteurs d'activité: </label>
                                        <select class="form-control" id="secteur">
                                            <option value="Agriculture et agroalimentaire">Agriculture et agroalimentaire
                                            </option>
                                            <option value="Art et divertissement">Art et divertissement</option>
                                            <option value="Automobile">Automobile</option>
                                            <option value="Biotechnologie">Biotechnologie</option>
                                            <option value="Construction et génie civil">Construction et génie civil</option>
                                            <option value="Éducation et formation">Éducation et formation</option>
                                            <option value="Énergie et services publics">Énergie et services publics</option>
                                            <option value="Fabrication">Fabrication</option>
                                            <option value="Immobilier">Immobilier</option>
                                            <option value="Informatique et technologies de l'information">Informatique et
                                                technologies de l'information</option>
                                            <option value="Marketing et publicité">Marketing et publicité</option>
                                            <option value="Médias et communication">Médias et communication</option>
                                            <option value="Pharmaceutique">Pharmaceutique</option>
                                            <option value="Restauration et hôtellerie">Restauration et hôtellerie</option>
                                            <option value="Santé et soins médicaux">Santé et soins médicaux</option>
                                            <option value="Services professionnels">Services professionnels</option>
                                            <option value="Télécommunications">Télécommunications</option>
                                            <option value="Transport et logistique">Transport et logistique</option>
                                            <option value="Vente au détail et commerce électronique">Vente au détail et
                                                commerce électronique</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Fax </label>
                                        <input type="text" placeholder="Entrer fax" class="form-control"
                                            name="fax">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label"> Addresse: </label>
                                        <input type="text" placeholder="Entrer Adresse" class="form-control"
                                            name="adresse">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Code postal </label>
                                        <input type="text" placeholder="Entrer Code postal" class="form-control"
                                            name="code_postal">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Web </label>
                                        <input type="text" placeholder="Entrer web" class="form-control"
                                            name="web">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Linkedin</label>
                                        <input type="text" placeholder="Entrer Linkedin" class="form-control"
                                            name="linkedin">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Facebook</label>
                                        <input type="text" placeholder="Entrer Facebook" class="form-control"
                                            name="facebook">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Instagram </label>
                                        <input type="text" placeholder="Entrer Instagram" class="form-control"
                                            name="instagram">

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
                                <br>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"> Commentaire: </label>
                                        <textarea placeholder="Entrer votre commentaire" class="form-control " name="commentaire"></textarea>

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
                    Sous contacts <span style="font-size:14px;color:green;cursor:pointer;font-weight:500"
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

    function savecontact() {

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


        var telephone_contact = $("input[name='telephone_contact[]']")
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



        var email_contact = $("input[name='email_contact[]']")
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
            return false
        }


        var raison = $("input[name='raison']").val();
        var nom = $("input[name='nom']").val();
        var prenom = $("input[name='prenom']").val();
        var email = $("input[name='email']").val();
        var telephone = $("input[name='telephone']").val();
        var mobile = $("input[name='mobile']").val();
        var mf = $("input[name='mf']").val();
        var secteur = $("#secteur").val();

        var web = $("input[name='web']").val();

        var poste = $("input[name='poste']").val();

        var fax = $("input[name='fax']").val();
        var adresse = $("input[name='adresse']").val();
        var code_postal = $("input[name='code_postal']").val();

        var linkedin = $("input[name='linkedin']").val();
        var facebook = $("input[name='facebook']").val();
        var instagram = $("input[name='instagram']").val();

        var commentaire = $("textarea[name='commentaire']").val();

        var contacts = []

        for (let j = 0; j < nom_contact.length; j++) {

            var autre_telef = null
            if (autre_telephone_contact[j]) {
                autre_telef = autre_telephone_contact[j]

            }

            contacts.push({
                'autre_telephone': autre_telef,
                'nom': nom_contact[j],
                'poste': poste_contact[j],
                'telephone': telephone_contact[j],
                'email': email_contact[j]
            })

        }

        var contactsJson = JSON.stringify(contacts);
        var photo = $("input[name='photo']")[0].files[0]
        var form = new FormData();

        form.append('raison', raison);
        form.append('nom', nom);
        form.append('prenom', prenom);
        form.append('email', email);
        form.append('photo', photo);

        form.append('telephone', telephone);
        form.append('mobile', mobile);
        form.append('mf', mf);
        form.append('poste', poste);
        form.append('secteur', secteur);

        form.append('web', web);
        form.append('fax', fax);
        form.append('adresse', adresse);
        form.append('code_postal', code_postal);

        form.append('linkedin', linkedin);
        form.append('facebook', facebook);
        form.append('instagram', web);

        form.append('comentaire', commentaire);

        form.append('contacts', contactsJson);



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            url: "{{ url('/storecontactcrm') }}",
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
                    if (result.error.raison) {
                        error_message(result.error.raison[0], "input[name='raison']")
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
                        title: 'contact ajouté avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(function() {


                        window.location.href =
                            "{{ url('/contactscrm') }}";

                    }, 1000);
                    console.log(result.success_id)



                }
            }
        });


    }

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
