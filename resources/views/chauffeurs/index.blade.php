@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des chauffeurs</h3>
                        </div>
                    </div>
                    <div class="col-md-2 ">

                        <select class="form-control status-dropdown">
                            <option value="">Tous</option>
                            <option value="interne">interne</option>
                            <option value="Sous-traitant">Sous-traitant</option>
                        

                        </select>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <a href="{{ route('chauffeurs.add') }}">
                                <button class="btn btn-primary float-right">Ajouter un chauffeur</button>
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
                    <table  id="chauffeur_table_index" class="table display table-bordered ">
                        <thead>
                            <tr>
                                <th>Nom </th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chauffeurs as $chauffeur)
                                <tr>
                                    <td>{{ $chauffeur->nom }} {{ $chauffeur->prenom }}</td>
                                    <td>{{ $chauffeur->email }}</td>
                                    <td>{{ $chauffeur->telephone }}</td>
                                    <td>
                                        @if ($chauffeur->type_chauffeur == 'interne')
                                            <span class="badge badge-success">{{ $chauffeur->type_chauffeur }}</span>
                                        @elseif($chauffeur->type_chauffeur == 'externe')
                                            <span class="badge badge-info">Sous-traitant</span>
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

                                                    <a href="{{ route('chauffeurs.update', ['id' => $chauffeur->id]) }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="list-group-item" style="cursor:pointer"><i
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

<script></script>
