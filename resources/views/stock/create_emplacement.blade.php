<!-- resources/views/stock/create_emplacement.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un Nouvel Emplacement</h1>
    <p>Date d'aujourd'hui : <strong>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</strong></p>
    <br>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stock.store.emplacement') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Ajouter</button>
    </form>
</div>
@endsection
