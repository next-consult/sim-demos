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
                                <th>Action</th>
                            </tr>
                        </thead>
                       <tbody>
                            @foreach ($conges as $conge)
                                
                                <tr class="conge-row" data-status="{{ $conge->status }}">
                                    <td><b>{{ $conge->user->name ?? null}}</b></td>
                                    <td><b>{{ ucfirst(trans($conge->type)) }}</b></td>
                                    <td><b>{{ $conge->raison }}</b></td>
                                    <td>
    @if ($conge->dure == 'one_journe' || $conge->dure == 'heures')
        {{ \Carbon\Carbon::parse($conge->date_jour)->format('Y-m-d') }}
    @else
        {{ \Carbon\Carbon::parse($conge->date_debut)->format('Y-m-d') }} à {{ \Carbon\Carbon::parse($conge->date_fin)->format('Y-m-d') }}
    @endif
</td>

                                    <td>{{ $conge->nb_jours }} Jours ({{ $conge->nb_heures }} heures )</td>
                                    <td>
                                        @if ($conge->status == 'en_attente')
                                            <span class="badge badge-info"> En attente</span>
                                        @elseif($conge->status == 'accepte')
                                            <span class="badge badge-success">Accepté</span>
                                        @elseif($conge->status == 'valide')
                                        <span class="badge badge-warning">validé</span>
                                        @elseif($conge->status == 'refuse')
                                            <span class="badge badge-danger" style="background-color: red">Refusé</span>
                                        @elseif($conge->status == 'annuler')
                                            <span class="badge badge-danger">Annulé</span>
                                        @endif
                                    </td>
                                    <td style="text-align:left">
                                            <div class="dropdown">
                                                <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    style="margin-left:20px">
                                                    Options <i class="fa-solid fa-circle-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                    <ul class="list-group">
                                                        @if($conge->user)
    @if($conge->user->role_id == 7)
                                                            @if(auth()->user()->email == "a.ochi@next.tn" && $conge->status == 'en_attente')
                                                                <a href="#" onclick="change_status('accepte', {{ $conge->id }})">
                                                                    <li class="list-group-item" style="cursor:pointer">
                                                                        <i class="fa fa-check" style="margin-right:5px"></i>
                                                                        Accepter
                                                                    </li>
                                                                </a>
                                                                <a href="#" onclick="change_status('refuse', {{ $conge->id }})">
                                                                    <li class="list-group-item" style="cursor:pointer">
                                                                        <i class="fa-solid fa-times" style="margin-right:5px"></i>
                                                                        Refuser
                                                                    </li>
                                                                </a>
                                                            @endif
                                                        @else
                                                            @if(auth()->user()->email == "timoumi.nesrine11@gmail.com" && $conge->validation_level == 'niveau1' && $conge->status == 'en_attente')
                                                                <a href="#" onclick="change_status('valide', {{ $conge->id }})">
                                                                    <li class="list-group-item" style="cursor:pointer">
                                                                        <i class="fa fa-check" style="margin-right:5px"></i>
                                                                        Accepter
                                                                    </li>
                                                                </a>
                                                                <a href="#" onclick="change_status('refuse', {{ $conge->id }})">
                                                                    <li class="list-group-item" style="cursor:pointer">
                                                                        <i class="fa-solid fa-times" style="margin-right:5px"></i>
                                                                        Refuser
                                                                    </li>
                                                                </a>
                                                            @elseif(auth()->user()->email == "s.slimani@next.tn" && (($conge->validation_level == 'niveau2' && $conge->status == 'valide') || ($conge->validation_level == 'niveau2' && $conge->user->role_id == 3)))
                                                                <a href="#" onclick="change_status('accepte', {{ $conge->id }})">
                                                                    <li class="list-group-item" style="cursor:pointer">
                                                                        <i class="fa fa-check" style="margin-right:5px"></i>
                                                                        Accepter
                                                                    </li>
                                                                </a>
                                                                <a href="#" onclick="change_status('refuse', {{ $conge->id }})">
                                                                    <li class="list-group-item" style="cursor:pointer">
                                                                        <i class="fa-solid fa-times" style="margin-right:5px"></i>
                                                                        Refuser
                                                                    </li>
                                                                </a>
                                                            @endif
                                                        @endif
                                                        
                                                        @if(auth()->user()->role_id == 1)
                                                            <a href="#" onclick="change_status('annuler', {{ $conge->id }})">
                                                                <li class="list-group-item" style="cursor:pointer">
                                                                    <i class="fa-solid fa-rotate-right" style="margin-right:5px;"></i> 
                                                                    Annuler
                                                                </li>
                                                            </a>
                                                        @endif
														@else
    <td colspan="7">Utilisateur non trouvé</td>
@endif
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }

    function change_status(status, id) {
        // Si c'est l'utilisateur avec ID=20
        @if(auth()->id() == 20)
            if (status === 'accepte') {
                $.ajax({
                    url: `/conges/${id}/validate-first`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        action: 'valider'
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        console.error('Erreur:', xhr);
                        alert('Une erreur est survenue');
                    }
                });
            } else if (status === 'refuse') {
                $.ajax({
                    url: `/conges/${id}/validate-first`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        action: 'refuser'
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        }
                    }
                });
            }
        @else
            // Ancien comportement pour les autres utilisateurs
            $.ajax({
                url: "{{ route('conges.change_status') }}",
                type: 'POST',
                data: {
                    id: id,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                }
            });
        @endif
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
