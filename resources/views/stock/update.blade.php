@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier le Stock</h1>

    <form action="{{ route('stock.update', $stock->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Champ Nom du Stock -->
        <div class="form-group mb-3">
            <label for="nom" class="form-label">Nom du Stock</label>
            <input type="text" name="nom" class="form-control" value="{{ $stock->nom }}" required>
        </div>

        <!-- Champ Quantité -->
        <div class="form-group mb-3">
            <label for="qte" class="form-label">Quantité</label>
            <input type="number" name="qte" class="form-control" value="{{ $stock->qte }}" required>
        </div>

        <!-- Champ Emplacement -->
        <div class="form-group mb-4">
            <label for="emplacement_id" class="form-label">Emplacement</label>
            <select name="emplacement_id" class="form-control custom-select" required>
                <option value="" disabled>Sélectionner un emplacement</option>
                @foreach ($emplacements as $emplacement)
                    <option value="{{ $emplacement->id }}" {{ $stock->emplacement_id == $emplacement->id ? 'selected' : '' }}>
                        {{ $emplacement->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Champ Code -->
        <div class="form-group mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" name="code" class="form-control" value="{{ $stock->code }}" required>
        </div>

        <!-- Champ Date de Début (pour catégorie 1) -->
        @if ($stock->idcategorie == 1)
        <div class="form-group mb-3">
            <label for="date_start" class="form-label">Date de Début</label>
            <input type="date" name="date_start" class="form-control" value="{{ $stock->date_start }}" required>
        </div>

        <!-- Champ Date d'Expiration (pour catégorie 1) -->
        <div class="form-group mb-3">
            <label for="date_expiration" class="form-label">Date d'Expiration</label>
            <input type="date" name="date_expiration" class="form-control" value="{{ $stock->date_expiration }}" required>
        </div>
        @endif

        <!-- Bouton Mettre à jour -->
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>

@endsection
