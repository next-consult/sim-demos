@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des utilisateurs</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="seipkon-breadcromb-right">
                            <a href="{{ route('users.add') }}">
                                <button class="btn btn-primary float-right">Ajouter un utilisateur</button>
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
                <?php
                $current_year = Date('Y');
                $parametre = App\Models\Parametre::first();

                ?>
                <div class="table-responsive advance-table">
                    <table id="responsive_datatables_example" class="table display table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom </th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Solde Congés ({{ $current_year }})</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td> <img src="{{ asset('assets/img') . '/' . $user->photo }}" class="profile-avator"
                                            alt="admin profile" /></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->telephone }}</td>
                                    <td>

                                        {{ $user->solde_conge }}</td>
                                    <td>
                                        <a href="{{ route('roles.update', ['id' => $user->role->id]) }}" target="_blank"
                                            style="text-decoration: underline;"
                                            class="text-success"><b>{{ $user->role->nom }}</b> </a>
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

                                                    <a href="{{ route('users.update', ['id' => $user->id]) }}">
                                                        <li class="list-group-item"><i class="fa fa-pen"
                                                                style="margin-right:5px"></i> Modifier </li>
                                                    </a>
                                                    @if ($user->type == 'user')
                                                        <a href="#">
                                                            <li class="list-group-item" style="cursor:pointer"
                                                                onclick="deleteuser({{ $user->id }})"><i
                                                                    class="fa-solid fa-trash"
                                                                    style="margin-right:5px;"></i>Supprimer</li>
                                                        </a>
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

<script></script>
