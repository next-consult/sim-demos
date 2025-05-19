@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Entrée de Stock</h1>

    <p>Date d'aujourd'hui : <strong>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</strong></p>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('update.stock') }}" method="POST" style="width: 90%;" id="stock-form">
        @csrf
        <div id="stock-entries">
            <div class="stock-entry">
                <div class="form-group col-md-3">
                    <label for="idcategorie">Catégorie</label>
                    <select name="idcategorie[]" class="form-control" onchange="toggleLicenseFields(this); updateCatalogueOptions(this);" required>
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $category)
                            @if($category->id == 1 || $category->id == 3)
                                <option value="{{ $category->id }}">{{ $category->nom }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>


                <style>.select2-container--default .select2-selection--single {
                    background-color: #fff;
                    border: 1px solid #aaa;
                    border-radius: 4px;
                    height: 40px !important;
                }</style>

            <div class="form-group col-md-3">
                <label for="catalogue_id">Produit</label>
                <select name="catalogue_id[]" class="form-control" required>
                    <option value="">Sélectionner un catalogue</option>
                </select>
            </div>

                {{-- <div class="form-group">
                    <label for="nom">Nom du produit</label>
                    <input type="text" name="nom[]" class="form-control" >
                </div> --}}

                <div class="form-group col-md-3">
                    <label for="qte">Quantité</label>
                    <input type="number" name="qte[]" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="emplacement_id">Emplacement:</label>
                    <select name="emplacement_id[]" class="form-control" required>
                        <option value="">Select Emplacement</option>
                        @foreach($emplacements as $emplacement)
                            <option value="{{ $emplacement->id }}">{{ $emplacement->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="license-fields" style="display: none;">
                    <div class="form-group col-md-3">
                        <label for="code">Code</label>
                        <input type="text" name="code[]" class="form-control" >
                    </div>
                    <div class="form-group col-md-3">
                        <label for="date_start">Date de début</label>
                        <input type="date" name="date_start[]" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="date_expiration">Date d'expiration</label>
                        <input type="date" name="date_expiration[]" class="form-control">
                    </div>
                </div>
                <hr>
            </div>
        </div>

    
        <button type="button" class="btn btn-warning" onclick="addStockEntry()">Ajouter un autre produit</button>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</div>

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function toggleLicenseFields(selectElement) {
        const categorySelect = selectElement;
        const stockEntry = categorySelect.closest('.stock-entry');
        const licenseFields = stockEntry.querySelector('.license-fields');
        const catalogueSelect = stockEntry.querySelector('select[name="catalogue_id[]"]');
        const selectedValue = categorySelect.value;

        // Réinitialiser et filtrer les catalogues
        catalogueSelect.querySelectorAll('option').forEach(option => {
            if (option.value === '') {
                option.style.display = 'block'; // Toujours afficher l'option par défaut
            } else {
                const categoryId = option.getAttribute('data-category');
                option.style.display = categoryId === selectedValue ? 'block' : 'none';
            }
        });

        // Réinitialiser la sélection du catalogue
        catalogueSelect.value = '';

        // Afficher/masquer les champs de licence
        licenseFields.style.display = selectedValue === '1' ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        function updateCatalogueOptions(categorySelect) {
            const categoryId = categorySelect.value;
            console.log('Catégorie sélectionnée:', categoryId);
            
            const stockEntry = categorySelect.closest('.stock-entry');
            const catalogueSelect = stockEntry.querySelector('select[name="catalogue_id[]"]');

            // Réinitialiser les options du catalogue
            catalogueSelect.innerHTML = '<option value="">Sélectionner un catalogue</option>';

            if (categoryId) {
                console.log('Envoi requête pour catégorie:', categoryId);
                
                // Utilisation de fetch pour la requête AJAX
                fetch(`/api/catalogues-by-category/${categoryId}`)
                    .then(response => {
                        console.log('Réponse reçue:', response);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Données reçues:', data);
                        if (Array.isArray(data)) {
                            data.forEach(catalogue => {
                                console.log('Ajout produit:', catalogue);
                                const option = document.createElement('option');
                                option.value = catalogue.id;
                                option.textContent = catalogue.produit;
                                catalogueSelect.appendChild(option);
                            });
                        } else {
                            console.error('Les données reçues ne sont pas un tableau:', data);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la requête:', error);
                    });
            } else {
                console.log('Aucune catégorie sélectionnée');
            }
        }

        // Rendre la fonction disponible globalement
        window.updateCatalogueOptions = updateCatalogueOptions;
    });

    function addStockEntry() {
        const stockEntries = document.getElementById('stock-entries');
        const newEntry = document.createElement('div');
        newEntry.classList.add('stock-entry');
        newEntry.innerHTML = `
            <div class="d-flex flex-wrap" >
                <div class="form-group col-md-3" >
                    <label for="idcategorie">Catégorie</label>
                    <select name="idcategorie[]" class="form-control" onchange="toggleLicenseFields(this); updateCatalogueOptions(this);" required>
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $category)
                            @if($category->id == 1 || $category->id == 3)
                                <option value="{{ $category->id }}">{{ $category->nom }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="catalogue_id">Produit</label>
                    <select name="catalogue_id[]" class="form-control" required>
                        <option value="">Sélectionner un catalogue</option>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="qte">Quantité</label>
                    <input type="number" name="qte[]" class="form-control" required>
                </div>

                <div class="form-group col-md-3">
                    <label for="emplacement_id">Emplacement:</label>
                    <select name="emplacement_id[]" class="form-control" required>
                        <option value="">Select Emplacement</option>
                        @foreach($emplacements as $emplacement)
                            <option value="{{ $emplacement->id }}">{{ $emplacement->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.stock-entry').remove()" style="margin-top: 35px;">X</button>
                </div>

                <div class="license-fields w-100" style="display: none;">
                    <div class="form-group col-md-3">
                        <label for="code">Code</label>
                        <input type="text" name="code[]" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="date_start">Date de début</label>
                        <input type="date" name="date_start[]" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="date_expiration">Date d'expiration</label>
                        <input type="date" name="date_expiration[]" class="form-control">
                    </div>
                </div>
            </div>
            <hr>
        `;
        stockEntries.appendChild(newEntry);
    }
</script>
@endsection
@endsection




