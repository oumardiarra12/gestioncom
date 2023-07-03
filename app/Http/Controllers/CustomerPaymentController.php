<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\CustomerPayement\StoreCustomerPaymentRequest;
use App\Http\Requests\CustomerPayement\UpdateCustomerPaymentRequest;
use App\Models\Company;
use App\Models\CustomerInvoice;
use App\Models\CustomerPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
class CustomerPaymentController extends Controller
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
        $customerinvoice = CustomerInvoice::findOrFail($id);
        return view('pages.clientpayment.create', compact('customerinvoice'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerPaymentRequest $request,$id)
    {
        $customerinvoice = CustomerInvoice::findOrFail($id);
        CustomerPayment::create([
            'amount_to_be_paid' => $request->amount_to_be_paid,
            'amount_to_pay' => $request->amount_to_pay,
            'reste' => $request->reste,
            'description_customer_payment' => $request->description_customer_payment,
            'customer_invoices_id' => $customerinvoice->id,
            'users_id'=>Auth::user()->id
        ]);
        if($request->reste==0){
            $customerinvoice->status_customer_invoices="pay";
            $customerinvoice->save();
        }elseif($request->reste>0){
            $customerinvoice->status_customer_invoices="partial_pay";
            $customerinvoice->save();
        }
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");
        return redirect()->route('ventefactures.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customerpayment = CustomerPayment::findOrFail($id);
        return view('pages.clientpayment.show', compact('customerpayment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customerpayment = CustomerPayment::findOrFail($id);
        return view('pages.clientpayment.edit', compact('customerpayment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerPaymentRequest $request, string $id)
    {
        $customerpayment = CustomerPayment::findOrFail($id);
        $customerinvoice = CustomerInvoice::where('id',$customerpayment->customer_invoices_id)->first();
        $customerpayment->amount_to_be_paid = $request->amount_to_be_paid;
        $customerpayment->amount_to_pay = $request->amount_to_pay;
        $customerpayment->reste = $request->reste;
        $customerpayment->description_customer_payment = $request->description_customer_payment;
        $customerpayment->update();
        if($request->reste==0){
            $customerinvoice->status_customer_invoices="pay";
            $customerinvoice->save();
        }elseif($request->reste>0){
            $customerinvoice->status_customer_invoices="partial_pay";
            $customerinvoice->save();
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
        $customerpayment = CustomerPayment::findOrFail($id);
       $sumcustomerpayment=CustomerPayment::groupBy('customer_invoices_id')
   ->selectRaw('*, sum(amount_to_pay) as sum')
   ->first();
       $customerinvoice = CustomerInvoice::where('id',$customerpayment->customer_invoices_id)->first();
       if($customerinvoice->total_customer_invoices==$sumcustomerpayment->sum){
        $customerinvoice->status_customer_invoices="pay";
            $customerinvoice->save();
       }elseif($customerinvoice->total_customer_invoices>$sumcustomerpayment->sum||$sumcustomerpayment->sum>0){
        $customerinvoice->status_customer_invoices="partial_pay";
        $customerinvoice->save();
       }else{
        $customerinvoice->status_customer_invoices="no_pay";
            $customerinvoice->save();
       }
        $customerpayment->delete();
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien supprimé !");

        return redirect()->back();
    }
    public function showcustomerpayment($id)
    {
        $customerinvoice = CustomerInvoice::findOrFail($id);
        $customerpayments = CustomerPayment::where("customer_invoices_id", $id)->get();
        return view('pages.clientpayment.showpayment', compact('customerinvoice', 'customerpayments'));
    }
    public function pdfcustomerpayement($id){
        $customerpayment = CustomerPayment::findOrFail($id);
        $company=Company::first();
        $data = [
            'customerpayment' =>  $customerpayment,
            'company'=>$company,
        ];

        $pdf = PDF::loadView('pages.clientpayment.pdfcustomerpayment', $data);

        return $pdf->download('ReglementClient.pdf');
    }
}
