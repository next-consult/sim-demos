<!-- resources/views/stock/emplacements.blade.php -->

@extends('layouts.app')

@section('content')
  <!-- Breadcromb Row Start -->
  <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-8">
                        <div class="seipkon-breadcromb-left">
                            <h3>Liste des Emplacements</h3>
                        </div>
                    </div>

                    <div class="col-md-4 ">
                        <div class="seipkon-breadcromb-right">
                            <!-- Button trigger modal -->
                            <a href="{{ route('stock.create.emplacement') }}" class="btn btn-primary">Ajouter Emplacement</a>


                        
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Breadcromb Row -->


  
    <!-- Vérifie si la collection $emplacements n'est pas vide -->
    @if($emplacements->isEmpty())
        <p>Aucun emplacement disponible.</p>
    @else
    <div class="row">
        <div class="col-md-12"> 
            <div class="page-box">
                <div class="datatables-example-heading">
                </div>
            <div class="table-responsive ">
            <table class="table display nowrap table-bordered facture_table_index">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Actions</th> <!-- Add a column for actions -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($emplacements as $emplacement)
                        <tr>
                            <td>{{ $emplacement->id }}</td>
                            <td>{{ $emplacement->nom }}</td>
                            <td>{{ $emplacement->description }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('stock.edit.emplacement', $emplacement->id) }}" class="btn btn-warning">Modifier</a>
                                <!-- Delete Button -->
                                <form action="{{ route('stock.delete.emplacement', $emplacement->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            </div>
        </div>
    </div>
    @endif

@endsection
