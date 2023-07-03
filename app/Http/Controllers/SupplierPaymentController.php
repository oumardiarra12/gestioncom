<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierPayment\StoreSupplierPaymentRequest;
use App\Http\Requests\SupplierPayment\UpdateSupplierPaymentRequest;
use App\Models\Company;
use App\Models\PurchaseInvoice;
use App\Models\SupplierPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;

class SupplierPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $purchaseinvoice = PurchaseInvoice::findOrFail($id);
        return view('pages.fournisseurpayment.create', compact('purchaseinvoice'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierPaymentRequest $request, $id)
    {
        $purchaseinvoice = PurchaseInvoice::findOrFail($id);
        SupplierPayment::create([
            'amount_to_be_paid' => $request->amount_to_be_paid,
            'amount_to_pay' => $request->amount_to_pay,
            'reste' => $request->reste,
            'description_supplier_payment' => $request->description_supplier_payment,
            'purchase_invoices_id' => $purchaseinvoice->id,
            'users_id'=>Auth::user()->id
        ]);
        if($request->reste==0){
            $purchaseinvoice->status_purchase_invoice="pay";
            $purchaseinvoice->save();
        }elseif($request->reste>0){
            $purchaseinvoice->status_purchase_invoice="partial_pay";
            $purchaseinvoice->save();
        }
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");
        return redirect()->route('achatfactures.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplierpayment = SupplierPayment::findOrFail($id);
        return view('pages.fournisseurpayment.show', compact('supplierpayment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplierpayment = SupplierPayment::findOrFail($id);
        return view('pages.fournisseurpayment.edit', compact('supplierpayment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierPaymentRequest $request, string $id)
    {
        $supplierpayment = SupplierPayment::findOrFail($id);
        $purchaseinvoice = PurchaseInvoice::where('id',$supplierpayment->purchase_invoices_id)->first();
        $supplierpayment->amount_to_be_paid = $request->amount_to_be_paid;
        $supplierpayment->amount_to_pay = $request->amount_to_pay;
        $supplierpayment->reste = $request->reste;
        $supplierpayment->description_supplier_payment = $request->description_supplier_payment;
        $supplierpayment->update();
        if($request->reste==0){
            $purchaseinvoice->status_purchase_invoice="pay";
            $purchaseinvoice->save();
        }elseif($request->reste>0){
            $purchaseinvoice->status_purchase_invoice="partial_pay";
            $purchaseinvoice->save();
        }
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplierpayment = SupplierPayment::findOrFail($id);
       $sumsupplierpayment=SupplierPayment::groupBy('purchase_invoices_id')
   ->selectRaw('*, sum(amount_to_pay) as sum')
   ->first();
       $purchaseinvoice = PurchaseInvoice::where('id',$supplierpayment->purchase_invoices_id)->first();
       if($purchaseinvoice->total_purchase_invoice==$sumsupplierpayment->sum){
        $purchaseinvoice->status_purchase_invoice="pay";
            $purchaseinvoice->save();
       }elseif($purchaseinvoice->total_purchase_invoice>$sumsupplierpayment->sum||$sumsupplierpayment->sum>0){
        $purchaseinvoice->status_purchase_invoice="partial_pay";
        $purchaseinvoice->save();
       }else{
        $purchaseinvoice->status_purchase_invoice="no_pay";
            $purchaseinvoice->save();
       }
        $supplierpayment->delete();
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien supprimé !");

        return redirect()->back();
    }
    public function showsupplierpayment($id)
    {
        $purchaseinvoice = PurchaseInvoice::findOrFail($id);
        $supplierpayments = SupplierPayment::where("purchase_invoices_id", $id)->get();
        return view('pages.fournisseurpayment.showpayment', compact('purchaseinvoice', 'supplierpayments'));
    }
    public function pdfsupplierpayement($id){
        $supplierpayment = SupplierPayment::findOrFail($id);
        $company=Company::first();
        $data = [
            'supplierpayment' =>  $supplierpayment,
            'company'=>$company,
        ];

        $pdf = PDF::loadView('pages.fournisseurpayment.pdfsupplierpayment', $data);

        return $pdf->download('ReglementFournisseur.pdf');
    }
}
