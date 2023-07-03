<?php

namespace App\Http\Controllers;

use App\Exports\UnitsExport;
use App\Http\Requests\Unite\StoreUniteRequest;
use App\Http\Requests\Unite\UpdateUniteRequest;
use App\Models\Unit;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unites=Unit::all();
        return view('pages.unite.index',compact('unites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.unite.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUniteRequest $request)
    {
        $unite=Unit::create($request->post());
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
       $unite=Unit::findOrFail($id);
       return view('pages.unite.edit',compact('unite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUniteRequest $request, string $id)
    {
        $unite=Unit::findOrFail($id);
        $unite->update($request->post());
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('unites.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $unite=Unit::findOrFail($id);
            $unite->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");
            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode)
            {
                case 23000:
                    return back()->with('error','Cet Unite ne peut pas etre supprimer car il est lie a un Produit.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }

    }
    public function pdftableunite(){
        $unites=Unit::all();
        $data = [
            'unites' => $unites
        ];

        $pdf = PDF::loadView('pages.unite.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listeunites.pdf');
    }
    public function exportunite()
    {
        return Excel::download(new UnitsExport, 'unites.xlsx');
    }
}
