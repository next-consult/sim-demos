@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des groupes</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <a href="{{ route('groupe.add') }}">
                                <button class="btn btn-primary float-right">Ajouter le groupe</button>
                            </a>

                            <!-- Modal -->
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
                    <table class="table display nowrap table-bordered devis_table_index">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Format</th>
                                <th>Nombre prochain</th>
                                <th>Le pavé gauche</th>
                                <th>Numéro réinitialisé</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupes as $groupe)
                                <tr>

                                    <td>{{ $groupe->nom }}</td>
                                    <td>{{ $groupe->format }} @foreach ($groupe->elements as $element ) { {{$element->nom}} }  @endforeach</td>
                                    <td>{{ $groupe->nb_prochain }}</td>
                                    <td>{{ $groupe->nb_left }}</td>
                                    <td>{{ $groupe->renist }}</td>

                                    <td style="text-align:left">
                                        <div class="dropdown">
                                            <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                style="margin-left:20px">
                                                Options <i class="fa-solid fa-circle-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                <ul class="list-group">

                                                    <a href="{{route('groupe.update',['id'=>$groupe->id])}}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="list-group-item" style="cursor:pointer"
                                                            onclick="deletegroupe({{ $groupe->id }})"><i
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
