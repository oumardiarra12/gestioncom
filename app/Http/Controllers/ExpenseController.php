<?php

namespace App\Http\Controllers;

use App\Exports\ExpenseExport;
use App\Http\Requests\Expense\StoreExpenseRequest;
use App\Http\Requests\Expense\UpdateExpenseRequest;
use App\Models\Company;
use App\Models\Expense;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses=Expense::all();
        return view('pages.depense.index',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expensetypes=ExpenseType::all();
        return view('pages.depense.create',compact('expensetypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        $expense=Expense::create($request->post());
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $expense=Expense::findOrFail($id);
        return view('pages.depense.show',compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expensetypes=ExpenseType::all();
        $expense=Expense::findOrFail($id);
        return view('pages.depense.edit',compact('expense','expensetypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, string $id)
    {
        $expense=Expense::findOrFail($id);
        $expense->update($request->post());
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('depenses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense=Expense::findOrFail($id);
        $expense->delete();
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien supprimé !");
        return redirect()->back();
    }
    public function depensepdf($id){
        $expense=Expense::findOrFail($id);
        $company=Company::first();
        $data = [
            'expense' =>  $expense,
            'company'=>$company,
        ];

        $pdf = PDF::loadView('pages.depense.depensepdf', $data);

        return $pdf->download('Depense.pdf');
    }
    public function pdftabledepense(){
        $expenses=Expense::all();
        $data = [
            'expenses' => $expenses
        ];

        $pdf = PDF::loadView('pages.depense.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listedepenses.pdf');
    }
    public function exportdepense()
    {
        return Excel::download(new ExpenseExport, 'expense.xlsx');
    }
}
