<?php

namespace App\Http\Controllers;

use App\Http\Requests\FactureVente\StoreCustomerInvoiceRequest;
use App\Http\Requests\FactureVente\UpdateCustomerInvoiceRequest;
use App\Models\Company;
use App\Models\CustomerInvoice;
use App\Models\Delivery;
use App\Models\LineCustomerInvoice;
use App\Models\LineDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;

class CustomerInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customerinvoices=CustomerInvoice::all();
        return view('pages.facturevente.index',compact('customerinvoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $delivery=Delivery::findOrFail($id);
        $lignedeliveries=LineDelivery::where('deliveries_id',$id)->get();
        return view('pages.facturevente.create',compact('delivery','lignedeliveries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerInvoiceRequest $request,$id)
    {
        $delivery=Delivery::findOrFail($id);
        $customerinvoices=new CustomerInvoice();
        $customerinvoices->deliveries_id= $delivery->id;
        $customerinvoices->description_customer_invoices=$request->description_customer_invoices;
        $customerinvoices->total_customer_invoices=$request->total_customer_invoices;
        $customerinvoices->users_id=Auth::user()->id;
        $customerinvoices->save();
        foreach ($request->products_id as $key => $products_id) {
            $lignecustomerinvoice=new LineCustomerInvoice();
            $lignecustomerinvoice->products_id=$request->products_id[$key];
            $lignecustomerinvoice->qty_line_customer_invoice=$request->qty_line_customer_invoice[$key];
            $lignecustomerinvoice->price_line_customer_invoice=$request->price_line_customer_invoice[$key];
            $lignecustomerinvoice->subtotal_line_customer_invoice=$request->subtotal_line_customer_invoice[$key];
            $lignecustomerinvoice->customer_invoices_id = $customerinvoices->id;
            $lignecustomerinvoice->save();
        }
        $delivery->status_deliveries="to invoice";
        $delivery->save();
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customerinvoice = CustomerInvoice::findOrFail($id);
        $lignecustomerinvoices = LineCustomerInvoice::where("customer_invoices_id", $id)->get();
        return view('pages.facturevente.show', compact('customerinvoice', 'lignecustomerinvoices'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customerinvoice = CustomerInvoice::findOrFail($id);
        $lignecustomerinvoices = LineCustomerInvoice::where("customer_invoices_id", $id)->get();
        return view('pages.facturevente.edit', compact('customerinvoice', 'lignecustomerinvoices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerInvoiceRequest $request, string $id)
    {
        $customerinvoices = CustomerInvoice::findOrFail($id);
        $lignecustomerinvoices = LineCustomerInvoice::where("customer_invoices_id", $id)->delete();
        $customerinvoices->description_customer_invoices=$request->description_customer_invoices;
        $customerinvoices->total_customer_invoices=$request->total_customer_invoices;
        $customerinvoices->users_id=Auth::user()->id;
        $customerinvoices->save();
        foreach ($request->products_id as $key => $products_id) {
            $lignecustomerinvoice=new LineCustomerInvoice();
            $lignecustomerinvoice->products_id=$request->products_id[$key];
            $lignecustomerinvoice->qty_line_customer_invoice=$request->qty_line_customer_invoice[$key];
            $lignecustomerinvoice->price_line_customer_invoice=$request->price_line_customer_invoice[$key];
            $lignecustomerinvoice->subtotal_line_customer_invoice=$request->subtotal_line_customer_invoice[$key];
            $lignecustomerinvoice->customer_invoices_id = $customerinvoices->id;
            $lignecustomerinvoice->save();
        }
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('ventefactures.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $customerinvoices = CustomerInvoice::findOrFail($id);
        $lignecustomerinvoices = LineCustomerInvoice::where("customer_invoices_id", $id)->delete();
            $delivery=Delivery::findOrFail($customerinvoices->deliveries->id);
            $delivery->status_deliveries="non invoice";
            $delivery->save();
            $customerinvoices->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");

            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode)
            {
                case 23000:
                    return back()->with('error','Cette Facture ne peut pas etre supprimer car il est lie a un reglement.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
    public function pdftableventefacture(){
        $customerinvoices=CustomerInvoice::all();
        $data = [
            'customerinvoices' =>  $customerinvoices
        ];

        $pdf = PDF::loadView('pages.facturevente.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listeFactures.pdf');
    }
    public function pdfventefacture($id){
        $customerinvoice = CustomerInvoice::findOrFail($id);
        $lignecustomerinvoices = LineCustomerInvoice::where("customer_invoices_id", $id)->get();
        $company=Company::first();
        $data = [
            'customerinvoice' => $customerinvoice,
            'company'=>$company,
            'lignecustomerinvoices'=> $lignecustomerinvoices

        ];

        $pdf = PDF::loadView('pages.facturevente.Ventefacturepdf', $data);

        return $pdf->download('facturevente.pdf');

    }
}
