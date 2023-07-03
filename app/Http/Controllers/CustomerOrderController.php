<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Requests\CustomerOrder\StoreCustomerOrderRequest;
use App\Http\Requests\CustomerOrder\UpdateCustomerOrderRequest;
use App\Http\Requests\livraison\StoreDeliveryRequest;
use App\Models\Company;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\Delivery;
use App\Models\LineCustomerOrder;
use App\Models\LineDelivery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;

class CustomerOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customereorders=CustomerOrder::all();
        $customers=Customer::all();
        return view('pages.commandevente.index',compact('customereorders','customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers=Customer::all();
        $products=Product::all();
        return view('pages.commandevente.create',compact('customers','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerOrderRequest $request)
    {
        $customerorder=new CustomerOrder();
        $customerorder->description_customer_order=$request->description_customer_order;
        $customerorder->total_customer_order=$request->total_customer_order;
        $customerorder->customers_id=$request->customers_id;
        $customerorder->users_id=Auth::user()->id;
        $customerorder->save();
        foreach ($request->products_id as $key => $products_id) {
           $linecustomerorder=new LineCustomerOrder();
           $linecustomerorder->products_id=$request->products_id[$key];
           $linecustomerorder->qty_line_customer_order=$request->qty_line_customer_order[$key];
           $linecustomerorder->price_line_customer_order=$request->price_line_customer_order[$key];
           $linecustomerorder->subtotal_line_customer_order=$request->subtotal_line_customer_order[$key];
           $linecustomerorder->customer_orders_id=$customerorder->id;
           $linecustomerorder->save();
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
        $customerorder=CustomerOrder::findOrFail($id);
        $lingecustomerorder=LineCustomerOrder::where('customer_orders_id',$id)->get();
        return view('pages.commandevente.show',compact('customerorder','lingecustomerorder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customerorder=CustomerOrder::findOrFail($id);
        $lingecustomerorder=LineCustomerOrder::where('customer_orders_id',$id)->get();
        $customers=Customer::all();
        $products=Product::all();
        return view('pages.commandevente.edit',compact('customerorder','lingecustomerorder','customers','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerOrderRequest $request, string $id)
    {
        $customerorder=CustomerOrder::findOrFail($id);
        $lingecustomerorder=LineCustomerOrder::where('customer_orders_id',$id)->delete();
        $customerorder->description_customer_order=$request->description_customer_order;
        $customerorder->total_customer_order=$request->total_customer_order;
        $customerorder->customers_id=$request->customers_id;
        $customerorder->users_id=Auth::user()->id;
        $customerorder->save();
        foreach ($request->products_id as $key => $products_id) {
            $linecustomerorder=new LineCustomerOrder();
            $linecustomerorder->products_id=$request->products_id[$key];
            $linecustomerorder->qty_line_customer_order=$request->qty_line_customer_order[$key];
            $linecustomerorder->price_line_customer_order=$request->price_line_customer_order[$key];
            $linecustomerorder->subtotal_line_customer_order=$request->subtotal_line_customer_order[$key];
            $linecustomerorder->customer_orders_id=$customerorder->id;
            $linecustomerorder->save();
         }
         Session::flash('notification.type', 'success');
         Session::flash('notification.message', "L'élément a été bien modifié !");

         return redirect()->route('commandeventes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $customerorder=CustomerOrder::findOrFail($id);
            $lingecustomerorder=LineCustomerOrder::where('customer_orders_id',$id)->delete();
            $customerorder->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");

            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode)
            {
                case 23000:
                    return back()->with('error','Ce Commande Achat ne peut pas etre supprimer car il est receptionne.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
    public function pdftablecustomerorder(){
        $customereorders=CustomerOrder::all();
        $data = [
            'customereorders' => $customereorders
        ];

        $pdf = PDF::loadView('pages.commandevente.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listeCommandeVentes.pdf');
    }
    public function pdfcustomerorder($id){
        $customerorder=CustomerOrder::findOrFail($id);
        $lingecustomerorder=LineCustomerOrder::where('customer_orders_id',$id)->get();
        $company=Company::first();
        $data = [
            'customerorder' => $customerorder,
            'company'=>$company,
            'lingecustomerorder'=>$lingecustomerorder,
            'date' => date('m/d/Y')

        ];

        $pdf = PDF::loadView('pages.commandeVente.commandeventepdf', $data);

        return $pdf->download('commandevente.pdf');

    }
    public function deliverycreate($id){
        $customerorder=CustomerOrder::findOrFail($id);
        $lingecustomerorder=LineCustomerOrder::where('customer_orders_id',$id)->get();
        return view('pages.livraison.createdelivery',compact('customerorder','lingecustomerorder'));
    }
    public function deliverystore(StoreDeliveryRequest $request,$id){
        $customerorder=CustomerOrder::findOrFail($id);
        $lingecustomerorder=LineCustomerOrder::where('customer_orders_id',$id)->get();
        $delivery=new Delivery();
        $delivery->customer_orders_id= $customerorder->id;
        $delivery->total_deliveries = $request->total_deliveries;
        $delivery->description_deliveries = $request->description_deliveries;
        $delivery->users_id=Auth::user()->id;
        $delivery->save();
    foreach ($request->products_id as $key => $products_id) {
       $lignedelivery=new LineDelivery();
       $lignedelivery->products_id=$request->products_id[$key];
       $lignedelivery->qty_line_order=$request->qty_line_order[$key];
       $lignedelivery->qty_line_deliverie=$request->qty_line_deliverie[$key];
       $lignedelivery->price_line_deliverie = $request->price_line_deliverie[$key];
       $lignedelivery->subtotal_line_deliverie = $request->subtotal_line_deliverie[$key];
       $lignedelivery->deliveries_id=$delivery->id;
       $lignedelivery->save();
        $lingecustomerorder=LineCustomerOrder::where('customer_orders_id',$id)->where('products_id',$request->products_id[$key])->increment('qty_line_delivery', $request->qty_line_order[$key]);
        $product=Product::where('id',$request->products_id[$key])->decrement('stock_actuel', $request->qty_line_order[$key]);
        if ($lignedelivery->qty_line_deliverie	>$lignedelivery->qty_line_order) {
            $customerorder->status_customer_order="biased delivery";
            $customerorder->save();
        }elseif ($lignedelivery->qty_line_deliverie	==$lignedelivery->qty_line_order) {
            $customerorder->status_customer_order="delivery";
            $customerorder->save();
        }
    }
    Session::flash('notification.type', 'success');
    Session::flash('notification.message', "L'élément a été bien enregistré !");

    return redirect()->back();

    }
}
