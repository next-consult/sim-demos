<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\OrdreController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\BonlivraisonController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\TaxeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\OemparametreController;
use App\Http\Controllers\ChiffreaffaireController;
use App\Http\Controllers\crm\OpportunityController;
use App\Http\Controllers\crm\ContactController;
use App\Http\Controllers\crm\CalendarController;
use App\Http\Controllers\contrats\ContratController;
use App\Http\Controllers\devise\DeviseController;
use App\Http\Controllers\BoncommandeController;
use App\Http\Controllers\CongeController;
//use App\Exports\ClientsExport;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\profil\ProfilController;
//use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login-page');

Auth::routes();


Route::group(['middleware' => ['auth', 'testcontrat']], function () {
    //profil routes
	Route::get('/logs', [LogController::class, 'showLogs'])->name('logs.show');
    Route::get('/editprofil', [ProfilController::class, 'update'])->name('profil.update');
    Route::post('/editprofilstore', [ProfilController::class, 'store_update'])->name('profil.update.store');

    //clients routes
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => ['can:clients']], function () {
		Route::get('/clients/export', [ClientController::class, 'export'])->name('clients.export');
        Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
        Route::get('/addclient', [ClientController::class, 'add'])->name('clients.add');
        Route::get('/updateclient/{id}', [ClientController::class, 'update'])->name('clients.update');

        Route::post('/storeclient', [ClientController::class, 'store'])->name('clients.store');
        Route::post('/updateclientstore/{id}', [ClientController::class, 'update_store'])->name('clients.update_store');
        Route::get('/deleteclient/{id}', [ClientController::class, 'delete'])->name('clients.delete');
        Route::get('/showclient/{id}', [ClientController::class, 'show'])->name('clients.show');
        Route::get('/devisclient/{id}', [ClientController::class, 'devis_client'])->name('clients.devis');
        Route::get('/downloadfile/{id}', [ClientController::class, 'download'])->name('clients.downloadfile');
    });

    //entreprises routes
    Route::group(['middleware' => ['can:entreprises']], function () {
        Route::get('/entreprises', [EntrepriseController::class, 'index'])->name('entreprises.index');
        Route::get('/addentreprises', [EntrepriseController::class, 'add'])->name('entreprises.add');
        Route::post('/storeentreprises', [EntrepriseController::class, 'store'])->name('entreprises.store');
        Route::get('/updateentreprisest/{id}', [EntrepriseController::class, 'update'])->name('entreprises.update');
        Route::post('/updateentreprisesstore/{id}', [EntrepriseController::class, 'update_store'])->name('entreprises.update_store');
        Route::get('/deleteentreprises/{id}', [EntrepriseController::class, 'delete'])->name('entreprises.delete');
    });
    Route::group(['middleware' => ['can:devis']], function () {
        //devis routes
        Route::get('/devis', [DevisController::class, 'index'])->name('devis.index');
        Route::get('/editdevis/{id}', [DevisController::class, 'update'])->name('devis.update');
        Route::post('/adddevis', [DevisController::class, 'store'])->name('devis.add');
        Route::post('/update_store/{id}', [DevisController::class, 'update_store'])->name('devis.update_store');
        Route::get('/printdevis/{id}', [DevisController::class, 'print'])->name('devis.print');
        Route::get('/deletedevis/{id}', [DevisController::class, 'delete'])->name('devis.delete');
        Route::get('/generatefacture/{id}', [DevisController::class, 'generate_facture'])->name('devis.generate');
        Route::post('/devisbonlivraison/{id}', [DevisController::class, 'bon_livraison'])->name('devis.bon_livraison');
    });

    //ordre de transport routes
    Route::get('/ordres', [OrdreController::class, 'index'])->name('ordres.index');
    Route::post('/addordre', [OrdreController::class, 'store'])->name('ordres.add');
    Route::get('/updateordre/{id}/{all}', [OrdreController::class, 'update'])->name('ordres.update');
    Route::post('/configordre/{id}', [OrdreController::class, 'config'])->name('ordres.config');
    Route::get('/printordre/{id}', [OrdreController::class, 'print'])->name('ordres.print');
    Route::get('/ordreclient/{id}', [OrdreController::class, 'ordreclient'])->name('ordres.client');
    Route::get('/ordredevis/{id}', [OrdreController::class, 'ordre_devis'])->name('ordres.devis');
    //factures routes
    Route::group(['middleware' => ['can:factures']], function () {
        Route::get('/factures', [FactureController::class, 'index'])->name('factures.index');
        Route::get('/onefacture/{id}', [FactureController::class, 'one_facture'])->name('factures.one');
        Route::get('/liaisonfacture', [FactureController::class, 'facture_liaison'])->name('factures.liaison');
        Route::get('/test_cles/{quantites}/{id}', [FactureController::class, 'test_cles'])->name('factures.test_cles');


        Route::post('/addfactures', [FactureController::class, 'store'])->name('factures.add');
        Route::get('/updatefacture/{id}', [FactureController::class, 'update'])->name('factures.update');
        Route::post('/get_ordres', [FactureController::class, 'get_ordres'])->name('factures.get_ordres');
        Route::post('/savefacture/{id}', [FactureController::class, 'save'])->name('factures.save');
        Route::get('/printfacture/{id}', [FactureController::class, 'print'])->name('factures.print');
        Route::get('/paiementfacture/{id}', [FactureController::class, 'paiementfacture'])->name('factures.paiement');
        Route::get('/ordrefacture/{id}', [FactureController::class, 'ordre_facture'])->name('factures.create_ordre');
        Route::post('/changestatus/{id}', [FactureController::class, 'changestatus'])->name('factures.changestatus');

        Route::get('/deletefacture/{id}', [FactureController::class, 'delete'])->name('facture.delete');

        Route::get('/retenufacture/{id}', [FactureController::class, 'retenu'])->name('factures.retenu');

        Route::get('/activeretenufacture/{id}', [FactureController::class, 'active_retenu'])->name('factures.active_retenu');
        Route::get('/desactiveretenufacture/{id}', [FactureController::class, 'desactive_retenu'])->name('factures.desactive_retenu');
		   Route::get('/avoir/{id}', [FactureController::class, 'avoir'])->name('factures.avoir');
        Route::post('/storeavoir', [FactureController::class, 'storeAvoir'])->name('factures.storeAvoir');
        Route::get('/printfacture/{id}', [FactureController::class, 'print'])->name('factures.print');
        Route::get('/printavoir/{id}', [FactureController::class, 'printavoir'])->name('factures.printavoir');
        Route::get('/facturesdavoir', [FactureController::class, 'facturesAvoir'])->name('factures.facturesdavoir');
        Route::get('/factures/{id}/avoir/edit', [FactureController::class, 'editAvoir'])->name('factures.editAvoir');
        Route::put('/factures/{id}/avoir', [FactureController::class, 'updateAvoir'])->name('factures.updateAvoir');
        Route::post('/factures/{facture}/update-reste', [FactureController::class, 'updateReste'])->name('factures.update-reste');
        Route::get('factures/show/{id}', [FactureController::class, 'show']);
    });

    //paiement routes
    Route::group(['middleware' => ['can:paiements']], function () {
        Route::get('/paiements', [PaiementController::class, 'index'])->name('paiement.index');
        Route::post('/savepaiement/{id}', [PaiementController::class, 'save'])->name('paiement.save');
        Route::get('/paiementsbyid/{id}', [PaiementController::class, 'update'])->name('paiement.update');
        Route::post('/updatepaiement/{id}', [PaiementController::class, 'save_update'])->name('paiement.save_update');
        Route::get('/deletepaiement/{id}', [PaiementController::class, 'delete'])->name('paiement.delete');
    });

    //dossier routes
    Route::get('/dossiers', [DossierController::class, 'index'])->name('dossiers.index');
    Route::post('/adddossiers', [DossierController::class, 'store'])->name('dossiers.add');
    Route::get('/updatedossiers/{id}', [DossierController::class, 'update'])->name('dossiers.update');
    Route::post('/updatestoredossiers/{id}', [DossierController::class, 'store_update'])->name('dossiers.update.store');
    Route::post('/storedevis/{id}', [DossierController::class, 'store_devis'])->name('dossiers.devis.store');
    //destinatins routes
    Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
    Route::post('/adddestination', [DestinationController::class, 'store'])->name('destinations.add');
    Route::get('/onedestination/{id}', [DestinationController::class, 'one_destination'])->name('destinations.one');
    Route::post('/updatedestination/{id}', [DestinationController::class, 'update'])->name('destinations.update');

     //catalogues routes
    Route::get('/onecatalogue/{id}', [CatalogueController::class, 'one_catalogue'])->name('catalogues.onecatalogue');
    Route::group(['middleware' => ['can:catalogues']], function () {
        Route::get('/catalogues', [CatalogueController::class, 'index'])->name('catalogues.index');
        Route::get('/addcatalogue', [CatalogueController::class, 'add'])->name('catalogues.add');
        Route::post('/storecatalogue', [CatalogueController::class, 'store'])->name('catalogues.store');

        Route::post('/storecatalogueoem', [CatalogueController::class, 'store_oem'])->name('catalogues.store_oem');
        Route::post('/storeupdatecatalogueoem/{id}', [CatalogueController::class, 'update_store_oem'])->name('catalogues.update_store_oem');
        Route::get('/productsbycategory/{categoryId}', [CatalogueController::class, 'getProductsByCategory'])->name('products.by_category');
        Route::get('/catalogue/{id}', [CatalogueController::class, 'show'])->name('catalogue.show');

        Route::get('/updatecatalogue/{id}', [CatalogueController::class, 'update'])->name('catalogues.update');
        Route::post('/storeupdatecatalogue/{id}', [CatalogueController::class, 'store_update'])->name('catalogues.update.store');
        Route::get('/deletecatalogue/{id}', [CatalogueController::class, 'delete'])->name('catalogues.delete');

    });

    //taxes routes
    Route::group(['middleware' => ['can:taxes']], function () {
        Route::get('/taxes', [TaxeController::class, 'index'])->name('taxe.index');
        Route::post('/addtaxe', [TaxeController::class, 'store'])->name('taxe.add');
        Route::get('/onetaxen/{id}', [TaxeController::class, 'one_taxe'])->name('taxe.one');
        Route::post('/updatetaxe/{id}', [TaxeController::class, 'update'])->name('taxe.update');
        Route::get('/deletetaxe/{id}', [TaxeController::class, 'delete'])->name('taxe.delete');
    });

    //categorie routes
    Route::group(['middleware' => ['can:categories']], function () {
        Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
        Route::post('/addcategorie', [CategorieController::class, 'store'])->name('categories.add');
        Route::get('/onecategorie/{id}', [CategorieController::class, 'one_categorie'])->name('categories.one');
        Route::post('/updatecategorie/{id}', [CategorieController::class, 'update'])->name('categories.update');
        Route::get('/deletecategorie/{id}', [CategorieController::class, 'delete'])->name('categories.delete');
    });

    //notif routes
    Route::get('/readnotif', [NotifController::class, 'read_notifs'])->name('notifs.read');
	    Route::get('/pending-conge-notifications', [NotifController::class, 'pending_conge_notifications'])->name('pending-conge-notifications');

    //users routes
    Route::group(['middleware' => ['can:utilisateurs']], function () {

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/adduser', [UserController::class, 'add'])->name('users.add');
        Route::post('/storeuser', [UserController::class, 'store'])->name('users.store');
        Route::get('/updateuser/{id}', [UserController::class, 'update'])->name('users.update');
        Route::post('/storeupdateuser/{id}', [UserController::class, 'store_update'])->name('users.storeupdate');
        Route::get('/deleteuser/{id}', [UserController::class, 'delete'])->name('users.delete');
    });

    //roles routes
    Route::group(['middleware' => ['can:roles']], function () {

        Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
        Route::get('/addroles', [RolesController::class, 'create'])->name('roles.add');
        Route::post('/storerole', [RolesController::class, 'store'])->name('roles.store');
        Route::get('/updaterole/{id}', [RolesController::class, 'update'])->name('roles.update');
        Route::post('/updatestorerole/{id}', [RolesController::class, 'update_store'])->name('roles.updatestore');
        Route::get('/deleterole/{id}', [RolesController::class, 'delete'])->name('roles.delete');
    });


    //intervention routes
        //intervention routes
    Route::group(['middleware' => ['can:interventions']], function () {
        Route::get('/interventions', [InterventionController::class, 'index'])->name('interventions.index');
        Route::get('/get-contracts/{clientId}', [InterventionController::class, 'getContracts']);
        Route::get('/get-contract-dates/{contractId}', [InterventionController::class, 'getContractDates']);

        Route::get('/addintervention', [InterventionController::class, 'add'])->name('interventions.add');
        Route::get('/newintervention/{date?}', [InterventionController::class, 'create'])->name('interventions.create');
		
        Route::post('/storeintervention', [InterventionController::class, 'store'])->name('interventions.store');
		 Route::put('/updateintervention/{id}', [InterventionController::class, 'update'])->name('interventions.update');
        Route::get('/editintervention/{id}', [InterventionController::class, 'edit'])->name('interventions.edit');
		        Route::put('/interventions/update/date/{id}', [InterventionController::class, 'updateDate']);

        Route::post('/updatestoreintervention/{id}', [InterventionController::class, 'store_update'])->name('interventions.update.store');
        Route::get('/deleteintervention/{id}', [InterventionController::class, 'delete'])->name('interventions.delete');
        Route::get('/printintervention/{id}', [InterventionController::class, 'print'])->name('interventions.print');

        //calendar routes
        Route::get('/oldplannings', [PlanningController::class, 'index'])->name('plannings.index');
        Route::get('/newplannings', [PlanningController::class, 'index'])->name('plannings.gear2');

    });


    //fournisseurs routes
    Route::group(['middleware' => ['can:fournisseurs']], function () {
        Route::get('/fournisseurs', [FournisseurController::class, 'index'])->name('fournisseur.index');
        Route::get('/addfournisseur', [FournisseurController::class, 'create'])->name('fournisseur.add');
        Route::post('/storefournisseur', [FournisseurController::class, 'store'])->name('fournisseur.store');
        Route::get('/updatefournisseur/{id}', [FournisseurController::class, 'update'])->name('fournisseur.update');
        Route::post('/updatestorefournisseur/{id}', [FournisseurController::class, 'store_update'])->name('fournisseur.update.store');
        Route::get('/deletefournisseur/{id}', [FournisseurController::class, 'delete'])->name('fournisseur.delete');
    });
    //depense routes
    Route::group(['middleware' => ['can:depenses']], function () {
        Route::get('/depense', [DepenseController::class, 'index'])->name('depense.index');
        Route::get('/adddepense', [DepenseController::class, 'create'])->name('depense.add');
        Route::post('/storedepense', [DepenseController::class, 'store'])->name('depense.store');
        Route::get('/updatedepense/{id}', [DepenseController::class, 'update'])->name('depense.update');
        Route::post('/updatestoredepense/{id}', [DepenseController::class, 'store_update'])->name('depense.update.store');
        Route::get('/deletedepense/{id}', [DepenseController::class, 'delete'])->name('depense.delete');

        //export
        Route::get('/exportdepense/{date_debut}/{date_fin}', [DepenseController::class, 'export'])->name('depense.export');
    });

    //groupes routes
    Route::group(['middleware' => ['can:groupes']], function () {
        Route::get('/groupe', [GroupeController::class, 'index'])->name('groupe.index');
        Route::get('/addgroupe', [GroupeController::class, 'create'])->name('groupe.add');
        Route::post('/storegroupe', [GroupeController::class, 'store'])->name('groupe.store');
        Route::get('/updategroupe/{id}', [GroupeController::class, 'update'])->name('groupe.update');
        Route::post('/updatestoregroupe/{id}', [GroupeController::class, 'store_update'])->name('groupe.update.store');
        Route::get('/deletegroupe/{id}', [GroupeController::class, 'delete'])->name('groupe.delete');
    });
    //chiffre affaire
    Route::group(['middleware' => ['can:chiffres']], function () {
        Route::get('/chiffreaffaire', [ChiffreaffaireController::class, 'index'])->name('chiffreaffaire.index');
        Route::get('/filtrechiffreaffaire', [ChiffreaffaireController::class, 'filtre'])->name('chiffreaffaire.filtre');
    });
    //crm routes
    Route::group(['middleware' => ['can:opportunites']], function () {

        Route::post('/storeleads', [OpportunityController::class, 'leads'])->name('crm.leads');
        Route::get('/newcrm', [OpportunityController::class, 'new_index'])->name('crm.index_new');
        Route::get('/oneopp/{id}', [OpportunityController::class, 'one_opp'])->name('crm.one_opp');
        Route::get('/delete_file_opp/{id}', [OpportunityController::class, 'delete_file'])->name('crm.delete_file');
        Route::get('/update_file_opp/{id}', [OpportunityController::class, 'update_file'])->name('crm.update_file');
        Route::post('/update_file_store/{id}', [OpportunityController::class, 'update_store_file'])->name('crm.update_store_file');
        Route::post('/save_profil', [OpportunityController::class, 'save_profil'])->name('crm.save_profil');
        Route::post('/save_notes', [OpportunityController::class, 'save_notes'])->name('crm.save_notes');
        Route::post('/storedocument', [OpportunityController::class, 'create_document'])->name('crm.create_document');
        Route::get('/devis_opp/{id}', [OpportunityController::class, 'devis_opp'])->name('crm.devis_opp');

        Route::get('/getopp', function () {
            return session('opp_id');
        });



        Route::get('/crm', [OpportunityController::class, 'index'])->name('crm.index');
        Route::post('/storecrm', [OpportunityController::class, 'store'])->name('crm.store');
        Route::post('/storeupdatecrm/{id}', [OpportunityController::class, 'store_update'])->name('crm.store_update');
        Route::post('/rightchange', [OpportunityController::class, 'change_right'])->name('crm.change_right');
        Route::get('/oneopportunite/{id}', [OpportunityController::class, 'oneopportunite'])->name('crm.oneopportunite');
        Route::get('/deleteopportunite/{id}', [OpportunityController::class, 'delete'])->name('crm.delete.opportunite');
        Route::post('/createdevisopportunite', [OpportunityController::class, 'devis_manuelle'])->name('crm.create_devis');
        Route::post('/createfactureopportunite', [OpportunityController::class, 'facture_manuelle'])->name('crm.create_facture');
        Route::get('/enattentestep/{id}', [OpportunityController::class, 'en_attente'])->name('crm.en_attente');
    });

    //bonlivraison routes

    Route::group(['middleware' => ['can:bonlivraison']], function () {
        Route::get('/bonlivraisons', [BonlivraisonController::class, 'index'])->name('bonlivraisons.index');
        Route::post('/storebonlivraisons', [BonlivraisonController::class, 'store'])->name('bonlivraisons.store');
        Route::get('/bonlivraisonsupdate/{id}', [BonlivraisonController::class, 'update'])->name('bonlivraisons.update');
        Route::post('/storebonlivraisonsupdate/{id}', [BonlivraisonController::class, 'store_update'])->name('bonlivraisons.update.store');
        Route::get('/printbonlivraisonsupdate/{id}', [BonlivraisonController::class, 'print'])->name('bonlivraisons.print');
        Route::get('/deletebonlivraisonsupdate/{id}', [BonlivraisonController::class, 'delete'])->name('bonlivraisons.delete');
    });

    //contact crm
    Route::group(['middleware' => ['can:contacts']], function () {
        Route::get('/contactscrm', [ContactController::class, 'index'])->name('crm.contact.index');
        Route::get('/addcontactcrm', [ContactController::class, 'add'])->name('crm.add.contact');
        Route::post('/storecontactcrm', [ContactController::class, 'store'])->name('crm.store.contact');
        Route::get('/updatecrm/{id}', [ContactController::class, 'update_contactcrm'])->name('crm.update_contactcrm');
        Route::post('/updatecrmstore/{id}', [ContactController::class, 'update_store'])->name('crm.update_store');
        Route::get('/deletecrmcontact/{id}', [ContactController::class, 'delete'])->name('crm.delete');
        Route::post('/importcontactcrm', [ContactController::class, 'import'])->name('crm.store.import');
        Route::get('/filedownload', [ContactController::class, 'download'])->name('crm.download');
    });
    //calendars
    Route::group(['middleware' => ['can:calendrier']], function () {
        Route::get('/calendars', [CalendarController::class, 'index'])->name('crm.calendars');
        Route::post('/addevent', [CalendarController::class, 'add_events'])->name('crm.calendars.add_events');
        Route::post('/updateevent', [CalendarController::class, 'update_drop'])->name('crm.calendars.update_drop');
        Route::get('/getevent/{id}', [CalendarController::class, 'one_event'])->name('crm.one_event');
        Route::post('/update_events', [CalendarController::class, 'update_events'])->name('crm.calendars.update_events');
        Route::get('/deletevent/{id}', [CalendarController::class, 'delete_event'])->name('crm.delete_event');
    });
    //contrats
    Route::group(['middleware' => ['can:contrat']], function () {
        Route::get('/contrats', [ContratController::class, 'index'])->name('contrats.index');
        Route::get('/createcontrat', [ContratController::class, 'create'])->name('contrats.create');
        Route::post('/storecontrat', [ContratController::class, 'store'])->name('contrats.store');
        Route::get('/updatecontrat/{id}', [ContratController::class, 'update'])->name('contrats.update');
        Route::post('/updatestore/{id}', [ContratController::class, 'update_store'])->name('contrats.update.store');
        Route::get('/deletecontrat/{id}', [ContratController::class, 'delete'])->name('contrats.delete');
        Route::get('/onecontrat/{id}', [ContratController::class, 'one_contrat'])->name('contrats.onecontrat');
        Route::get('/liaison/{id_old}/id_new', [ContratController::class, 'liaison'])->name('contrats.liaison');
        Route::get('/get-contract-dates/{clientId}', [ContratController::class, 'getContractDates'])->name('get.contract.dates');

    });

    //devises routes
    Route::group(['middleware' => ['can:devise']], function () {
        Route::get('/devises', [DeviseController::class, 'index'])->name('devise.index');
        Route::post('/adddevise', [DeviseController::class, 'store'])->name('devise.add');
        Route::get('/onedevise/{id}', [DeviseController::class, 'one_devise'])->name('devise.one');
        Route::post('/updatedevise/{id}', [DeviseController::class, 'update'])->name('devise.update');
        Route::get('/deletedevise/{id}', [DeviseController::class, 'delete'])->name('devise.delete');
    });

    //boncommande routes
    Route::group(['middleware' => ['can:boncommande']], function () {
        Route::get('/boncommande', [BoncommandeController::class, 'index'])->name('boncommande.index');
        Route::get('/editboncommande/{id}', [BoncommandeController::class, 'update'])->name('boncommande.update');
        Route::post('/addboncommande', [BoncommandeController::class, 'store'])->name('boncommande.add');
        Route::post('/update_store_boncommande/{id}', [BoncommandeController::class, 'update_store'])->name('boncommande.update_store');
        Route::get('/printboncommande/{id}', [BoncommandeController::class, 'print'])->name('boncommande.print');
        Route::get('/deleteboncommande/{id}', [BoncommandeController::class, 'delete'])->name('boncommande.delete');
    });

    //parametres routes

    Route::group(['middleware' => ['can:conges_admin']], function () {
        Route::get('/parametres', [ParametreController::class, 'index'])->name('parametre.index');
        Route::post('/addparametre', [ParametreController::class, 'store'])->name('parametre.add');
        Route::get('/oneparametren/{id}', [ParametreController::class, 'one_parametre'])->name('parametre.one');
        Route::post('/updateparametre/{id}', [ParametreController::class, 'update'])->name('parametre.update');
        Route::get('/deleteparametre/{id}', [ParametreController::class, 'delete'])->name('parametre.delete');
    });


    //parametres oem

    Route::group(['middleware' => ['can:conges_admin']], function () {
        Route::get('/oem', [OemparametreController::class, 'index'])->name('parametres.index');
        Route::post('/addoemparametre', [OemparametreController::class, 'store'])->name('parametres.add');
        Route::get('/oneoemparametren/{id}', [OemparametreController::class, 'one_oemparametre'])->name('parametres.one');
        Route::post('/updateoemparametre/{id}', [OemparametreController::class, 'update'])->name('parametres.update');
        Route::get('/deleteoemparametre/{id}', [OemparametreController::class, 'delete'])->name('parametres.delete');
    });


    //congés routes
    Route::post('/changestatus', [CongeController::class, 'change_status'])->name('conges.change_status');

    Route::group(['middleware' => ['can:conges']], function () {
        Route::get('/conges', [CongeController::class, 'index'])->name('conges.index');
        Route::post('/storeconges', [CongeController::class, 'store'])->name('conges.store');
        Route::get('/addconges', [CongeController::class, 'create'])->name('conges.add');
    });

    Route::group(['middleware' => ['can:conges_admin']], function () {
        Route::get('/congesadmin', [CongeController::class, 'admin'])->name('conges.admin');
        Route::post('/update_store_conges/{id}', [CongeController::class, 'update_store'])->name('conges.update_store');
        Route::get('/deleteconges/{id}', [CongeController::class, 'delete'])->name('conges.delete');
    });
});

    //stock routes
    Route::get('/onestock/{id}', [StockController::class, 'one_stock'])->name('stock.onestock');

    // Group routes with middleware for stock management
    Route::group(['middleware' => ['can:stock']], function () {
       
    });
 Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
        Route::get('/entreestock', [StockController::class, 'entree'])->name('stock.entree');

        Route::get('/sortiestock', [StockController::class, 'sortie'])->name('stock.sortie');

        Route::get('/stocks/emplacement', [StockController::class, 'emplacement'])->name('stock.emplacement');
        Route::post('/stocks/emplacement', [StockController::class, 'storeEmplacement'])->name('stock.store.emplacement');

        Route::get('/stocks/{id}/edit', [StockController::class, 'edit'])->name('stock.edit');
        Route::put('/stocks/{id}', [StockController::class, 'update'])->name('stock.update');

        Route::get('/stocks/emplacement/create', [StockController::class, 'createEmplacement'])->name('stock.create.emplacement');
        Route::delete('/stocks/emplacement/{id}', [StockController::class, 'deleteEmplacement'])->name('stock.delete.emplacement');
        Route::get('/stocks/emplacement/{id}/edit', [StockController::class, 'editEmplacement'])->name('stock.edit.emplacement');
        Route::put('/stocks/emplacement/{id}', [StockController::class, 'updateEmplacement'])->name('stock.update.emplacement');


        Route::get('/deletestock/{id}', [StockController::class, 'delete'])->name('stock.delete');
        Route::post('/update-stock', [StockController::class, 'store_update'])->name('update.stock');
        Route::post('/update-stock-qte', [StockController::class, 'store_update_qte'])->name('update.stockqte');
        Route::post('/upload-catalogue-stock', [StockController::class, 'uploadCatalogueStock'])->name('stock.import');
Route::post('/stock/importmateriel', [StockController::class, 'importmateriel'])->name('stock.importmateriel');
Route::post('/importstkLicence', [StockController::class, 'import'])->name('stock.importt');
Route::get('stkLicence_template', function () {
    return response()->download(public_path('stkLicence_template.xlsx'));
})->name('stkLicence.template');

Route::get('stkMateriel_template', function () {
    return response()->download(public_path('stkMateriel_template.xlsx'));
})->name('stkMateriel.template');
Route::get('/etat-stock', [StockController::class, 'etatStock'])->name('stock.etat');
Route::get('/api/catalogues-by-category/{categoryId}', [CatalogueController::class, 'getCataloguesByCategory']);


//bonlivraison routes
// Route::get('/bonlivraisons', [BonlivraisonController::class, 'index'])->name('bonlivraisons.index');
// Route::post('/addbonlivraisons', [BonlivraisonController::class, 'store'])->name('bonlivraisons.add');
// Route::get('/updatebonlivraisons/{id}', [BonlivraisonController::class, 'update'])->name('bonlivraisons.update');
// Route::post('/savebonlivraisons/{id}', [BonlivraisonController::class, 'save'])->name('bonlivraisons.save');
// Route::get('/printbonlivraisons/{id}', [BonlivraisonController::class, 'print'])->name('bonlivraisons.print');


Route::get('/factures/print/{id}', [FactureController::class, 'print'])->name('factures.printt');
Route::post('/update-order', [App\Http\Controllers\FactureController::class, 'updateOrder']);
Route::post('/update-product-order', [FactureController::class, 'updateProductOrder']);
Route::get('/catalogues/client-products', [CatalogueController::class, 'clientProducts'])
    ->name('catalogues.client-products');
Route::post('/catalogues/client-products/filter', [CatalogueController::class, 'filterClientProducts'])->name('catalogues.client-products.filter');