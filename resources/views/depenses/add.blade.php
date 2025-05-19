@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-7">
                        <div class="seipkon-breadcromb-left">
                            <h3>Ajouter un dépense</h3>
                        </div>
                    </div>
                    <div class="col-md-5">

                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">

                            <button type="button" class="btn btn-info " onclick="savedepense()"><i class="fa fa-check"></i>
                                Enregistrer
                                dépense</button>

                            <a href="{{ route('depense.index') }}"><button type="button" class="btn btn-warning btn_retour"
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
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Date: <span class="obligatoire">*</span></label>
                                    <input type="date" class="form-control " name="date">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Montant: <span class="obligatoire">*</span></label>
                                    <input type="number" class="form-control " name="montant">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Taxe: <span class="obligatoire">*</span></label>
                                    <input type="number" class="form-control " name="taxe">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Catégorie: <span class="obligatoire">*</span>
                                    </label>
                                    <select class='form-control' id="categorie">
                                        <option value="client">
                                            Facture client
                                        </option>
                                        <option value="fournisseur">
                                            Facture fournisseur
                                        </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="test-div">
                              
                            </div>

                        
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Choisir l'entreprise: <span class="obligatoire">*</span>
                                    </label>
                                    <select class='form-control' id="entreprise_id">
                                        @foreach ($entreprises as $entreprise)
                                            <option value='{{ $entreprise->id }}'>
                                                {{ $entreprise->nom }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>


                             <div class="col-md-12">
                                    <br>
                                    <div class="form-group">
                                        <label for="first">Choisir des fichiers 
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
                                        <label class="control-label"> Description: <span class="obligatoire">*</span></label>
                                        <textarea placeholder="Description" class="form-control " name="description"></textarea>

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

    function test_categorie() {
        var categorie = $('#categorie').val()
        $('#test-div').empty()
        $('#client_id').remove()
        $('#fournisseur_id').remove()
        if (categorie == "client") {
           
           $('#test-div').append("<div class='form-group' id='client_div' >"+
                "<label class='control-label'>Choisir le client: <span class='obligatoire'>*</span>"+
                 "</label>"+
                     "<select class='form-control' id='client_id'>"+
                       "@foreach ($clients as $client)"+
                                            "<option value='{{ $client->id }}'>"+
                                     "{{ $client->nom }}"+
                                            "</option>"+
                                        "@endforeach"+
                                    "</select>"+
                                "</div>") 


        } else if (categorie == "fournisseur") {
            $('#test-div').append("<div class='form-group' id='fournisseur_div' >"+
                "<label class='control-label'>Choisir le fournisseur: <span class='obligatoire'>*</span>"+
                 "</label>"+
                     "<select class='form-control' id='fournisseur_id'>"+
                       "@foreach ($fournisseurs as $fournisseur)"+
                                            "<option value='{{ $fournisseur->id }}'>"+
                                     "{{ $fournisseur->nom }}"+
                                            "</option>"+
                                        "@endforeach"+
                                    "</select>"+
                                "</div>") 
        }
            $("select:not(.none)").select2({
                theme: "classic"
            });

    }

    $(document).ready(function() {
         test_categorie()
        $('#categorie').change(function() {
            test_categorie()
        });

    });


    function savedepense() {
        $('.erreur').empty();
        var obligatoire =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"

        var number =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ doit etre un telephone</p>"
       
       var date = $("input[name='date']").val();
        var montant = $("input[name='montant']").val();
        var taxe = $("input[name='taxe']").val();
       
        var categorie = $("#categorie").val();
        var description = $("textarea[name='description']").val();

        var client_id = $("#client_id").val();
        var fournisseur_id = $("#fournisseur_id").val();
        var entreprise_id = $("#entreprise_id").val();
        var files = $("input[name='files']")[0].files

         var fournisseur_id = categorie == 'fournisseur' ? $("#fournisseur_id").val():'';
          var client_id = categorie == 'client' ? $("#client_id").val():'';
        var form = new FormData();

        form.append('montant', montant);
        form.append('date', date);
        form.append('taxe', taxe);
        form.append('categorie', categorie);
        form.append('description', description);

        form.append('client_id', client_id);
        form.append('entreprise_id', entreprise_id);
        form.append('fournisseur_id', fournisseur_id);

        for (var i = files.length - 1; i >= 0; i--) {
            form.append('files[]', files[i]);
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
            url: "{{ url('/storedepense') }}",
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
                    if (result.error.montant) {
                        error_message(result.error.montant[0], "input[name='montant']")
                    }
                    if (result.error.date) {
                        error_message(result.error.date[0], "input[name='date']")
                    }
                    if (result.error.categorie) {
                        error_message(result.error.categorie[0], "input[name='categorie']")
                    }
                    if (result.error.taxe) {
                        error_message(result.error.taxe[0], "input[name='taxe']")
                    }
                  
                    if (result.error.description) {
                        error_message(result.error.description[0], "textarea[name='description']")
                    }
                    if (result.error.client_id) {
                        error_message(result.error.client_id[0], "#client_id")
                    }
                     if (result.error.fournisseur_id) {
                        error_message(result.error.fournisseur_id[0], "#fournisseur_id")
                    }


                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'depense ajouté avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(function() {


                        window.location.href =
                            "{{ url('/depense') }}";

                    }, 1000);
                    console.log(result.success_id)



                }
            }
        });


    }
</script>
