<?php

namespace App\Http\Controllers;

use App\Exports\SupplierExport;
use App\Http\Requests\Fournisseur\StoreFournisseurRequest;
use App\Http\Requests\Fournisseur\UpdateFournisseurRequest;
use App\Imports\SuppliersImport;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Routing\Loader\Configurator\ImportConfigurator;
use PDF;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers=Supplier::all();
        return view('pages.fournisseur.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('pages.fournisseur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFournisseurRequest $request)
    {
       Supplier::create($request->post());
       Session::flash('notification.type', 'success');
       Session::flash('notification.message', "L'élément a été bien enregistré !");

       return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier=Supplier::findOrFail($id);
        return view('pages.fournisseur.show',compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier=Supplier::findOrFail($id);
        return view('pages.fournisseur.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFournisseurRequest $request, string $id)
    {
        $supplier=Supplier::findOrFail($id);
        $supplier->update($request->post());
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('fournisseurs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $supplier=Supplier::findOrFail($id);
        $supplier->delete();
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien supprimé !");
            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode)
            {
                case 23000:
                    return back()->with('error','Ce Fournisseur ne peut pas etre supprimer car il est lie a un achat.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
    public function importfournisseur(){
        return view('pages.fournisseur.import');
    }
    public function storefournisseur(Request $request){
        $request->validate([
            'importfournisseur' => 'required',
        ]);
        Excel::import(new SuppliersImport, request()->file('importfournisseur'));
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");
        return back();
    }
    public function pdftablefournisseur(){
        $suppliers=Supplier::all();
        $data = [
            'suppliers' => $suppliers
        ];

        $pdf = PDF::loadView('pages.fournisseur.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listefournisseur.pdf');
    }
    public function exportfournisseur()
    {
        return Excel::download(new SupplierExport, 'fournisseurs.xlsx');
    }
}
