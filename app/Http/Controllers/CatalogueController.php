<?php

namespace App\Http\Controllers;

use App\Imports\CatalogueImport;
use Illuminate\Http\Request;
use App\Models\Catalogue;
use App\Models\CategoriesProduit;
use App\Models\Groupe;
use App\Models\Taxe;
use App\Models\Fournisseur;
use App\Models\Packcle;
use App\Models\Oemparametre;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Client;
use App\Models\ClientProduct;
use App\Models\Facture;
use App\Models\ItemFacture;


class CatalogueController extends Controller
{
    public function index()
    {
        $catalogues = Catalogue::all()->map(function ($catalogue) {
            $categorieProduit = CategoriesProduit::find($catalogue->categorie);
            $catalogue->categorieName = $categorieProduit ? $categorieProduit->nom : 'N/A';
            return $catalogue;
        });

        return view('catalogues.index', compact('catalogues'));
    }



    public function store_oem(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file_cles' => 'required',
                'date_cles' => 'required',
                'type_produit' => 'required',
                'fournisseur_id' => 'required',
            ],
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $filePath = $request->file('file_cles');
        $arrayCle = [];
        if (File::exists($filePath)) {
            $content = File::get($filePath);
            $lines = explode("\n", $content);
            foreach ($lines as $line) {
                $line = str_replace("\r", '', $line);
                $test_cle = Catalogue::where('numero_cle', $line)->exists();
                if ($test_cle) {
                    return response()->json(['erreur_existe' => "Erreur dans le fichier , le clé " . $line . " éxiste déja"]);
                }
                if ($line != "") {
                    array_push($arrayCle, $line);
                }
            }
        }
        $pack = packcle::create(["date" => $request->date_cles]);
        foreach ($arrayCle as $cle) {
            $parametre = Oemparametre::first();
            $total_ht = $parametre->prix_ht;
            $total_tva = $total_ht * ($parametre->tva / 100);
            $total_ttc = $total_tva + $total_ht;
            if ($parametre) {
                $groupe = Groupe::where('nom', 'produit')->first();

                $numero = $groupe->numero();
                if (!$numero) {
                    return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
                }
                Catalogue::create([
                    "numero" => $numero,
                    'prix_ht' => $parametre->prix_ht,
                    'quantites' => 1,
                    'tva' => $parametre->tva,
                    'produit' => $parametre->produit,
                    'description' => $parametre->description,
                    'total_tva' => $total_tva,
                    'total_ht' => $total_ht,
                    'total_ttc' => $total_ttc,
                    'fournisseur_id' => $request->fournisseur_id,
                    'categorie' => $request->type_produit,
                    'numero_cle' => $cle,
                    'packcle_id' => $pack->id,
                    "date_cle" => $request->date_cles
                ]);
                $groupe->nb_prochain++;
                $groupe->save();
            }
        }
        return response()->json(200);
    }


    public function update_store_oem(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'date_cles' => 'required',
                'type_produit' => 'required',
                'fournisseur_id' => 'required',
                'num_cle' => 'required|unique:catalogues,numero_cle,' . $id,
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Catalogue::where('id', $id)->update([
            'fournisseur_id' => $request->fournisseur_id,
            'categorie' => $request->type_produit,
            'numero_cle' => $request->num_cle,
            "date_cle" => $request->date_cles
        ]);
        return response()->json(200);
    }

    public function add()
    {
        $taxes = Taxe::all();
        $fournisseurs = Fournisseur::all();
        $categories = CategoriesProduit::all();
        return view('catalogues.add')
            ->with(compact('fournisseurs'))
            ->with(compact('taxes'))
            ->with(compact('categories'));
    }
     public function store(Request $request)
    {
        try {
       

            $rules = [
                'prix_achat' => 'required|numeric|min:0',
                'prix_ht' => 'required|numeric|min:0',
                'produit' => 'required|string',
                'description' => 'required|string',
                'type_produit' => 'required',
                'tva' => 'required|numeric',
                'remise' => 'nullable|numeric',
                'type_remise' => 'required|string',
                'date_debut' => 'nullable|date',
                'date_fin' => 'nullable|date',
                'fournisseur_id' => 'nullable|exists:fournisseurs,id'
            ];

            // Modification ici pour rendre la référence nullable pour le type matériel
            if ($request->type_produit == '3') {
                $rules['reference'] = 'nullable|string';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                
                return response()->json(['error' => $validator->errors()], 422);
            }

            $groupe = Groupe::where('nom', 'produit')->first();
            $numero = $groupe->numero();

            if (!$numero) {
                return response()->json([
                    'error' => "Numéro existe déjà, changer le numéro prochain dans les paramètres"
                ], 422);
            }

            $catalogueData = [
                'numero' => $numero,
                'prix_ht' => $request->prix_ht,
                'prix_achat' => $request->prix_achat,
                'tva' => $request->tva,
                'remise' => $request->remise,
                'type_remise' => $request->type_remise,
                'produit' => $request->produit,
                'description' => $request->description,
                'fournisseur_id' => $request->fournisseur_id,
                'categorie' => $request->type_produit,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin
            ];

            // Ajout de la référence uniquement si elle est fournie pour le type matériel
            if ($request->type_produit == '3' && $request->has('reference')) {
                $catalogueData['reference'] = $request->reference;
            }

            $catalogue = Catalogue::create($catalogueData);

            $groupe->nb_prochain++;
            $groupe->save();

            return response()->json(200);

        } catch (\Exception $e) {
           
            return response()->json([
                'error' => [
                    'message' => 'Une erreur est survenue lors de la création',
                    'details' => $e->getMessage()
                ]
            ], 500);
        }
    }
    public function update($id)
    {

        $taxes = Taxe::all();

        $catalogue = Catalogue::find($id);
        $fournisseurs = Fournisseur::all();
        $categories = CategoriesProduit::all();


        return view('catalogues.update')
            ->with(compact('catalogue'))
            ->with(compact('fournisseurs'))
            ->with(compact('taxes'))
            ->with(compact('categories'));
    }
    public function getProductsByCategory($categoryId)
    {
        $products = Catalogue::query()
            ->where('categorie', $categoryId)
            ->whereIn('id', function($query) {
                $query->select('catalogue_id')
                      ->from('stocks')
                      ->where('qte', '>', 0);
            })
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json($products);
    }

    public function store_update(Request $request, $id)
    {
        try {
           
            $rules = [
                'prix_achat' => 'required|numeric|min:0',
                'prix_ht' => 'required|numeric|min:0',
                'produit' => 'required|string',
                'description' => 'required|string',
                'type_produit' => 'required',
                'tva' => 'required|numeric',
                'remise' => 'nullable|numeric',
                'type_remise' => 'required|string',
                'date_debut' => 'nullable|date',
                'date_fin' => 'nullable|date',
                'fournisseur_id' => 'nullable|exists:fournisseurs,id'
            ];

            if ($request->type_produit == '3') {
                $rules['reference'] = 'nullable|string';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                \Log::warning('Échec de validation', [
                    'errors' => $validator->errors()->toArray()
                ]);
                return response()->json(['error' => $validator->errors()], 422);
            }

            // Si c'est une création (pas d'ID)
            if (!$id) {
                $groupe = Groupe::where('nom', 'produit')->first();
                \Log::info('Génération du numéro pour nouveau produit', ['groupe' => $groupe]);

                $numero = $groupe->numero();
                if (!$numero) {
                    return response()->json(['error_existe' => "Numéro existe déjà, changer le numéro prochain dans les paramètres"]);
                }

                $updateData = [
                    "numero" => $numero,
                    'prix_ht' => $request->prix_ht,
                    'prix_achat' => $request->prix_achat,
                    'tva' => $request->tva,
                    'remise' => $request->remise,
                    'type_remise' => $request->type_remise,
                    'produit' => $request->produit,
                    'description' => $request->description,
                    'fournisseur_id' => $request->fournisseur_id,
                    'categorie' => $request->type_produit,
                    'date_debut' => $request->date_debut,
                    'date_fin' => $request->date_fin
                ];

                if ($request->type_produit == '3') {
                    $updateData['reference'] = $request->reference;
                }

                $catalogue = Catalogue::create($updateData);

                $groupe->nb_prochain++;
                $groupe->save();

                \Log::info('Nouveau catalogue créé', [
                    'catalogue' => $catalogue->toArray(),
                    'nouveau_numero' => $numero
                ]);
            } else {
                // Si c'est une mise à jour
                $catalogue = Catalogue::findOrFail($id);
             

                $updateData = [
                    'prix_ht' => $request->prix_ht,
                    'prix_achat' => $request->prix_achat,
                    'tva' => $request->tva,
                    'remise' => $request->remise,
                    'type_remise' => $request->type_remise,
                    'produit' => $request->produit,
                    'description' => $request->description,
                    'fournisseur_id' => $request->fournisseur_id,
                    'categorie' => $request->type_produit,
                    'date_debut' => $request->date_debut,
                    'date_fin' => $request->date_fin
                ];

                if ($request->type_produit == '3') {
                    $updateData['reference'] = $request->reference;
                }

                $catalogue->update($updateData);

            }

            return response()->json(200);

        } catch (\Exception $e) {
      
            return response()->json([
                'error' => [
                    'message' => 'Une erreur est survenue lors de la mise à jour',
                    'details' => $e->getMessage()
                ]
            ], 500);
        }
    }







    public function one_catalogue($id)
    {
        $catalogue = Catalogue::with('stocks')->where('id', $id)->first();
        return response()->json($catalogue);
    }
    public function delete($id)
    {

        Catalogue::where('id', $id)->delete();
        return response()->json(200);
    }
    public function show(Request $request, $id)
    {
        $catalogue = Catalogue::find($id);
        if (!$catalogue) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($catalogue);
    }

    public function getCataloguesByCategory($categoryId)
    {
        $catalogues = Catalogue::where('categorie', $categoryId)->get();

        return response()->json($catalogues);
    }

    
    public function clientProducts()
    {
        $items = ItemFacture::query()
            ->with(['facture', 'facture.client'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('catalogues.client_products', compact('items'));
    }

    public function filterClientProducts(Request $request)
    {
        $query = ItemFacture::with(['facture.client']);

        if ($request->client_id) {
            $query->whereHas('facture', function($query) use ($request) {
                $query->where('client_id', $request->client_id);
            });
        }

        if ($request->date_debut) {
            $query->whereHas('facture', function($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->date_debut);
            });
        }

        if ($request->date_fin) {
            $query->whereHas('facture', function($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->date_fin);
            });
        }

        $items = $query->orderBy('created_at', 'desc')->get();

        $view = view('catalogues.partials.products-table', compact('items'))->render();
        return response()->json(['html' => $view]);
    }

}
