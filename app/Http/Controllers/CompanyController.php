<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Show all website companies.
     */
    public function index()
    {
        return Company::all();
    }

    /**
     * Show a specific company.
     */

    public function show(string $id)
    {
        return Company::find($id);
    }

    /**
     * It allows the user to create a company.
     */

    public function store(CompanyRequest $request)
    {
        // Validation passed, create and store the company
        $company = new Company();
        $company->name = $request->input('name');
        $company->description = $request->input('description');
        $company->website = $request->input('website');
        $company->save();
        return $company;
    }

    /**
     * It allows the user to update the given company.
     */
    public function update(CompanyRequest $request, string $id)
    {
        $company = Company::find($id);

        // Validation passed, create and store the company
        $company->update([
            $company->name = $request->input('name'),
            $company->description = $request->input('description'),
            $company->website = $request->input('website'),
        ]);

        return $company;
    }
    /**
     *It allows the user to delete the company
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);

        if ($company) {

            $company->delete();

            return response()->json([

                'Message: ' => 'company deleted with success.',

            ]);
        } else {

            return response([

                'Message: ' => 'We could not find the company.',

            ]);
        }
    }
}
