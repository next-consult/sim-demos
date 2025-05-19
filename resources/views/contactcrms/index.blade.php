@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb-area">
                <div class="row">
                    <div class="col-md-6">
                        <div class="breadcrumb-left">
                            <h3>Leads</h3>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="breadcrumb-right">
                            <a href="{{ route('crm.add.contact') }}">
                                <button class="btn btn-primary">Ajouter un contact</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="breadcrumb-right">
                            <a href="{{ route('crm.download') }}">
                                <button class="btn btn-info">Exemple fichier</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="breadcrumb-right">
                            <a data-toggle="modal" data-target="#import">
                                <button class="btn btn-success float-right">Import</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Row -->

    <!-- Advance Table Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-box">
                <div class="datatables-example-heading"></div>
                <div class="table-responsive advance-table">
                    <table class="table display table-bordered devis_table_index">
                        <thead>
                            <tr>
                                <th>R/S</th>
                                <th>Nom et prénom</th>
                                <th>Poste</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Mobile</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contactcrms as $contact)
                                <tr>
                                    <td>{{ $contact->raison_social }}</td>
                                    <td>{{ $contact->nom }} {{ $contact->prenom }}</td>
                                    <td>{{ $contact->poste }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->telephone }}</td>
                                    <td>{{ $contact->mobile }}</td>
                                    <td style="text-align:left">
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">
                                                    <a href="#" data-toggle="modal" data-target="#opportunite"
                                                        class="add-opp" data-id="{{ $contact->id }}">
                                                        <li class="list-group-item"><i class="fa fa-check"
                                                                style="margin-right:5px"></i> Créer une opportunité </li>
                                                    </a>
                                                    <a href="{{ route('crm.update_contactcrm', ['id' => $contact->id]) }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="list-group-item delete-li" style="cursor:pointer"
                                                            onclick="deletecontact({{ $contact->id }})"><i
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
    <!-- End Advance Table Row -->

    <!-- Modal Opportunité -->
    <div class="modal fade" id="opportunite" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Ajouter une opportunité</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="create_opp">
                    <div class="modal-body">
                        <input type="hidden" id="contact_id" value="">
                        <div class="form-group row">
                            <label for="date_deal" class="col-md-4 col-form-label">Date Deal</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" name="date_deal" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="revenu" class="col-md-4 col-form-label">Revenue éspéré</label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" name="revenu" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type_projet" class="col-md-4 col-form-label">Segments</label>
                            <div class="col-md-8">
                                <select class="js-example-basic-single js-states form-control" id="type_projet">
                                    <option value="Big deal">Big deal</option>
                                    <option value="Medium deal">Medium deal</option>
                                    <option value="Small deal">Small deal</option>
                                    <option value="Non qualifié">Non qualifié</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rating_value" class="col-md-4 col-form-label">Rating</label>
                            <div class="col-md-8">
                                <div class="rating">
                                    <input type="hidden" id="rating_value" name="rating" value="0">
                                    <span class="star" id="star1" data-value="1"></span>
                                    <span class="star" id="star2" data-value="2"></span>
                                    <span class="star" id="star3" data-value="3"></span>
                                    <span class="star" id="star4" data-value="4"></span>
                                    <span class="star" id="star5" data-value="5"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
                        <button class="btn btn-primary" id="submit_taxe">Ajouter</button>
                    </div>-->
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Opportunité -->

    <!-- Modal Import -->
    <div class="modal fade" id="import" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Import</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               <form id="import_contact" action="{{ route('crm.store.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group row">
            <label for="file" class="col-md-4 col-form-label">Fichier</label>
            <div class="col-md-8">
                <input type="file" class="form-control" name="file" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Annuler</button>
        <button class="btn btn-primary" id="submit_taxe">Import</button>
    </div>
</form>

            </div>
        </div>
    </div>
    <!-- End Modal Import -->
@endsection

<!-- jQuery and other JS scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<script>
    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    $(document).ready(function() {
        $('.star').click(function() {
            var value = $(this).attr('data-value');
            var count_actives = $('.star.active').length;

            $('#rating_value').val(value);
            $('.star').removeClass('active');

            for (var i = 1; i <= value; i++) {
                $('#star' + i).addClass('active');
            }
        });

        $(document).on('click', '.add-opp', function() {
            var id = $(this).attr("data-id");
            $('#contact_id').val(id);
        });

        function deletecontact(id) {
            Swal.fire({
                title: 'Voulez-vous vraiment supprimer?',
                showCancelButton: true,
                confirmButtonText: 'Supprimer',
                cancelButtonText: `Annuler`,
                icon: 'warning'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: '/crm/delete_contactcrm/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": 'DELETE',
                            id: id
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Supprimé",
                                text: "Contact supprimé avec succès",
                                icon: 'success',
                                confirmButtonText: "OK",
                            }).then(function() {
                                window.location.reload();
                            });
                        }
                    });
                }
            });
        }
    });
</script>
