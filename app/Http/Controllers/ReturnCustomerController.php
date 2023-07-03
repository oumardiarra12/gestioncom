<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnCustomer\StoreReturnCustomerRequest;
use App\Http\Requests\ReturnCustomer\UpdateReturnCustomerRequest;
use App\Models\Company;
use App\Models\Customer;
use App\Models\LineReturnCustomer;
use App\Models\Product;
use App\Models\ReturnCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
class ReturnCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers=Customer::all();
        $returncustomers=ReturnCustomer::all();
        return view('pages.returnvente.index',compact('returncustomers','customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers=Customer::all();
        $products = Product::all();
        return view('pages.returnvente.create',compact('products','customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReturnCustomerRequest $request)
    {
        $returnCustomer=new ReturnCustomer();
        $returnCustomer->description_return_customer=$request->description_return_customer;
        $returnCustomer->total_return_customer=$request->total_return_customer;
        $returnCustomer->customers_id=$request->customers_id;
        $returnCustomer->users_id=Auth::user()->id;
        $returnCustomer->save();
        foreach ($request->products_id as $key => $products_id) {
           $linereturncustomer=new LineReturnCustomer();
           $linereturncustomer->products_id=$request->products_id[$key];
           $linereturncustomer->qty_line_return_customer=$request->qty_line_return_customer[$key];
           $linereturncustomer->price_return_customer=$request->price_return_customer[$key];
           $linereturncustomer->subtotal_return_customer=$request->subtotal_return_customer[$key];
           $linereturncustomer->return_customers_id=$returnCustomer->id;
           $linereturncustomer->save();
           $product = Product::where('id', $request->products_id[$key])->increment('stock_actuel', $request->qty_line_return_customer[$key]);
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
        $returnCustomer=ReturnCustomer::findOrFail($id);
        $lignereturnCustomers=LineReturnCustomer::where('return_customers_id',$id)->get();
        return view('pages.returnvente.show',compact('returnCustomer','lignereturnCustomers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customers=Customer::all();
        $products = Product::all();
        $returnCustomer=ReturnCustomer::findOrFail($id);
        $lignereturnCustomers=LineReturnCustomer::where('return_customers_id',$id)->get();
        return view('pages.returnvente.edit',compact('returnCustomer','lignereturnCustomers','customers','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReturnCustomerRequest $request, string $id)
    {
        $returnCustomer=ReturnCustomer::findOrFail($id);
        $lignereturnCustomers=LineReturnCustomer::where('return_customers_id',$id)->get();
        foreach ($lignereturnCustomers as  $lignereturnCustomer) {
            $product = Product::find($lignereturnCustomer->products_id);
            $product->decrement('stock_actuel', $lignereturnCustomer->qty_line_return_customer);
        }
        $lignereturnCustomers=LineReturnCustomer::where('return_customers_id',$id)->delete();
        $returnCustomer->description_return_customer=$request->description_return_customer;
        $returnCustomer->total_return_customer=$request->total_return_customer;
        $returnCustomer->customers_id=$request->customers_id;
        $returnCustomer->users_id=Auth::user()->id;
        $returnCustomer->save();
        foreach ($request->products_id as $key => $products_id) {
           $linereturncustomer=new LineReturnCustomer();
           $linereturncustomer->products_id=$request->products_id[$key];
           $linereturncustomer->qty_line_return_customer=$request->qty_line_return_customer[$key];
           $linereturncustomer->price_return_customer=$request->price_return_customer[$key];
           $linereturncustomer->subtotal_return_customer=$request->subtotal_return_customer[$key];
           $linereturncustomer->return_customers_id=$returnCustomer->id;
           $linereturncustomer->save();
           $product = Product::where('id', $request->products_id[$key])->increment('stock_actuel', $request->qty_line_return_customer[$key]);
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
        $returnCustomer=ReturnCustomer::findOrFail($id);
        $lignereturnCustomers=LineReturnCustomer::where('return_customers_id',$id)->get();
        foreach ($lignereturnCustomers as  $lignereturnCustomer) {
            $product = Product::find($lignereturnCustomer->products_id);
            $product->decrement('stock_actuel', $lignereturnCustomer->qty_line_return_customer);
        }
        LineReturnCustomer::where('return_customers_id',$id)->delete();
        $returnCustomer->delete();
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien supprimé !");

        return redirect()->back();
    }
    public function pdftableretourvente(){
        $returncustomers=ReturnCustomer::all();
        $data = [
            'returncustomers' =>  $returncustomers
        ];

        $pdf = PDF::loadView('pages.returnvente.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listeRetouVentes.pdf');
    }
    public function pdfretourvente($id){
        $returnCustomer=ReturnCustomer::findOrFail($id);
        $company=Company::first();
        $lignereturncustomers=LineReturnCustomer::where('return_customers_id',$id)->get();
        $data = [
            'returnCustomer' => $returnCustomer,
            'company'=>$company,
            'lignereturncustomers'=> $lignereturncustomers

        ];

        $pdf = PDF::loadView('pages.returnvente.retournventepdf', $data);

        return $pdf->download('retourvente.pdf');

    }
}
