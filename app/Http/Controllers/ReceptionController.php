<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reception\StoreDirectReceptionRequest;
use App\Http\Requests\Reception\UpdateReceptionRequest;
use App\Models\Category;
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
class ReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receptions = Reception::all();
        return view('pages.reception.index', compact('receptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('pages.reception.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDirectReceptionRequest $request)
    {
        $reception = new Reception();
        $reception->total_reception = $request->total_reception;
        $reception->description_reception = $request->description_reception;
        $reception->users_id=Auth::user()->id;
        $reception->save();
        foreach ($request->products_id as $key => $products_id) {
            $lignereception = new LineReception();
            $lignereception->products_id = $request->products_id[$key];
            $lignereception->qty_line_reception = $request->qty_line_reception[$key];
            $lignereception->qty_recu_line_reception = $request->qty_recu_line_reception[$key];
            $lignereception->price_line_reception = $request->price_line_reception[$key];
            $lignereception->subtotal_line_reception = $request->subtotal_line_reception[$key];
            $lignereception->receptions_id = $reception->id;
            $lignereception->save();
            $product = Product::where('id', $request->products_id[$key])->increment('stock_actuel', $request->qty_recu_line_reception[$key]);
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
        $reception = Reception::findOrFail($id);
        $lignereceptions = LineReception::where("receptions_id", $id)->get();
        $purchaseorder = PurchaseOrder::where("id", $reception->purchase_orders_id)->get();
        return view('pages.reception.show', compact('reception', 'lignereceptions', 'purchaseorder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reception = Reception::findOrFail($id);
        $lignereceptions = LineReception::where("receptions_id", $id)->get();
        $products = Product::all();
        return view('pages.reception.edit', compact('reception', 'lignereceptions', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReceptionRequest $request, string $id)
    {
        $reception = Reception::findOrFail($id);
        $lignereceptions = LineReception::where("receptions_id", $id)->get();

        foreach ($lignereceptions as  $lignereception) {
            $product = Product::find($lignereception->products_id);
            $product->decrement('stock_actuel', $lignereception->qty_recu_line_reception);
        }

        $lignereceptions = LineReception::where("receptions_id", $id)->delete();
        $reception->total_reception = $request->total_reception;
        $reception->description_reception = $request->description_reception;
        $reception->users_id=Auth::user()->id;
        $reception->save();
        foreach ($request->products_id as $key => $products_id) {
            $lignereception=new LineReception();
            $lignereception->products_id = $request->products_id[$key];
            $lignereception->qty_line_reception = $request->qty_line_reception[$key];
            $lignereception->qty_recu_line_reception = $request->qty_recu_line_reception[$key];
            $lignereception->price_line_reception = $request->price_line_reception[$key];
            $lignereception->subtotal_line_reception = $request->subtotal_line_reception[$key];
            $lignereception->receptions_id = $reception->id;
            $lignereception->save();
            $product = Product::where('id', $request->products_id[$key])->increment('stock_actuel', $request->qty_recu_line_reception[$key]);
        }
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('receptions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $reception = Reception::findOrFail($id);
            $lignereceptions = LineReception::where("receptions_id", $id)->get();
            $purchaseorder=PurchaseOrder::findOrFail($reception->purchase_order->id);
            // $lingepurchaseorders=LinePurchaseOrder::where('purchase_orders_id',$reception->purchase_order->id)->get();
            // foreach ($lingepurchaseorders as  $lingepurchaseorder) {
            //     foreach ($lignereceptions as  $lignereception) {
            //     $lingepurchaseorder->decrement('qty_line_recept',$lignereception->qty_recu_line_reception);
            //     }
            // }
            foreach ($lignereceptions as  $lignereception) {
                $product = Product::find($lignereception->products_id);
                $product->decrement('stock_actuel', $lignereception->qty_recu_line_reception);
            }
            LineReception::where("receptions_id", $id)->delete();
            $reception->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode)
            {
                case 23000:
                    return back()->with('error','Cette Reception ne peut pas etre supprimer car il est lie a un Facture.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
    public function pdftablereception(){
    $receptions=Reception::all();
    $data = [
        'receptions' => $receptions
    ];

    $pdf = PDF::loadView('pages.reception.pdftable', $data)->setPaper('a4', 'landscape');

    return $pdf->download('listeReceptions.pdf');
}
public function pdfreception($id){
    $reception=Reception::findOrFail($id);
    $company=Company::first();
    $lignereceptions=LineReception::where('receptions_id',$id)->get();
    $data = [
        'reception' => $reception,
        'company'=>$company,
        'lignereceptions'=>$lignereceptions

    ];

    $pdf = PDF::loadView('pages.reception.receptionpdf', $data);

    return $pdf->download('reception.pdf');

}


}
