<?php

namespace App\Http\Controllers;

use App\Http\Requests\Estimate\StoreEstimateRequest;
use App\Http\Requests\Estimate\UpdateEstimateRequest;
use App\Models\Company;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\Estimate;
use App\Models\LineCustomerOrder;
use App\Models\LineEstimate;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;

class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers=Customer::all();
        $estimates=Estimate::all();
        return view('pages.devis.index',compact('estimates','customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers=Customer::all();
        $products = Product::all();
        return view('pages.devis.create',compact('products','customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstimateRequest $request)
    {
        $estimate=new Estimate();
        $estimate->description_estimates=$request->description_estimates;
        $estimate->total_estimates=$request->total_estimates;
        $estimate->customers_id=$request->customers_id;
        $estimate->users_id=Auth::user()->id;
        $estimate->save();
        foreach ($request->products_id as $key => $products_id) {
           $lineestimate=new LineEstimate();
           $lineestimate->products_id=$request->products_id[$key];
           $lineestimate->qty_line_estimate=$request->qty_line_estimate[$key];
           $lineestimate->price_line_estimate=$request->price_line_estimate[$key];
           $lineestimate->subtotal_line_estimate=$request->subtotal_line_estimate[$key];
           $lineestimate->estimates_id=$estimate->id;
           $lineestimate->save();
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
        $estimate=Estimate::findOrFail($id);
        $estimates=Estimate::all();
        $ligneestimates=LineEstimate::where('estimates_id',$id)->get();
        return view('pages.devis.show',compact('estimate','ligneestimates','estimates'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customers=Customer::all();
        $products = Product::all();
        $estimate=Estimate::findOrFail($id);
        $ligneestimates=LineEstimate::where('estimates_id',$id)->get();
        return view('pages.devis.edit',compact('estimate','ligneestimates','customers','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstimateRequest $request, string $id)
    {
        $estimate=Estimate::findOrFail($id);
        $ligneestimates=LineEstimate::where('estimates_id',$id)->delete();
        $estimate->description_estimates=$request->description_estimates;
        $estimate->total_estimates=$request->total_estimates;
        $estimate->customers_id=$request->customers_id;
        $estimate->users_id=Auth::user()->id;
        $estimate->save();
        foreach ($request->products_id as $key => $products_id) {
            $lineestimate=new LineEstimate();
            $lineestimate->products_id=$request->products_id[$key];
            $lineestimate->qty_line_estimate=$request->qty_line_estimate[$key];
            $lineestimate->price_line_estimate=$request->price_line_estimate[$key];
            $lineestimate->subtotal_line_estimate=$request->subtotal_line_estimate[$key];
            $lineestimate->estimates_id=$estimate->id;
            $lineestimate->save();
        }
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('retournventes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $estimate=Estimate::findOrFail($id);
        $ligneestimates=LineEstimate::where('estimates_id',$id)->delete();
        $estimate->delete();
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien supprimé !");

        return redirect()->back();
    }
    public function updatestatus(Request $request,$id){
        $estimate=Estimate::findOrFail($id);
        $lingeestimates=LineEstimate::where('estimates_id',$id)->get();
        $estimate->status_estimates=$request->status_estimates;
        $estimate->save();
        if($request->status_estimates=="valid"){
            $CustomersOrder=new CustomerOrder();
            $CustomersOrder->description_customer_order=$estimate->description_estimates;
            $CustomersOrder->total_customer_order=$estimate->total_estimates;
            $CustomersOrder->customers_id=$estimate->customers_id;
            $CustomersOrder->users_id=Auth::user()->id;
            $CustomersOrder->save();
             foreach ($lingeestimates as  $lingeestimate) {
                 $linecustomerorder=new LineCustomerOrder();
                 $linecustomerorder->products_id = $lingeestimate->products_id;
                 $linecustomerorder->qty_line_customer_order = $lingeestimate->qty_line_estimate;
                 $linecustomerorder->price_line_customer_order = $lingeestimate->price_line_estimate;
                 $linecustomerorder->subtotal_line_customer_order = $lingeestimate->subtotal_line_estimate;
                 $linecustomerorder->customer_orders_id = $CustomersOrder->id;
                 $linecustomerorder->save();
              }
         }

         return back()->with('success','Le status est modifier avec success');
    }
    public function pdftabledevis(){
        $restimates=Estimate::all();
        $data = [
            'restimates' =>  $restimates
        ];

        $pdf = PDF::loadView('pages.devis.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listeDevis.pdf');
    }
    public function pdfdevis($id){
        $estimate=Estimate::findOrFail($id);
        $ligneestimates=LineEstimate::where('estimates_id',$id)->get();
        $company=Company::first();
        $data = [
            'estimate' => $estimate,
            'company'=>$company,
            'ligneestimates'=> $ligneestimates

        ];

        $pdf = PDF::loadView('pages.devis.devispdf', $data);

        return $pdf->download('devis.pdf');

    }
}
