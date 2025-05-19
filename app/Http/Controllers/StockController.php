<?php
// app/Http/Controllers/StockController.php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Catalogue;
use App\Models\Emplacement;
use App\Models\StockHistory;
use Illuminate\Http\Request;
use App\Imports\StocksImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StocksImportMaterial;
use App\Models\CategoriesProduit; // Assuming the model name is CategoriesProduit
use Illuminate\Support\Facades\Mail;
use App\Mail\LicenseExpirationReminder;

class StockController extends Controller
{
// app/Http/Controllers/StockController.php

    public function index()
    {
        $stocks = Stock::with('category', 'emplacement')->get();
        $emplacements = Emplacement::all();

        return view('stock.index', compact('stocks', 'emplacements'));
    }

    public function entree()
    {
        $categories = CategoriesProduit::all();
        $emplacements = Emplacement::all();
        $stocks = Stock::all();
        $catalogues = Catalogue::all();

        return view('stock.entree', compact('categories', 'emplacements', 'stocks', 'catalogues'));
    }

    public function sortie(Request $request)
    {
        $selectedStockId = $request->query('id', null);
        $stocks = Stock::all();
        return view('stock.sortie', compact('stocks', 'selectedStockId'));
    }


    public function emplacement()
    {
        $emplacements = Emplacement::all();
        return view('stock.emplacement', compact('emplacements'));
    }


    public function delete($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return redirect()->route('stock.index')->with('success', 'Stock deleted successfully.');
    }


    public function store_update(Request $request)
    {
        $request->validate([
            'idcategorie.*' => 'required|exists:categories_produit,id',
            'catalogue_id.*' => 'required|exists:catalogues,id',
            'code.*' => 'nullable|string|max:255',
            'date_start.*' => 'nullable|date',
            'date_expiration.*' => 'nullable|date',
            'qte.*' => 'required|integer',
            'emplacement_id.*' => 'nullable|exists:emplacements,id',
        ]);

        $categories = $request->input('idcategorie', []);
        $catalogueIds = $request->input('catalogue_id', []);
        $dateStarts = $request->input('date_start', []);
        $dateExpirations = $request->input('date_expiration', []);
        $quantities = $request->input('qte', []);
        $emplacementIds = $request->input('emplacement_id', []);
        $ids = $request->input('id', []);

        $entriesCount = count($categories);

        for ($index = 0; $index < $entriesCount; $index++) {
            $categoryId = $categories[$index] ?? null;
            $catalogueId = $catalogueIds[$index] ?? null;
            $quantity = $quantities[$index] ?? null;
            $emplacementId = $emplacementIds[$index] ?? null;
            $dateStart = $dateStarts[$index] ?? null;
            $dateExpiration = $dateExpirations[$index] ?? null;
            $id = $ids[$index] ?? null;

            if ($categoryId === null || $catalogueId === null || $quantity === null) {
                continue;
            }

            $catalogue = Catalogue::find($catalogueId);
            $nom = $catalogue ? $catalogue->produit : null;

            $isLicence = $categoryId == 1;

            $data = [
                'idcategorie' => $categoryId,
                'catalogue_id' => $catalogueId,
                'nom' => $nom,
                'code' => $request->input('code')[$index] ?? null,
                'qte' => $quantity,
                'emplacement_id' => $emplacementId
            ];

            if ($isLicence) {
                $data['date_start'] = $dateStart;
                $data['date_expiration'] = $dateExpiration;

                if ($dateExpiration && now()->diffInDays($dateExpiration) <= 30) {
                    Mail::to(env('MAIL_FROM_ADDRESS'))->send(new LicenseExpirationReminder($nom, $dateExpiration));
                }
            }

            Stock::updateOrCreate(
                ['id' => $id],
                $data
            );
        }

        return redirect()->route('stock.index')->with('success', 'Stocks updated successfully.');
    }



    // modifier article
    public function edit($id)
    {
        $stock = Stock::findOrFail($id); // Trouver le stock par son ID
        $emplacements = Emplacement::all(); // Récupérer tous les emplacements

        return view('stock.update', compact('stock', 'emplacements')); // Passer le stock et les emplacements à la vue
    }

    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'nullable|string|max:255',
            'qte' => 'required|integer',
            'emplacement_id' => 'required|exists:emplacements,id', // Valider l'emplacement
        ]);

        // Trouver le stock et le mettre à jour
        $stock = Stock::findOrFail($id);
        $stock->update($validated);

        // Rediriger vers une page (par exemple, la liste des stocks)
        return redirect()->route('stock.index')->with('success', 'Stock mis à jour avec succès.');
    }







    public function store_update_qte(Request $request)
    {
        $request->validate([
            'stock_id.*' => 'required|exists:stocks,id',  // Ensure each stock_id exists
            'qte.*' => 'required|integer|min:1',  // Quantity must be positive integer
        ]);

        $stockIds = $request->input('stock_id', []);
        $quantities = $request->input('qte', []);

        $entriesCount = count($stockIds);

        for ($index = 0; $index < $entriesCount; $index++) {
            $stockId = $stockIds[$index] ?? null;
            $quantity = $quantities[$index] ?? null;

            if ($stockId === null || $quantity === null) {
                continue;  // Skip if any critical data is missing
            }

            $stock = Stock::find($stockId);

            if ($stock === null) {
                continue;  // Skip if stock not found
            }

            if ($stock->qte < $quantity) {
                return redirect()->back()->with('error', 'Quantité demandée dépasse la quantité disponible en stock.');
            }

            $stock->qte -= $quantity;
            $stock->save();
        }

        return redirect()->route('stock.index')->with('success', 'Quantités mises à jour avec succès.');
    }





    public function uploadCatalogueStock(Request $request)
    {
        // Implement your logic for uploading catalogue stock
        return redirect()->route('stock.index')->with('success', 'Catalogue imported successfully.');
    }
    // app/Http/Controllers/StockController.php

    public function createEmplacement()
    {
        return view('stock.create_emplacement');
    }
    // app/Http/Controllers/StockController.php

    public function storeEmplacement(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Emplacement::create([
            'nom' => $request->input('nom'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('stock.emplacement')->with('success', 'Emplacement ajouté avec succès.');
    }
    // app/Http/Controllers/StockController.php

    public function editEmplacement($id)
    {
        $emplacement = Emplacement::findOrFail($id);
        return view('stock.edit_emplacement', compact('emplacement'));
    }

    public function updateEmplacement(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $emplacement = Emplacement::findOrFail($id);
        $emplacement->update([
            'nom' => $request->input('nom'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('stock.emplacement')->with('success', 'Emplacement mis à jour avec succès.');
    }

    public function deleteEmplacement($id)
    {
        $emplacement = Emplacement::findOrFail($id);
        $emplacement->delete();

        return redirect()->route('stock.emplacement')->with('success', 'Emplacement supprimé avec succès.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        \Log::info('Début de l\'importation du fichier Excel');

        try {
            // Validation préliminaire du fichier
            $file = $request->file('file');
            if (!$file->isValid()) {
                throw new \Exception('Le fichier n\'est pas valide');
            }

            // Ajout de la transaction pour assurer l'intégrité des données
            DB::beginTransaction();

            Excel::import(new StocksImport, $file);

            DB::commit();

            \Log::info('Importation terminée avec succès');
            return redirect()->route('stock.index')
                ->with('success', 'Importation réussie !');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            DB::rollBack();
            \Log::error('Erreur de validation:', [
                'failures' => $e->failures(),
                'message' => $e->getMessage()
            ]);

            // Récupération des erreurs de validation
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = "Ligne {$failure->row()}: {$failure->errors()[0]}";
            }

            return redirect()->route('stock.index')
                ->with('error', 'Erreurs de validation : ' . implode(', ', $errors));

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erreur lors de l\'importation:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('stock.index')
                ->with('error', 'Erreur lors de l\'importation : ' . $e->getMessage());
        }
    }


    public function importmateriel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        \Log::info('Début de l\'importation du fichier Excel');

        try {
            // Validation préliminaire du fichier
            $file = $request->file('file');
            if (!$file->isValid()) {
                throw new \Exception('Le fichier n\'est pas valide');
            }

            // Ajout de la transaction pour assurer l'intégrité des données
            DB::beginTransaction();

            Excel::import(new StocksImportMaterial, $file);

            DB::commit();

            \Log::info('Importation terminée avec succès');
            return redirect()->route('stock.index')
                ->with('success', 'Importation réussie !');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            DB::rollBack();
            \Log::error('Erreur de validation:', [
                'failures' => $e->failures(),
                'message' => $e->getMessage()
            ]);

            // Récupération des erreurs de validation
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = "Ligne {$failure->row()}: {$failure->errors()[0]}";
            }

            return redirect()->route('stock.index')
                ->with('error', 'Erreurs de validation : ' . implode(', ', $errors));

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erreur lors de l\'importation:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('stock.index')
                ->with('error', 'Erreur lors de l\'importation : ' . $e->getMessage());
        }
    }

    public function etatStock()
    {
        $stocks = Stock::select('catalogue_id', 'nom', DB::raw('SUM(qte) as total_qte'))
            ->groupBy('catalogue_id', 'nom')
            ->get();

        return view('stock.etat', compact('stocks'));
    }

    public function checkLicenseExpirations()
    {
        $stocks = Stock::with('category')->get(); // Récupérer tous les stocks avec leur catégorie

        foreach ($stocks as $stock) {
            if ($stock->category_id == 1 && $stock->date_expiration) { // Vérifiez si la catégorie est 1
                $expirationDate = \Carbon\Carbon::parse($stock->date_expiration);
                if (now()->diffInDays($expirationDate) == 30) { // Vérifiez si la date d'expiration est dans 30 jours
                    $nom = $stock->nom; // Récupérer le nom du produit
                    Mail::to(env('MAIL_FROM_ADDRESS'))->send(new LicenseExpirationReminder($nom, $expirationDate));
                }
            }
        }

        return 'Vérification des licences terminée.';
    }



}
