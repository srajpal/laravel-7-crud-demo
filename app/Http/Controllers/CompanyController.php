<?php

namespace App\Http\Controllers;

use App\Company;
use App\Mail\NewCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    const IMAGE_LOCATION = 'logos';

    /**
     * CompanyController constructor.
     * restrict controller using auth middleware
     */
    public function __construct()
    {
        // Utilize a middleware for the entire controller
        // Only authorized/logged in users can use this controller
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('companies.index')->with([
            // return all companies that belong to this user, include count of employees per company
            'companies' => Auth::user()->companies()->withCount('employees')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the input from the request
        $inputs = $request->validate([
            'name' => ['required', 'min:2', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'logo' => ['nullable', 'file', 'mimetypes:image/*', 'dimensions:min_width=100,min_height=100'],
            'website' => ['nullable', 'url', 'max:255']
        ]);

        // if image provided store it
        if (request('logo')) {
            $inputs['logo'] = $request->file('logo')->store(self::IMAGE_LOCATION);
        }

        // create the company and use ORM to attach to user
        $company = Auth::user()->companies()->create($inputs);

        // use flash to return a message
        session()->flash('message-success','Company, '.$inputs['name'].', created');

        // send an email to site owner informing about a new company created
        Mail::to(env('MAIL_SITE_OWNER_TO', 'no@email.com'))->send(
            new NewCompany($company)
        );

        return redirect(route('companies.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        // Use a Policy to determine if the user is authorized for this action
        $this->authorize('view', $company);
        return view('companies.show')->with(['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        // Use a Policy to determine if the user is authorized for this action
        $this->authorize('view', $company);
        return view('companies.edit')->with(['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        // Use a Policy to determine if the user is authorized for this action
        $this->authorize('update', $company);

        // validate the input from the request
        $inputs = $request->validate([
            'name' => ['required', 'min:2', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'logo' => ['nullable', 'file', 'mimetypes:image/*', 'dimensions:min_width=100,min_height=100'],
            'website' => ['nullable', 'url', 'max:255']
        ]);

        // if image provided store it
        if (request('logo')) {
            if ($company->logo != null){
                // if we already had an image lets update the same file
                $filename = Str::of($company->logo)->basename();
                $inputs['logo'] = $request->file('logo')->storeAs(self::IMAGE_LOCATION,$filename);
            } else {
                $inputs['logo'] = $request->file('logo')->store(self::IMAGE_LOCATION);
            }
        }

        $company->update($inputs);

        // use flash to return a message
        session()->flash('message-success','Company, '.$company->name.', updated');

        return redirect(route('companies.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Company $company)
    {
        // Use a Policy to determine if the user is authorized for this action
        $this->authorize('delete', $company);

        if (!stristr($company->logo,Company::DEFAULT_LOGO)) {
            // if a logo was provided for this company remove it first
            $file = $company->logo;
            $asset_path = Company::getAssetPath();
            if (stristr($file,$asset_path)) {
                // if we are using an accessor to make the path into an asset url
                // remove the asset path from the file path
                $file = str_replace($asset_path,'',$file);
            }
            Storage::delete($file);
        }

        $name = $company->name;
        $company->delete();

        // use flash to return a message
        session()->flash('message-success','Company, '.$name.', was deleted');

        // if we made the companies.destroy call using jQuery.ajax or other ajax method
        // return the status as a JSON string
        if ($request->ajax()) {
            return ['status'=>true];
        }

        return redirect(route('companies.index'));
    }
}
