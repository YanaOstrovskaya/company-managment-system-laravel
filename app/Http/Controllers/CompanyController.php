<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\EditCompany;
use Intervention\Image\Facades\Image as ImageInt;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $companies = Company::orderBy('id', 'desc')->paginate(10);
        $users = User::all();
        if(isset(Auth::user()->company_id)){
            $logo = Auth::user()->company->logo;
        }
        else{
            $logo = 'default-logo.png';
        }

        return view('company.index')->with(['companies'=>$companies, 'logo'=>$logo, 'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditCompany $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $users = User::all();
        return view('company.edit')->with(['company' => $company, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(EditCompany $request, Company $company)
    {

        if($request->hasFile('logo')){
            $img = ImageInt::make($request->logo)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();});
            $extension = $request->logo->extension();
            $imgName = str_random(20).'.'.$extension;
            $img->save(public_path("images/logo/$imgName"));
        }

        $logo = $request->hasFile('logo')?$imgName:$company->logo;
        //var_dump($request->owner_id);
        //die();
        Company::where('id', $company->id)->update([
            'logo' => $logo,
            'name' => $request->name,
            'adress_line1' => $request->adress_line1,
            'adress_line2' => $request->adress_line2,
            'zip' => $request->zip,
            'province' => $request->province,
            'city' => $request->city,
            'country' => $request->country,
            'owner_id' => $request->owner_id
        ]);

        if(isset($request->owner_id)){
            $user = User::find($request->owner_id);
            $user->company_id = $company->id;
            $user->save();
        }

        return redirect('/company');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company = Company::find($company->id);
        $company->delete();
        return redirect('/company');
    }
}
