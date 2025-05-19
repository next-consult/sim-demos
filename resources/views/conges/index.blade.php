@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des demandes de congé</h3>
                            @php
                                $current_year = date('Y');
                                $user = auth()->user();
                            @endphp
                            <h5 style="margin-top:8px">
                                Solde de congé restant pour {{ $current_year }}:
                                <b>
                                    @php
                                        $jours = floor($user->solde_conge);
                                        $heures = round(($user->solde_conge - $jours) * 8);
                                    @endphp
                                    {{ $jours }} Jour(s) et
                                    @if ($heures > 0)
                                        {{ $heures }} Heure(s)
                                    @endif
                                </b>
                            </h5>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <a href="{{ route('conges.add') }}">
                                <button class="btn btn-primary float-right">Ajouter une
                                    demande</button>
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
                                <th>Utilisateur</th>
                                <th>Type de congé</th>
								<th>Raison</th>
                                <th>Date</th>
                                <th>Durée</th>
                                <th>Status</th>
@if(auth()->user()->role_id == 1)
  <th>Action</th>@endif

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($conges as $conge)
                                <tr>
                                    <td><b>{{ $conge->user->name }}</b></td>
                                    <td><b>{{ ucfirst(trans($conge->type)) }}</b></td>
									<td><b>{{ $conge->raison }}</b></td>
                                    <td>
                                        @if ($conge->dure == 'one_journe' || $conge->dure == 'heures')
                                            {{ $conge->date_jour }}
                                        @else
                                            {{ date('Y-m-d', strtotime($conge->date_debut)) }} à
                                            {{ date('Y-m-d', strtotime($conge->date_fin)) }}
                                        @endif
                                    </td>
                                    <td>{{ $conge->nb_jours }} Jours ({{ $conge->nb_heures }} heures )</td>
                                    <td>
                                        @if ($conge->status == 'en_attente')
                                            <span class="badge badge-info"> En attente</span>
                                        @elseif($conge->status == 'accepte')
                                            <span class="badge badge-success">Accepté</span>
                                        @elseif($conge->status == 'refuse')
                                            <span class="badge badge-warning">Refusé</span>
                                        @elseif($conge->status == 'annuler')
                                            <span class="badge badge-danger">Annulé</span>
                                        @endif
                                    </td>
@if(auth()->user()->role_id == 1)
  <td style="text-align:left">
                                        @if ($conge->status == 'en_attente')
                                            <div class="dropdown">
                                                <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    style="margin-left:20px">
                                                    Options <i class="fa-solid fa-circle-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                    <ul class="list-group">
                                                        <a href="#"
                                                            onclick="change_status('accepte', {{ $conge->id }})">
                                                            <li class="list-group-item" style="cursor:pointer">
                                                                <i class="fa fa-check" style="margin-right:5px"></i>
                                                                Accepter
                                                            </li>
                                                        </a>
                                                        <a href="#"
                                                            onclick="change_status('refuse', {{ $conge->id }})">
                                                            <li class="list-group-item" style="cursor:pointer">
                                                                <i class="fa-solid fa-times" style="margin-right:5px"></i>
                                                                Refuser
                                                            </li>
                                                        </a>
                                                        <a href="#"
                                                            onclick="change_status('annuler', {{ $conge->id }})">
                                                            <li class="list-group-item" style="cursor:pointer">
                                                                <i class="fa-solid fa-rotate-right"
                                                                    style="margin-right:5px;"></i> Annuler
                                                            </li>
                                                        </a>

                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    </td>@endif

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

    function change_status(status, congeId) {

        fetch(`/change_status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    id: congeId,
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'Le statut du congé a été mis à jour avec succès.'
                    }).then(() => {
                        location.reload(); // Refresh the page or update the UI as needed
                    });
                } else if (data.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: data.error
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Une erreur est survenue lors de la mise à jour du statut.'
                });
            });
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
