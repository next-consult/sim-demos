@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sortie de Stock</h1>
    <p>Date d'aujourd'hui : <strong>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</strong></p>
    <br>
   
    <form action="{{ route('update.stockqte') }}" method="POST" style="width: 90%;" onsubmit="return validateForm()">
        @csrf
        <div id="stock-entries">
            <div class="stock-entry">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="stock_id">Sélectionner un Stock</label>
                            <select name="stock_id[]" class="form-control" onchange="updateQuantity(this)" required>
                                <option value="">Sélectionner un stock</option>
                                @foreach($stocks as $stock)
                                    <option value="{{ $stock->id }}" data-quantity="{{ $stock->qte }}" {{ $stock->id == $selectedStockId ? 'selected' : '' }}>{{ $stock->nom }}</option>
                                @endforeach
                            </select>
                            @error('stock_id.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="description[]">Raison de la sortie</label>
                            <input type="text" name="description[]" class="form-control" required placeholder="Décrivez la raison de cette sortie de stock">
                            @error('description.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="qte">Quantité à retirer</label>
                            <input type="number" name="qte[]" class="form-control" oninput="adjustQuantity(this)" min="1" required>
                            @error('qte.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Quantité restante :</label>
                            <p class="remaining_qte_text form-control-static"></p>
                            <input type="hidden" class="initial_quantity" value="0">
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>

        <button type="button" class="btn btn-warning" onclick="addStockEntry()">Ajouter un autre produit</button>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</div>

<script>
    function updateQuantity(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const quantity = parseInt(selectedOption.getAttribute('data-quantity')) || 0;
        const stockEntry = selectElement.closest('.stock-entry');
        const remainingQuantityText = stockEntry.querySelector('.remaining_qte_text');
        const initialQuantityInput = stockEntry.querySelector('.initial_quantity');
        const quantityInput = stockEntry.querySelector('input[name="qte[]"]');
         
        if (quantity > 0) {
            remainingQuantityText.textContent = quantity;
            initialQuantityInput.value = quantity;
            quantityInput.max = quantity; // Set max attribute
        } else {
            remainingQuantityText.textContent = '';
            initialQuantityInput.value = 0;
            quantityInput.max = 0;
        }

        quantityInput.value = '';
    }

    function adjustQuantity(inputElement) {
        const stockEntry = inputElement.closest('.stock-entry');
        const initialQuantity = parseInt(stockEntry.querySelector('.initial_quantity').value) || 0;
        let quantityToRemove = parseInt(inputElement.value) || 0;
        
        // Ensure quantity to remove doesn't exceed initial quantity
        if (quantityToRemove > initialQuantity) {
            quantityToRemove = initialQuantity;
            inputElement.value = initialQuantity;
        }
        
        const remainingQuantityText = stockEntry.querySelector('.remaining_qte_text');
        const newRemainingQuantity = initialQuantity - quantityToRemove;
        remainingQuantityText.textContent = newRemainingQuantity < 0 ? 0 : newRemainingQuantity;
    }

    function validateForm() {
        const stockEntries = document.querySelectorAll('.stock-entry');
        for (const entry of stockEntries) {
            const quantityToRemove = parseInt(entry.querySelector('input[name="qte[]"]').value) || 0;
            const initialQuantity = parseInt(entry.querySelector('.initial_quantity').value) || 0;
            if (quantityToRemove > initialQuantity) {
                alert('La quantité à retirer ne peut pas dépasser la quantité initiale.');
                return false;
            }
        }
        return true;
    }

    function addStockEntry() {
        const stockEntries = document.getElementById('stock-entries');
        const newEntry = document.createElement('div');
        newEntry.classList.add('stock-entry');
        newEntry.innerHTML = `
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="stock_id">Sélectionner un Stock</label>
                        <select name="stock_id[]" class="form-control" onchange="updateQuantity(this)" required>
                            <option value="">Sélectionner un stock</option>
                            @foreach($stocks as $stock)
                                <option value="{{ $stock->id }}" data-quantity="{{ $stock->qte }}">{{ $stock->nom }}</option>
                            @endforeach
                        </select>
                        @error('stock_id.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="description[]">Raison de la sortie</label>
                        <input type="text" name="description[]" class="form-control" required placeholder="Décrivez la raison de cette sortie de stock">
                        @error('description.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="qte">Quantité à retirer</label>
                        <input type="number" name="qte[]" class="form-control" oninput="adjustQuantity(this)" min="1" required>
                        @error('qte.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Quantité restante :</label>
                        <p class="remaining_qte_text form-control-static"></p>
                        <input type="hidden" class="initial_quantity" value="0">
                    </div>
                </div>

                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.stock-entry').remove()" style="margin-top: 25px;">X</button>
                </div>
            </div>
            <hr>
        `;
        stockEntries.appendChild(newEntry);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const stockEntries = document.querySelectorAll('.stock-entry');
        stockEntries.forEach(entry => {
            const select = entry.querySelector('select[name="stock_id[]"]');
            if (select.value) {
                updateQuantity(select);
            }
        });
    });
</script>
@endsection
