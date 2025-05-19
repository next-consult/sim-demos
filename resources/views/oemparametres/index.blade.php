@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des oemparametres</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Breadcromb Row -->

    <!-- Advance Table Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-box">
                <div class="datatables-example-heading">
                </div>
                <div class="table-responsive advance-table">
                    <table class="table display table-bordered devis_table_index">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Description</th>
                                <th>Quantites</th>
                                <th>Prix_ht</th>
                                <th>TVA</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($oemparametres as $oemparametre)
                                <tr>

                                    <td>{{ $oemparametre->produit }}</td>
                                    <td>{{ $oemparametre->description }}</td>
                                    <td>{{ $oemparametre->quantites }}</td>
                                    <td>{{ sprintf('%.3f', $oemparametre->prix_ht) }}</td>
                                    <td>{{ sprintf('%.3f', $oemparametre->tva) }}%</td>
                                    <td style="text-align:left">
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">

                                                    <a href="#" data-toggle="modal" data-target="#update_oemparametre"
                                                        class="update_button" data-id="{{ $oemparametre->id }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- UpdateModal -->
    <div class="modal fade" id="update_oemparametre" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Modifier la paramétre</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>

                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Produit</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="produit_update">
                                <input type="hidden" class="form-control" id="oemparametre_id">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Prix_ht</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="prix_ht_update">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Taxes</label>
                            <div class="col-md-8">
                                <select id='tva_update'class='form-control opp-class' style='margin-top:5px'>
                                    @foreach ($taxes as $taxe)
                                        <option value='{{ $taxe->pourcentage }}' style='float:left'>
                                            {{ $taxe->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="description_update">
                                </textarea>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="submit_update"
                            onclick="update_oemparametre()">Modifier</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<script scr="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
<script>
    $(document).ready(function() {

        $('.update_button').click(function() {
            var id = $(this).data('id');
            $('#oemparametre_id').val(id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/oneoemparametren') }}/" + id,
                method: 'get',
                success: function(result) {
                    console.log(result)
                    $('#produit_update').val(result.produit)
                    $('#description_update').val(result.description)
                    $('#prix_ht_update').val(result.prix_ht)
                    $("#tva_update option[value=" + result.tva + "]").prop('selected',
                        true);
                }
            });

        });
    });


    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }





    function update_oemparametre() {
        $('#submit_update').attr('disabled', 'disabled');
        $('.erreur').empty()
        let produit = $('#produit_update').val()
        let description = $('#description_update').val()
        let prix_ht = $('#prix_ht_update').val()
        let tva = $("#tva_update").val()
        let oemparametre_id = $("#oemparametre_id").val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/updateoemparametre') }}/" + oemparametre_id,
            method: 'post',
            data: {
                produit: produit,
                description: description,
                prix_ht: prix_ht,
                tva: tva,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {

                    $('#submit_update').removeAttr('disabled');

                    if (result.error.produit) {
                        error_message(result.error.produit[0], "#produit_update")
                    }
                    if (result.error.description) {
                        error_message(result.error.description[0], "#description_update")
                    }
                    if (result.error.prix_ht) {
                        error_message(result.error.prix_ht[0], "#prix_ht_update")
                    }
                    if (result.error.tva) {
                        error_message(result.error.tva[0], "#tva_update")
                    }


                } else if (result == 200) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'parametre modifié avecc succéss',
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
</script>
