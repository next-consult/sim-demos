@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des produits</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <a href="{{ route('catalogues.add') }}">

                                <button class="btn btn-primary float-right">Ajouter un
                                    produit</button>

                            </a>


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
                <div class="table-responsive ">
                    <table class="table display table-bordered client_table_index">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Produit</th>
                                <th>Categorie</th>
                                <th>Prix HT</th>
                                <th>Fournisseur</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catalogues as $catalogue)
                                <tr>
                                    <td><a href="{{ route('catalogues.update', ['id' => $catalogue->id]) }}"
                                            style="text-decoration: underline;" class="text-success"><b>
                                                {{ $catalogue->numero }}</b> </a> </td>

                                    <td>{{ $catalogue->produit }}</td>
                                    <td>{{ $catalogue->categorieName ?? 'N/A' }}</td>

                                    <td>{{ $catalogue->prix_ht }} TND</td>

                                    <td><b>{{ $catalogue->fournisseur->nom }}</b></td>
                                    <td style="text-align:left">
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">
                                                    <a href="{{ route('catalogues.update', ['id' => $catalogue->id]) }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    <a href="#" onclick="deletecatalogue({{ $catalogue->id }})">
                                                        <li class="list-group-item" style="cursor:pointer" onclick="#"><i
                                                                class="fa-solid fa-trash"
                                                                style="margin-right:5px;"></i>Supprimer</li>
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
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<script scr="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>

<script>
    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    function add_dossier() {
        $('#submit_dossier').attr('disabled', 'disabled');
        $('.erreur').empty()
        var entreprise_id = jQuery('#entreprise_id').val()
        var client_id = jQuery('#client_id').val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/adddossiers') }}",
            method: 'post',
            data: {
                entreprise_id: entreprise_id,
                client_id: client_id,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.error) {

                    $('#submit_dossier').removeAttr('disabled');

                    if (result.error.entreprise_id) {
                        error_message(result.error.entreprise_id[0], "#entreprise_id")
                    }
                    if (result.error.client_id) {
                        error_message(result.error.client_id[0], "#client_id")
                    }

                } else if (result.success_id) {
                    window.location.href = `updatedossiers/${result.success_id}`;

                }


            }
        });



    }
</script>
