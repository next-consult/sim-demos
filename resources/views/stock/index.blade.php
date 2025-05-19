@extends('layouts.app')

@section('content')
<div class="container mb-6">
    <h1 class="mb-4">Gestion des Stocks</h1>

    <!-- Ajout des boutons radio pour le filtre dans un cadre -->
    <div class="d-flex flex-wrap justify-content-start mb-4" style="gap: 10px;     margin-bottom: 52px;">
        <a href="{{ route('stock.entree') }}" class="btn btn-primary btn-lg me-3" style="width: 180px">Entrée Stock</a>

        <a href="{{ route('stock.sortie') }}" class="btn btn-warning btn-lg me-3" style="width: 180px">Sortie Stock</a>

        <button type="button" class="btn btn-primary btn-lg me-3" style="width: 180px" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>

        <button type="button" class="btn btn-success btn-lg" style="width: 180px" data-bs-toggle="modal" data-bs-target="#structureModal">Structure</button>
    </div>
</div>

<!-- Espacement entre les boutons et le filtre -->
<div class="my-4"></div>
<div class="card p-3 mb-4 rounded border border-dark" style="">
    <div class="card-body ">
        <h5 class="card-title" style="    margin-bottom: -25px;
        margin-left: 42px;
    font-size: 24px;">Filtrer par catégorie :</h5>
        <div class="mb-4 d-flex justify-content-center" style="    padding: 3%;
    margin-right: 5%;
    font-size: large;">
            <label class="me-4" style="    margin-right: 21px;">
                <input type="radio" name="categoryFilter" value="tous" onclick="filterStocks('tous')" checked class="form-check-input">
                <span class="form-check-label">Tous</span>
            </label>

            <label class="me-4" style="    margin-right: 21px;">
                <input type="radio" name="categoryFilter" value="materiel" onclick="filterStocks('materiel')" class="form-check-input">
                <span class="form-check-label">Matériel</span>
            </label>

            <label class="me-4" style="    margin-right: 21px;">
                <input type="radio" name="categoryFilter" value="licence" onclick="filterStocks('licence')" class="form-check-input">
                <span class="form-check-label">Licence</span>
            </label>
        </div>
    </div>
</div>

    <!-- Nouveau Modal principal -->
    <div class="modal" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Stock</h5>
                </div>
                <div class="modal-body">
                    <div id="importTypeButtons">
                        <button type="button" class="btn btn-info" onclick="showImportForm('materiel')">
                            Import Materiel
                        </button>
                        <button type="button" class="btn btn-info" onclick="showImportForm('licence')">
                            Import Licence
                        </button>
                    </div>

                    <!-- Formulaire Import Materiel -->
                    <div id="materielForm" style="display: none;" class="mt-3">
                        <button class="btn btn-secondary btn-sm mb-3" style="background-color: #80bdff;" onclick="retourChoix()">Retour</button>
                        <form action="{{ route('stock.importmateriel') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="materielFile" class="form-label">Fichier Excel Materiel</label>
                                <input type="file" class="form-control" id="materielFile" name="file" accept=".xlsx,.xls" required>
                            </div>
                            <button type="submit" class="btn btn-success">Importer</button>
                        </form>
                    </div>

                    <!-- Formulaire Import Licence -->
                    <div id="licenceForm" style="display: none;" class="mt-3">
                        <button class="btn btn-secondary btn-sm mb-3" style="background-color: #80bdff;" onclick="retourChoix()">Retour</button>
                        <form action="{{ route('stock.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="licenceFile" class="form-label">Fichier Excel Licence</label>
                                <input type="file" class="form-control" id="licenceFile" name="file" accept=".xlsx,.xls" required>
                            </div>
                            <button type="submit" class="btn btn-success">Importer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Nouveau Modal pour Structure -->
    <div class="modal" id="structureModal" tabindex="-1" aria-labelledby="structureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="structureModalLabel">Télécharger Structure</h5>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-around">
                        <a href="{{ route('stkLicence.template') }}" class="btn btn-success btn-lg" style="width: 180px; background-color: #149fad; border: 1px solid #149fad;">
                            <i class="fas fa-download mr-2"></i> Structure Licence
                        </a>
                        <a href="{{ route('stkMateriel.template') }}" class="btn btn-success btn-lg" style="width: 180px; background-color: #149fad; border: 1px solid #149fad;">
                            <i class="fas fa-download mr-2"></i> Structure Materiel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Liste des Stocks
        </div>
       <div class="table-responsive ">
                    <table class="table display table-bordered client_table_index">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Catégorie</th>
                        <th>Nom</th>
                        <th>Date de Début</th>
                        <th>Date d'Expiration</th>
                        <th>Quantité</th>
                        <th>Emplacement</th>
                        <th>Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                        <tr>
                            <td>{{ $stock->id }}</td>
                            <td>{{ $stock->category->nom ?? 'N/A' }}</td>

                            <td>{{ $stock->nom }}</td>
                            <td>{{ $stock->idcategorie == 1 && $stock->date_start ? \Carbon\Carbon::parse($stock->date_start)->format('d/m/Y') : 'N/A' }}</td>
                            <td>{{ $stock->idcategorie == 1 && $stock->date_expiration ? \Carbon\Carbon::parse($stock->date_expiration)->format('d/m/Y') : 'N/A' }}</td>
                            <td>{{ $stock->qte }}</td>
                            <td>
                                @php
                                    $emplacement = $emplacements->firstWhere('id', $stock->emplacement_id);
                                @endphp
                                {{ $emplacement ? $emplacement->nom : 'Non défini' }}

                               @if($stock->category->nom == 'Licence')
                                <td>
                                    <span class="code-value" style="display: none;" onclick="toggleCode(this)">{{ $stock->code }}</span>
                                    <span class="code-dots" style="cursor: pointer;" onclick="toggleCode(this)"><b>••••••</b></span>
                                </td>
                            @else
                                <td>
                                    
                                </td>
                            @endif

                            <td>
                                <a href="{{ route('stock.delete', $stock->id) }}" class="btn btn-danger btn-sm">Retirer Stock</a>
                                <a href="{{ route('stock.edit', $stock->id) }}" class="btn btn-primary">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des alertes
        const alertSuccess = document.querySelector('.alert-success');
        if (alertSuccess) {
            setTimeout(function() {
                alertSuccess.style.display = 'none';
            }, 3000);
        }

        // Validation du fichier
        const importForm = document.querySelector('#importForm');
        const fileInput = document.querySelector('#file');

        importForm.addEventListener('submit', function(e) {
            const file = fileInput.files[0];
            if (file) {
                const fileType = file.name.split('.').pop().toLowerCase();
                if (!['xlsx', 'xls'].includes(fileType)) {
                    e.preventDefault();
                    alert('Veuillez sélectionner un fichier Excel valide (.xlsx ou .xls)');
                } else {
                    console.log('Soumission du formulaire d\'import');
                    console.log('Nom du fichier:', file.name);
                    console.log('Taille du fichier:', (file.size / 1024).toFixed(2) + ' KB');
                    console.log('Type du fichier:', file.type);
                }
            }
        });
    });





    function toggleCode(element) {
        const codeValue = element.previousElementSibling || element.nextElementSibling; // span avec le code
        if (codeValue.style.display === "none" || codeValue.style.display === "") {
            codeValue.style.display = "inline";
            element.style.display = "none"; // cacher les points
        } else {
            codeValue.style.display = "none";
            element.style.display = "inline"; // afficher les points
        }
    }

    // Ajout de la fonction pour cacher le code lorsque cliqué
    document.querySelectorAll('.code-value').forEach(code => {
        code.addEventListener('click', function() {
            this.style.display = "none"; // cacher le code
            this.previousElementSibling.style.display = "inline"; // afficher les points
        });
    });

</script>

<style>
    /* Style pour le modal */
    .modal-dialog {
        max-width: 500px;
    }

    .alert-info {
        font-size: 0.9em;
        margin-top: 15px;
    }

    /* Ajoutez ces styles pour modifier l'apparence du modal */
    .modal-backdrop {
        display: none !important;
    }

    .modal {
        background: transparent;
    }

    .modal-dialog {
        max-width: 500px;
        margin: 1.75rem auto;
    }

    .modal-content {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    /* Style pour le modal d'import */
    #importTypeButtons {
        display: flex;
        justify-content: space-around;
        margin: 20px 0;
    }

    #importTypeButtons .btn {
        padding: 15px 30px;
        font-size: 1.1em;
        width: 45%;
    }

    .modal-content {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        border-radius: 10px 10px 0 0;
    }

    .modal-body {
        padding: 25px;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
    }

    .btn-secondary {
        margin-bottom: 15px;
    }

    .form-control {
        border: 2px solid #dee2e6;
    border-radius: 5px;
    padding: 4px;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    .btn-success {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
    }

    .modal {
        background: rgba(0, 0, 0, 0.5);
    }

    .modal-dialog {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        margin: 0;
        width: 500px;
    }

    /* Style des boutons principaux */
    .btn-lg {
        margin: 0 10px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-lg:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Style spécifique pour chaque type de bouton */
    .btn-primary {
        background-color: #4361ee;
        border-color: #4361ee;
    }

    .btn-primary:hover {
        background-color: #3a53d0;
        border-color: #3a53d0;
    }

    .btn-warning {
        background-color: #e05429;
        border-color: #ff9f43;
        color: white;
    }

    .btn-warning:hover {
        background-color: #ff922b;
        border-color: #ff922b;
        color: white;
    }

    .btn-success {
        background-color: #28c76f;
        border-color: #28c76f;
    }

    .btn-success:hover {
        background-color: #24b263;
        border-color: #24b263;
    }

    /* Style pour les boutons dans le modal */
    #importTypeButtons .btn {
        padding: 12px 25px;
        font-size: 1rem;
        width: 45%;
        margin: 10px;
        border-radius: 6px;
    }

    .btn-info {
        background-color: #00cfe8;
        border-color: #00cfe8;
        color: white;
    }

    .btn-info:hover {
        background-color: #00b8d4;
        border-color: #00b8d4;
        color: white;
    }

</style>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script>
function showImportForm(type) {
    document.getElementById('importTypeButtons').style.display = 'none';
    if (type === 'materiel') {
        document.getElementById('materielForm').style.display = 'block';
        document.getElementById('licenceForm').style.display = 'none';
    } else {
        document.getElementById('materielForm').style.display = 'none';
        document.getElementById('licenceForm').style.display = 'block';
    }
}

function retourChoix() {
    document.getElementById('importTypeButtons').style.display = 'block';
    document.getElementById('materielForm').style.display = 'none';
    document.getElementById('licenceForm').style.display = 'none';
}

    document.addEventListener('DOMContentLoaded', function() {
        const importButton = document.querySelector('[data-bs-target="#importModal"]');
        const importModal = document.getElementById('importModal');

        importButton.addEventListener('click', function() {
            console.log('Bouton cliqué');
            const modal = new bootstrap.Modal(importModal);
            modal.show();
        });
    });

    function filterStocks(category) {
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const stockCategory = row.querySelector('td:nth-child(2)').textContent.trim();
            if (category === 'tous') {
                row.style.display = ''; // Affiche toutes les lignes
            } else if (category === 'materiel' && stockCategory !== 'N/A' && stockCategory !== 'Licence') {
                row.style.display = '';
            } else if (category === 'licence' && stockCategory === 'Licence') {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    $(document).ready(function() {
        $('#stocksTable').DataTable(); // Initialiser DataTable
    });

    function filterByEmplacement() {
        const selectedEmplacement = document.getElementById('emplacementFilter').value;
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const stockEmplacement = row.querySelector('td:nth-child(7)').textContent.trim();
            if (selectedEmplacement === 'tous' || stockEmplacement === selectedEmplacement) {
                row.style.display = ''; // Affiche la ligne
            } else {
                row.style.display = 'none'; // Cache la ligne
            }
        });
    }

</script>
@endsection
