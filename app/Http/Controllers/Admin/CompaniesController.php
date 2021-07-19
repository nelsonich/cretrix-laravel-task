<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompaniesController extends Controller
{
    public function companies()
    {
        $companies = Company::paginate(10);

        return view('pages.companies', [
            'companies' => $companies
        ]);
    }

    public function single_company($id)
    {
        $company = Company::find($id);

        return view('pages.single_company', [
            'company' => $company
        ]);
    }

    public function create_company(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email',
            'logo' => 'dimensions:max_width=100,max_height=100'
        ]);

        $name = $request->post('name');
        $email = $request->post('email');
        $webSite = $request->post('web_site');
        $logo = $request->file('logo');

        $company = new Company();
        $company->name = $name;
        $company->email = $email;
        $company->web_site = $webSite;

        $uploadedName = "noImage.png";
        if ($request->file('logo')) {
            $imagePath = $logo;
            $fileName = $imagePath->getClientOriginalName();
            $uploadedName = time() . '_' . $fileName;
            $logo->storeAs('companies', $uploadedName, 'public');
        }

        $company->logo = $uploadedName;
        $company->save();

        return redirect()->back();
    }

    public function update_company(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email',
            'logo' => 'dimensions:max_width=100,max_height=100'
        ]);

        $name = $request->post('name');
        $email = $request->post('email');
        $webSite = $request->post('web_site');
        $logo = $request->file('logo');

        $company = Company::find($id);
        $company->name = $name;
        $company->email = $email;
        $company->web_site = $webSite;

        
        if ($request->hasFile('logo')) {            
            if ($request->file('logo')) {
                $imagePath = $logo;
                $fileName = $imagePath->getClientOriginalName();
                $uploadedName = time() . '_' . $fileName;
                $logo->storeAs('companies', $uploadedName, 'public');
            }

            $company->logo = $uploadedName;
        }

        $company->save();

        return redirect()->back();
    }

    public function remove_company($id)
    {
        Company::destroy($id);

        return redirect('/dashboard/companies');
    }
}
