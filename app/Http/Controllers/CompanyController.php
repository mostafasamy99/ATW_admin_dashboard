<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index ()
    {
        $companies = Company::get();
        return view('Dashboard.company.index' , compact('companies'));
    }// end of index method

    public function create ()
    {
        return view('Dashboard.company.create');

    }// end of create method

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:companies,email,$id',
            'website' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,png',
        ]);

        // get logo details
        $logo = $request->file('logo');
        $extenstion = $logo->getClientOriginalExtension();
        $logoName = "Company-". uniqid() . ".$extenstion" ;

        //Move logo to it is folder
        $logo->move( public_path('Uploads/Company') , $logoName);

        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $logoName,
        ]);
        return redirect( route('companies.index') );
    }// end of store method

    public function edit (Company $company)
    {
        return view('Dashboard.company.edit' , compact('company') );
    }// end of edit method

    public function update(Request $request , $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:companies,email,$id',
            'website' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,png',
        ]);

        $company = Company::findOrFail($id);
        $logoName = $company->logo ;

        if( $request->hasFile('logo') )
        {
            if($logoName !== null )
            {
                unlink( public_path('Uploads/Company/') . $logoName);
            }

            // get logo details
            $logo = $request->file('logo');
            $extenstion = $logo->getClientOriginalExtension();
            $logoName = "Company-". uniqid() . ".$extenstion" ;

            //Move logo to it is folder
            $logo->move( public_path('Uploads/Company') , $logoName);
        }
        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $logoName,
        ]);
        return redirect( route('companies.index'));
    }
    public function delete(Company $company)
    {
        if( $company->logo !== null )
        {
            unlink( public_path('Uploads/Company/') . $company->logo );
        }
        $company->delete();
        return redirect( route('companies.index'));
    }
}
