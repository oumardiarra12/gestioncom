<?php

namespace App\Http\Controllers;

use App\Http\Requests\FactureAchat\StoreFactureAchatRequest;
use App\Http\Requests\FactureAchat\UpdateFactureAchatRequest;
use App\Models\Company;
use App\Models\LinePurchaseInvoice;
use App\Models\LinePurchaseOrder;
use App\Models\LineReception;
use App\Models\PurchaseInvoice;
use App\Models\Reception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;

class PurchaseInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseinvoices=PurchaseInvoice::all();
        return view('pages.factureachat.index',compact('purchaseinvoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $reception=Reception::findOrFail($id);
        $lignereceptions=LineReception::where('receptions_id',$id)->get();
        return view('pages.factureachat.create',compact('reception','lignereceptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFactureAchatRequest $request,$id)
    {
        $reception=Reception::findOrFail($id);
        $purchaseinvoice=new PurchaseInvoice();
        $purchaseinvoice->receptions_id=$reception->id;
        $purchaseinvoice->description_purchase_invoice=$request->description_purchase_invoice;
        $purchaseinvoice->total_purchase_invoice=$request->total_purchase_invoice;
        $purchaseinvoice->users_id=Auth::user()->id;
        $purchaseinvoice->save();
        foreach ($request->products_id as $key => $products_id) {
            $lignepurchaseinvoice=new LinePurchaseInvoice();
            $lignepurchaseinvoice->products_id=$request->products_id[$key];
            $lignepurchaseinvoice->qty_line_purchase_invoice=$request->qty_line_purchase_invoice[$key];
            $lignepurchaseinvoice->price_purchase_invoice=$request->price_purchase_invoice[$key];
            $lignepurchaseinvoice->subtotal_purchase_invoice=$request->subtotal_purchase_invoice[$key];
            $lignepurchaseinvoice->purchase_invoices_id=$purchaseinvoice->id;
            $lignepurchaseinvoice->save();
        }
        $reception->status_reception="to invoice";
        $reception->save();
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchaseinvoice = PurchaseInvoice::findOrFail($id);
        $lignepurchaseinvoices = LinePurchaseInvoice::where("purchase_invoices_id", $id)->get();
        return view('pages.factureachat.show', compact('purchaseinvoice', 'lignepurchaseinvoices'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchaseinvoice = PurchaseInvoice::findOrFail($id);
        $lignepurchaseinvoices = LinePurchaseInvoice::where("purchase_invoices_id", $id)->get();
        return view('pages.factureachat.edit', compact('purchaseinvoice', 'lignepurchaseinvoices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFactureAchatRequest $request, string $id)
    {
        $purchaseinvoice = PurchaseInvoice::findOrFail($id);
        $lignepurchaseinvoices = LinePurchaseInvoice::where("purchase_invoices_id", $id)->delete();
        $purchaseinvoice->description_purchase_invoice=$request->description_purchase_invoice;
        $purchaseinvoice->total_purchase_invoice=$request->total_purchase_invoice;
        $purchaseinvoice->users_id=Auth::user()->id;
        $purchaseinvoice->save();
        foreach ($request->products_id as $key => $products_id) {
            $lignepurchaseinvoice=new LinePurchaseInvoice();
            $lignepurchaseinvoice->products_id=$request->products_id[$key];
            $lignepurchaseinvoice->qty_line_purchase_invoice=$request->qty_line_purchase_invoice[$key];
            $lignepurchaseinvoice->price_purchase_invoice=$request->price_purchase_invoice[$key];
            $lignepurchaseinvoice->subtotal_purchase_invoice=$request->subtotal_purchase_invoice[$key];
            $lignepurchaseinvoice->purchase_invoices_id=$purchaseinvoice->id;
            $lignepurchaseinvoice->save();
        }
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('achatfactures.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $purchaseinvoice = PurchaseInvoice::findOrFail($id);
            $reception=Reception::findOrFail($purchaseinvoice->reception->id);
            $reception->status_reception="non invoice";
            $reception->save();
            $lignepurchaseinvoices = LinePurchaseInvoice::where("purchase_invoices_id", $id)->delete();
            $purchaseinvoice->delete();
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
    public function pdftableachatfacture(){
        $purchaseinvoices=PurchaseInvoice::all();
        $data = [
            'purchaseinvoices' =>  $purchaseinvoices
        ];

        $pdf = PDF::loadView('pages.factureachat.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listeFactures.pdf');
    }
    public function pdfachatfacture($id){
        $purchaseinvoice = PurchaseInvoice::findOrFail($id);
        $lignepurchaseinvoices = LinePurchaseInvoice::where("purchase_invoices_id", $id)->get();
        $company=Company::first();
        $data = [
            'purchaseinvoice' => $purchaseinvoice,
            'company'=>$company,
            'lignepurchaseinvoices'=> $lignepurchaseinvoices

        ];

        $pdf = PDF::loadView('pages.factureachat.achatfacturepdf', $data);

        return $pdf->download('factureachat.pdf');

    }
}
