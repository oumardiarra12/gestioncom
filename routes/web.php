<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ComptoirController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerInvoiceController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\CustomerPaymentController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseInvoiceController;
use App\Http\Controllers\PurchaseOrdersController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\ReturnCustomerController;
use App\Http\Controllers\ReturnPurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierPaymentController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('pages.dashboard.dashboard');
// });

//Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home.index');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'Login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
   // Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');
    Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
    Route::put('/profileupdate',[ProfileController::class,'update'])->name('profile.update');
      /**
     * Route utilisateur
     */
    Route::controller(RegisterController::class)->group(function () {
        Route::prefix('/utilisateur')->group(function () {
            Route::name('utilisateur.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'delete')->name('delete');
            });
        });
    });
      /**
     * Route Societe
     */
    Route::controller(CompanyController::class)->group(function () {
        Route::prefix('/companies')->group(function () {
            Route::name('companies.')->group(function () {
                Route::get('/create', 'createorupdate')->name('create');
                Route::post('/store', 'store')->name('store');
            });
        });
    });
      /**
     * Route unites
     */
    Route::controller(UnitController::class)->group(function () {
        Route::prefix('/unites')->group(function () {
            Route::name('unites.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftableunite')->name('pdftable');
                Route::get('exportunite','exportunite')->name('exportunite');
            });
        });
    });

      /**
     * Route categories
     */
    Route::controller(CategorieController::class)->group(function () {
        Route::prefix('/categories')->group(function () {
            Route::name('categories.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftablecategorie')->name('pdftable');
                Route::get('exportcategorie','exportcategorie')->name('exportcategorie');
            });
        });
    });
    /**
     * Route produits
     */
    Route::controller(ProductController::class)->group(function () {
        Route::prefix('/produits')->group(function () {
            Route::name('produits.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createproduct', 'create')->name('createproduct');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('listecodebarre','generecodebarre')->name('listecodebarre');
                Route::get('generercodebarre','genererpdfcodebarre')->name('generercodebarre');
                Route::get('importproduit','importproduit')->name('importproduit');
                Route::post('storeproduit','storeproduit')->name('storeproduit');
                Route::get('pdftable','pdftableproduit')->name('pdftable');
                Route::get('exportproduit','exportproduit')->name('exportproduit');
            });
        });
    });
      /**
     * Route fournisseurs
     */
    Route::controller(SupplierController::class)->group(function () {
        Route::prefix('/fournisseurs')->group(function () {
            Route::name('fournisseurs.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createfournisseur', 'create')->name('createfournisseur');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('importfournisseur','importfournisseur')->name('importfournisseur');
                Route::post('storefournisseur','storefournisseur')->name('storefournisseur');
                Route::get('pdftable','pdftablefournisseur')->name('pdftable');
                Route::get('exportfournisseur','exportfournisseur')->name('exportfournisseur');
            });
        });
    });
     /**
     * Route Commande Achat
     */
    Route::controller(PurchaseOrdersController::class)->group(function () {
        Route::prefix('/commandeachats')->group(function () {
            Route::name('commandeachats.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createcmdachat', 'create')->name('createcmdachat');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftablepurchaseorder')->name('pdftable');
                Route::get('commandeachatpdf/{id}','pdfpurchaseorder')->name('commandeachatpdf');
                // Route::put('/updatestatus/{id}', 'updatestatus')->name('updatestatus');
                Route::get('createrecept/{id}','receptcreate')->name('createrecept');
                Route::post('/receptstore/{id}', 'receptstore')->name('receptstore');

            });
        });
    });
     /**
     * Route Reception
     */
    Route::controller(ReceptionController::class)->group(function () {
        Route::prefix('/receptions')->group(function () {
            Route::name('receptions.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createreception', 'create')->name('createreception');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftablereception')->name('pdftable');
                Route::get('receptionpdf/{id}','pdfreception')->name('receptionpdf');
            });
        });
    });
     /**
     * Route Facture Commande Achat
     */
    Route::controller(PurchaseInvoiceController::class)->group(function () {
        Route::prefix('/achatfactures')->group(function () {
            Route::name('achatfactures.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create/{id}', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store/{id}', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftableachatfacture')->name('pdftable');
                Route::get('achatfacturepdf/{id}','pdfachatfacture')->name('achatfacturepdf');

            });
        });
    });
     /**
     * Route Payement Fournisseur
     */
    Route::controller(SupplierPaymentController::class)->group(function () {
        Route::prefix('/supplierpayements')->group(function () {
            Route::name('supplierpayements.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create/{id}', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store/{id}', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                //Route::get('/createsupplierpayment/{id}', 'createsupplierpayment')->name('createsupplierpayment');
                // Route::get('pdftable','pdftableachatfacture')->name('pdftable');
                Route::get('supplierpayementpdf/{id}','pdfsupplierpayement')->name('supplierpayementpdf');
                Route::get('showpayment/{id}','showsupplierpayment')->name('showpayment');
            });
        });
    });
     /**
     * Route Retourn Commande Achat
     */
    Route::controller(ReturnPurchaseController::class)->group(function () {
        Route::prefix('/retournachats')->group(function () {
            Route::name('retournachats.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftableretourachat')->name('pdftable');
                Route::get('pdfretourachat/{id}','pdfretourachat')->name('pdfretourachat');
            });
        });
    });

      /**
     * Route clients
     */
    Route::controller(CustomerController::class)->group(function () {
        Route::prefix('/clients')->group(function () {
            Route::name('clients.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createclient', 'create')->name('createclient');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('importclient','importclient')->name('importclient');
                Route::post('storeclient','storeclient')->name('storeclient');
                Route::get('pdftable','pdftableclient')->name('pdftable');
                Route::get('exportclient','exportclient')->name('exportclient');
            });
        });
    });
    /**
     * Route categories depenses
     */
    Route::controller(ExpenseTypeController::class)->group(function () {
        Route::prefix('/typedepenses')->group(function () {
            Route::name('typedepenses.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftabletypedepense')->name('pdftable');
                Route::get('exporttypedepense','exporttypedepense')->name('exporttypedepense');
            });
        });
    });
     /**
     * Route depenses
     */
    Route::controller(ExpenseController::class)->group(function () {
        Route::prefix('/depenses')->group(function () {
            Route::name('depenses.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftabledepense')->name('pdftable');
                Route::get('depensepdf/{id}','depensepdf')->name('depensepdf');
                Route::get('exportdepense','exportdepense')->name('exportdepense');
            });
        });
    });
      /**
     * Route Commande Vente
     */
    Route::controller(CustomerOrderController::class)->group(function () {
        Route::prefix('/commandeventes')->group(function () {
            Route::name('commandeventes.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createcmdvente', 'create')->name('createcmdvente');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftablecustomerorder')->name('pdftable');
                Route::get('commandeventepdf/{id}','pdfcustomerorder')->name('commandeventepdf');
                Route::get('createdelivery/{id}','deliverycreate')->name('createdelivery');
                Route::post('/deliverystore/{id}', 'deliverystore')->name('deliverystore');

            });
        });
    });
     /**
     * Route Livraison
     */
    Route::controller(LivraisonController::class)->group(function () {
        Route::prefix('/livraisons')->group(function () {
            Route::name('livraisons.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createlivraison', 'create')->name('createlivraison');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftablelivraison')->name('pdftable');
                Route::get('livraisonpdf/{id}','pdflivraison')->name('livraisonpdf');
            });
        });
    });
     /**
     * Route Facture Commande Vente
     */
    Route::controller(CustomerInvoiceController::class)->group(function () {
        Route::prefix('/ventefactures')->group(function () {
            Route::name('ventefactures.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create/{id}', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store/{id}', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftableventefacture')->name('pdftable');
                Route::get('ventefacturepdf/{id}','pdfventefacture')->name('ventefacturepdf');

            });
        });
    });
     /**
     * Route Payement Client
     */
    Route::controller(CustomerPaymentController::class)->group(function () {
        Route::prefix('/customerpayements')->group(function () {
            Route::name('customerpayements.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create/{id}', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store/{id}', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                //Route::get('/createsupplierpayment/{id}', 'createsupplierpayment')->name('createsupplierpayment');
                // Route::get('pdftable','pdftableachatfacture')->name('pdftable');
                Route::get('customerpayementpdf/{id}','pdfcustomerpayement')->name('customerpayementpdf');
                Route::get('showpayment/{id}','showcustomerpayment')->name('showpayment');
            });
        });
    });
     /**
     * Route Retourn Commande Vente
     */
    Route::controller(ReturnCustomerController::class)->group(function () {
        Route::prefix('/retournventes')->group(function () {
            Route::name('retournventes.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftableretourvente')->name('pdftable');
                Route::get('pdfretourvente/{id}','pdfretourvente')->name('pdfretourvente');
            });
        });
    });
     /**
     * Route Devis
     */
    Route::controller(EstimateController::class)->group(function () {
        Route::prefix('/devis')->group(function () {
            Route::name('devis.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftabledevis')->name('pdftable');
                Route::get('pdfdevis/{id}','pdfdevis')->name('pdfdevis');
                Route::put('/updatestatus/{id}', 'updatestatus')->name('updatestatus');
            });
        });
    });

});
Route::middleware(['auth', 'user-access:gerant'])->group(function () {

    Route::get('/home', [HomeController::class, 'homegerant'])->name('home.homegerant');
  //  Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');
    Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
    Route::put('/profileupdate',[ProfileController::class,'update'])->name('profile.update');
      /**
     * Route unites
     */
    Route::controller(UnitController::class)->group(function () {
        Route::prefix('/unites')->group(function () {
            Route::name('unites.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftableunite')->name('pdftable');
                Route::get('exportunite','exportunite')->name('exportunite');
            });
        });
    });

      /**
     * Route categories
     */
    Route::controller(CategorieController::class)->group(function () {
        Route::prefix('/categories')->group(function () {
            Route::name('categories.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftablecategorie')->name('pdftable');
                Route::get('exportcategorie','exportcategorie')->name('exportcategorie');
            });
        });
    });
    /**
     * Route produits
     */
    Route::controller(ProductController::class)->group(function () {
        Route::prefix('/produits')->group(function () {
            Route::name('produits.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createproduct', 'create')->name('createproduct');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('listecodebarre','generecodebarre')->name('listecodebarre');
                Route::get('generercodebarre','genererpdfcodebarre')->name('generercodebarre');
                Route::get('importproduit','importproduit')->name('importproduit');
                Route::post('storeproduit','storeproduit')->name('storeproduit');
                Route::get('pdftable','pdftableproduit')->name('pdftable');
                Route::get('exportproduit','exportproduit')->name('exportproduit');
            });
        });
    });
      /**
     * Route fournisseurs
     */
    Route::controller(SupplierController::class)->group(function () {
        Route::prefix('/fournisseurs')->group(function () {
            Route::name('fournisseurs.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createfournisseur', 'create')->name('createfournisseur');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('importfournisseur','importfournisseur')->name('importfournisseur');
                Route::post('storefournisseur','storefournisseur')->name('storefournisseur');
                Route::get('pdftable','pdftablefournisseur')->name('pdftable');
                Route::get('exportfournisseur','exportfournisseur')->name('exportfournisseur');
            });
        });
    });
     /**
     * Route Commande Achat
     */
    Route::controller(PurchaseOrdersController::class)->group(function () {
        Route::prefix('/commandeachats')->group(function () {
            Route::name('commandeachats.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createcmdachat', 'create')->name('createcmdachat');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftablepurchaseorder')->name('pdftable');
                Route::get('commandeachatpdf/{id}','pdfpurchaseorder')->name('commandeachatpdf');
                // Route::put('/updatestatus/{id}', 'updatestatus')->name('updatestatus');
                Route::get('createrecept/{id}','receptcreate')->name('createrecept');
                Route::post('/receptstore/{id}', 'receptstore')->name('receptstore');

            });
        });
    });
     /**
     * Route Reception
     */
    Route::controller(ReceptionController::class)->group(function () {
        Route::prefix('/receptions')->group(function () {
            Route::name('receptions.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createreception', 'create')->name('createreception');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftablereception')->name('pdftable');
                Route::get('receptionpdf/{id}','pdfreception')->name('receptionpdf');
            });
        });
    });
     /**
     * Route Facture Commande Achat
     */
    Route::controller(PurchaseInvoiceController::class)->group(function () {
        Route::prefix('/achatfactures')->group(function () {
            Route::name('achatfactures.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create/{id}', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store/{id}', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftableachatfacture')->name('pdftable');
                Route::get('achatfacturepdf/{id}','pdfachatfacture')->name('achatfacturepdf');

            });
        });
    });
     /**
     * Route Payement Fournisseur
     */
    Route::controller(SupplierPaymentController::class)->group(function () {
        Route::prefix('/supplierpayements')->group(function () {
            Route::name('supplierpayements.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create/{id}', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store/{id}', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                //Route::get('/createsupplierpayment/{id}', 'createsupplierpayment')->name('createsupplierpayment');
                // Route::get('pdftable','pdftableachatfacture')->name('pdftable');
                Route::get('supplierpayementpdf/{id}','pdfsupplierpayement')->name('supplierpayementpdf');
                Route::get('showpayment/{id}','showsupplierpayment')->name('showpayment');
            });
        });
    });
     /**
     * Route Retourn Commande Achat
     */
    Route::controller(ReturnPurchaseController::class)->group(function () {
        Route::prefix('/retournachats')->group(function () {
            Route::name('retournachats.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftableretourachat')->name('pdftable');
                Route::get('pdfretourachat/{id}','pdfretourachat')->name('pdfretourachat');
            });
        });
    });

      /**
     * Route clients
     */
    Route::controller(CustomerController::class)->group(function () {
        Route::prefix('/clients')->group(function () {
            Route::name('clients.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createclient', 'create')->name('createclient');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('importclient','importclient')->name('importclient');
                Route::post('storeclient','storeclient')->name('storeclient');
                Route::get('pdftable','pdftableclient')->name('pdftable');
                Route::get('exportclient','exportclient')->name('exportclient');
            });
        });
    });
    /**
     * Route categories depenses
     */
    Route::controller(ExpenseTypeController::class)->group(function () {
        Route::prefix('/typedepenses')->group(function () {
            Route::name('typedepenses.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftabletypedepense')->name('pdftable');
                Route::get('exporttypedepense','exporttypedepense')->name('exporttypedepense');
            });
        });
    });
     /**
     * Route depenses
     */
    Route::controller(ExpenseController::class)->group(function () {
        Route::prefix('/depenses')->group(function () {
            Route::name('depenses.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftabledepense')->name('pdftable');
                Route::get('depensepdf/{id}','depensepdf')->name('depensepdf');
                Route::get('exportdepense','exportdepense')->name('exportdepense');
            });
        });
    });
      /**
     * Route Commande Vente
     */
    Route::controller(CustomerOrderController::class)->group(function () {
        Route::prefix('/commandeventes')->group(function () {
            Route::name('commandeventes.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createcmdvente', 'create')->name('createcmdvente');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftablecustomerorder')->name('pdftable');
                Route::get('commandeventepdf/{id}','pdfcustomerorder')->name('commandeventepdf');
                Route::get('createdelivery/{id}','deliverycreate')->name('createdelivery');
                Route::post('/deliverystore/{id}', 'deliverystore')->name('deliverystore');

            });
        });
    });
     /**
     * Route Livraison
     */
    Route::controller(LivraisonController::class)->group(function () {
        Route::prefix('/livraisons')->group(function () {
            Route::name('livraisons.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createlivraison', 'create')->name('createlivraison');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftablelivraison')->name('pdftable');
                Route::get('livraisonpdf/{id}','pdflivraison')->name('livraisonpdf');
            });
        });
    });
     /**
     * Route Facture Commande Vente
     */
    Route::controller(CustomerInvoiceController::class)->group(function () {
        Route::prefix('/ventefactures')->group(function () {
            Route::name('ventefactures.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create/{id}', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store/{id}', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftableventefacture')->name('pdftable');
                Route::get('ventefacturepdf/{id}','pdfventefacture')->name('ventefacturepdf');

            });
        });
    });
     /**
     * Route Payement Client
     */
    Route::controller(CustomerPaymentController::class)->group(function () {
        Route::prefix('/customerpayements')->group(function () {
            Route::name('customerpayements.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create/{id}', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store/{id}', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                //Route::get('/createsupplierpayment/{id}', 'createsupplierpayment')->name('createsupplierpayment');
                // Route::get('pdftable','pdftableachatfacture')->name('pdftable');
                Route::get('customerpayementpdf/{id}','pdfcustomerpayement')->name('customerpayementpdf');
                Route::get('showpayment/{id}','showcustomerpayment')->name('showpayment');
            });
        });
    });
     /**
     * Route Retourn Commande Vente
     */
    Route::controller(ReturnCustomerController::class)->group(function () {
        Route::prefix('/retournventes')->group(function () {
            Route::name('retournventes.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftableretourvente')->name('pdftable');
                Route::get('pdfretourvente/{id}','pdfretourvente')->name('pdfretourvente');
            });
        });
    });
     /**
     * Route Devis
     */
    Route::controller(EstimateController::class)->group(function () {
        Route::prefix('/devis')->group(function () {
            Route::name('devis.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftabledevis')->name('pdftable');
                Route::get('pdfdevis/{id}','pdfdevis')->name('pdfdevis');
                Route::put('/updatestatus/{id}', 'updatestatus')->name('updatestatus');
            });
        });
    });
});
Route::middleware(['auth', 'user-access:gestionnaire'])->group(function () {
    Route::get('/user/home', [HomeController::class, 'homeuser'])->name('home.user');
   // Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');
    Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
    Route::put('/profileupdate',[ProfileController::class,'update'])->name('profile.update');
     /**
     * Route Comptoir
     */
    Route::controller(ComptoirController::class)->group(function () {
        Route::prefix('/comptoirs')->group(function () {
            Route::name('comptoirs.')->group(function () {
                //Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                // Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('pdftable','pdftablecomptoir')->name('pdftable');
                Route::get('pdfcomptoir/{id}','pdfcomptoir')->name('pdfcomptoir');
            });
        });
    });
     /**
     * Route clients
     */
    Route::controller(CustomerController::class)->group(function () {
        Route::prefix('/clients')->group(function () {
            Route::name('clients.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createclient', 'create')->name('createclient');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('importclient','importclient')->name('importclient');
                Route::post('storeclient','storeclient')->name('storeclient');
                Route::get('pdftable','pdftableclient')->name('pdftable');
                Route::get('exportclient','exportclient')->name('exportclient');
            });
        });
    });
});
// Route::middleware('auth')->group(function () {
//     Route::get('/', [HomeController::class, 'index'])->name('home.index');
//     Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');
//     Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
//     Route::put('/profileupdate',[ProfileController::class,'update'])->name('profile.update');


// });
