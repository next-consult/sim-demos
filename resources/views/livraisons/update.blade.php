@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row ">
                    <div class="col-md-7 seipkon-breadcromb-left">

                        <h3>Le bon de livraison

                        </h3>
                    </div>
                    <div class="col-md-5">
                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">

                            <button type="button" class="btn btn-info  " onclick="save()"><i class="fa fa-check"></i>
                                Enregistrer</button>
                            <a href="{{ route('bonlivraisons.print', ['id' => $livraison->id]) }}"><button type="button"
                                    class="btn btn-success btn_mobile" style="margin-left:8px"> <i
                                        class="fa-solid fa-file-export"></i>PDF</button></a>

                            <a onclick="history.back();"><button type="button" class="btn btn-warning btn_retour"
                                    style=" margin-left: 120px;
"><i class="fa-solid fa-backward"></i>Retour</button></a>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="page-box">
                <div class="invoice-box">
                    <h4 class="invoice-status">en attente</h4>
                    <div style="text-align:center;margin-bottom:75px;color:#333;font-size:18px">
                        <h3>BON DE LIVRAISON / DELIVERY NOTE: {{ $livraison->numero }}</h3>
                    </div>
                    <div class="invoice-address">
                        <div class="row">
                            <div class="col-md-7">
                                <a href="{{ route('ordres.update', ['id' => $livraison->ordre->id]) }}" target="_blank">

                                    <span class="livraison-label">No ordre :</span><span style="text-decoration: underline;font-size:14px"
                                        class="text-warning">{{ $livraison->ordre->numero }}</span></a><br>


                                <span class="livraison-label">Date :</span> <span
                                    class="livraison-info">{{ date('d/m/Y', strtotime($livraison->date)) }}</span><br>
                                <span class="livraison-label">Our Ref :</span><span
                                    class="livraison-info">{{ $livraison->ordre->items->no_dossier }}</span><br>
                                <span class="livraison-label">Master BL:</span><span
                                    class="livraison-info">{{ $livraison->master_bl }}</span><br>
                                <span class="livraison-label">Lieu d’enlèvement / Pick up address:</span><span
                                    class="livraison-info">{{ $livraison->ordre->items->adress_enlev }}</span><br>
                                <span class="livraison-label">Lieu de livraison / Delivery address:</span><span
                                    class="livraison-info">{{ $livraison->ordre->items->adress_livraison }}</span><br>
                                <span class="livraison-label">Expéditeur/Sender: </span><span
                                    class="livraison-info">{{ $livraison->ordre->items->nom_enlev }}</span><br>
                                <span class="livraison-label">Destinataire/Receiver:</span><span
                                    class="livraison-info">{{ $livraison->ordre->items->nom_livraison }}</span><br>
                                <span class="livraison-label">Chauffer / Driver:</span><span class="livraison-info">
                                    @if ($livraison->ordre->items->chauffeur)
                                        {{ $livraison->ordre->items->chauffeur->nom }}
                                        {{ $livraison->ordre->items->chauffeur->prenom }}
                                    @endif
                                </span><br>
                            </div>
                            <div class="col-md-5">
                                <span class="livraison-label"> EMIS PAR/ISSUED BY:</span><span
                                    class="livraison-info">{{ $livraison->user->name }}</span><br>
                                <span class="livraison-label"> Client / Customer:</span><span
                                    class="livraison-info">{{ $livraison->ordre->client->nom }}
                                    {{ $livraison->ordre->client->prenom }}</span><br>
                                <span class="livraison-label"> House BL:</span><span
                                    class="livraison-info">{{ $livraison->house_bl }}</span>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <span class="livraison-label">Matr. camion / Truck nbr: </span><span class="livraison-info">
                                    @if ($livraison->ordre->items->camion)
                                        {{ $livraison->ordre->items->camion->matricule }}
                                    @endif
                                </span>
                            </div>

                        </div>
                    </div>


                    <div class="invoice-action" style="padding:35px">

                        <div class="invoice-table">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="th-livraison">
                                                Nbre colis/Number of packages
                                            </th>
                                            <th class="th-livraison">
                                                Poids/Weight
                                            </th>
                                            <th class="th-livraison">
                                                Marchandise/Commodity
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="livraison">{{ $livraison->ordre->items->nb_coliss }}</td>
                                            <td class="livraison">{{ $livraison->ordre->items->poids }}</td>
                                            <td class="livraison">{{ $livraison->ordre->items->nature }}</td>
                                        </tr>

                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <ul>
                                    <li><a href="#" data-toggle="tooltip" title="Print"><i
                                                class="fa fa-print"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" title="Download"><i
                                                class="fa fa-download"></i></a></li>
                                </ul> --}}
                            <h4 style="color:#333;float:left">Pied de la page :</h4>
                            <br>
                            {{-- <input style="height:54px" class="form-control" name="footer"
                                    value="{{ $devis->footer }}" /> --}}

                            <textarea class="form-control  @error('condition') is-invalid @enderror" name="footer"> @if ($livraison->footer)
{{ $livraison->footer }} @else{{ $livraison->ordre->entreprise->footer }}
@endif
                                </textarea>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="page-box">
                <div class="invoice-box">
                    <h3 style="font-size: 18px;color: black;border-bottom:1px black solid;padding-bottom:8px">
                        Configuration
                    </h3>
                    <br>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-md-4 col-form-label">Ordres</label>
                        <div class="col-md-8">
                            <select class="js-example-basic-single js-states form-control"style="width: 100%" id="ordre_id"
                                required>
                                @foreach ($ordres as $ordre)
                                    <option value="{{ $ordre->id }}" style="float:left"
                                        {{ $ordre->id == $livraison->ordre_id ? 'selected' : '' }}>
                                        {{ $ordre->numero }} ({{ $ordre->client->nom }}
                                        {{ $ordre->client->prenom }})</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">

                        <p class="name-invoice col-md-4 "><b>Master
                                BL</b></p>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="master_bl" value="{{ $livraison->master_bl }}">
                        </div>
                    </div>
                    <div class="form-group row">

                        <p class="name-invoice col-md-4 "><b>House
                                BL</b></p>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="house_bl"
                                value="{{ $livraison->house_bl }}">
                        </div>
                    </div>
                    <div class="form-group row">

                        <p class="name-invoice col-md-4 "><b>Date</b></p>
                        <div class="col-md-8">
                            <input type="date" class="form-control" id="date_livraison"
                                value="{{ $livraison->date }}">
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


    function save() {
        $('.erreur').empty()
        var date_livraison = jQuery('#date_livraison').val()
        var ordre_id = jQuery('#ordre_id').val()
        var house_bl = jQuery('#house_bl').val()
        var master_bl = jQuery('#master_bl').val()
        var footer = $("textarea[name='footer']").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/savebonlivraisons') }}/" + '{{ $livraison->id }}',
            method: 'post',
            data: {
                date_livraison: date_livraison,
                ordre_id: ordre_id,
                house_bl: house_bl,
                master_bl: master_bl,
                footer: footer,

                _token: "{{ csrf_token() }}",
            },
            success: function(result) {


                if (result.error) {


                    if (result.error.date_livraison) {
                        error_message(result.error.date_livraison[0], "#date_livraison")
                    }
                    if (result.error.ordre_id) {
                        error_message(result.error.ordre_id[0], "#ordre_id")
                    }
                    if (result.error.house_bl) {
                        error_message(result.error.house_bl[0], "#house_bl")
                    }
                    if (result.error.master_bl) {
                        error_message(result.error.master_bl[0], "#master_bl")
                    }


                }
                if (result == 200) {

                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Bon de livraison configuré avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })

                    setTimeout(function() {

                        location.reload(true);
                    }, 1000);



                }


            }
        });



    }

    $(document).ready(function() {



    });
</script>
