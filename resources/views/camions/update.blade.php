@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-7">
                        <div class="seipkon-breadcromb-left">
                            <h3>Modifier la camion</h3>
                        </div>
                    </div>
                    <div class="col-md-5">

                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">

                            <button type="button" class="btn btn-info " onclick="savecamion()"><i class="fa fa-check"></i>
                                Enregistrer la
                                camion</button>

                            <a href="{{route('camions.index')}}"><button type="button" class="btn btn-warning btn_retour"
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
                                        <label class="control-label">Marque: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer marque"
                                            class="form-control  @error('nom') is-invalid @enderror" name="marque"
                                            value="{{ $camion->marque }}">


                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Modéle: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer Modele"
                                            class="form-control  @error('nom') is-invalid @enderror" name="modele"
                                            value="{{ $camion->modele }}">


                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Matricule: <span class="obligatoire">*</span> </label>
                                        <input type="text" placeholder="Entrer matricule"
                                            class="form-control  @error('email') is-invalid @enderror" name="matricule"
                                            value="{{ $camion->matricule }}">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Num chass: <span class="obligatoire">*</span></label>
                                        <input type="text" placeholder="Entrer num_chass" class="form-control"
                                            name="num_chass" value="{{ $camion->num_chass }}">
                                        @error('telephone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror


                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Date dérniere visite technique<span
                                                class="obligatoire">*</span></label>
                                        <input type="date" class="form-control" name="date_visite"
                                            value="{{ $camion->date_visite }}">

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Date fin assurance: <span
                                                class="obligatoire">*</span></label>
                                        <input type="date"
                                            class="form-control  @error('code_postal') is-invalid @enderror"
                                            name="date_assurance" value="{{ $camion->date_assurance }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Date fin vignette: <span
                                                class="obligatoire">*</span></label>
                                        <input type="date" class="form-control " name="date_vignette" value="{{ $camion->date_vignette }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Date circulation: <span
                                                class="obligatoire">*</span></label>
                                        <input type="date" class="form-control " name="date_circulation"
                                            value="{{ $camion->date_circulation }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Kilometrage: <span
                                                class="obligatoire">*</span></label>
                                        <input type="number" placeholder="Kilométrage" class="form-control"
                                            name="kilometrage" value="{{ $camion->kilometrage }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Num carte grise<span
                                                class="obligatoire">*</span></label>
                                        <input type="text" class="form-control  @error('mf') is-invalid @enderror"
                                            name="num_carte" placeholder="Numéro carte grise"
                                            value="{{ $camion->num_carte }}">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Max volume: <span
                                                class="obligatoire">*</span></label>
                                        <input type="number" placeholder="Max volume" class="form-control"
                                            name="max_volume" value="{{ $camion->max_volume }}">

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Max tonnage: <span
                                                class="obligatoire">*</span></label>
                                        <input type="number" placeholder="Max tonnage" class="form-control"
                                            name="max_tonnage" value="{{ $camion->max_tonnage }}">
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

    function savecamion() {
        $('.erreur').empty();
        var obligatoire =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"

        var number =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ doit etre un telephone</p>"

        var marque = $("input[name='marque']").val();
        var modele = $("input[name='modele']").val();
        var matricule = $("input[name='matricule']").val();
        var num_chass = $("input[name='num_chass']").val();
        var date_circulation = $("input[name='date_circulation']").val();
        var num_carte = $("input[name='num_carte']").val();
        var date_visite = $("input[name='date_visite']").val();
        var date_assurance = $("input[name='date_assurance']").val();
        var date_vignette = $("input[name='date_vignette']").val();
        var max_volume = $("input[name='max_volume']").val();
        var max_tonnage = $("input[name='max_tonnage']").val();
        var kilometrage = $("input[name='kilometrage']").val();
        var form = new FormData();

        form.append('marque', marque);
        form.append('modele', modele);
        form.append('matricule', matricule);
        form.append('num_chass', num_chass);
        form.append('date_circulation', date_circulation);
        form.append('num_carte', num_carte);
        form.append('date_visite', date_visite);
        form.append('date_assurance', date_assurance);
        form.append('date_vignette', date_vignette);
        form.append('max_volume', max_volume);
        form.append('max_tonnage', max_tonnage);
        form.append('kilometrage', kilometrage);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            url: "{{ url('/storeupdatecamion') }}/"+'{{$camion->id}}',
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
                    if (result.error.marque) {
                        error_message(result.error.marque[0], "input[name='marque']")
                    }
                    if (result.error.modele) {
                        error_message(result.error.modele[0], "input[name='modele']")
                    }
                    if (result.error.matricule) {
                        error_message(result.error.matricule[0], "input[name='matricule']")
                    }
                    if (result.error.num_chass) {
                        error_message(result.error.num_chass[0], "input[name='num_chass']")
                    }
                    if (result.error.date_circulation) {
                        error_message(result.error.date_circulation[0], "input[name='date_circulation']")
                    }
                    if (result.error.num_carte) {
                        error_message(result.error.num_carte[0], "input[name='num_carte']")
                    }
                    if (result.error.date_visite) {
                        error_message(result.error.date_visite[0], "input[name='date_visite']")
                    }
                    if (result.error.date_assurance) {
                        error_message(result.error.date_assurance[0], "input[name='date_assurance']")
                    }


                    if (result.error.date_vignette) {
                        error_message(result.error.date_vignette[0], "input[name='date_vignette']")
                    }

                    if (result.error.max_volume) {
                        error_message(result.error.max_volume[0], "input[name='max_volume']")
                    }
                    if (result.error.max_tonnage) {
                        error_message(result.error.max_tonnage[0], "input[name='max_tonnage']")
                    }
                    if (result.error.kilometrage) {
                        error_message(result.error.kilometrage[0], "input[name='kilometrage']")
                    }

                } else if (result.success_id) {

                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Camion modifié avecc succéss',
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
</script>
