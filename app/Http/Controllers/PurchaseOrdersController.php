<?php

namespace App\Http\Controllers;

use App\Http\Requests\Commandeachat\StoreCommandeachatRequest;
use App\Http\Requests\Commandeachat\UpdateCommandeachatRequest;
use App\Http\Requests\Reception\StoreReceptionRequest;
use App\Models\Company;
use App\Models\LinePurchaseOrder;
use App\Models\LineReception;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Reception;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
class PurchaseOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseorders=PurchaseOrder::all();
        $suppliers=Supplier::all();
        return view('pages.commandeachat.index',compact('purchaseorders','suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers=Supplier::all();
        $products=Product::all();
        return view('pages.commandeachat.create',compact('suppliers','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommandeachatRequest $request)
    {
       $purchaseorder=new PurchaseOrder();
        // $purchaseorder->stats_purchase_order=$request->stats_purchase_order;
        $purchaseorder->description_purchase_order=$request->description_purchase_order;
        $purchaseorder->total_purchase_order=$request->total_purchase_order;
        $purchaseorder->suppliers_id=$request->suppliers_id;
        $purchaseorder->users_id=Auth::user()->id;
        $purchaseorder->save();
        foreach ($request->products_id as $key => $products_id) {
           $linepurchaseorder=new LinePurchaseOrder();
           $linepurchaseorder->products_id=$request->products_id[$key];
           $linepurchaseorder->qty_line_purchase_order=$request->qty_line_purchase_order[$key];
           $linepurchaseorder->price_line_purchase_order=$request->price_line_purchase_order[$key];
           $linepurchaseorder->subtotal_line_purchase_order=$request->subtotal_line_purchase_order[$key];
           $linepurchaseorder->purchase_orders_id=$purchaseorder->id;
           $linepurchaseorder->save();
        }
        // if($request->stats_purchase_order=="receipt"){
        //    $reception=new Reception();
        //     $reception->purchase_orders_id=$purchaseorder->id;
        //     $reception->save();
        //     foreach ($request->products_id as $key => $products_id) {
        //         $linereception=new LineReception();
        //         $linereception->products_id=$request->products_id[$key];
        //         $linereception->qty_line_reception=$request->qty_line_purchase_order[$key];
        //         $linereception->qty_recu_line_reception=$request->qty_line_purchase_order[$key];
        //         $linereception->receptions_id= $reception->id;
        //         $linereception->save();
        //      }
        // }
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchaseorder=PurchaseOrder::findOrFail($id);
        $lingepurchaseorder=LinePurchaseOrder::where('purchase_orders_id',$id)->get();
        return view('pages.commandeachat.show',compact('purchaseorder','lingepurchaseorder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchaseorder=PurchaseOrder::findOrFail($id);
        $lingepurchaseorder=LinePurchaseOrder::where('purchase_orders_id',$id)->get();
        $suppliers=Supplier::all();
        $products=Product::all();
        return view('pages.commandeachat.edit',compact('purchaseorder','lingepurchaseorder','suppliers','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommandeachatRequest $request, string $id)
    {
        $purchaseorder=PurchaseOrder::findOrFail($id);
        $lingepurchaseorder=LinePurchaseOrder::where('purchase_orders_id',$id)->delete();
        // $purchaseorder->stats_purchase_order=$request->stats_purchase_order;
        $purchaseorder->description_purchase_order=$request->description_purchase_order;
        $purchaseorder->total_purchase_order=$request->total_purchase_order;
        $purchaseorder->suppliers_id=$request->suppliers_id;
        $purchaseorder->users_id=Auth::user()->id;
        $purchaseorder->save();
        foreach ($request->products_id as $key => $products_id) {
            $linepurchaseorder=new LinePurchaseOrder();
            $linepurchaseorder->products_id=$request->products_id[$key];
            $linepurchaseorder->qty_line_purchase_order=$request->qty_line_purchase_order[$key];
            $linepurchaseorder->price_line_purchase_order=$request->price_line_purchase_order[$key];
            $linepurchaseorder->subtotal_line_purchase_order=$request->subtotal_line_purchase_order[$key];
            $linepurchaseorder->purchase_orders_id=$purchaseorder->id;
            $linepurchaseorder->save();
         }
         Session::flash('notification.type', 'success');
         Session::flash('notification.message', "L'élément a été bien modifié !");

         return redirect()->route('commandeachats.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $lingepurchaseorder=LinePurchaseOrder::where('purchase_orders_id',$id)->delete();
            $purchaseorder=PurchaseOrder::findOrFail($id);
            $purchaseorder->delete();
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
    public function pdftablepurchaseorder(){
        $purchaseorders=PurchaseOrder::all();
        $data = [
            'purchaseorders' => $purchaseorders
        ];

        $pdf = PDF::loadView('pages.commandeachat.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listeCommandeAchats.pdf');
    }
    public function pdfpurchaseorder($id){
        $purchaseorder=PurchaseOrder::findOrFail($id);
        $company=Company::first();
        $lingepurchaseorder=LinePurchaseOrder::where('purchase_orders_id',$id)->get();
        $data = [
            'purchaseorder' => $purchaseorder,
            'company'=>$company,
            'lingepurchaseorder'=>$lingepurchaseorder,
            'date' => date('m/d/Y')

        ];

        $pdf = PDF::loadView('pages.commandeachat.commandeachatpdf', $data);

        return $pdf->download('commandeachat.pdf');

    }
    // public function updatestatus(Request $request,$id){
    //     $purchaseorder=PurchaseOrder::findOrFail($id);
    //     $lingepurchaseorder=LinePurchaseOrder::where('purchase_orders_id',$id)->get();
    //     $purchaseorder->stats_purchase_order=$request->stats_purchase_order;
    //     $purchaseorder->save();
    //     if($request->stats_purchase_order=="receipt"){
    //         $reception=new Reception();
    //          $reception->purchase_orders_id=$purchaseorder->id;
    //          $reception->save();
    //          foreach ($lingepurchaseorder as  $lingepurchase) {
    //              $linereception=new LineReception();
    //              $linereception->products_id=$lingepurchase->products_id;
    //              $linereception->qty_line_reception=$lingepurchase->qty_line_purchase_order;
    //              $linereception->qty_recu_line_reception=$lingepurchase->qty_line_purchase_order;
    //              $linereception->receptions_id= $reception->id;
    //              $linereception->save();
    //             //  Product::findOrFail($fields['product_id'][$i])->increment('quantity', $quantity);
    //             // foreach ($purchase->products()->get() as $product){
    //             //     $product->decrement('quantity', $product->pivot->quantity);
    //             // }
    //           }
    //      }

    //      return back()->with('success','Le status est modifier avec success');
    // }
    public function receptcreate($id){
        $purchaseorder=PurchaseOrder::findOrFail($id);
        $lingepurchaseorder=LinePurchaseOrder::where('purchase_orders_id',$id)->get();
        return view('pages.reception.receptioncreate',compact('purchaseorder','lingepurchaseorder'));
    }
    public function receptstore(StoreReceptionRequest $request,$id){
        $purchaseorder=PurchaseOrder::findOrFail($id);
        $lingepurchaseorder=LinePurchaseOrder::where('purchase_orders_id',$id)->get();
        $reception=new Reception();
        $reception->purchase_orders_id=$purchaseorder->id;
        $reception->total_reception = $request->total_reception;
        $reception->description_reception = $request->description_reception;
        $reception->users_id=Auth::user()->id;
        $reception->save();
    foreach ($request->products_id as $key => $products_id) {
       $lignereception=new LineReception();
       $lignereception->products_id=$request->products_id[$key];
        $lignereception->qty_line_reception=$request->qty_line_reception[$key];
        $lignereception->qty_recu_line_reception=$request->qty_recu_line_reception[$key];
        $lignereception->price_line_reception = $request->price_line_reception[$key];
        $lignereception->subtotal_line_reception = $request->subtotal_line_reception[$key];
        $lignereception->receptions_id=$reception->id;
        $lignereception->save();
        $lingepurchaseorder=LinePurchaseOrder::where('purchase_orders_id',$id)->where('products_id',$request->products_id[$key])->increment('qty_line_recept', $request->qty_recu_line_reception[$key]);
        $product=Product::where('id',$request->products_id[$key])->increment('stock_actuel', $request->qty_recu_line_reception[$key]);
        if ($lignereception->qty_line_reception>$lignereception->qty_recu_line_reception) {
            $purchaseorder->stats_purchase_order="biased receipt";
            $purchaseorder->save();
        }elseif ($lignereception->qty_line_reception==$lignereception->qty_recu_line_reception) {
            $purchaseorder->stats_purchase_order="receipt";
            $purchaseorder->save();
        }
    }
    Session::flash('notification.type', 'success');
    Session::flash('notification.message', "L'élément a été bien enregistré !");

    return redirect()->back();

    }
}
