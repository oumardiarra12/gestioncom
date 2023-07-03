<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\UpdateOrCreateRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function createorupdate(){
        $company=Company::first();
        return view('pages.societe.create',compact('company'));
    }
    public function store(UpdateOrCreateRequest $request){
        $imageName="";
        $company=Company::first();
        if($request->file('company_logo')){
            if ($company->company_logo) {
                Storage::delete('public/logosociete/' . $company->company_logo);
              }
            $imageName = 'logo'.'.'.$request->company_logo->extension();
            $request->company_logo->storeAs('public/logosociete', $imageName);

        }else {
            $imageName="companylogo.jpg";
        }
        Company::updateOrCreate([
            'id'=>1
        ],[
            'company_name'=>$request->company_name,
            'company_sigle'=>$request->company_sigle,
            'company_status'=>$request->company_status,
            'company_nif'=>$request->company_nif,
            'company_contact'=>$request->company_contact,
            'company_email'=>$request->company_email,
            'company_bp'=>$request->company_bp,
            'company_fax'=>$request->company_fax,
            'company_address'=>$request->company_address,
            'company_activity'=>$request->company_activity,
            'company_logo'=> $imageName,

        ]);
        return redirect()->back();
    }
}
