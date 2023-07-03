<?php

namespace App\Http\Controllers;

use App\Exports\ExpenseTypeExport;
use App\Http\Requests\ExpenseType\StoreExpenseTypeRequest;
use App\Http\Requests\ExpenseType\UpdateExpenseTypeRequest;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
class ExpenseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expensetypes=ExpenseType::all();
        return view('pages.categoriedepense.index',compact('expensetypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.categoriedepense.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseTypeRequest $request)
    {
        $expensetype=ExpenseType::create($request->post());
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien enregistré !");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expensetype=ExpenseType::findOrFail($id);
        return view('pages.categoriedepense.edit',compact('expensetype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseTypeRequest $request, string $id)
    {
        $expensetype=ExpenseType::findOrFail($id);
        $expensetype->update($request->post());
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('typedepenses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $expensetype=ExpenseType::findOrFail($id);
            $expensetype->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");
            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode)
            {
                case 23000:
                    return back()->with('error','Ce Type de Depense ne peut pas etre supprimer car elle est lie a un Depense.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }
    }
    public function pdftabletypedepense(){
        $expensetypes=ExpenseType::all();
        $data = [
            'expensetypes' => $expensetypes
        ];

        $pdf = PDF::loadView('pages.categoriedepense.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listeexpensetypes.pdf');
    }
    public function exporttypedepense()
    {
        return Excel::download(new ExpenseTypeExport, 'typeexpense.xlsx');
    }
}
