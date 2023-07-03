<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comptoir\StoreComptoirRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\comptoir;
use App\Models\Customer;
use App\Models\linecomptoir;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;

class ComptoirController extends Controller
{
    //
    public function create(){
        $comptoirs=comptoir::orderBy("id", "asc")->get();
        $customers=Customer::all();
        $categories=Category::all();
        return view('pages.comptoir.create',compact('customers','categories','comptoirs'));
    }

    public function store(StoreComptoirRequest $request){
        if ($request->total_comptoir==0) {
            return redirect()->back();
        }
        $comptoir=new comptoir();
        $comptoir->total_comptoir=$request->total_comptoir;
        $comptoir->customers_id=$request->customers_id;
        $comptoir->users_id=Auth::user()->id;
        $comptoir->save();
        foreach ($request->products_id as $key => $products_id) {
           $lignecomptoir=new linecomptoir();
           $lignecomptoir->products_id=$request->products_id[$key];
           $lignecomptoir->qty_linecomptoir=$request->qty_linecomptoir[$key];
           $lignecomptoir->price_linecomptoir=$request->price_linecomptoir[$key];
           $lignecomptoir->subtotal_linecomptoir=$request->subtotal_linecomptoir[$key];
           $lignecomptoir->comptoirs_id=$comptoir->id;
           $lignecomptoir->save();
           $product = Product::where('id', $request->products_id[$key])->decrement('stock_actuel', $request->qty_linecomptoir[$key]);
        }

        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }
    public function show($id){
        $comptoir = comptoir::findOrFail($id);
        $company=Company::first();
        $lignecomptoirs = linecomptoir::where("comptoirs_id", $id)->get();
        return view('pages.comptoir.show', compact('comptoir', 'lignecomptoirs','company'));
    }
    public function destroy(string $id)
    {
            $comptoir = comptoir::findOrFail($id);
            $lignecomptoirs = linecomptoir::where("comptoirs_id", $id)->delete();
            $comptoir->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");

            return redirect()->back();

    }
    public function pdftablecomptoir(){
        $comptoirs=comptoir::orderBy("id", "asc")->get();
        $data = [
            'comptoirs' => $comptoirs
        ];

        $pdf = PDF::loadView('pages.comptoir.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listeComptoir.pdf');
    }
    public function pdfcomptoir($id){
        $comptoir = comptoir::findOrFail($id);
        $lignecomptoirs = linecomptoir::where("comptoirs_id", $id)->get();
        $company=Company::first();
        $data = [
            'comptoir' => $comptoir,
            'company'=>$company,
            'lignecomptoirs'=>$lignecomptoirs,
            'date' => date('m/d/Y')

        ];

        $pdf = PDF::loadView('pages.comptoir.pdfticke', $data)->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('ticke.pdf');

    }
}
