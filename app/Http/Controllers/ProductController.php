<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Http\Requests\Produit\StoreProduitRequest;
use App\Http\Requests\Produit\UpdateProduitRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits=Product::all();
        $categories=Category::all();
        $unites=Unit::all();
        return view('pages.produit.index',compact('produits','categories','unites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $categories=Category::all();
       $unites=Unit::all();
       return view('pages.produit.create',compact('categories','unites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduitRequest $request)
    {
        $imageName="";
        if($request->file('image_product')){
            $imageName = time().'.'.$request->image->extension();
            $request->image_product->storeAs('public/imageproduits', $imageName);
        }else {
            $imageName="produitdefault.jpg";
        }
        Product::create([
            'ref_product'=>'ref01',
            'image_product'=>$imageName,
            'codebarre_product'=>$request->codebarre_product,
            'name_product'=>$request->name_product,
            'price_sale'=>$request->price_sale,
            'price_purchase'=>$request->price_purchase,
            'stock_min'=>$request->stock_min,
            'stock_actuel'=>$request->stock_actuel,
            'description_product'=>$request->description_product,
            'category_id'=>$request->category_id,
            'units_id'=>$request->units_id
        ]);
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produit=Product::findOrFail($id);
        return view('pages.produit.show',compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $produit=Product::findOrFail($id);
       $categories=Category::all();
       $unites=Unit::all();
       return view('pages.produit.edit',compact('produit','categories','unites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduitRequest $request, string $id)
    {
        $produit=Product::findOrFail($id);
        $imageName="";
        if($request->file('image_product')){
            $imageName = time().'.'.$request->image_product->extension();
            $request->image_product->storeAs('public/imageproduits', $imageName);
            $produit->image_product=$imageName;
            $produit->save();
        }
        $produit->update([
            'ref_product'=>$request->ref_product,
            'codebarre_product'=>$request->codebarre_product,
            'name_product'=>$request->name_product,
            'price_sale'=>$request->price_sale,
            'price_purchase'=>$request->price_purchase,
            'stock_min'=>$request->stock_min,
            'stock_actuel'=>$request->stock_actuel,
            'description_product'=>$request->description_product,
            'categories_id'=>$request->categories_id,
            'units_id'=>$request->units_id
        ]);

        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('produits.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $produit=Product::findOrFail($id);
            $produit->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");
            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode)
            {
                case 23000:
                    return back()->with('error','Ce Produit ne peut pas etre supprimer car il est lie a un vente et ou un achat.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }

    }
    public function generecodebarre(){
        $produits=Product::all();
        return view('pages.produit.codebarre',compact('produits'));
    }
    public function genererpdfcodebarre(){
        $produits=Product::all();
        $data = [
            'produits' => $produits
        ];

        $pdf = PDF::loadView('pages.produit.pdfcodebarre', $data);

        return $pdf->download('produits.pdf');
    }
    public function importproduit(){
        return view('pages.produit.import');
    }
    public function storeproduit(Request $request){
        $request->validate([
            'importproduit' => 'required',
        ]);
        Excel::import(new ProductsImport, request()->file('importproduit'));
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");
        return back();
    }
    public function pdftableproduit(){
        $produits=Product::all();
        $data = [
            'produits' => $produits
        ];

        $pdf = PDF::loadView('pages.produit.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listeproduits.pdf');
    }
    public function exportproduit()
    {
        return Excel::download(new ProductsExport, 'produits.xlsx');
    }
}
