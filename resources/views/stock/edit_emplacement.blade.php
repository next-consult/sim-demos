<!-- resources/views/stock/edit_emplacement.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier Emplacement</h1>
    <p>Date d'aujourd'hui : <strong>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</strong></p>
    <br>
    <form action="{{ route('stock.update.emplacement', $emplacement->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ $emplacement->nom }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" class="form-control" value="{{ $emplacement->description }}"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Mettre à jour</button>
    </form>
</div>
@endsection
