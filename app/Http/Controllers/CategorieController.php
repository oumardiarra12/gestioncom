<?php

namespace App\Http\Controllers;

use App\Exports\CategoriesExport;
use App\Http\Requests\Categorie\StoreCategorieRequest;
use App\Http\Requests\Categorie\UpdateCategorieRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return view('pages.categorie.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('pages.categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorieRequest $request)
    {
        $categorie=Category::create($request->post());
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
        $categorie=Category::findOrFail($id);
        return view('pages.categorie.edit',compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, string $id)
    {
        $categorie=Category::findOrFail($id);
        $categorie->update($request->post());
        Session::flash('notification.type', 'success');
        Session::flash('notification.message', "L'élément a été bien modifié !");

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $categorie=Category::findOrFail($id);
            $categorie->delete();
            Session::flash('notification.type', 'success');
            Session::flash('notification.message', "L'élément a été bien supprimé !");
            return redirect()->back();
        } catch (\Throwable $th) {
            $dbCode = trim($th->getCode());
            switch ($dbCode)
            {
                case 23000:
                    return back()->with('error','Cette Categorie ne peut pas etre supprimer car elle est lie a un Produit.');
                    break;
                default:
                    $errorMessage = 'database invalid';
            }
        }

    }
    public function pdftablecategorie(){
        $categories=Category::all();
        $data = [
            'categories' => $categories
        ];

        $pdf = PDF::loadView('pages.categorie.pdftable', $data)->setPaper('a4', 'landscape');

        return $pdf->download('listecategories.pdf');
    }
    public function exportcategorie()
    {
        return Excel::download(new CategoriesExport, 'categories.xlsx');
    }
}
