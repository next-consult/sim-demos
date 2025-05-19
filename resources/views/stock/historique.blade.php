@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Historique des Stocks</h1>

    <div class="mb-4">
        <a href="{{ route('stock.entree') }}" class="btn btn-primary btn-lg">Entrée Stock</a>
        <a href="{{ route('stock.sortie') }}" class="btn btn-warning btn-lg">Sortie Stock</a>
        <a href="{{ route('stock.index') }}" class="btn btn-secondary btn-lg">Gestion des Stocks</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Historique des Entrées et Sorties de Stock
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th> <!-- Entry or Exit -->
                        <th>Catégorie</th>
                        <th>Nom</th>
                        <th>Date</th>
                        <th>Quantité</th>
                        <th>Emplacement</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historique as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->type }}</td> <!-- Should reflect entry/exit -->
                            <td>{{ $record->category->nom ?? 'N/A' }}</td>
                            <td>{{ $record->nom }}</td>
                            <td>{{ \Carbon\Carbon::parse($record->date)->format('d/m/Y') }}</td>
                            <td>{{ $record->qte }}</td>
                            <td>
                                @php
                                    $emplacement = $emplacements->firstWhere('id', $record->emplacement_id);
                                @endphp
                                {{ $emplacement ? $emplacement->nom : 'Non défini' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
