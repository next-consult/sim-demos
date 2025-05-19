@extends('layouts.newapp')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left h-100">
                            <h3>Liste des interventions</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <a href="{{ route('interventions.create') }}">
                                <button class="btn btn-primary float-right">Ajouter une intervention</button>
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
                <div class="table-responsive advance-table">
                    <table id="responsive_datatables_example" class="table display table-bordered">
                        <thead>
                            <tr>
                                <th>Numero </th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>intervention</th>
                                <th>Intervenant</th>
                                <th>Recurrence</th>
                                <th>Debut</th>
                                <th>Fin</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($interventions->groupBy('numero') as $numero => $interventionGroup)
                            @php
                                $firstIntervention = $interventionGroup->first();
                                // Define background color based on status and date proximity
                                $bgColor = '';
                                $today = \Carbon\Carbon::now();
                                $startDate = \Carbon\Carbon::parse($firstIntervention->date);
                                $daysDifference = $startDate->diffInDays($today, false);

                                // Apply color logic for status
                                if ($firstIntervention->status == 'En attente') {
                                    $bgColor = '';
                                } elseif ($firstIntervention->status == 'Démarré') {
                                    $bgColor = 'lightgreen';
                                } elseif ($firstIntervention->status == 'Complété') {
                                    $bgColor = 'lightcoral';
                                }

                                // Apply color degradation logic for upcoming firstInterventions
                                if ($daysDifference <= 3 && $daysDifference >= 0 && $firstIntervention->status == 'En attente') {
                                    $bgColor = 'lightyellow'; // Interventions within 3 days
                                }
                            @endphp
                            <tr>

                                    <td>
                                        <a href="#" target="_blank" style="text-decoration: underline;" class="text-success">
                                            <b>{{ $firstIntervention->numero }}</b>
                                        </a>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($firstIntervention->date)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('clients.show', ['id' => $firstIntervention->client->id]) }}" target="_blank" style="text-decoration: underline;" class="text-primary">
                                            <b>{{ $firstIntervention->client->nom }}</b>
                                        </a>
                                    </td>
                                    <td>{{ $firstIntervention->entreprise->nom }}</td>


                                    <td>
                                        @foreach($interventionGroup as $intervention)
                                        @foreach($intervention->intervenants as $intervenan)
                                            {{ \App\Models\User::find($intervenan->id)->name }}@if(!$loop->last), @endif
                                            @endforeach
                                        @endforeach
                                    </td>




                                    <td>
                                        @switch($firstIntervention->repeat_type)
                                            @case('')
                                                -
                                                @break
                                            @case('oneshot')
                                                Une fois
                                                @break

                                            @case('daily')
                                                Journalier
                                                @break

                                            @case('weekly')
                                                Hebdomadaire
                                                @break

                                            @case('monthly')
                                                Mensuel
                                                @break

                                            {{-- @case('yearly')
                                                annuel
                                                @break --}}
                                        @endswitch
                                    </td>
                                    @if($firstIntervention->datedebut)
                                        <td>{{\Carbon\Carbon::parse($firstIntervention->datedebut)->format('d/m/Y') }}</td>
                                    @else
                                        <td style="text-align:center">-</td>
                                    @endif
                                    @if($firstIntervention->datedebut)
                                        <td>{{ \Carbon\Carbon::parse($firstIntervention->datefin)->format('d/m/Y') }}</td>
                                    @else
                                        <td style="text-align:center">-</td>
                                    @endif
                                    <td style="background-color: {{ $bgColor }};">{{ $firstIntervention->status }}</td>
                                    <td style="text-align:left">
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">
                                                    <a
                                                        href="{{ route('interventions.print', ['id' => $intervention->id]) }}">
                                                        <li class="list-group-item"><i class="fa fa-file"
                                                                style="margin-right:5px"></i> PDF </li>
                                                    </a>
                                                    <a
                                                        href="{{ route('interventions.edit', ['id' => $intervention->id]) }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    <a href="#"
                                                        onclick="deleteintervention({{ $firstIntervention->id }})">
                                                        <li class="list-group-item" style="cursor:pointer">
                                                            <i class="fa-solid fa-trash" style="margin-right:5px;"></i> Supprimer
                                                        </li>
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

@section('scripts')
<script>
    let interventions = @json($interventions);

    interventions.forEach(function(intervention) {
        if (intervention.intervenant) {
            console.log('Intervenant Name:', intervention.intervenant.name);
        } else {
            console.log('Intervenant Name: N/A');
        }
    });
</script>
@endsection