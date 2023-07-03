<?php

namespace App\Http\Controllers;

use App\Http\Requests\RetourAchat\StoreRetourAchatRequest;
use App\Http\Requests\RetourAchat\UpdateRetourAchatRequest;
use App\Models\Company;
use App\Models\LineReturnPurchase;
use App\Models\Product;
use App\Models\ReturnPurchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;

class ReturnPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers=Supplier::all();
        $returnpurchases=ReturnPurchase::all();
        return view('pages.returnachat.index',compact('returnpurchases','suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers=Supplier::all();
        $products = Product::all();
        return view('pages.returnachat.create',compact('products','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRetourAchatRequest $request)
    {
        $returnPurchase=new ReturnPurchase();
        $returnPurchase->description_return_purchase=$request->description_return_purchase;
        $returnPurchase->total_return_purchase=$request->total_return_purchase;
        $returnPurchase->suppliers_id=$request->suppliers_id;
        $returnPurchase->users_id=Auth::user()->id;
        $returnPurchase->save();
        foreach ($request->products_id as $key => $products_id) {
           $linereturnpurchase=new LineReturnPurchase();
           $linereturnpurchase->products_id=$request->products_id[$key];
           $linereturnpurchase->qty_line_return_purchase=$request->qty_line_return_purchase[$key];
           $linereturnpurchase->price_return_purchase=$request->price_return_purchase[$key];
           $linereturnpurchase->subtotal_return_purchase=$request->subtotal_return_purchase[$key];
           $linereturnpurchase->return_purchases_id=$returnPurchase->id;
           $linereturnpurchase->save();
           $product = Product::where('id', $request->products_id[$key])->decrement('stock_actuel', $request->qty_line_return_purchase[$key]);
        }

        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $returnPurchase=ReturnPurchase::findOrFail($id);
        $lignereturnPurchases=LineReturnPurchase::where('return_purchases_id',$id)->get();
        return view('pages.returnachat.show',compact('returnPurchase','lignereturnPurchases'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $returnPurchase=ReturnPurchase::findOrFail($id);
        $lignereturnPurchases=LineReturnPurchase::where('return_purchases_id',$id)->get();
        $suppliers=Supplier::all();
        $products=Product::all();
        return view('pages.returnachat.edit',compact('returnPurchase','lignereturnPurchases','suppliers','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRetourAchatRequest $request, string $id)
    {
        $returnPurchase=ReturnPurchase::findOrFail($id);
        $lignereturnPurchases=LineReturnPurchase::where('return_purchases_id',$id)->get();
        foreach ($lignereturnPurchases as  $lignereturnPurchase) {
            $product = Product::find($lignereturnPurchase->products_id);
            $product->increment('stock_actuel', $lignereturnPurchase->qty_line_return_purchase);
        }
        $lignereturnPurchases=LineReturnPurchase::where('return_purchases_id',$id)->delete();
        $returnPurchase->description_return_purchase=$request->description_return_purchase;
        $returnPurchase->total_return_purchase=$request->total_return_purchase;
        $returnPurchase->suppliers_id=$request->suppliers_id;
        $returnPurchase->users_id=Auth::user()->id;
        $returnPurchase->save();
        foreach ($request->products_id as $key => $products_id) {
           $linereturnpurchase=new LineReturnPurchase();
           $linereturnpurchase->products_id=$request->products_id[$key];
           $linereturnpurchase->qty_line_return_purchase=$request->qty_line_return_purchase[$key];
           $linereturnpurchase->price_return_purchase=$request->price_return_purchase[$key];
           $linereturnpurchase->subtotal_return_purchase=$request->subtotal_return_purchase[$key];
           $linereturnpurchase->return_purchases_id=$returnPurchase->id;
           $linereturnpurchase->save();
           $product = Product::where('id', $request->products_id[$key])->decrement('stock_actuel', $request->qty_line_return_purchase[$key]);
        }
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('retournachats.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $returnPurchase=ReturnPurchase::findOrFail($id);
        $lignereturnPurchases=LineReturnPurchase::where('return_purchases_id',$id)->get();
        foreach ($lignereturnPurchases as  $lignereturnPurchase) {
            $product = Product::find($lignereturnPurchase->products_id);
            $product->increment('stock_actuel', $lignereturnPurchase->qty_line_return_purchase);
        }
        LineReturnPurchase::where('return_purchases_id',$id)->delete();
        $returnPurchase->delete();
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien supprimé !");

        return redirect()->back();
    }
    public function pdftableretourachat(){
        $returnpurchases=ReturnPurchase::all();
        $data = [
            'returnpurchases' =>  $returnpurchases
        ];

        $pdf = PDF::loadView('pages.returnachat.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listeRetourAchats.pdf');
    }
    public function pdfretourachat($id){
        $returnPurchase=ReturnPurchase::findOrFail($id);
        $company=Company::first();
        $lignereturnPurchases=LineReturnPurchase::where('return_purchases_id',$id)->get();
        $data = [
            'returnPurchase' => $returnPurchase,
            'company'=>$company,
            'lignereturnPurchases'=> $lignereturnPurchases

        ];

        $pdf = PDF::loadView('pages.returnachat.retournachatpdf', $data);

        return $pdf->download('retourachat.pdf');

    }
}
