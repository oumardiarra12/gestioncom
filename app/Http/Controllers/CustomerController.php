<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Imports\CustomersImport;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers=Customer::all();
        return view('pages.client.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
       Customer::create($request->post());
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer=Customer::findOrFail($id);
        return view('pages.client.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer=Customer::findOrFail($id);
        return view('pages.client.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id)
    {
        $customer=Customer::findOrFail($id);
        $customer->update($request->post());
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $customer=Customer::findOrFail($id);
            $customer->delete();
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien supprimé !");
            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode)
            {
                case 23000:
                    return back()->with('error','Ce Client ne peut pas etre supprimer car il est lie a un vente.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
    public function importclient(){
        return view('pages.client.import');
    }
    public function storeclient(Request $request){
        $request->validate([
            'importclient' => 'required',
        ]);
        Excel::import(new CustomersImport, request()->file('importclient'));
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");
        return back();
    }
    public function pdftableclient(){
        $customers=Customer::all();
        $data = [
            'customers' => $customers
        ];

        $pdf = PDF::loadView('pages.client.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listeclient.pdf');
    }
    public function exportclient()
    {
        return Excel::download(new CustomerExport, 'clients.xlsx');
    }
}
