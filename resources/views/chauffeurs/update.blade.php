@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-5">
                        <div class="seipkon-breadcromb-left">
                            <h3>Modifier le chauffeur</h3>
                        </div>
                    </div>

                    <div class="col-md-2">

                        <select class="form-control none" id="type_chauffeur" onchange="change_type()">
                            <option selected value="interne"
                                {{ $chauffeur->type_chauffeur == 'interne' ? 'selected' : '' }}>Interne
                            </option>
                            <option value="externe" {{ $chauffeur->type_chauffeur == 'externe' ? 'selected' : '' }}>Sous
                                traitant</option>

                        </select>
                    </div>

                    <div class="col-md-5">

                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">

                            <button type="button" class="btn btn-info " onclick="savechauffeur()"><i
                                    class="fa fa-check"></i>
                                Enregistrer le
                                chauffeur</button>

                            <a href="{{ route('chauffeurs.index') }} "><button type="button"
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
                                        <input type="text" placeholder="Entrer nom"
                                            class="form-control  @error('nom') is-invalid @enderror" name="nom"
                                            value="{{ $chauffeur->nom }}">
                                        @error('nom')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Prénom: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer prénom"
                                            class="form-control  @error('nom') is-invalid @enderror" name="prenom"
                                            value="{{ $chauffeur->prenom }}">


                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Email: <span class="obligatoire">*</span> </label>
                                        <input type="email" placeholder="Enter L'email"
                                            class="form-control  @error('email') is-invalid @enderror" name="email"
                                            value="{{ $chauffeur->email }}">
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
                                            value="{{ $chauffeur->telephone }}">
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
                                        <input type="number" placeholder="Entrer Cin" class="form-control" name="cin"
                                            value="{{ $chauffeur->cin }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Date cin: <span class="obligatoire">*</span></label>
                                        <input type="date" class="form-control  @error('mf') is-invalid @enderror"
                                            name="date_cin" value="{{ $chauffeur->date_cin }}">

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Date naissance: <span
                                                class="obligatoire">*</span></label>
                                        <input type="date"
                                            class="form-control  @error('code_postal') is-invalid @enderror"
                                            name="date_naissance" value="{{ $chauffeur->date_naissance }}">
                                        @error('code_postal')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Date permis: <span
                                                class="obligatoire">*</span></label>
                                        <input type="date" class="form-control  @error('mf') is-invalid @enderror"
                                            name="date_permis" value="{{ $chauffeur->date_permis }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" id="categorie_label">Type pérmis : <span
                                                class="obligatoire">*</span></label>

                                        <select class="form-control none" id="type_permis" placeholder="Type de permis">
                                            <option {{ $chauffeur->type_permis == 'B' ? 'selected' : '' }}>B</option>
                                            <option {{ $chauffeur->type_permis == 'B1' ? 'selected' : '' }}>B1</option>
                                            <option {{ $chauffeur->type_permis == 'BE' ? 'selected' : '' }}>BE</option>
                                            <option {{ $chauffeur->type_permis == 'C' ? 'selected' : '' }}>C</option>
                                            <option {{ $chauffeur->type_permis == 'C1E' ? 'selected' : '' }}>C1E</option>
                                            <option {{ $chauffeur->type_permis == 'C1' ? 'selected' : '' }}>C1</option>
                                            <option {{ $chauffeur->type_permis == 'D' ? 'selected' : '' }}>D</option>
                                            <option {{ $chauffeur->type_permis == 'D1' ? 'selected' : '' }}>D1</option>
                                            <option {{ $chauffeur->type_permis == 'C1E' ? 'selected' : '' }}>C1E</option>
                                            <option {{ $chauffeur->type_permis == 'D1E' ? 'selected' : '' }}>D1E</option>
                                            <option {{ $chauffeur->type_permis == 'DE' ? 'selected' : '' }}>DE</option>
                                        </select>

                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Code postal: <span
                                                class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Code postal"
                                            class="form-control  @error('code_postal') is-invalid @enderror"
                                            name="code_postal" value="{{ $chauffeur->code_postal }}">
                                        @error('code_postal')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"> Addresse: <span class="obligatoire">*</span></label>
                                        <textarea placeholder="Entrer votre adresse" class="form-control " name="adresse">{{ $chauffeur->adresse }}</textarea>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <div class="form-group">
                                        <label for="first">Ajouter des fichiers
                                        </label>
                                        <input type='file' class="form-control" name="photo" multiple="multiple" />

                                        @if (count($chauffeur->files) > 0)
                                            <table class="table table-bordered" style="width:50%;margin-top:10px">
                                                <thead>
                                                    <tr>
                                                        <th class="th-livraison">
                                                            Fichier
                                                        </th>
                                                        <th class="th-livraison">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($chauffeur->files as $file)
                                                        <tr>
                                                            <td class="livraison">
                                                                <input type="hidden" name="files_ids[]"
                                                                    value="{{ $file->id }}" />
                                                                {{ $file->file }}
                                                            </td>
                                                            <td class="livraison">
                                                                <a
                                                                    href="{{ route('clients.downloadfile', ['id' => $file->file]) }}">
                                                                    <i class="fa-solid fa-download text-success"
                                                                        style="font-size:15px"></i>
                                                                </a>
                                                                <a href="#">
                                                                    <i class="fa-solid fa-trash text-danger"
                                                                        style="font-size:15px"
                                                                        onclick="delete_operation($(this))"></i>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>


                                            </table>
                                        @endif

                                    </div>
                                </div>

                            </div>

                            <div class="row" id="traitant">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Entreprise: <span
                                                class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entreprise"
                                            class="form-control  @error('entreprise') is-invalid @enderror"
                                            name="entreprise">

                                    </div>
                                </div>

                                <div class="col-md-6">
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


                                <div class="col-md-12 table-responsive" style="margin-top:25px">
                                    <h3
                                        style="font-size: 18px;color: black;border-bottom:1px black solid;padding-bottom:8px">
                                        Les camions de sous traitants <span
                                            style="font-size:14px;color:green;cursor:pointer;font-weight:500"
                                            onclick="add_camion()">(Ajouter)</span><a>

                                    </h3>
                                    <table class="table table-bordered" style="margin-top:15px" id="camion_table">
                                        <thead>
                                            <th>Matricule</th>
                                            <th>Marque</th>
                                            <th>Modéle</th>
                                            <th>Max volume </th>
                                            <th>Max tonnage </th>

                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($chauffeur->camions as $camion)
                                                <tr>
                                                    <td>
                                                        <input type='hidden' class='form-control'
                                                            value='{{ $camion->id }}' name='id[]' required>
                                                        <input type='text' class='form-control'
                                                            value='{{ $camion->matricule }}' name='matricule[]' required>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control'
                                                            value='{{ $camion->marque }}' name='marque[]' required>

                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control'
                                                            value='{{ $camion->modele }}' name='modele[]' required>

                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control'
                                                            value='{{ $camion->max_tonnage }}' name='max_tonnage[]'
                                                            required>

                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control'
                                                            value='{{ $camion->max_volume }}' name='max_volume[]'
                                                            required>

                                                    </td>
                                                    <td><a class='btn btn_mobile'
                                                            onclick='delete_operation($(this))'>X</a>
                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>


                                    </table>
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

    function change_type() {
        var type = $('#type_chauffeur').val()
        if (type == "externe") {
            $('#traitant').show()
            $("input[name='mf_externe']").val('{{ $chauffeur->mf_externe }}');
            $("input[name='entreprise']").val('{{ $chauffeur->nom_entreprise }}');
        } else {

            $("input[name='mf_externe']").val('');
            $("input[name='entreprise']").val('');
            $('#traitant').hide()


        }
        console.log(type)

    }
    $(document).ready(function() {
        change_type()
    });


    function savechauffeur() {
        $('.erreur').empty();
        var obligatoire =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"

        var number =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ doit etre un telephone</p>"

        var test = true
        var type_chauffeur = $('#type_chauffeur').val()

        var matricule = $("input[name='matricule[]']")
            .map(function() {

                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);

                }
                return $(this).val();
            }).get();



        var marque = $("input[name='marque[]']")
            .map(function() {

                return $(this).val();
            }).get();


        var modele = $("input[name='modele[]']")
            .map(function() {


                return $(this).val();
            }).get();

        var max_volume = $("input[name='max_volume[]']")
            .map(function() {


                return $(this).val();
            }).get();

        var ids = $("input[name='id[]']")
            .map(function() {


                return $(this).val();
            }).get();
        var files_ids = $("input[name='files_ids[]']")
            .map(function() {
                return $(this).val();

            }).get();
        var files_id_array = []
        for (let j = 0; j < files_ids.length; j++) {
            files_id_array.push({
                'id': files_ids[j],
            })

        }


        var max_tonnage = $("input[name='max_tonnage[]']")
            .map(function() {


                return $(this).val();
            }).get();



        if (($('#camion_table tr').length <= 1) && ($('#type_chauffeur').val() == "externe")) {
            test = false
            var title_var = "Ajouter les camions de sous traitons"

        } else {
            var title_var = "Il faut remplir tous les champs correctement"

        }



        if (test == false) {
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: title_var,
                showConfirmButton: true,
                timer: 3000
            })

        } else if (test == true) {






            var camions = []
            var mf_externe = "";
            var entreprise = "";

            if (type_chauffeur == "externe") {
                for (var i = 0; i < matricule.length; i++) {
                    camions.push({
                        "id": ids[i],
                        "marque": marque[i],
                        "modele": modele[i],
                        "matricule": matricule[i],
                        "max_volume": max_volume[i],
                        "max_tonnage": max_tonnage[i],

                    })
                }
                mf_externe = $("input[name='mf_externe']").val();
                entreprise = $("input[name='entreprise']").val();

            }

            var nom = $("input[name='nom']").val();
            var filesJson = JSON.stringify(files_id_array);
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
            var files = $("input[name='photo']")[0].files

            var form = new FormData();

            for (var i = files.length - 1; i >= 0; i--) {
                form.append('files[]', files[i]);
            }

            var camionsJson = JSON.stringify(camions);
            form.append('type_chauffeur', type_chauffeur);
            form.append('files_ids', filesJson);
            form.append('mf_externe', mf_externe);
            form.append('entreprise', entreprise);
            form.append('nom', nom);
            form.append('camions', camionsJson);
            form.append('prenom', prenom);
            form.append('email', email);
            form.append('telephone', telephone);
            form.append('cin', cin);
            form.append('date_cin', date_cin);
            form.append('date_naissance', date_naissance);
            form.append('date_permis', date_permis);
            form.append('type_permis', type_permis);
            form.append('code_postal', code_postal);
            form.append('adresse', adresse);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                url: "{{ url('/storeupdatechauffeur') }}/" + '{{ $chauffeur->id }}',
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
                        if (result.error.mf_externe) {
                            error_message(result.error.mf_externe[0], "input[name='mf_externe']")
                        }

                        if (result.error.entreprise) {
                            error_message(result.error.entreprise[0], "input[name='entreprise']")
                        }

                        if (result.error.code_postal) {
                            error_message(result.error.code_postal[0], "input[name='code_postal']")
                        }

                        if (result.error.adresse) {
                            error_message(result.error.adresse[0], "textarea[name='adresse']")
                        }

                    } else if (result.success_id) {

                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Chauffeur modifié avecc succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })

                        setTimeout(function() {
                                location.reload()

                        }, 1000);

                    }
                }
            });

        }

    }


    //contacts
    function add_camion() {
        $('#camion_table tbody').append(
            "<tr>" +
            "<td><input type='hidden' class='form-control' value='new' name='id[]' required ><input type='text' class='form-control' value='' name='matricule[]' required ></td>" +
            "<td><input type='text' class='form-control' value='' name='marque[]' required ></td>" +
            "<td><input type='text' class='form-control' value='' name='modele[]' required ></td>" +
            "<td><input type='number' class='form-control' value='' name='max_volume[]' required ></td>" +
            "<td><input type='number' class='form-control' value='' name='max_tonnage[]' required ></td>" +
            "<td><a class='btn btn_mobile' onclick ='delete_operation($(this))'>X</a></td>" +
            "</tr>"
        )
    }

    function delete_operation(row) {
        row.closest('tr').remove();
    }
</script>
