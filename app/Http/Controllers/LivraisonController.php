<?php

namespace App\Http\Controllers;

use App\Http\Requests\livraison\StoreDeliveryRequest;
use App\Http\Requests\livraison\UpdateDeliveryRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\CustomerOrder;
use App\Models\Delivery;
use App\Models\LineCustomerOrder;
use App\Models\LineDelivery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;

class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::all();
        return view('pages.livraison.index', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $categories = Category::all();
        foreach($products as $product){
            $categoryid[]  = $product->category_id;
        }

        $cates = Category::with('products')->get();
        return view('pages.livraison.create', compact('products', 'categories','categoryid'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeliveryRequest $request)
    {
        $delivery = new Delivery();
        // $delivery->customer_orders_id= $customerorder->id;
        $delivery->total_deliveries = $request->total_deliveries;
        $delivery->description_deliveries = $request->description_deliveries;
        $delivery->users_id = Auth::user()->id;
        $delivery->save();
        foreach ($request->products_id as $key => $products_id) {
            $lignedelivery = new LineDelivery();
            $lignedelivery->products_id = $request->products_id[$key];
            $lignedelivery->qty_line_order = $request->qty_line_order[$key];
            $lignedelivery->qty_line_deliverie = $request->qty_line_deliverie[$key];
            $lignedelivery->price_line_deliverie = $request->price_line_deliverie[$key];
            $lignedelivery->subtotal_line_deliverie = $request->subtotal_line_deliverie[$key];
            $lignedelivery->deliveries_id = $delivery->id;
            $lignedelivery->save();
            $product = Product::where('id', $request->products_id[$key])->decrement('stock_actuel', $request->qty_line_order[$key]);
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
        $delivery = Delivery::findOrFail($id);
        $lignedeliveries = LineDelivery::where("deliveries_id", $id)->get();
        $customerorder = CustomerOrder::where("id", $delivery->customer_orders_id)->get();
        return view('pages.livraison.show', compact('delivery', 'lignedeliveries', 'customerorder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $delivery = Delivery::findOrFail($id);
        $lignedeliveries = LineDelivery::where("deliveries_id", $id)->get();
        $products = Product::all();
        return view('pages.livraison.edit', compact('delivery', 'lignedeliveries', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeliveryRequest $request, string $id)
    {
        $delivery = Delivery::findOrFail($id);
        $lignedeliveries = LineDelivery::where("deliveries_id", $id)->get();
        foreach ($lignedeliveries as  $lignedeliverie) {
            $product = Product::find($lignedeliverie->products_id);
            $product->increment('stock_actuel', $lignedeliverie->qty_line_order);
        }
        $lignedeliveries = LineDelivery::where("deliveries_id", $id)->delete();
        // $delivery->customer_orders_id= $customerorder->id;
        $delivery->total_deliveries = $request->total_deliveries;
        $delivery->description_deliveries = $request->description_deliveries;
        $delivery->users_id = Auth::user()->id;
        $delivery->save();
        foreach ($request->products_id as $key => $products_id) {
            $lignedelivery = new LineDelivery();
            $lignedelivery->products_id = $request->products_id[$key];
            $lignedelivery->qty_line_order = $request->qty_line_order[$key];
            $lignedelivery->qty_line_deliverie = $request->qty_line_deliverie[$key];
            $lignedelivery->price_line_deliverie = $request->price_line_deliverie[$key];
            $lignedelivery->subtotal_line_deliverie = $request->subtotal_line_deliverie[$key];
            $lignedelivery->deliveries_id = $delivery->id;
            $lignedelivery->save();
            $product = Product::where('id', $request->products_id[$key])->decrement('stock_actuel', $request->qty_line_order[$key]);
        }
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('livraisons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $delivery = Delivery::findOrFail($id);
            $lignedeliveries = LineDelivery::where("deliveries_id", $id)->get();
            $purchaseorder = CustomerOrder::findOrFail($delivery->customer_order->id);

            foreach ($lignedeliveries as  $lignedeliverie) {
                $product = Product::find($lignedeliverie->products_id);
                $product->increment('stock_actuel', $lignedeliverie->qty_line_order);
            }
            LineDelivery::where("deliveries_id", $id)->delete();
            $delivery->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode) {
                case 23000:
                    return back()->with('error', 'Cette Livraison ne peut pas etre supprimer car il est lie a un Facture.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
    public function pdftablelivraison()
    {
        $deliveries = Delivery::all();
        $data = [
            'deliveries' => $deliveries
        ];

        $pdf = PDF::loadView('pages.livraison.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listeLivraisons.pdf');
    }
    public function pdflivraison($id)
    {
        $company = Company::first();
        $delivery = Delivery::findOrFail($id);
        $lignedeliveries = LineDelivery::where("deliveries_id", $id)->get();
        $data = [
            'delivery' => $delivery,
            'company' => $company,
            'lignedeliveries' => $lignedeliveries

        ];

        $pdf = PDF::loadView('pages.livraison.livraisonpdf', $data);

        return $pdf->download('livraison.pdf');
    }
}
